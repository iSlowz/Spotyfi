------------------------------------------------------------
--        Script Postgre
------------------------------------------------------------

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS artiste CASCADE;
DROP TABLE IF EXISTS musique CASCADE;
DROP TABLE IF EXISTS playlist CASCADE;
DROP TABLE IF EXISTS style CASCADE ;
DROP TABLE IF EXISTS musique_playlist CASCADE;
DROP TABLE IF EXISTS album CASCADE;

------------------------------------------------------------
-- Table: users
------------------------------------------------------------
CREATE TABLE public.users(
	id_user               SERIAL NOT NULL ,
	prenom_user           VARCHAR (20) NOT NULL ,
	nom_user              VARCHAR (20) NOT NULL ,
	date_naissance_user   DATE  NOT NULL ,
	mail_user             VARCHAR (50) NOT NULL ,
	mot_de_passe          VARCHAR (50) NOT NULL  ,
	CONSTRAINT users_PK PRIMARY KEY (id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: playlist
------------------------------------------------------------
CREATE TABLE public.playlist(
	id_playlist              SERIAL NOT NULL ,
	titre_playlist           VARCHAR (20) NOT NULL ,
	date_creation_playlist   DATE  NOT NULL ,
	id_user                  INT  NOT NULL  ,
	CONSTRAINT playlist_PK PRIMARY KEY (id_playlist)

	,CONSTRAINT playlist_users_FK FOREIGN KEY (id_user) REFERENCES public.users(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: style
------------------------------------------------------------
CREATE TABLE public.style(
	id_style    SERIAL NOT NULL ,
	nom_style   VARCHAR (50) NOT NULL  ,
	CONSTRAINT style_PK PRIMARY KEY (id_style)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: artiste
------------------------------------------------------------
CREATE TABLE public.artiste(
	id_artiste       SERIAL NOT NULL ,
	nom_artiste      VARCHAR (20) NOT NULL ,
	type_artiste     VARCHAR (20) NOT NULL ,
	prenom_artiste   VARCHAR (20) NOT NULL ,
	pseudo_artiste   VARCHAR (20) NOT NULL ,
	id_style         INT  NOT NULL  ,
	CONSTRAINT artiste_PK PRIMARY KEY (id_artiste)

	,CONSTRAINT artiste_style_FK FOREIGN KEY (id_style) REFERENCES public.style(id_style)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: album
------------------------------------------------------------
CREATE TABLE public.album(
	id_album              SERIAL NOT NULL ,
	titre_album           VARCHAR (20) NOT NULL ,
	photo_album           VARCHAR (100) NOT NULL ,
	date_creation_album   DATE  NOT NULL ,
	id_artiste            INT  NOT NULL ,
	id_style              INT  NOT NULL  ,
	CONSTRAINT album_PK PRIMARY KEY (id_album)

	,CONSTRAINT album_artiste_FK FOREIGN KEY (id_artiste) REFERENCES public.artiste(id_artiste)
	,CONSTRAINT album_style0_FK FOREIGN KEY (id_style) REFERENCES public.style(id_style)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: musique
------------------------------------------------------------
CREATE TABLE public.musique(
	id_musique              SERIAL NOT NULL ,
	titre_musique           VARCHAR (20) NOT NULL ,
	lien_musique            VARCHAR (100) NOT NULL ,
	duree_musique           TIMETZ  NOT NULL ,
	date_parution_musique   DATE  NOT NULL ,
	id_artiste              INT  NOT NULL ,
	id_album                INT  NOT NULL ,
	id_style                INT  NOT NULL  ,
	CONSTRAINT musique_PK PRIMARY KEY (id_musique)

	,CONSTRAINT musique_artiste_FK FOREIGN KEY (id_artiste) REFERENCES public.artiste(id_artiste)
	,CONSTRAINT musique_album0_FK FOREIGN KEY (id_album) REFERENCES public.album(id_album)
	,CONSTRAINT musique_style1_FK FOREIGN KEY (id_style) REFERENCES public.style(id_style)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: musique_playlist
------------------------------------------------------------
CREATE TABLE public.musique_playlist(
	id_musique                    INT  NOT NULL ,
	id_playlist                   INT  NOT NULL ,
	date_ajout_musique_playlist   DATE  NOT NULL  ,
	CONSTRAINT musique_playlist_PK PRIMARY KEY (id_musique,id_playlist)

	,CONSTRAINT musique_playlist_musique_FK FOREIGN KEY (id_musique) REFERENCES public.musique(id_musique)
	,CONSTRAINT musique_playlist_playlist0_FK FOREIGN KEY (id_playlist) REFERENCES public.playlist(id_playlist)
)WITHOUT OIDS;


