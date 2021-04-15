create table Items(
idItem int identity(1,1),
nomItem varchar(32) not null,
qtStockItem int not null,
typeItem char(3) not null,
prixUnitaireItem money not null,
urlImageItem varchar(256) not null,
disponible char not null,
primary key(idItem)
);

create table Joueurs(
idJoueur int identity(1,1),
alias varchar(32) not null,
nom varchar(32) not null,
prenom varchar(32),
montantInitial money not null,
motdepasse varbinary(128)
primary key(idJoueur)
);

create table evaluations(
idJoueur int not null,
idItem int not null,
evaluation int not null,
commentaire varchar(256) null,
constraint FK_idJoueurRating foreign key (idJoueur)
references Joueurs(idJoueur),
constraint FK_idItemRating foreign key (idItem)
references Items(idItem),
constraint PK_idJoueurItem primary key (idJoueur, idItem),
constraint CK_Rating CHECK (evaluation >= 0 AND evaluation <= 5)
);

create table Armes(
idItem int primary key,
efficacite int not null,
genre varchar(32) not null,
descriptionArme varchar(256),
constraint fk_ArmeItem foreign key (idItem)
references Items(idItem)
);

create table Armures(
idItem int primary key,
matiere varchar(32) not null,
poids varchar(16) not null,
taille varchar(32) not null,
constraint fk_ArmureItem foreign key (idItem)
references Items(idItem)
);

create table inventaireJoueur(
idJoueur int,
idItem int not null,
qtItem int not null,
constraint fk_idJoueur foreign key (idJoueur)
references Joueurs(idJoueur),
constraint fk_idItem foreign key (idItem)
references Items(idItem),
primary key(idJoueur,idItem) 
);


create table Panier(
idJoueur int not null,
idItem int not null,
qtItem int not null,
constraint fk_idItemPanier foreign key (idItem)
references Items(idItem),
constraint fk_idJoueurPanier foreign key (idJoueur)
references Joueurs(idJoueur),
primary key(idJoueur,idItem)
);

create table Potions(
idItem int not null,
effet varchar(128) not null,
duree int not null,
constraint fk_idItemPotion foreign key (idItem)
references Items(idItem),
primary key(idItem)
);
create table Ressource 
(
idItem int not null,
description varchar(64) not null
constraint fk_RessourceItem foreign key (idItem)
references Items(idItem)
);