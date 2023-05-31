------------------------------------------------------------
--        Script Postgre
------------------------------------------------------------



------------------------------------------------------------
-- Table: artiste
------------------------------------------------------------
CREATE TABLE public.artiste(
                               id_artiste     SERIAL NOT NULL ,
                               nom_artiste    VARCHAR (20) NOT NULL ,
                               type_artiste   VARCHAR (20) NOT NULL  ,
                               CONSTRAINT artiste_PK PRIMARY KEY (id_artiste)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: user
------------------------------------------------------------
CREATE TABLE public.user(
                            id_user        SERIAL NOT NULL ,
                            prenom_user    VARCHAR (20) NOT NULL ,
                            nom_user       VARCHAR (20) NOT NULL ,
                            age_user       INT  NOT NULL ,
                            mail_user      VARCHAR (50) NOT NULL ,
                            mot_de_passe   VARCHAR (50) NOT NULL  ,
                            CONSTRAINT user_PK PRIMARY KEY (id_user)
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

    ,CONSTRAINT playlist_user_FK FOREIGN KEY (id_user) REFERENCES public.user(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: album
------------------------------------------------------------
CREATE TABLE public.album(
                             id_album              SERIAL NOT NULL ,
                             title_album           VARCHAR (20) NOT NULL ,
                             photo_album           VARCHAR (100) NOT NULL ,
                             type_album            VARCHAR (20) NOT NULL ,
                             date_creation_album   DATE  NOT NULL ,
                             id_artiste            INT  NOT NULL  ,
                             CONSTRAINT album_PK PRIMARY KEY (id_album)

    ,CONSTRAINT album_artiste_FK FOREIGN KEY (id_artiste) REFERENCES public.artiste(id_artiste)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: musique
------------------------------------------------------------
CREATE TABLE public.musique(
                               id_musique              SERIAL NOT NULL ,
                               type_musique            VARCHAR (20) NOT NULL ,
                               titre_musique           VARCHAR (20) NOT NULL ,
                               lien_musique            VARCHAR (100) NOT NULL ,
                               duree_musique           TIMETZ  NOT NULL ,
                               date_parution_musique   DATE  NOT NULL ,
                               id_album                INT  NOT NULL  ,
                               CONSTRAINT musique_PK PRIMARY KEY (id_musique)

    ,CONSTRAINT musique_album_FK FOREIGN KEY (id_album) REFERENCES public.album(id_album)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: contenir
------------------------------------------------------------
CREATE TABLE public.contenir(
                                id_musique                    INT  NOT NULL ,
                                id_playlist                   INT  NOT NULL ,
                                date_ajout_musique_playlist   DATE  NOT NULL  ,
                                CONSTRAINT contenir_PK PRIMARY KEY (id_musique,id_playlist)

    ,CONSTRAINT contenir_musique_FK FOREIGN KEY (id_musique) REFERENCES public.musique(id_musique)
    ,CONSTRAINT contenir_playlist0_FK FOREIGN KEY (id_playlist) REFERENCES public.playlist(id_playlist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: creer
------------------------------------------------------------
CREATE TABLE public.creer(
                             id_artiste   INT  NOT NULL ,
                             id_musique   INT  NOT NULL  ,
                             CONSTRAINT creer_PK PRIMARY KEY (id_artiste,id_musique)

    ,CONSTRAINT creer_artiste_FK FOREIGN KEY (id_artiste) REFERENCES public.artiste(id_artiste)
    ,CONSTRAINT creer_musique0_FK FOREIGN KEY (id_musique) REFERENCES public.musique(id_musique)
)WITHOUT OIDS;



