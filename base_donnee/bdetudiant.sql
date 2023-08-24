/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  22/08/2023 13:21:03                      */
/*==============================================================*/


drop table if exists etudiant;

drop table if exists filiere;

drop table if exists niveau_etude;

drop table if exists utilisateur;



CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id`, `nom`, `prenom`, `username`, `password`, `statut`) VALUES
(1, 'ggg', 'fffg', 'admin', 'admin', 'admin'),
(2, 'dene', 'Selrez', 'Della', '1111', 'admin'),
(3, 'Tresor', 'dilla', 'Trez', '2222', 'Utilisateur');


/*==============================================================*/
/* Table : etudiant                                             */
/*==============================================================*/
create table etudiant
(
   id_etudiant          int not null,
   id_filiere           int not null,
   id_niveau            int not null,
   nom                  varchar(254),
   prenom               varchar(254),
   date_de_naissance    datetime,
   matricule            int,
   adresse              varchar(254),
   email                varchar(254),
   contact              int,
   nationalite          varchar(254),
   primary key (id_etudiant)
);

/*==============================================================*/
/* Table : filiere                                              */
/*==============================================================*/
create table filiere
(
   id_filiere           int not null,
   nom_filiere          varchar(254),
   primary key (id_filiere)
);

/*==============================================================*/
/* Table : niveau_etude                                         */
/*==============================================================*/
create table niveau_etude
(
   id_niveau            int not null,
   valeur               int,
   primary key (id_niveau)
);

/*==============================================================*/
/* Table : utilisateur                                          */
/*==============================================================*/
create table utilisateur
(
   id_utilisateur       int not null,
   nom                  varchar(254),
   prenom               varchar(254),
   adresse              varchar(254),
   email                varchar(254),
   contact              int,
   primary key (id_utilisateur)
);

alter table etudiant add constraint FK_Association_1 foreign key (id_filiere)
      references filiere (id_filiere) on delete restrict on update restrict;

alter table etudiant add constraint FK_Association_2 foreign key (id_niveau)
      references niveau_etude (id_niveau) on delete restrict on update restrict;

