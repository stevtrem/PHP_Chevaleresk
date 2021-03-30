create procedure ajoutItem
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
	delete from Panier where idJoueur = @idJoueur;
end;