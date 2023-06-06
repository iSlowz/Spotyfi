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
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_album', 'album_cover/album1.png', DATE '2022-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_style FROM public.style WHERE nom_style = 'pop'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('second_album', 'album_cover/album2.png', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_style FROM public.style WHERE nom_style = 'rock'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('third_album', 'album_cover/album1.png', DATE '2021-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'L'), (SELECT id_style FROM public.style WHERE nom_style = 'rap'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('fourth_album', 'album_cover/album2.png', DATE '2021-12-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'L'), (SELECT id_style FROM public.style WHERE nom_style = 'rap'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('album_musique', 'album_cover/album2.png', DATE '2021-12-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'L'), (SELECT id_style FROM public.style WHERE nom_style = 'rap'));
INSERT INTO public.album(titre_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('album_musique2', 'album_cover/album2.png', DATE '2021-12-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Tod'), (SELECT id_style FROM public.style WHERE nom_style = 'rap'));

/*création des musiques*/
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music1', 'musique/epic-power.mp3', TIME '00:01:01', DATE '2022-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'first_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music2', 'musique/epic-trailer.mp3', TIME '00:00:56', DATE '2022-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'first_album'), (SELECT id_style FROM public.album WHERE titre_album = 'first_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music3', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'first_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music4', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'first_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music5', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'second_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music6', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'second_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music7', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'second_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music8', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'Mariooo'), (SELECT id_album FROM public.album WHERE titre_album = 'second_album'), (SELECT id_style FROM public.album WHERE titre_album = 'second_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('musique1', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'L'), (SELECT id_album FROM public.album WHERE titre_album = 'third_album'), (SELECT id_style FROM public.album WHERE titre_album = 'third_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('musique2', 'musique/epic-trailer.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'L'), (SELECT id_album FROM public.album WHERE titre_album = 'third_album'), (SELECT id_style FROM public.album WHERE titre_album = 'third_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('musique3', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'L'), (SELECT id_album FROM public.album WHERE titre_album = 'fourth_album'), (SELECT id_style FROM public.album WHERE titre_album = 'fourth_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('musique4', 'musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE pseudo_artiste = 'L'), (SELECT id_album FROM public.album WHERE titre_album = 'fourth_album'), (SELECT id_style FROM public.album WHERE titre_album = 'fourth_album'));

/*création des playlist*/
/*INSERT INTO public.playlist(titre_playlist, date_creation_playlist, id_user) VALUES('nom_playlist', NOW(), (SELECT id_user FROM public.users WHERE mail_user = 'jdupont@mail.fr'));*/

/*rajout de musique dans un playlist*/
/*INSERT INTO public.musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) VALUES((SELECT id_musique FROM public.musique WHERE titre_musique = 'titre_musique'), (SELECT id_playlist FROM public.playlist WHERE titre_playlist = 'nomplaylist'), NOW());*/

/*création des Historique ou Favoris (playlist)*/
/*INSERT INTO public.playlist(titre_playlist, date_creation_playlist, id_user) VALUES('Historique', NOW(), (SELECT id_user FROM public.users WHERE mail_user = 'jdupont@mail.fr'));
INSERT INTO playlist(titre_playlist, date_creation_playlist, id_user) VALUES ('Favoris',NOW(), (SELECT id_user FROM public.users WHERE mail_user = 'jdupont@mail.fr'));*/
