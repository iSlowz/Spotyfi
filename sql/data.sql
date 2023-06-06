/*création d'un utilisateur*/
/*INSERT INTO public.users(prenom_user, nom_user, date_naissance_user, mail_user, mot_de_passe) VALUES('Jean', 'Dupont', DATE '2000-01-01', 'jdupont@mail.fr', 'hash');*/


/*création des différent styles*/
INSERT INTO public.style(nom_style) VALUES('pop');
INSERT INTO public.style(nom_style) VALUES('rock');
INSERT INTO public.style(nom_style) VALUES('funk');
INSERT INTO public.style(nom_style) VALUES('rap');
INSERT INTO public.style(nom_style) VALUES('jazz');
INSERT INTO public.style(nom_style) VALUES('lo-fi');
INSERT INTO public.style(nom_style) VALUES('heavy-metal');


/*création des artistes*/
INSERT INTO public.artiste(nom_artiste, type_artiste, prenom_artiste, pseudo_artiste, id_style) VALUES('Pery', 'chanteur', 'Katie', 'POP-queen', (SELECT id_style FROM public.style WHERE nom_style = 'pop'));
INSERT INTO public.artiste(nom_artiste, type_artiste, prenom_artiste, pseudo_artiste, id_style) VALUES('Cury', 'duo', 'Freddy', 'ROCK-king', (SELECT id_style FROM public.style WHERE nom_style = 'rock'));
INSERT INTO public.artiste(nom_artiste, type_artiste, prenom_artiste, pseudo_artiste, id_style) VALUES('Parkker', 'groupe', 'Gray', 'FUNK-emperor', (SELECT id_style FROM public.style WHERE nom_style = 'funk'));
INSERT INTO public.artiste(nom_artiste, type_artiste, prenom_artiste, pseudo_artiste, id_style) VALUES('Shady', 'chanteur', 'slim', 'RAP-god', (SELECT id_style FROM public.style WHERE nom_style = 'rap'));
INSERT INTO public.artiste(nom_artiste, type_artiste, prenom_artiste, pseudo_artiste, id_style) VALUES('Harm-strong', 'chanteur', 'Louis', 'JAZZ-master', (SELECT id_style FROM public.style WHERE nom_style = 'jazz'));
INSERT INTO public.artiste(nom_artiste, type_artiste, prenom_artiste, pseudo_artiste, id_style) VALUES('Chill', 'chanteur', 'Low', 'LO-FI-sleep', (SELECT id_style FROM public.style WHERE nom_style = 'lo-fi'));
INSERT INTO public.artiste(nom_artiste, type_artiste, prenom_artiste, pseudo_artiste, id_style) VALUES('Stark', 'groupe', 'Tony', 'METAL-soldiers', (SELECT id_style FROM public.style WHERE nom_style = 'heavy-metal'));


/*création des albums*/
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_pop_album', 'album_cover/album1.png', DATE '2019-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'POP-queen'), (SELECT id_style FROM public.style WHERE nom_style = 'pop'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('second_pop_album', 'album_cover/album3.png', DATE '2023-05-03', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'POP-queen'), (SELECT id_style FROM public.style WHERE nom_style = 'pop'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_rock_album', 'album_cover/album5.png', DATE '1998-11-21', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'ROCK-king'), (SELECT id_style FROM public.style WHERE nom_style = 'rock'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_funk_album', 'album_cover/album4.png', DATE '2021-12-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'FUNK-emperor'), (SELECT id_style FROM public.style WHERE nom_style = 'funk'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_rap_album', 'album_cover/album2.png', DATE '2022-06-30', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'RAP-god'), (SELECT id_style FROM public.style WHERE nom_style = 'rap'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_jazz_album', 'album_cover/album2.png', DATE '2018-07-007', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'JAZZ-master'), (SELECT id_style FROM public.style WHERE nom_style = 'jazz'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_lo-fi_album', 'album_cover/album2.png', DATE '2011-10-09', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'LO-FI-sleep'), (SELECT id_style FROM public.style WHERE nom_style = 'lo-fi'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_metal_album', 'album_cover/album2.png', DATE '2001-09-06', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'METAL-soldiers'), (SELECT id_style FROM public.style WHERE nom_style = 'heavy-metal'));


/*création des musiques*/
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('epic power', 'musique/epic-power.mp3', TIME '00:01:01', DATE '2019-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'POP-queen'), (SELECT id_album FROM public.album WHERE titre_album = 'first_pop_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_pop_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('epic trailer', 'musique/epic-trailer.mp3', TIME '00:00:56', DATE '2019-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'POP-queen'), (SELECT id_album FROM public.album WHERE titre_album = 'first_pop_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_pop_album'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('fashion pop', 'musique/fashion-pop.mp3', TIME '00:01:32', DATE '2023-05-03', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'POP-queen'), (SELECT id_album FROM public.album WHERE titre_album = 'second_pop_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_pop_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('ukulele trip', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-05-03', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'POP-queen'), (SELECT id_album FROM public.album WHERE titre_album = 'second_pop_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_pop_album'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('groovy rock', 'musique/groovy-rock.mp3', TIME '00:00:30', DATE '1998-11-21', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'ROCK-king'), (SELECT id_album FROM public.album WHERE titre_album = 'first_rock_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_rock_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('rock it', 'musique/rock-it.mp3', TIME '00:01:33', DATE '1998-11-21', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'ROCK-king'), (SELECT id_album FROM public.album WHERE titre_album = 'first_rock_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_rock_album'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('default1', 'musique/groovy-rock.mp3', TIME '00:00:30', DATE '2021-12-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'FUNK-emperor'), (SELECT id_album FROM public.album WHERE titre_album = 'first_funk_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_funk_album'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('default2', 'musique/groovy-rock.mp3', TIME '00:00:30', DATE '2022-06-30', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'RAP-god'), (SELECT id_album FROM public.album WHERE titre_album = 'first_rap_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_rap_album'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('jazz band', 'musique/jazz-band.mp3', TIME '00:01:23', DATE '2018-07-007', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'JAZZ-master'), (SELECT id_album FROM public.album WHERE titre_album = 'first_jazz_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_jazz_album'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('default4', 'musique/groovy-rock.mp3', TIME '00:00:30', DATE '2011-10-09', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'LO-FI-sleep'), (SELECT id_album FROM public.album WHERE titre_album = 'first_lo-fi_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_lo-fi_album'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('default5', 'musique/groovy-rock.mp3', TIME '00:00:30', DATE '2001-09-06', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'METAL-soldiers'), (SELECT id_album FROM public.album WHERE titre_album = 'first_metal_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_metal_album'));


/*création des playlist*/
/*INSERT INTO public.playlist(titre_playlist, date_creation_playlist, id_user) VALUES('nom_playlist', NOW(), (SELECT id_user FROM public.users WHERE mail_user = 'jdupont@mail.fr'));*/


/*rajout de musique dans un playlist*/
/*INSERT INTO public.musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) VALUES((SELECT id_musique FROM public.musique WHERE titre_musique = 'titre_musique'), (SELECT id_playlist FROM public.playlist WHERE titre_playlist = 'nomplaylist'), NOW());*/


/*création des Historique ou Favoris (playlist)*/
/*INSERT INTO public.playlist(titre_playlist, date_creation_playlist, id_user) VALUES('Historique', NOW(), (SELECT id_user FROM public.users WHERE mail_user = 'jdupont@mail.fr'));
INSERT INTO playlist(titre_playlist, date_creation_playlist, id_user) VALUES ('Favoris',NOW(), (SELECT id_user FROM public.users WHERE mail_user = 'jdupont@mail.fr'));*/
