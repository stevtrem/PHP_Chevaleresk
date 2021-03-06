go;
create or alter procedure AjusterInventaire
(@idJoueur int)
as
begin
	set nocount on;

	declare
	@idItem int,
	@quantite int;

	declare
	@counter int
	set @counter = 1;

	declare itemPanier cursor read_only
	for
	select idItem,qtItem from Panier where idJoueur = @idJoueur;

	open itemPanier;

	fetch next from itemPanier into 
	@idItem,@quantite;

	while @@FETCH_STATUS = 0
	begin
		if exists(select * from inventaireJoueur where idItem = @idItem and idJoueur = @idJoueur)
		begin
			update inventaireJoueur set qtItem = qtItem+@quantite where idItem = @idItem and idJoueur = @idJoueur;
			update Items set qtStockItem = qtStockItem-@quantite where idItem = @idItem;
		end;
		else
		begin
			insert into inventaireJoueur values(@idJoueur,@idItem,@quantite);
			update Items set qtStockItem = qtStockItem-@quantite where idItem = @idItem;
		end;
		
		set @counter = @counter+1;

		fetch next from itemPanier into 
		@idItem,@quantite;
	end;

	close itemPanier;
	deallocate itemPanier;
end;

select * from Panier;
select * from inventaireJoueur;
select * from Items;
execute AjusterInventaire
1;
drop table inventaireJoueur;


go;
create or alter function montantPanier(@idjoueur int) 
returns money
as
begin
declare 
@somme money;
select @somme = sum(Items.prixUnitaireItem * Panier.qtItem) from Panier 
inner join Items on Panier.idItem = Items.idItem
where Panier.idJoueur = @idjoueur;

	return @somme;
end;

select * from Joueurs;
select * from Panier;
select * from Items;
insert into Panier values(1,1,1);
update Panier set qtItem = 2 where idJoueur = 1;
select dbo.montantPanier(1);


create or alter procedure QuantiteFondSuffisant
(@montantPanier money,@idJoueur int, @result bit output)
as
begin
	declare
	@soldeJoueur money;
	select @soldeJoueur = montantInitial from Joueurs where idJoueur = @idJoueur;
	
	if(@montantPanier > @soldeJoueur)
	begin
		set @result = 0;
	end;
	else
	begin 
		set @result = 1;
	end;
end;

declare @resultat bit;
execute QuantiteFondSuffisant
1000,1,@resultat out;
print(@resultat);




create or alter procedure ClearPanier
(@idJoueur int)
as
begin
	delete from Panier where idJoueur = @idJoueur;
end;




create or alter procedure Checkout (@idJoueur int)
as
begin
BEGIN TRAN
	declare 
	@montant money,
	@isValide bit,
	@inventaireDispo bit;
	select @montant = dbo.montantPanier(@idJoueur);

	execute QuantiteFondSuffisant
	@montant,@idJoueur,@isValide out;

	execute InventaireValide @idJoueur, @inventaireDispo out;

	if(@isValide = 1 and @inventaireDispo = 1)
	begin
		execute AjusterInventaire @idJoueur;
		execute PayerPanier @idJoueur,@montant;
		execute ClearPanier @idJoueur;
    commit;
	end;
	else
    ROLLBACK;
  end

select * from Joueurs;
select * from Panier;
select * from Items;
select * from inventaireJoueur;
insert into Panier values(3,1,1);

declare @resultatCheckOut bit;
execute Checkout
3,@resultatCheckOut out;
print(@resultatCheckOut);




create or alter procedure PayerPanier
(@idJoueur int, @montant money)
as
begin
	update Joueurs set montantInitial = montantInitial-@montant where idJoueur = @idJoueur;
end;


create or alter procedure ItemDisponible
(@idItem int, @quantiteAcheter int,@result bit output)
as
begin
	declare @quantite int;
	select @quantite = qtStockItem from Items where idItem = @idItem;

	if(@quantiteAcheter <= @quantite)
	begin
		set @result = 1;
	end;
	else
	begin
		set @result = 0;
	end;
end;

create or alter procedure InventaireValide
(@idJoueur int,@result bit output)
as
begin
	set nocount on;

	declare
	@idItem int,
	@quantite int;

	declare
	@counter int
	set @counter = 1;

	declare quantiteItem cursor read_only
	for
	select idItem,qtItem from Panier where idJoueur = @idJoueur;

	open quantiteItem;

	fetch next from quantiteItem into 
	@idItem,@quantite;

	while @@FETCH_STATUS = 0
	begin
		execute ItemDisponible @idItem,@quantite,@result out;
		if(@result = 1)
		begin
			set @counter = @counter+1;
			set @result = 1;
			fetch next from quantiteItem into 
			@idItem,@quantite;
		end;
		else
		begin
			set @result = 0;
			close quantiteItem;
			deallocate quantiteItem;
			return;
		end;
	end;

	close quantiteItem;
	deallocate quantiteItem;
end;