
create or alter procedure ajoutItem
(@nomItem varchar(32),
@qtStock int,
@type char(3),
@prix money,
@url VARCHAR(256),
@efficacite int = NULL,
@genre VARCHAR(32) = NUll,
@descriptionArme VARCHAR(256) = NULL,
@matiere VARCHAR(32) = NULL,
@poids VARCHAR(32) = NULL,
@taille VARCHAR(32) = NULL,
@effet VARCHAR(128) = NULL,
@duree int = NULL,
@descriptionRes VARCHAR(64) = NULL)
as
begin
  DECLARE @id int;
	if(@type = 'WPN')
  BEGIN
    if(@efficacite is not null and @genre is not null and @descriptionArme is not null)
    BEGIN
      insert into Items values(@nomItem, @qtStock, @type, @prix, @url, 'o');
      set @id = @@IDENTITY
      insert into Armes values(@id, @efficacite, @genre, @descriptionArme);
    END
  END
  ELSE if(@type = 'POT')
  BEGIN
    if(@effet is not null and @duree is not null)
    BEGIN
      insert into Items values(@nomItem, @qtStock, @type, @prix, @url, 'o');
      set @id = @@IDENTITY
      insert into Potions values(@id, @effet, @duree);
    END
  end;
  ELSE if(@type = 'ARM')
  BEGIN
    if(@matiere is not null and @poids is not null and @taille is not null)
    BEGIN
      insert into Items values(@nomItem, @qtStock, @type, @prix, @url, 'o')
      set @id = @@IDENTITY
      insert into Armures values(@id, @matiere, @poids, @taille)
    END
  end;
  ELSE if(@type = 'RES')
  BEGIN
    if(@descriptionRes is not null)
    BEGIN
      insert into Items values(@nomItem, @qtStock, @type, @prix, @url, 'o')
      set @id = @@IDENTITY
      insert into Ressource values(@id, @descriptionRes) 
    END
  end;
end;


EXEC ajoutItem 
@nomItem = 'Patate',
@qtStock= 10,
@type ='POT',
@prix =100,
@url ='test',
@effet ='ahah',
@duree = 99;


go
create or alter procedure DeleteItemCascade
(@idItem int)
as
begin
declare
@type char(3);
select @type = typeItem from Items where idItem = @idItem;

	if exists(select * from inventaireJoueur where idItem = @idItem)
	begin
		update Items set disponible = 'N' where idItem = @idItem;
	end
	else
	begin
	if exists(select * from Panier where idItem = @idItem)
	begin
		delete from Panier where idItem = @idItem;
	end
		if(@type = 'WPN')
		begin
			delete from Armes where idItem = @idItem;
			delete from Items where idItem = @idItem;
		end
		else if(@type = 'ARM')
		begin
			delete from Armures where idItem = @idItem;
			delete from Items where idItem = @idItem;
		end
		else if(@type = 'POT')
		begin
			delete from Potions where idItem = @idItem;
			delete from Items where idItem = @idItem;
		end
		else if(@type = 'RES')
		begin
			delete from Ressource where idItem = @idItem;
			delete from Items where idItem = @idItem;
		end
	end
end;