-- Procedure pour insere un nouveau joueur dans la table "Joueurs"

USE Cheveleresk;

GO;
DROP PROCEDURE InsererJoueur;
GO;
CREATE OR ALTER PROCEDURE InsererJoueur (@alias VARCHAR(32),
										 @nom VARCHAR(32),
										 @prenom VARCHAR(32),
										 @password VARCHAR(30)) AS
BEGIN
DECLARE @idJoueur INT, @montantInitial MONEY, @MPencrypte VARBINARY(MAX);
BEGIN TRY
	SELECT @MPencrypte = HASHBYTES('SHA2_512',@password);
	SELECT @montantInitial = 1500;
	BEGIN TRANSACTION
		IF (@alias IN (SELECT alias FROM Joueurs))
			ROLLBACK;
		ELSE
			INSERT INTO Joueurs(alias, nom, prenom, montantInitial, motdepasse)
			VALUES (@alias, @nom, @prenom, @montantInitial, @MPencrypte);
	COMMIT;
END TRY
BEGIN CATCH
	IF @@TRANCOUNT > 0 ROLLBACK;
	RAISERROR(15600, 16, 1, 'L''insertion d''un nouveau joueur a �chou�');
END CATCH
END;

---------------------------------
GO;
EXECUTE InsererJoueur
@alias = 'bobo',
@nom = 'Tremblay',
@prenom = 'Steven';

GO;
EXECUTE InsererJoueur
@alias = 'baba',
@nom = 'Tremblay',
@prenom = 'Steven',
@password = '123456';

Select * from joueurs;
DBCC CHECKIDENT ('Joueurs', RESEED, 0);
delete from Joueurs;

---------------------------------

GO;
DROP PROCEDURE LoginJoueur;
GO;
CREATE OR ALTER PROCEDURE LoginJoueur (@alias VARCHAR(32),
									   @password VARCHAR(30)) AS
BEGIN
DECLARE @MPencrypte VARBINARY(MAX);
BEGIN TRY
	SELECT @MPencrypte = HASHBYTES('SHA2_512',@password);
	BEGIN TRANSACTION
		IF (@alias IN (SELECT alias FROM Joueurs) AND 
			@MPencrypte = (SELECT motdepasse FROM Joueurs where alias = @alias))
			SELECT * FROM Joueurs WHERE alias = @alias;
		ELSE
			RAISERROR(15600, 16, 1, 'Le login a échoué');
	COMMIT;
END TRY
BEGIN CATCH
	IF @@TRANCOUNT > 0 ROLLBACK;
	RAISERROR(15600, 16, 1, 'Le login a échoué');
END CATCH
END;

---------------------------------

EXECUTE LoginJoueur
@alias = 'baba',
@password = '123456';

Select * from joueurs;
DBCC CHECKIDENT ('Joueurs', RESEED, 0);
delete from Joueurs;

---------------------------------

GO
create PROCEDURE addItem (@idJoueur INT, @idItem INT)
AS
BEGIN
  if exists(select * from Panier where idJoueur = @idJoueur and idItem = @idItem)
    update Panier set qtItem = qtItem + 1 where idJoueur = @idJoueur and idItem = @idItem;
  else 
    insert into Panier values(@idJoueur, @idItem, 1);
END;

exec addItem
@idJoueur = 1,
@idItem = 1;

-------------------------------------------