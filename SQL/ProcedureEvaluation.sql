-- Procedure pour insere ou mettre a jour une evaluation dans la table evaluations

USE Cheveleresk;

GO;
DROP PROCEDURE evaluerItem;
GO;
CREATE OR ALTER PROCEDURE evaluerItem (@evaluation int,
									   @idJoueur int,
									   @idItem int) AS
BEGIN
BEGIN TRY
	IF exists(SELECT * FROM evaluations WHERE idJoueur = @idJoueur AND idItem = @idItem)
		UPDATE evaluations SET evaluation = @evaluation WHERE idJoueur = @idJoueur AND idItem = @idItem;
	ELSE
		INSERT INTO evaluations VALUES(@idJoueur, @idItem, @evaluation);
END TRY
BEGIN CATCH
	IF @@TRANCOUNT > 0 ROLLBACK;
	RAISERROR(15600, 16, 1, 'L''évaluation a échoué');
END CATCH
END;