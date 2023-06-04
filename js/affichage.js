let id_user = document.getElementById("id_user").innerText
ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
ajaxRequest("GET", "request.php/playlist_list/" + id_user, loadPlaylists)   //id_user sera ce qu'on va retrouver
//dans id dans request.php (car après le /)
$('.flex-recherche').submit(function (event){
    event.preventDefault()
    console.log($('#bar-recherche').val())
    ajaxRequest("GET", "request.php/recherche/", showRecherches,'recherche='+$('#bar-recherche').val())

})

function showRecherches(recherches){
    console.log(recherches);
    
    let html =

        '<div class="page-playlist-flex">' +
        '<h1>' + playlist["titre_playlist"] + '</h1>' +
        '<h4 class="titre-date">' + playlist["date_creation_playlist"] + '</h4>' +
        '</div>' +
        '<hr id="trait">' +
        '<div class="page-table" id="titre-table">' +
        '<table class="table" id="texte-titre-table">' +
        '<thead>' +
        '<tr>' +
        '<th scope="col">Titre</th>' +
        '<th scope="col">Artiste</th>' +
        '<th scope="col">Album</th>' +
        '<th scope="col">Date dajout</th>' +
        '<th scope="col">Durée</th>' +
        '<th scope="col">Sup</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';

    playlist["musiques"].forEach(function (musique) {
        html +=
            '<tr>' +
            '<th scope="row"><button type="button" class="musique-bouton" value="' + musique["id_musique"] + '">' + musique["titre_musique"] + '</button></th>' +
            '<td><button type="button" class="artiste-bouton" value="' + musique["id_artiste"] + '">' + musique["pseudo_artiste"] + '</button></td>' +
            '<td><button type="button" class="album-bouton" value="' + musique["id_album"] + '">' + musique["titre_album"] + '</button></td>' +
            '<td>' + musique["date_ajout_musique_playlist"] + '</td>' +
            '<td>' + musique["duree_musique"] + '</td>' +
            '<td>Bouton supprimer</td>' +
            '</tr>';
    });

    html += '</tbody>' +
        '</table>' +
        '</div>';

    $(".flex-page").html(html);

     
}

function loadHistorique(musiques) {
    console.log(musiques)
    $(".flex-page").html('')
    let text = '<div class="titre-page">' +
        '            <label>Derniers morceaux écoutés</label>' +
        '          </div>' +
        '          <div class="barre-page">' +
        '            <hr>' +
        '          </div>' +
        '          <div class="flex-card" id="dernier-morceaux-page">'
    musiques.forEach(function (musique) {
        console.log(musique)

        text +=
            '<div class="card" id="id-card" style="width: 17%;">' + // Amélioration, mettre les derniers morceaux à gauches
            '<div class="card-body">' +
            '<div class="id_musique" style="display: none">' + musique["id_musique"] + '</div>' +
            '<h5 class="card-title">' + musique["titre_musique"] + '</h5>' +
            '<p class="card-text"><button type="button" class="artiste-bouton souligne" value="'+musique["id_artiste"] +'">' + musique["pseudo_artiste"] + '</button></p>' +
            '</div>' +
            '</div>'

    })
    $(".flex-page").append(text + '</div>')
    $(".card-body").click(function (event) {
        let id = $(event.target).closest(".card").find(".id_musique").text();
        console.log(id)
        ajaxRequest("GET", "request.php/musique/" + id, showMusique)
    })
    $(".artiste-bouton").click(function (event){    //à laisser ou non
        let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
        console.log(id);
        ajaxRequest("GET", "request.php/artiste/"+id, showArtiste)

    })
}

function loadPlaylists(playlists) {
    console.log(playlists)
    playlists.forEach(function (playlist) {
        console.log(playlist)
        $(".flex-playlist").append('<button class="playlist-bouton" value="' + playlist["id_playlist"] + '" type="submit">' + playlist["titre_playlist"] + '</button>')
    })

    $(".playlist-bouton").click(function (event) {
            let id = $(event.target).closest('.playlist-bouton').attr('value')
            console.log(id)
            ajaxRequest("GET", "request.php/playlist/" + id, showPlaylist)
        }
    )

}


/*--------------------------------------------------------------------------------------------------------------*/
/* Permet d'afficher ce que contient une playlist */
/*--------------------------------------------------------------------------------------------------------------*/


function showPlaylist(playlist) {    //affiche les musiques d'une playlist
    console.log(playlist);

    let html =

    '<div class="page-playlist-flex">' +
      '<div id="titre-page-des-playlist">'+
        '<h1>' + playlist["titre_playlist"] + '</h1>' +
      '</div>'+
      '<div class="date-container">'+
        '<h4 class="titre-date">' + playlist["date_creation_playlist"] + '</h4>' +
      '</div>' +
    '</div>'+
      '<hr id="trait">' +
    '<div class="page-table" id="titre-table">' +
      '<table class="table" id="texte-titre-table">' +
        '<thead>' +
          '<tr>' +
            '<th scope="col">Titre</th>' +
            '<th scope="col">Artiste</th>' +
            '<th scope="col">Album</th>' +
            '<th scope="col">Date dajout</th>' +
            '<th scope="col">Durée</th>' +
            '<th scope="col"></th>' +
          '</tr>' +
        '</thead>' +
        '<tbody>';

    playlist["musiques"].forEach(function (musique) {
        html +=
            '<tr id="tableau-playlist">'+
            '<th scope="row"><button type="button" class="musique-bouton" value="' + musique["id_musique"]+'">' + musique["titre_musique"] + '</button></th>' +
            '<td><button type="button" class="artiste-bouton" value="'+musique["id_artiste"]+'">' + musique["pseudo_artiste"] + '</button></td>' +
            '<td><button type="button" class="album-bouton" value="' + musique["id_album"] + '">' + musique["titre_album"] + '</button></td>' +
            '<td>' + musique["date_ajout_musique_playlist"] + '</td>' +
            '<td>' + musique["duree_musique"] + '</td>' +
            '<td>Bouton supprimer</td>'+
            '</tr>'
    });

    html += '</tbody>' +
    '</table>' +
    '</div>';

    $(".flex-page").html(html);

    $(".musique-bouton").click(function (event){
        let id = $(event.target).closest('.musique-bouton').attr('value')   // id de la musique
        console.log(id)
        ajaxRequest("GET", "request.php/musique/"+id, showMusique)
    })
    $(".album-bouton").click(function (event){
        let id = $(event.target).closest('.album-bouton').attr('value')   // id de l'album
        console.log(id)
        ajaxRequest("GET", "request.php/album/"+id, showAlbum)
    })

    $(".artiste-bouton").click(function (event){
        let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
        console.log(id);
        ajaxRequest("GET", "request.php/artiste/"+id, showArtiste)

    })

}

$("#Accueil").click(function (event){
    ajaxRequest("GET", "request.php/historique/"+id_user, loadHistorique)
})


/*--------------------------------------------------------------------------------------------------------------*/
/* Permet d'afficher les détails sur les musiques */
/*--------------------------------------------------------------------------------------------------------------*/


function showMusique(musique){
    console.log(musique)
    console.log(musique["titre_musique"])
    $(".flex-page").html(
        
        '<h1 id="titre-page-de-recherche"> Titre : ' + musique["titre_musique"]+'</h1>' +
        '<br>'+
        '<div class="text-musique">' +
            '<p> Durée : '+musique["duree_musique"]+'</p>' +
            '<p>Date de parution : '+musique["date_parution_musique"]+'</p>' +
            '<p> Son album : <button type="button" class="album-bouton" value="'+musique["id_album"]+'">' + musique["titre_album"] + '</button></p>' +
            '<p> Son artiste : <button type="button" class="artiste-bouton" value="'+musique["id_artiste"]+'">' + musique["pseudo_artiste"] + '</button></p>' +
            '<p> Style : '+musique["nom_style"]+'</p>'+
        '</div>')

    $(".album-bouton").click(function (event){
        let id = $(event.target).closest('.album-bouton').attr('value')   // id de l'album
        console.log(id)
        ajaxRequest("GET", "request.php/album/"+id, showAlbum)
    })

    $(".artiste-bouton").click(function (event){
        let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
        console.log(id);
        ajaxRequest("GET", "request.php/artiste/"+id, showArtiste)
    })


}


/*--------------------------------------------------------------------------------------------------------------*/
/* Permet d'afficher les détails sur les albums */
/*--------------------------------------------------------------------------------------------------------------*/


function showAlbum(album) { 
    console.log(album)
    let html = 
        
        "<h1 id='titre-page-de-recherche'> Nom de l'album : " + album["titre_album"] + '</h1>' +
        '<h4> Artiste : <button type="button" class="artiste-bouton" value="' + album["id_artiste"] + '">' + album["pseudo_artiste"] + '</button>' + '</h4>' +
        '<p>Créé le ' + album["date_creation_album"] + '</p>' +
        '<hr id="trait">' +
        '<div class="page-table" id="titre-table">' +
          '<table class="table" id="texte-titre-table">' +
            '<thead>' +
              '<tr>' +
                '<th scope="col">Titre</th>' +
                '<th scope="col">Durée</th>' +
                '<th scope="col">Sup</th>' +
              '</tr>' +
            '</thead>' +
            '<tbody>'


    album["musiques"].forEach(function (musique) {
        html += 
        
        '<tr>' +
            '<td><button type="button" class="musique-bouton-album" value="' + musique["id_musique"] + '">' + musique["titre_musique"] + '</button></td>' +
            '<td>' + musique["duree_musique"] + '</td>' +
            '<td> suppr </td>'
        '</tr>';

    })

    html += '</tbody>' +
        '</table>' +
        '</div>';
        
    $(".flex-page").html(html)

    $(".musique-bouton").click(function (event) {
        let id = $(event.target).closest('.musique-bouton').attr('value')   // id de la musique
        console.log(id)
        ajaxRequest("GET", "request.php/musique/" + id, showMusique)
    })

    $(".artiste-bouton").click(function (event) {
        let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
        console.log(id);
        ajaxRequest("GET", "request.php/artiste/" + id, showArtiste)
    })

}

$("#id-bouton-user").click(function (event) {
    ajaxRequest("GET", "request.php/profil/" + id_user, loadProfil)
})

function loadProfil(profil) {
    console.log(profil)
    $(".flex-page").html('<form action="Deconnexion.php"><button id="deco">Se déconnecter</button></form>' +
        '<h1><div id="nom_user">' + profil["nom_user"] + '</div>' + ' ' + '<div id="prenom_user">' + profil["prenom_user"] + '</div></h1>' +
        '<p><div id="date_naissance">' + profil["date_naissance_user"] + '</div></p>' +
        '<p>' + profil["age"] + '</p>' +
        '<div id="mail"><p id="mail">' + profil["mail_user"] + '</p></div>' +
        '<button type="button" class="btn" id="modif_profil">Modifier votre profil</button>' //on pourra enlever class btn
    )
    $('#modif_profil').click(function (event) {

        $('.flex-page').append('<form id="changement_profil" action="#" method="post">' +
            '<label for="userInput" class="form-label">Nom :</label>\n' +
            '<input type="text" class="form-control" id="nouveau_nom" aria-describedby="userInput" name="nouveau_nom" value="' + $("#nom_user").text() + '">' +
            '<label for="userInput" class="form-label">Prenom :</label>' +
            '<input type="text" class="form-control" id="nouveau_prenom" aria-describedby="userInput" name="nouveau_prenom" value="' + $("#prenom_user").text() + '">' +
            '<label for="userInput" class="form-label">Date de naissance :</label>' +
            '<input type="text" class="form-control" id="nouvelle_date" aria-describedby="userInput" name="nouvelle_date" value="' + $("#date_naissance").text() + '">' +
            '<label for="userInput" class="form-label">Mail :</label>' +
            '<input type="text" class="form-control" id="nouveau_mail" aria-describedby="userInput" name="nouveau_mail" value="' + $("#mail").text() + '">' +
            '<button id="valider" type="button">Valider</button>' +
            '<button id="annuler" type="button">Annuler</button>' +
            '</form>')

        $('#annuler').click(function (event) {
            event.preventDefault()
            ajaxRequest("GET", "request.php/profil/" + id_user, loadProfil)
        })
        $('#valider').click(function (event) {
            event.preventDefault()
            console.log($('#nouveau_nom').val())
            console.log($('#nouveau_prenom').val())
            console.log($('#nouvelle_date').val())
            console.log($('#nouveau_mail').val())

            ajaxRequest("PUT", "request.php/profil/" + id_user, (result) => {
                let resultat = JSON.stringify(result)
                console.log("resuuult", resultat)
                ajaxRequest("GET", "request.php/profil/" + id_user, loadProfil)
                if (resultat === '"Mail déjà utilisé"') {
                    console.log('aaaa')
                    setTimeout(() => {
                        $(".flex-page").append('<p class="erreur_mail">Mail déjà utilisé</p>')
                    }, 200)
                }
            }, 'nom=' + $('#nouveau_nom').val() + '&prenom=' + $('#nouveau_prenom').val() + '&date=' + $('#nouvelle_date').val() + '&mail=' + $('#nouveau_mail'))
        })
    })


}


function showArtiste(artiste) {
    console.log(artiste)
    console.log(artiste["pseudo_artiste"])
    let html = 
    
    '<div class="titre-text-artiste">' +
      '<h1 id="titre-page-de-recherche"> Artiste : ' + artiste["pseudo_artiste"] + '</h1>' +
      '<br>' +
      '<div class="text-artiste">' +
        '<p> Nom artiste : ' + artiste["nom_artiste"] + '</p>' +
        '<p> Prenom artiste : ' + artiste["prenom_artiste"] + '</p>' +
        '<p> Type de chant : ' + artiste["type_artiste"] + '</p>' +
        '<p> Style : ' + artiste["nom_style"] + '</p></div>' +
      '</div>' +
      '<hr id="trait">' +
        '<div class="page-table" id="titre-table">' +
          '<table class="table" id="texte-titre-table">' +
            '<thead>' +
              '<tr>' +
                '<th scope="col">Titre</th>' +
                '<th scope="col">Album</th>' +
                '<th scope="col">Durée</th>' +
                '<th scope="col">Suppr</th>' +
              '</tr>' +
            '</thead>' +
            '<tbody>'

    artiste["musiques"].forEach(function (musique) {
        html += '<tr>' +
            '<th scope="row"><button type="button" class="musique-bouton" value="' + musique["id_musique"] + '">' + musique["titre_musique"] + '</button></th>' +
            '<td><button type="button" class="album-bouton" value="' + musique["id_album"] + '">' + musique["titre_album"] + '</button></td>' +
            '<td> ' + musique["duree_musique"] + '</td>' +
            '<td> suppr </td>' +
            '</tr>'

    })

    html += '</tbody>' +
        '</table>' +
        '</div>';

    $(".flex-page").html(html)
    $(".musique-bouton").click(function (event) {
        let id = $(event.target).closest('.musique-bouton').attr('value')   // id de la musique
        console.log(id)
        ajaxRequest("GET", "request.php/musique/" + id, showMusique)
    })
    $(".album-bouton").click(function (event) {
        let id = $(event.target).closest('.album-bouton').attr('value')   // id de l'album
        console.log(id)
        ajaxRequest("GET", "request.php/album/" + id, showAlbum)
    })
}