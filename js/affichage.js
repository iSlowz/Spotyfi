let id_user=document.getElementById("id_user").innerText
ajaxRequest("GET", "request.php/historique/"+id_user, loadHistorique)
ajaxRequest("GET","request.php/playlist_list/"+id_user, loadPlaylists)   //id_user sera ce qu'on va retrouver
                                                        //dans id dans request.php (car après le /)

function loadHistorique(musiques){
    console.log(musiques)
    $(".flex-page").html('')
    let text='<div class="titre-page">' +
        '            <label>Derniers morceaux écoutés</label>' +
        '          </div>' +
        '          <div class="barre-page">' +
        '            <hr>' +
        '          </div>' +
        '          <div id="dernier-morceaux-page">'
    musiques.forEach(function (musique){
        console.log(musique)

        text+= '<p>'+musique["titre_musique"]+'</p>' + //Faudra faire un rectangle clean avec titre et
            '<p>' +musique["nom_artiste"]+'</p>' + // en plus petit en dessous auteur (et à gauche photo de la musique)
            '<hr>'

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

function showPlaylist(playlist){
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
        '<button type="button" class="album-bouton" value="'+musique["id_album"]+'">' + musique["title_album"] + '</button></td>' +
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
        '<button type="button" class="album-bouton" value="'+musique["id_album"]+'">' + musique["title_album"] + '</button>' +
        '<button type="button" class="artiste-bouton" value="'+musique["id_artiste"]+'">' + musique["pseudo_artiste"] + '</button>' +
        '<p>'+["nom_style"]+'</p>')
}