drop table Armes;
drop table Armures;
drop table Potions;
drop table Panier;
drop table InventaireJoueur;
drop table Items;

select * from Items;
select * from Armes;

--insertion des évaluations
insert into evaluations values(1, 1, 3, "L'item est tres utile");
insert into evaluations values(1, 3, 3, "L'objet m'a servi dans des moments precis");
insert into evaluations values(1, 4, 3, "Item d'une valeur moyenne");
insert into evaluations values(1, 13, 4, "J'ai adorer cet objet");
insert into evaluations values(1, 14, 4, "Vraiment pratique!");
insert into evaluations values(1, 15, 4, "Vraiment un super item");
insert into evaluations values(1, 16, 1, "L'objet est extremement mediocre");
insert into evaluations values(1, 19, 5, "Cet objet a une puissance quasi illimitee");

insert into evaluations values(2, 6, 4, "Puissance d'attaque incomparable");
insert into evaluations values(2, 13, 2, "Je suis mort plusieurs fois en utilisant cet objet");
insert into evaluations values(2, 14, 5, "Objet legendaire!");
insert into evaluations values(2, 15, 4, "Tres pratique, m'a sauver la peau plus d''une fois");
insert into evaluations values(2, 16, 4, "Excellent item");
insert into evaluations values(2, 22, 3, "Parfois utile, parfois inutile");

insert into evaluations values(3, 1, 4, "J'ai fendu plusieurs crane avec cet item");

insert into evaluations values(6, 13, 3, "Cet objet est pratique jusqu'a un certain niveau");
insert into evaluations values(6, 14, 5, "Cet objet m'accompagne dans toutes mes aventures");
insert into evaluations values(6, 16, 4, "Je n'ai pas d'autres mots sur cet objet a part qu'il est excellent!");

insert into evaluations values(11, 20, 5, "Une fois plus, je me retrouve a utiliser cet objet qui est selon moi le meilleur de sa categorie");

--insertion des Armes
insert into Items(nomItem,qtStockItem,typeItem,prixUnitaireItem,urlImageItem) values('Arc celeste',100,'WPN',500,'arcCeleste.png', 'O');
insert into Items(nomItem,qtStockItem,typeItem,prixUnitaireItem,urlImageItem) values('Epee de feu',100,'WPN',600,'epeeFeu.png', 'O');
insert into Items(nomItem,qtStockItem,typeItem,prixUnitaireItem,urlImageItem) values('Arc de feu',100,'WPN',550,'arcFeu.png', 'O');
insert into Items(nomItem,qtStockItem,typeItem,prixUnitaireItem,urlImageItem) values('Epee de glace',100,'WPN',650,'epeeGlace.png', 'O');
insert into Items(nomItem,qtStockItem,typeItem,prixUnitaireItem,urlImageItem) values('Arme du future...',100,'WPN',2000,'armeFuture.png', 'O');
insert into Items(nomItem,qtStockItem,typeItem,prixUnitaireItem,urlImageItem) values('Arbalete',100,'WPN',300,'arbalete.png');
insert into Items(nomItem,qtStockItem,typeItem,prixUnitaireItem,urlImageItem) values('Arbalete anti vampire',100,'WPN',800,'arbaleteVampire.png', 'O');

insert into Armes values(1,10,'Longue Porte','Un arc � fleche cree par une ancienne civilisation maintenant detruite');
insert into Armes values(2,11,'deux main','Une epee si chaude que vos sourcils prendront feu!');
insert into Armes values(3,11,'Longue Porte','Un arc tirant du feu faire attention...');
insert into Armes values(4,12,'deux main','Une epee qui transforme vos ennemis en desserts glaces!');
insert into Armes values(5,20,'Longue Porte','Un homme du future est venu nous donner cette arme...');
insert into Armes values(6,7,'Longue Porte','Une arbalete traditionelle');
insert into Armes values(7,10,'Longue Porte','Une arbalete automatique servant a chasser les vampires');


select * from Items;
select * from Armures;
--insertion Armures
insert into Items values('Casque de la republique',100,'ARM',400,'casqueRepublique.png', 'O');
insert into Armures values(8,'Fer','1kg','petit');

insert into Items values('Armure Torsal de la Republique',100,'ARM',450,'torseRepublique.png', 'O');
insert into Armures values(9,'Fer','5kg','petit');

insert into Items values('Jambiere de la republique',100,'ARM',380,'jambiereRepublique.png', 'O');
insert into Armures values(10,'Fer','2kg','petit');

insert into Items values('Casque de Viking',100,'ARM',500,'casqueViking.png', 'O');
insert into Armures values(11,'Fer','1.2kg','grand');

insert into Items values('Armure Torsal de Viking',100,'ARM',550,'torseViking.png', 'O');
insert into Armures values(12,'Cuire','1.5kg','grand');

insert into Items values('Jambiere Viking',100,'ARM',200,'jambiereViking.png', 'O');
insert into Armures values(13,'Cuire','0.5kg','grand');


select * from Potions;
--insertion Potions
insert into Items values('Potion de vitalite',100,'POT',50,'potionVitalite.png', 'O');
insert into Potions values(14,'Donne 20 points de vie au joueur',1);

insert into Items values('Potion de rapidite',100,'POT',60,'potionRapidite.png', 'O');
insert into Potions values(15,'Boost la vitesse de deplacement de 25%',45);

insert into Items values('Potion de resistance au feu',100,'POT',80,'potionFeu.png', 'O');
insert into Potions values(16,'Reduit les degats de feu de 30%',60);

insert into Items values('Potion de resistance au froid',100,'POT',80,'potionFroid.png', 'O');
insert into Potions values(17,'Reduit les degats de glace  de 30%',60);

insert into Items values('Potion de resistance au poison',100,'POT',70,'potionPoison.png', 'O');
insert into Potions values(18,'Reduit les degats de poison de 40%',60);


insert into Items values('Fer', 100, 'RES', 25, 'fer.png', 'O');
insert into Ressource values(19, 'Un materiau dur et pas cher !')

insert into Items values('Or', 100, 'RES', 200, 'or.png', 'O');
insert into Ressource values(20, 'Une ressource rare et couteuse !')

insert into Items values('Cuir', 100, 'RES', 50, 'leatherScraps.png', 'O');
insert into Ressource values(21, 'Pas très cher et pas très utile !')

insert into Items values('Bois', 100, 'RES', 10, 'bois.png', 'O')
insert into Ressource values(22, 'Le materiau de base, achetez-en !')

insert into Items values('Diamant', 100, 'RES', 500, 'Diamant.png', 'O')
insert into Ressource values(22, 'La crême de la crême')