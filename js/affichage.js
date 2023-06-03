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
        '          <div class="flex-card" id="dernier-morceaux-page">'
    musiques.forEach(function (musique){
        console.log(musique)

        text+=
        '<div class="card" id="id-card" style="width: 17%;">'+ // Amélioration, mettre les derniers morceaux à gauches
          '<div class="card-body">'+
            '<div class="id_musique" style="display: none">'+musique["id_musique"]+'</div>'+
             '<h5 class="card-title">' + musique["titre_musique"] + '</h5>' + 
             '<p class="card-text">' + musique["pseudo_artiste"] + '</p>'+
           '</div>'+
        '</div>'

    })
    $(".flex-page").append(text+'</div>')
    $(".card-body").click(function (event){
        let id = $(event.target).closest(".card").find(".id_musique").text();
        console.log(id)
        ajaxRequest("GET", "request.php/musique/"+id, showMusique)
    })
}

function loadPlaylists(playlists){
    console.log(playlists)
    playlists.forEach(function (playlist){
        console.log(playlist)
        $(".flex-playlist").append('<button class="playlist-bouton" value="'+playlist["id_playlist"]+'" type="submit">'+playlist["titre_playlist"]+'</button>')
    })

    $(".playlist-bouton").click(function (event) {
        let id = $(event.target).closest('.playlist-bouton').attr('value')
        console.log(id)
        ajaxRequest("GET", "request.php/playlist/" + id, showPlaylist)
        }
        )

}

function showPlaylist(playlist){    //affiche les musiques d'une playlist
    console.log(playlist);

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
        '<th scope="row">' + musique["titre_musique"] + '</th>' +
        '<td>' + musique["pseudo_artiste"] + '</td>' +
        '<td>' + musique["titre_album"] + '</td>' +
        '<td>' + musique["date_ajout_musique_playlist"] + '</td>' +
        '<td>' + musique["duree_musique"] + '</td>' +
        '<td>Bouton supprimer</td>' +
        '</tr>';
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
    $(".flex-page").html('<h1>' + album["titre_album"] + '</h1>' +
        '<h4> par : <button type="button" class="artiste-bouton" value="'+album["id_artiste"]+'">' + album["pseudo_artiste"] + '</button>'  + '</h4>' +
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

    $(".artiste-bouton").click(function (event){
        let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
        console.log(id);
        ajaxRequest("GET", "request.php/artiste/"+id, showArtiste)
    })
}


$("#id-bouton-user").click(function (event){
    ajaxRequest("GET", "request.php/profil/"+id_user, loadProfil)
})

function loadProfil(profil){
    console.log(profil)
    $(".flex-page").html('<h1><div id="nom_user">'+profil["nom_user"]+'</div>'+' '+'<div id="prenom_user">'+profil["prenom_user"]+'</div></h1>' +
        '<p><div id="date_naissance">'+profil["date_naissance_user"]+'</div></p>' +
        '<p>'+profil["age"]+'</p>'+
        '<div id="mail"><p id="mail">'+profil["mail_user"]+'</p></div>'+
        '<button type="button" id="modif_profil">Modifier votre profil</button>'
    )
    $('#modif_profil').click(function (event){

        $('.flex-page').append('<form id="changement_profil" action="#" method="post">' +
            '<label for="userInput" class="form-label">Nom :</label>\n' +
            '<input type="text" class="form-control" id="nouveau_nom" aria-describedby="userInput" name="nouveau_nom" value="'+$("#nom_user").text()+'">' +
            '<label for="userInput" class="form-label">Prenom :</label>' +
            '<input type="text" class="form-control" id="nouveau_prenom" aria-describedby="userInput" name="nouveau_prenom" value="'+$("#prenom_user").text()+'">'+
            '<label for="userInput" class="form-label">Date de naissance :</label>' +
            '<input type="text" class="form-control" id="nouvelle_date" aria-describedby="userInput" name="nouvelle_date" value="'+$("#date_naissance").text()+'">' +
            '<button id="valider" type="button">Valider</button>'+
            '<button id="annuler" type="button">Annuler</button>'+
            '</form>')
        $('#annuler').click(function (){
            ajaxRequest("GET", "request.php/profil/"+id_user, loadProfil)
        })
        $('#valider').click(function (){

            console.log($('#nouveau_nom').val())
            console.log($('#nouveau_prenom').val())
            console.log($('#nouvelle_date').val())

            ajaxRequest("PUT","request.php/profil/"+id_user,() => {
                ajaxRequest("GET", "request.php/profil/"+id_user, loadProfil)
            },'nom='+$('#nouveau_nom').val()+'&prenom='+$('#nouveau_prenom').val()+'&date='+$('#nouvelle_date').val())
        })
    })


}


function showArtiste(artiste){
    console.log(artiste)
    console.log(artiste["pseudo_artiste"])
    $(".flex-page").html('<h1>' + artiste["pseudo_artiste"] + '</h1>' +
    '<p>' + artiste["nom_artiste"] + '</p>' +
    '<p>' + artiste["prenom_artiste"] + '</p>' +
    '<p>' + artiste["type_artiste"] + '</p>' +
        '<p>'+artiste["nom_style"]+'</p>'
    )
    let text=""
    text+='<table>' +
    '<tr><th>Titre</th><th>Album</th><th>Durée</th></tr>'


    artiste["musiques"].forEach(function (musique){
        text+='<tr>' +
            '<td><button type="button" class="musique-bouton" value="'+musique["id_musique"]+'">' + musique["titre_musique"] + '</button></td>' +
            '<td><button type="button" class="album-bouton" value="'+musique["id_album"]+'">' + musique["titre_album"] + '</button></td>' +
            '<td> '+musique["duree_musique"]+'</td>' +
            '</tr>'

    })
    $(".flex-page").append(text+'</table>')
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
}