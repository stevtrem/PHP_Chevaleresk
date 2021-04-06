
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
