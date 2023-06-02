
let id_user=document.getElementById("id_user").innerText
ajaxRequest("GET", "request.php/historique/"+id_user, loadHistorique)
ajaxRequest("GET","request.php/playlist_list/"+id_user, loadPlaylists)   //id_user sera ce qu'on va retrouver
                                                        //dans id dans request.php (car après le /)

function loadHistorique(musiques){
    console.log(musiques)
    $(".flex-page").html('')
    let text=
    
    '<div class="titre-page">' +
      '<label>Derniers morceaux écoutés</label>' +
    '</div>' +
    '<div class="barre-page">' +
      '<hr>' +
    '</div>' +
    '<div class="card" style="width: 10rem;">' +
      '<div class="card-body">' +

    musiques.forEach(function (musique){
        console.log(musique)

        text+= '<h5 class="card-title">' + musique["titre_musique"] + '</h5>' + 
            '<p class="card-text">' +musique["nom_artiste"]+'</p>' + 
            '</div>' + 
            '</div>'

    })
    $(".flex-page").append(text+'</div>')
}

function loadPlaylists(playlists){
    console.log(playlists)
    playlists.forEach(function (playlist){
        console.log(playlist)
        $(".flex-playlist").append('<button class="btn playlist-bouton" value="'+playlist["id_playlist"]+'" type="submit">'+playlist["titre_playlist"]+'</button>')
    })

    $(".playlist-bouton").click(function (event) {
        let id = $(event.target).closest('.playlist-bouton').attr('value')
        console.log(id)
        ajaxRequest("GET", "request.php/playlist/" + id, showPlaylist)
        }
        )

}

function showPlaylist(playlist){    //affiche les musiques d'une playlist
    console.log(playlist)
    $(".flex-page").html('<h1>'+playlist["titre_playlist"]+'</h1>' +
        '<p>Créée le '+playlist["date_creation_playlist"]+'</p>' +
        '<table>' +
        '<tr><th>Titre</th><th>Artiste</th><th>Album</th><th>Date d\'ajout</th><th>Durée</th></tr>')

    let text=""
    playlist["musiques"].forEach(function (musique){
        text+='<tr>' +
            '<td><button type="button" class="musique-bouton" value="'+musique["id_musique"]+'">' + musique["titre_musique"] + '</button></td>' +
        '<td><button type="button" class="artiste-bouton" value="'+musique["id_artiste"]+'">' + musique["pseudo_artiste"] + '</button></td>' +
        '<td><button type="button" class="album-bouton" value="'+musique["id_album"]+'">' + musique["titre_album"] + '</button></td>' +
        '<td>'+musique["date_ajout_musique_playlist"]+' </td> <td> '+musique["duree_musique"]+'</td>' +
            '</tr>'

    })
    $(".flex-page").append(text+'</table>')
    //faut ajouter tous les .click pour les xxx-bouton

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

function showMusique(musique){
    console.log(musique)
    console.log(musique["titre_musique"])
    $(".flex-page").html('<h1>'+musique["titre_musique"]+'</h1>' +
        '<p>'+musique["duree_musique"]+'</p>' +
        '<p>Parue le '+musique["date_parution_musique"]+'</p>' +
        '<button type="button" class="album-bouton" value="'+musique["id_album"]+'">' + musique["titre_album"] + '</button>' +
        '<button type="button" class="artiste-bouton" value="'+musique["id_artiste"]+'">' + musique["pseudo_artiste"] + '</button>' +
        '<p>'+musique["nom_style"]+'</p>')

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

function showAlbum(album) {    //affiche les musiques d'un album
    console.log(album)
    $(".flex-page").html('<h1>' + album["titre_album"] + '<h4> par : ' + album['pseudo_artiste'] + '</h4></h1>' +
        '<p>Créé le ' + album["date_creation_album"] + '</p>' +
        '<table>' +
        '<tr><th>Titre</th><th>Durée</th></tr>')

    let text = ""
    album["musiques"].forEach(function (musique) {
        text += '<tr>' +
            '<td><button type="button" class="musique-bouton" value="' + musique["id_musique"] + '">' + musique["titre_musique"] + '</button></td>' +
            '<td>' + musique["duree_musique"] + '</td>' +
            '</tr>'

    })
    $(".flex-page").append(text + '</table>')

    $(".musique-bouton").click(function (event){
        let id = $(event.target).closest('.musique-bouton').attr('value')   // id de la musique
        console.log(id)
        ajaxRequest("GET", "request.php/musique/"+id, showMusique)
    })
}


$("#id-bouton-user").click(function (event){
    ajaxRequest("GET", "request.php/profil/"+id_user, loadProfil)
})

function loadProfil(profil){
    console.log(profil)
    $(".flex-page").html('<h1>'+profil["prenom_user"]+' '+profil["nom_user"]+'</h1>' +
        '<p>'+profil["date_naissance_user"]+'</p>' +
        '<p>'+profil["age"]+'</p>'+
        '<p>'+profil["mail_user"]+'</p>'+
        '<button type="button" id="password">Modifier votre mot de passe</button>'
    )
}


function showArtiste(artiste){
    console.log(artiste)
    console.log(artiste["pseudo_artiste"])
    $(".flex-page").html('<h1>' + artiste["pseudo_artiste"] + '</h1>' +
    '<p>' + artiste["nom_artiste"] + '</p>' +
    '<p>' + artiste["prenom_artiste"] + '</p>' +
    '<p>' + artiste["type_artiste"] + '</p>' +
        '<p>'+artiste["nom_style"]+'</p>'
    
    //Rajouter les albums
    
    )
}