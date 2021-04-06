-- Procedure pour ajuster le solde d'un joueur en tant qu'administrateur

GO;
DROP PROCEDURE AjusterSolde;
GO;
CREATE OR ALTER PROCEDURE AjusterSolde (@idJoueur INT,
										@montant MONEY) AS
BEGIN TRANSACTION
	if (@montant > 0)
		UPDATE Joueurs SET montantInitial = montantInitial + @montant WHERE idJoueur = @idJoueur;
	else
		RAISERROR(15600, 16, 1, 'Le montant est invalide');
COMMIT;
