-- Procédures stockées

-- Procédure pour inséré un nouveau joueur dans la table "Joueurs"

USE Cheveleresk;

GO;
DROP PROCEDURE InsererJoueur;
GO;
CREATE OR ALTER PROCEDURE InsererJoueur (@alias VARCHAR(32),
										 @nom VARCHAR(32),
										 @prenom VARCHAR(32)) AS
BEGIN
DECLARE @idJoueur INT, @montantInitial MONEY;
BEGIN TRY
	SELECT @montantInitial = 1500;
	BEGIN TRANSACTION
		IF (@alias IN (SELECT alias FROM Joueurs))
			ROLLBACK;
		ELSE
			INSERT INTO Joueurs(alias, nom, prenom, montantInitial)
			VALUES (@alias, @nom, @prenom, @montantInitial);
	COMMIT;
END TRY
BEGIN CATCH
	IF @@TRANCOUNT > 0 ROLLBACK;
	RAISERROR(15600, 16, 1, 'L''insertion d''un nouveau joueur a échoué');
END CATCH
END;

GO;
EXECUTE InsererJoueur
@alias = 'bobo',
@nom = 'Tremblay',
@prenom = 'Steven';

GO;
EXECUTE InsererJoueur
@alias = 'baba',
@nom = 'Tremblay',
@prenom = 'Steven';

Select * from joueurs;
DBCC CHECKIDENT ('Joueurs', RESEED, 0);
delete from Joueurs;