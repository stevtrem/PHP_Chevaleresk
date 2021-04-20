-- Procedure pour insere ou mettre a jour une evaluation dans la table evaluations

USE Cheveleresk;

GO;
DROP PROCEDURE evaluerItem;
GO;
CREATE OR ALTER PROCEDURE evaluerItem (@idJoueur int,
									   @idItem int,
									   @evaluation int,
									   @commentaire varchar(256)) AS
BEGIN
BEGIN TRY
	IF exists(SELECT * FROM evaluations WHERE idJoueur = @idJoueur AND idItem = @idItem)
		UPDATE evaluations SET evaluation = @evaluation, commentaire = @commentaire WHERE idJoueur = @idJoueur AND idItem = @idItem;
	ELSE
		INSERT INTO evaluations VALUES(@idJoueur, @idItem, @evaluation, @commentaire);
END TRY
BEGIN CATCH
	IF @@TRANCOUNT > 0 ROLLBACK;
	RAISERROR(15600, 16, 1, 'L''évaluation a échoué');
END CATCH
END;