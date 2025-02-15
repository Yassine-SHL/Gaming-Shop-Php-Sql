drop database if exists gamingShop;
create database gamingShop;
use gamingShop;
create table utilisateur(
    id_utilisateur int auto_increment primary key not null,
    nom varchar(150) not null,
    prenom varchar(150) not null,
    courriel varchar(250) not null unique,
    motdepasse text not null,
    sexe varchar(50),
    date_de_naissance date,
    telephone varchar(50)
);
create table adresse(
    id_adresse int auto_increment primary key not null,
    rue varchar(50) not null,
    ville varchar(50) not null,
    province varchar(50) not null,
    codepostal varchar(50) not null,
    numero varchar(10)
);
create table utilisateur_adresse(
    id_utilisateur int,
    id_adresse int
);
create table role(
    id_role int auto_increment primary key not null,
    description varchar(50) not null
);
create table role_utilisateur(
    id_role int,
    id_utilisateur int
);
create table produit(
    id_produit int auto_increment primary key not null,
    nom varchar(250) not null,
    description varchar(1500),
    courte_description varchar(250),
    prix_unitaire varchar(10) not null,
    quantite int default 0,
    categorie varchar(50) not null
);
create table commande(
    id_commande int auto_increment primary key not null,
    id_utilisateur int,
    quantite int,
    prix varchar(10),
    date_commande datetime
);
create table produit_commande(
    id_commande int,
    id_produit int,
    quantite int not null
);
create table image(
    id_image int auto_increment PRIMARY KEY not null,
    id_produit int,
    chemin text
);
alter table utilisateur_adresse add constraint fk_utilisateur_adresse_utilisateur
    foreign key (id_utilisateur) references utilisateur(id_utilisateur)
    on delete cascade on update cascade;;
        

alter table utilisateur_adresse add constraint fk_utilisateur_adresse_adresse
    foreign key (id_adresse) references adresse(id_adresse)
    on delete cascade on update cascade;;

alter table role_utilisateur add constraint fk_role_utilisateur_role
    foreign key (id_role) references role(id_role) 
    on delete cascade on update cascade;

alter table role_utilisateur add constraint fk_role_utilisateur_utilisateur
    foreign key (id_utilisateur) references utilisateur(id_utilisateur) 
    on delete cascade on update cascade;

alter table commande add constraint fk_commande_utilisateur
    foreign key (id_utilisateur) references utilisateur(id_utilisateur)
    on delete cascade on update cascade;

alter table produit_commande add constraint fk_produit_commande_commande
    foreign key (id_commande) references commande(id_commande);

alter table produit_commande add constraint fk_produit_commande_produit
    foreign key (id_produit) references produit(id_produit);

alter table image add constraint fk_image_produit
    foreign key (id_produit) references produit(id_produit);
        on delete cascade on update cascade;

/*alter table utilisateur_adresse
    add constraint fk_utilisateur_adresse
        foreign key (id_utilisateur) references utilisateur(id_utilisateur)
            on delete cascade on update cascade;
    add constraint fk_adresse_utilisateur
        foreign key (id_adresse) references adresse(id_adresse)
            on delete cascade on update cascade;
alter table role_utilisateur
    add constraint fk_utilisateur_role
        foreign key (id_utilisateur) references utilisateur(id_utilisateur)
            on delete cascade on update cascade;
    add constraint fk_role_utilisateur
        foreign key (id_role) references role (id_role)
            on delete cascade on update cascade;
alter table commande
    add constraint fk_commande_utilisateur
        foreign key (id_utilisateur) references utilisateur(id_utilisateur)
            on delete cascade on update cascade;
alter table produit_commande
    add constraint fk_produit_commande
        foreign key (id_produit) references produit (id_produit)
            on delete cascade on update cascade;
    add constraint fk_commande_produit
        foreign key (id_commande) references commande (id_commande)
            on delete cascade on update cascade;
*/