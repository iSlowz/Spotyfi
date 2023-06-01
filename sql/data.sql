/*
INSERT INTO public.users(prenom_user, nom_user, age_user, mail_user, mot_de_passe) VALUES('raphael', 'fosse', 19, 'raphael.fosse@isen-ouest.yncrea.fr', 'mdp');
INSERT INTO public.users(prenom_user, nom_user, age_user, mail_user, mot_de_passe) VALUES('maxime', 'bellenger', 19, 'maxime.bellenger@isen-ouest.yncrea.fr', 'mdp');
INSERT INTO public.users(prenom_user, nom_user, age_user, mail_user, mot_de_passe) VALUES('ethan', 'le-pan', 19, 'ethan.le-pan@isen-ouest.yncrea.fr', 'mdp');
INSERT INTO public.users(prenom_user, nom_user, age_user, mail_user, mot_de_passe) VALUES('dorian', 'rena', 19, 'dorian.rena@isen-ouest.yncrea.fr', 'mdp');*/
INSERT INTO public.users(prenom_user, nom_user, age_user, mail_user, mot_de_passe) VALUES('a', 'b', 19, 'ab@isen.fr', 'mdp');
/*
INSERT INTO public.styles(nom_style) VALUES('pop');
INSERT INTO public.styles(nom_style) VALUES('rock');
INSERT INTO public.styles(nom_style) VALUES('funk');
INSERT INTO public.styles(nom_style) VALUES('rap');

INSERT INTO public.artiste(nom_artiste, type_artiste) VALUES('M', 'chanteur');
INSERT INTO public.artiste(nom_artiste, type_artiste) VALUES('N', 'chanteur');
INSERT INTO public.artiste(nom_artiste, type_artiste) VALUES('L', 'groupe');

INSERT INTO public.album(title_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('first_album', '../album_cover/album1.png', DATE '2022-08-08', (SELECT id_artiste FROM public.artiste WHERE nom_artiste = 'M'), (SELECT id_style FROM public.style WHERE nom_style = 'pop'));
INSERT INTO public.album(title_album, photo_album, date_creation_album, id_artiste, id_style) VALUES('second_album', '../album_cover/album2.png', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE nom_artiste = 'M'), (SELECT id_style FROM public.style WHERE nom_style = 'rock'));

INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music1', '../musique/epic-power.mp3', TIME '00:01:01', DATE '2022-08-08', (SELECT id_artiste FROM public.artiste WHERE nom_artiste = 'M'), (SELECT id_album FROM public.album WHERE title_album = 'first_album'), (SELECT id_style FROM public.album WHERE title_album = 'first_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music2', '../musique/epic-trailer.mp3', TIME '00:00:56', DATE '2022-08-08', (SELECT id_artiste FROM public.artiste WHERE nom_artiste = 'M'), (SELECT id_album FROM public.album WHERE title_album = 'first_album'), (SELECT id_style FROM public.album WHERE title_album = 'first_album'));
INSERT INTO public.musique(titre_musique, lien_musique, duree_musique, date_parution_musique, id_artiste, id_album, id_style) VALUES('music3', '../musique/ukulele-trip.mp3', TIME '00:01:00', DATE '2023-08-08', (SELECT id_artiste FROM public.artiste WHERE nom_artiste = 'M'), (SELECT id_album FROM public.album WHERE title_album = 'second_album'), (SELECT id_style FROM public.album WHERE title_album = 'second_album'));

INSERT INTO public.playlist(titre_playlist, date_creation_playlist, id_user) VALUES('printemps', NOW(), (SELECT id_user FROM public.users WHERE mail_user = 'raphael.fosse@isen-ouest.yncrea.fr'));

INSERT INTO public.musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) VALUES((SELECT id_musique FROM public.musique WHERE titre_musique = 'music1'), (SELECT id_playlist FROM public.playlist WHERE titre_playlist = 'printemps'), NOW());
INSERT INTO public.musique_playlist(id_musique, id_playlist, date_ajout_musique_playlist) VALUES((SELECT id_musique FROM public.musique WHERE titre_musique = 'music2'), (SELECT id_playlist FROM public.playlist WHERE titre_playlist = 'printemps'), NOW());

*/