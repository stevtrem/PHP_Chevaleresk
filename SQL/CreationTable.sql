create table Items(
idItem int identity(1,1),
nomItem varchar(32) not null,
qtStockItem int not null,
typeItem char(3) not null,
prixUnitaireItem money not null,
urlImageItem varchar(256) not null,
primary key(idItem)
);

create table Joueurs(
idJoueur int identity(1,1),
alias varchar(32) not null,
nom varchar(32) not null,
prenom varchar(32),
montantInitial money not null,
primary key(idJoueur)
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
idJoueur int primary key,
idItem int not null,
qtItem int not null,
constraint fk_idJoueur foreign key (idJoueur)
references Joueurs(idJoueur),
constraint fk_idItem foreign key (idItem)
references Items(idItem)
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