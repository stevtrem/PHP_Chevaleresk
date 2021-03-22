go;
create or alter procedure AjusterInventaireJoueur
(@idJoueur int,@idItem int,@quantite int)
as
begin
	if exists(select 1 from inventaireJoueur where idItem = @idItem and idJoueur = @idJoueur)
		begin
			update inventaireJoueur set qtItem = qtItem+@quantite where idItem = @idItem and idJoueur = @idJoueur;
			update Items set qtStockItem = qtStockItem-@quantite where idItem = @idItem;
		end;
	else
		begin
			insert into inventaireJoueur values(@idJoueur,@idItem,@quantite);
			update Items set qtStockItem = qtStockItem-@quantite where idItem = @idItem;
		end;	
end;





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