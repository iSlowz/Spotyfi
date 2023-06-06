//recupère l'id de l'uilisateur présente dans la value du bouton du profil
let id_user = $("#id-bouton-user").val()

//Charge l'historique et la liste de playlist
ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
ajaxRequest("GET", "request.php/playlist_list/" + id_user, loadPlaylists)


$('.flex-recherche').submit(function (event){
    event.preventDefault()
    console.log($('#bar-recherche').val())
    if ($('#bar-recherche').val()!="") {
        ajaxRequest("GET", "request.php/recherche/", showRecherches, 'recherche=' + $('#bar-recherche').val())
    }
    else{
        ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
    }
})
$('#bar-recherche').on('input',function (event){
    console.log($('#bar-recherche').val())
    if ($('#bar-recherche').val()!="") {
        ajaxRequest("GET", "request.php/recherche/", showRecherches, 'recherche=' + $('#bar-recherche').val())
    }
    else{
        ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
    }
})
$('#id-bouton-creer').click(function() {
    console.log("creer");
    $('.flex-page').html(
            
          '<div class="card-créer-playlist">' +
            '<h1 class="card-title-créer-playlist">' +
              'Créer une Playlist' +
            '</h1>' +
          '</div>' +
          '<hr class="trait-long">' +
          '<form action="#" method="post" id="form-playlist">' +
            '<br>'+
            '<h4 for="userInput" class="titre-nouvelle-playlist">Titre de la Playlist : </h4>' +
            '<input type="text" class="text-bar-style" id="titre" aria-describedby="userInput" name="titre">' +
            '<br>'+
            '<button class="bouton-valid-annule" id="annuler" type="button">Annuler</button>' +
            '<button class="bouton-valid-annule" id="valider" type="submit">Valider</button>' +
          '</form>' + 
        '</div>');

    $('#annuler').click(function (event) {
        event.preventDefault()
        ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
    })
    $('#form-playlist').submit(function (event) {
        event.preventDefault()
        console.log($('#titre').val())
        ajaxRequest("POST", "request.php/playlist_list/" + id_user, () => {
            ajaxRequest("GET", "request.php/playlist_list/" + id_user, loadPlaylists)
            ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
        }, 'titre=' + $("#titre").val())

    })
});
$('#btn-creer-playlist').click(function() {
    var nomPlaylist = $('#nom-playlist').val();
    // Traitez le nom de la playlist ici
    $('#modal-creer-playlist').modal('hide');
});

function showRecherches(recherches) {
    console.log(recherches);
    let html=
    
        '<h1 id="titre-recherche-spécifique">Recherche : </h1>' +
        '<div class="flex-bouton-recherche-spécifique">' +
          '<button class="bouton-recherche-spécifique" type="button" id="musique-search" value="musique">Musique</button>' +
          '<button class="bouton-recherche-spécifique" type="button" id="artiste-search" value="artiste">Artiste</button>' +
          '<button class="bouton-recherche-spécifique" type="button" id="album-search" value="album">Album</button>' +
        '</div>' +

        // onClick="color()" à faire pour que le bouton change de couleur

        '<div id="liste-musique"><hr class="trait-long"><h1 class="text-gauche">Musiques : </h1>' +
          '<div class="flex-card-musique">'

    recherches["musiques"].forEach(function (musique) {
        html +=
        '<div class="card bouton-musique-select" id="id-card" style="width: 17%;">' + // Amélioration, mettre les derniers morceaux à gauches
          '<div class="card-body musique">' +
            '<div class="id_musique" style="display: none">' + musique["id_musique"] + '</div>' +
              '<h5 class="card-title">' + musique["titre_musique"] + '</h5>' +
              '<p class="card-text"><button type="button" class="artiste-bouton souligne" value="'+musique["id_artiste"] +'">' + musique["pseudo_artiste"] + '</button></p>' +
              '<p>'+musique["duree_musique"]+'</p>' +
            '</div>' +
          '</div>'
    });

    $(".flex-page").html(html + '</div></div>');

    html='<div id="liste-album"><hr class="trait-long"><h1 class="text-gauche">Albums : </h1>' +
        '<div class="flex-card-musique">'
    recherches["albums"].forEach(function (album){
        html +=
            '<div class="card" id="id-card" style="width: 17%;">' + // Amélioration, mettre les derniers morceaux à gauches
            '<div class="card-body album">' +
            '<div class="id_musique" style="display: none">' + album["id_album"] + '</div>' +
            '<h5 class="card-title">' + album["titre_album"] + '</h5>' +
            '<p class="card-text"><button type="button" class="artiste-bouton souligne" value="'+album["id_artiste"] +'">' + album["pseudo_artiste"] + '</button></p>' +
            '</div>' +
            '</div>'
    });

    $(".flex-page").append(html + '</div></div>');

    html='<div id="liste-artiste"><hr class="trait-long"><h1 class="text-gauche">Artistes : </h1>' +
        '<div class="flex-card-musique">'
    recherches["artistes"].forEach(function (artiste) {
        console.log(artiste)
        html +=
            '<div class="card" id="id-card" style="width: 17%;">' + // Amélioration, mettre les derniers morceaux à gauches
            '<div class="card-body artiste">' +
            '<div class="id_musique" style="display: none">' + artiste["id_artiste"] + '</div>' +
            '<h5 class="card-title">' + artiste["pseudo_artiste"] + '</h5>' +
            '<p class="card-text">' + artiste["nom_style"] + '</button></p>' +
            '</div>' +
            '</div>'
    });
    $(".flex-page").append(html + '</div></div>');


    $(".musique").click(function (event) {
        let id = $(event.target).closest(".card").find(".id_musique").text();
        console.log(id)
        ajaxRequest("GET", "request.php/musique/" + id + "?id_user="+id_user, showMusique)
    })
    $(".album").click(function (event) {
        let id = $(event.target).closest(".card").find(".id_musique").text();
        console.log(id)
        ajaxRequest("GET", "request.php/album/" + id, showAlbum)
    })
    $(".artiste").click(function (event) {
        let id = $(event.target).closest(".card").find(".id_musique").text();
        console.log(id)
        ajaxRequest("GET", "request.php/artiste/"+id, showArtiste)
    })
    $(".artiste-bouton").click(function (event){    //à laisser ou non
        let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
        console.log(id);
        ajaxRequest("GET", "request.php/artiste/"+id, showArtiste)

    })
    $("#musique-search").click(function (){
        $("#liste-musique").show()
        $("#liste-album").hide()
        $("#liste-artiste").hide()
    })
    $("#album-search").click(function (){
        $("#liste-musique").hide()
        $("#liste-album").show()
        $("#liste-artiste").hide()
    })
    $("#artiste-search").click(function (){
        $("#liste-musique").hide()
        $("#liste-album").hide()
        $("#liste-artiste").show()
    })
     
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
        ajaxRequest("GET", "request.php/musique/" + id + "?id_user="+id_user, showMusique)
    })
    $(".artiste-bouton").click(function (event){    //à laisser ou non
        let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
        console.log(id);
        ajaxRequest("GET", "request.php/artiste/"+id, showArtiste)

    })
}

function loadPlaylists(playlists) {
    console.log(playlists)
    $(".flex-playlist").html('<label id="Playlist">Playlists</label>'+
    '<button class="playlist-bouton" value="' + playlists["favoris"]["id_playlist"] + '" type="submit">' + playlists["favoris"]["titre_playlist"] + ' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">\n' +
        '            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>\n' +
        '          </svg></button>')
    playlists["playlists"].forEach(function (playlist) {
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
              '<div id="titre-page-des-playlist">' +
                '<h1 class="titre-playlist" id="'+playlist["id_playlist"]+'">' + playlist["titre_playlist"] + '</h1>' +
              '</div>' +
              '<div class="date-container">' +
                '<h4 class="titre-date">' + playlist["date_creation_playlist"] + '</h4>' +
              '</div>' +
            '</div>' +
            '<hr class="trait">' +
              '<div class="page-table" id="titre-table">' +
                '<table class="table" id="texte-titre-table">' +
                  '<thead>' +
                    '<tr>' +
                      '<th scope="col">Jouer</th>' +
                      '<th scope="col">Titre</th>' +
                      '<th scope="col">Artiste</th>' +
                      '<th scope="col">Album</th>' +
                      '<th scope="col">Date dajout</th>' +
                      '<th scope="col">Durée</th>' +
                      '<th scope="col">Aimer</th>'
        if (playlist["titre_playlist"]!=="Favoris") {
            html +=
                '<th>Supprimer</th>'
        }
        html+=
                    '</tr>' +
                  '</thead>' +
                  '<tbody>';

        playlist["musiques"].forEach(function (musique) {
            console.log(musique)
            html +=
                '<tr id="tableau-playlist">' +
                  '<td>' +
                    '<button type="button" class="play-musique" value="' + musique["id_musique"] + '" onClick="playPauseFrom(\'' + musique["lien_musique"] + '\', \'' + musique["photo_album"] + '\' )">' +
                      '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">'+
                        '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>'+
                        '<path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>'+
                      '</svg>' +
                    '</button>' +
                  '</td>' +
                  '<th scope="row">'+
                    '<button type="button" class="musique-bouton" value="' + musique["id_musique"] + '">' + musique["titre_musique"] + '</button>' +
                  '</th>' +
                  '<td>' +
                    '<button type="button" class="artiste-bouton" value="' + musique["id_artiste"] + '">' +
                      musique["pseudo_artiste"] +
                    '</button>' +
                  '</td>' +
                  '<td>' +
                    '<button type="button" class="album-bouton" value="' + musique["id_album"] + '">'
                      + musique["titre_album"] +
                    '</button>' +
                  '</td>' +
                  '<td>'
                    + musique["date_ajout_musique_playlist"] +
                  '</td>' +
                  '<td>'
                    + musique["duree_musique"] +
                  '</td>'
            if (musique["like"]===false) {
                html+='<td><button type="button" class="like-musique" value="' + musique["id_musique"] + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">' +
                    '<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>' +
                    '</svg></button></td>'
            }
            else{
                html+='<td><button type="button" class="unlike-musique" value="' + musique["id_musique"] + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">'+
                    '<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>'+
                    '</svg></button></td>'
            }

            if (playlist["titre_playlist"]!=="Favoris") {
                html+='<td><button type="button" class="delete-musique" value="' + musique["id_musique"] + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">' +
                    '  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>' +
                    '</svg></button></td>'
            }
        });

        html += '</tbody>' +
            '</table>' +
            '</div>'
    if (playlist["titre_playlist"]!=="Favoris") {
        html +=
        '<div class="flex-bouton-supprimer-ajouter">'+
          '<div class="bouton-supprimer-style">' +
            '<button type="button" class="button-delete" value="' + playlist["id_playlist"] + '">Supprimer playlist</button>' +
          '</div>' +
        '</div>';
    }


        $(".flex-page").html(html);

        $(".play-musique").click(function (event) {
            let id = $(event.target).closest('.play-musique').attr('value')
            console.log(id);
            ajaxRequest("POST", "request.php/historique/" + id,()=>{
            },"id_user="+id_user)
        })
        $(".musique-bouton").click(function (event) {
            let id = $(event.target).closest('.musique-bouton').attr('value')   // id de la musique
            console.log(id)
            ajaxRequest("GET", "request.php/musique/" + id + "?id_user="+id_user, showMusique)
        })
        $(".album-bouton").click(function (event) {
            let id = $(event.target).closest('.album-bouton').attr('value')   // id de l'album
            console.log(id)
            ajaxRequest("GET", "request.php/album/" + id, showAlbum)
        })

        $(".artiste-bouton").click(function (event) {
            let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
            console.log(id);
            ajaxRequest("GET", "request.php/artiste/" + id, showArtiste)
        })
        $(".delete-musique").click(function (event){
            console.log(playlist["id_playlist"])
            let id = $(event.target).closest('.delete-musique').attr('value')
            ajaxRequest("DELETE", "request.php/musique/" + id+"."+playlist["id_playlist"], ()=>{
                ajaxRequest("GET", "request.php/playlist/" + playlist["id_playlist"], showPlaylist)
            },)
        })
        $(".like-musique").click(function (event) {
            let id = $(event.target).closest('.like-musique').attr('value')
            console.log(id);
            ajaxRequest("POST", "request.php/like/" + id,()=>{
                ajaxRequest("GET", "request.php/playlist/" + playlist["id_playlist"], showPlaylist)
            },"user="+id_user)
        })
        $(".unlike-musique").click(function (event) {
            let id = $(event.target).closest('.unlike-musique').attr('value')
            console.log(id);
            ajaxRequest("DELETE", "request.php/like/" + id + "?user="+id_user,()=>{
                ajaxRequest("GET", "request.php/playlist/" + playlist["id_playlist"], showPlaylist)
            },)
        })
        $(".button-delete").click(function (event){
            console.log("button-delete")
            let id = $(event.target).closest('.button-delete').attr('value')
            console.log(id)
            ajaxRequest("DELETE", "request.php/playlist/" + id, ()=>{
                ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
                ajaxRequest("GET", "request.php/playlist_list/" + id_user, loadPlaylists)
            })
        },)

    $("#Accueil").click(function (event) {
        ajaxRequest("GET", "request.php/historique/" + id_user, loadHistorique)
    })

}


/*--------------------------------------------------------------------------------------------------------------*/
/* Permet d'afficher les détails sur les musiques */
/*--------------------------------------------------------------------------------------------------------------*/


function showMusique(musique) {
        console.log(musique)
        console.log(musique["titre_musique"])
        $(".flex-page").html(
            '<h1 id="titre-page-de-recherche"> Titre : ' + musique["titre_musique"] + '</h1>' +
            '<br>' +
            '<div class="text-musique">' +
            '<p> Durée : ' + musique["duree_musique"] + '</p>' +
            '<p>Date de parution : ' + musique["date_parution_musique"] + '</p>' +
            '<p> Son album : <button type="button" class="album-bouton" value="' + musique["id_album"] + '">' + musique["titre_album"] + '</button></p>' +
            '<p> Son artiste : <button type="button" class="artiste-bouton" value="' + musique["id_artiste"] + '">' + musique["pseudo_artiste"] + '</button></p>' +
            '<p> Style : ' + musique["nom_style"] + '</p>' +
            '</div>'
        
            )

        $(".flex-page").append('<div class="flex-boutons-musique"')
        
        if (musique["like"]===false) {
            $(".flex-page").append(
                '<button type="button" class="like-musique like-recherche-page" value="' + musique["id_musique"] + '">' + 
                  '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">' +
                    '<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>' +
                  '</svg>'+
                '</button>'
            
            )
            $(".like-musique").click(function (event) {
                let id = $(event.target).closest('.like-musique').attr('value')
                console.log(id);
                ajaxRequest("POST", "request.php/like/" + id,()=>{
                    ajaxRequest("GET", "request.php/musique/"+ id + "?id_user="+id_user, showMusique)
                },"user="+id_user)
            })
        }

        else{
            $(".flex-page").append( //bouton coeur
                
                '<button type="button" class="unlike-musique" value="' + musique["id_musique"] + '">'+
                  '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">'+
                    '<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>'+
                  '</svg>'+
                '</button>'
                
            )
            $(".unlike-musique").click(function (event) {
                let id = $(event.target).closest('.unlike-musique').attr('value')
                console.log(id);
                ajaxRequest("DELETE", "request.php/like/" + id + "?user="+id_user,()=>{
                    ajaxRequest("GET", "request.php/musique/"+ id + "?id_user="+id_user, showMusique)
                },)
            })
        }

        $(".flex-page").append( //bouton +
            
            '<button type="button" class="add-playlist" id="add-playlist" value="'+musique["id_musique"]+'">' +
              '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">' +
                '<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>' +
                '<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>' +
              '</svg>' +
            '</button>'
        
        )
        $(".flex-page").append( //bouton jouer
            
            '<button type="button" class="play-musique" value="' + musique["id_musique"] + '" onClick="playPauseFrom(\'' + musique["lien_musique"] + '\' )">' +
              '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">'+
                '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>'+
                '<path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>'+
              '</svg>' +
            '</button>' 

        )

        $(".flex-page").append('</div>')

        $(".play-musique").click(function (event) {
            let id = $(event.target).closest('.play-musique').attr('value')
            console.log(id);
            ajaxRequest("POST", "request.php/historique/" + id,()=>{
                ajaxRequest("GET", "request.php/musique/" + id + "?id_user="+id_user, showMusique)
            },"id_user="+id_user)
        })
        $("#add-playlist").click(function (event){
            let id = $(event.target).closest('#add-playlist').attr('value')   // id de la musique
            console.log(id)
            ajaxRequest("GET", "request.php/playlist_list/" + id_user + "?musique="+JSON.stringify(musique), loadPlaylistsMain)
        })

        $(".album-bouton").click(function (event) {
            let id = $(event.target).closest('.album-bouton').attr('value')   // id de l'album
            console.log(id)
            ajaxRequest("GET", "request.php/album/" + id, showAlbum)
        })

        $(".artiste-bouton").click(function (event) {
            let id = $(event.target).closest('.artiste-bouton').attr('value')   //id de l'artiste
            console.log(id);
            ajaxRequest("GET", "request.php/artiste/" + id, showArtiste)
        })

}


    function loadPlaylistsMain(playlists){
        console.log(playlists)
        $(".flex-page").html(
            '<div class="titre-ajoute">'+
            '<h2>A quelle playlist souhaitez vous ajoutez : "'+playlists["musique"]["titre_musique"] +
            '" de "'+playlists["musique"]["pseudo_artiste"]+'" ? </h2>'+
            '</div>'+
            '<hr class="trait-long">'
        )

        $(".flex-page").append('<div class="liste-playlist-ajoute">')

        playlists["playlists"].forEach(function (playlist) {
            console.log(playlist)
            $(".flex-page").append(

            '<button type="button" class="add-in-one-playlist" value="' + playlist["id_playlist"] + '" type="submit">' + playlist["titre_playlist"] + '</button>'

            )
        })

        $(".flex-page").append('</div>')


        $(".add-in-one-playlist").click(function (event) {
                let id = $(event.target).closest('.add-in-one-playlist').attr('value')
                console.log(id,playlists["musique"]["id_musique"])
                ajaxRequest("POST", "request.php/playlist/" + id, ()=>{
                    ajaxRequest("GET", "request.php/playlist/" + id, showPlaylist)
                },"id_musique="+playlists["musique"]["id_musique"])
            }
        )


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
            '<hr class="trait">' +
            '<div class="page-table" id="titre-table">' +
            '<table class="table" id="texte-titre-table">' +
            '<thead>' +
            '<tr>' +
            '<th scope="col">Titre</th>' +
            '<th scope="col">Durée</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>'


        album["musiques"].forEach(function (musique) {
            html +=

                '<tr>' +
                '<td><button type="button" class="musique-bouton" value="' + musique["id_musique"] + '">' + musique["titre_musique"] + '</button></td>' +
                '<td>' + musique["duree_musique"] + '</td>' +

            '</tr>';

        })

        html += '</tbody>' +
            '</table>' +
            '</div>';

        $(".flex-page").html(html)

        $(".musique-bouton").click(function (event) {
            let id = $(event.target).closest('.musique-bouton').attr('value')   // id de la musique
            console.log(id)
            ajaxRequest("GET", "request.php/musique/"+ id + "?id_user="+id_user, showMusique)
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
        $(".flex-page").html(
            
            '<div class="flex-info-user">' +
              '<h1>Nom&ensp;:&ensp;</h1>' + ' '+
              '<div id="nom_user">' + 
                '<h1>' + profil["nom_user"] + '</h1>'  +
              '</div>' +
            '</div>' + 
            '<div class="flex-info-user">' +
              '<h1>Prenom&ensp;:&ensp;</h1>' + ' '+
              '<div id="prenom_user">' + 
                '<h1>' +profil["prenom_user"] + '</h1>' +
              '</div>'+
            '</div>' + 

            '<hr class="trait">' +
            
            '<div class="flex-info-user">' +
              '<p>Date de naissance&ensp;:&ensp;</p>' +
              '<div id="date_naissance">' +
                '<p>' + profil["date_naissance_user"] + '</p>' +
              '</div>' +
            '</div>' +

            '<p> Age&ensp;:&ensp;' + profil["age"] + '</p>' +

            '<div class="flex-info-user">' +
              '<p>Courriel&ensp;:&ensp;</p>' +
              '<div id="mail">'+
                '<p>' + profil["mail_user"] + '</p>' + 
              '</div>' +
            '</div>' +

            '<hr class="trait">' +
            
            '<div class="flex-bouton-modif-deco">' +
              '<button type="button" class="bouton-user-modif" id="modif_profil">Modifier votre profil</button>' + 
              '<form action="Deconnexion.php" class="bouton-user-deco">' + 
                '<button class="bouton-user-deco-style" id="deco">Se déconnecter</button>' + 
              '</form>' +
            '</div>'

        )
        $('#modif_profil').click(function (event) {

            $('.flex-page').append(
                '<hr class="trait">' +
                '<div class="form-modif-profil" ' +
                  '<form id="changement_profil" action="#" method="post">' +
                    '<label for="userInput" class="form-label-user">Nom : </label>\n' +
                    '<input type="text" class="form-control" id="nouveau_nom" aria-describedby="userInput" name="nouveau_nom" value="' + $("#nom_user").text() + '">' +
                    '<label for="userInput" class="form-label-user">Prenom : </label>' +
                    '<input type="text" class="form-control" id="nouveau_prenom" aria-describedby="userInput" name="nouveau_prenom" value="' + $("#prenom_user").text() + '">' +
                    '<label for="userInput" class="form-label-user">Date de naissance : </label>' +
                    '<input type="text" class="form-control" id="nouvelle_date" aria-describedby="userInput" name="nouvelle_date" value="' + $("#date_naissance").text() + '">' +
                    '<label for="userInput" class="form-label-user">Mail : </label>' +
                    '<input type="text" class="form-control" id="nouveau_mail" aria-describedby="userInput" name="nouveau_mail" value="' + $("#mail").text() + '">' +
                    '<button class="bouton-valid-annule" id="valider" type="button">Valider</button>' +
                    '<button class="bouton-valid-annule" id="annuler" type="button">Annuler</button>' +
                  '</form>' + 
                '</div>'
                )

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
              '<h1> Artiste : ' + artiste["pseudo_artiste"] + '</h1>' +
              '<br>' +
                '<div class="text-artiste">' +
                  '<p> Nom : ' + artiste["nom_artiste"] + '</p>' +
                  '<p> Prenom : ' + artiste["prenom_artiste"] + '</p>' +
                  '<hr class="petit-trait">' +
                  '<p> Type de chant : ' + artiste["type_artiste"] + '</p>' +
                  '<p> Style : ' + artiste["nom_style"] + '</p></div>' +
                '</div>' +
                '<hr class="trait">'

        html+='<div id="liste-album"><h1>Albums : </h1>' +
            '<div class="flex-card-musique page-album-card">'
        artiste["albums"].forEach(function (album){
            html +=
                '<div class="card " id="id-card" style="width: 17%;">' + // Amélioration, mettre les derniers morceaux à gauches
                  '<div class="card-body album">' +
                    '<div class="id_musique" style="display: none">' + album["id_album"] + '</div>' +
                      '<h5 class="card-title">' + album["titre_album"] + '</h5>' +
                      '<p class="card-text">'+album["date_creation_album"]+'</p>' +
                    '</div>' +
                  '</div>'
        });

        html+='</div></div>';

        html+=
            '<hr class="trait">'+
            '<div class="page-table" id="titre-table">' +
            '<table class="table" id="texte-titre-table">' +
            '<thead>' +
            '<tr>' +
            '<th scope="col">Titre</th>' +
            '<th scope="col">Album</th>' +
            '<th scope="col">Durée</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>'

        artiste["musiques"].forEach(function (musique) {
            html += '<tr>' +
                '<th scope="row"><button type="button" class="musique-bouton" value="' + musique["id_musique"] + '">' + musique["titre_musique"] + '</button></th>' +
                '<td><button type="button" class="album-bouton" value="' + musique["id_album"] + '">' + musique["titre_album"] + '</button></td>' +
                '<td> ' + musique["duree_musique"] + '</td>' +
                '</tr>'

        })

        html += '</tbody>' +
            '</table>' +
            '</div>';

        $(".flex-page").html(html)
        $(".musique-bouton").click(function (event) {
            let id = $(event.target).closest('.musique-bouton').attr('value')   // id de la musique
            console.log(id)
            ajaxRequest("GET", "request.php/musique/" + id + "?id_user="+id_user, showMusique)
        })
        $(".album-bouton").click(function (event) {
            let id = $(event.target).closest('.album-bouton').attr('value')   // id de l'album
            console.log(id)
            ajaxRequest("GET", "request.php/album/" + id, showAlbum)
        })
        $(".album").click(function (event) {
            let id = $(event.target).closest(".card").find(".id_musique").text();
            console.log(id)
            ajaxRequest("GET", "request.php/album/" + id, showAlbum)
        })

}


/*--------------------------------------------------------------------------------------------------------------*/
/* Fonctions relié à la balise audio */
/*--------------------------------------------------------------------------------------------------------------*/

let playing = false;
function playPauseFrom(lien_musique, lien_photo){
    document.getElementById('player').innerHTML = '<source src="' + lien_musique + '" >';
    
    document.getElementById('musique-info').innerHTML = '<img id="photo-album" src="' + lien_photo + '">';

    if(playing){
        pause();
    }
    document.getElementById('player').load();
    lancer();

}

function playPause(){
    if(!playing){
        lancer();
    }
    else{
        pause();
    }
}
function lancer(){
    playing = true;

    document.getElementById('btn-lancer').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pause-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M5 6.25a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5zm3.5 0a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5z"/></svg>';

    myInterval = setInterval(updateMusiqueBar, 1001);

    document.getElementById('player').play();
}
function pause(){
    playing = false;

    document.getElementById('btn-lancer').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/></svg>';
    
    clearInterval(myInterval);
    document.getElementById('player').pause();
}
function updateMusiqueBar(){

    let max = getDuration()-1;
    document.getElementById('range-test').max = max;

    let musiqueBar = document.getElementById('range-test');
    musiqueBar.value = getCurrentTime();

    $("#player").bind('ended', function(){
        musiqueBar.value = 0;
        pause();
    });
    musiqueBar.addEventListener("change", () => {
        const val = musiqueBar.value ;
        setCurrentTime(val);
    });
    console.log(musiqueBar.value);
}


function boucle(){
    if(document.getElementById('player').loop == true){
        console.log('false');
        document.getElementById('player').loop = false;
        document.getElementById('btn-boucle').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16"><path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/></svg>';
    }
    else{
        console.log('true');
        document.getElementById('player').loop = true;
        document.getElementById('btn-boucle').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-repeat-1" viewBox="0 0 16 16"> <path d="M11 4v1.466a.25.25 0 0 0 .41.192l2.36-1.966a.25.25 0 0 0 0-.384l-2.36-1.966a.25.25 0 0 0-.41.192V3H5a5 5 0 0 0-4.48 7.223.5.5 0 0 0 .896-.446A4 4 0 0 1 5 4h6Zm4.48 1.777a.5.5 0 0 0-.896.446A4 4 0 0 1 11 12H5.001v-1.466a.25.25 0 0 0-.41-.192l-2.36 1.966a.25.25 0 0 0 0 .384l2.36 1.966a.25.25 0 0 0 .41-.192V13h6a5 5 0 0 0 4.48-7.223Z"/> <path d="M9 5.5a.5.5 0 0 0-.854-.354l-1.75 1.75a.5.5 0 1 0 .708.708L8 6.707V10.5a.5.5 0 0 0 1 0v-5Z"/> </svg>';
    }
}

function getDuration(){
    let x = document.getElementById('player');
    x.play();
    return parseInt(x.duration);
}
function getCurrentTime(){
    let x = document.getElementById('player');
    x.play();
    return parseInt(x.currentTime);
}
function setCurrentTime(k){
    let x = document.getElementById('player');
    x.play();
    x.currentTime = k;
}

function plus5s(){
    let x = document.getElementById('player');
    x.play();
    x.currentTime += 5;
}
function moins5s(){
    let x = document.getElementById('player');
    x.play();
    x.currentTime -= 5;
}


function setVolume(){
    
    volume_bar.addEventListener("change", () => {
        const vol = volume_bar.value ;
        document.getElementById('player').volume = vol*0.1;
    }); 
    if(volume_bar.value <= 10 && volume_bar.value >= 7){
        document.getElementById('logo-volume').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-volume-up" viewBox="0 0 16 16"> <path d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z"/> <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z"/> <path d="M10.025 8a4.486 4.486 0 0 1-1.318 3.182L8 10.475A3.489 3.489 0 0 0 9.025 8c0-.966-.392-1.841-1.025-2.475l.707-.707A4.486 4.486 0 0 1 10.025 8zM7 4a.5.5 0 0 0-.812-.39L3.825 5.5H1.5A.5.5 0 0 0 1 6v4a.5.5 0 0 0 .5.5h2.325l2.363 1.89A.5.5 0 0 0 7 12V4zM4.312 6.39 6 5.04v5.92L4.312 9.61A.5.5 0 0 0 4 9.5H2v-3h2a.5.5 0 0 0 .312-.11z"/> </svg>';
    }
    else{
        document.getElementById('logo-volume').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-volume-down" viewBox="0 0 16 16"> <path d="M9 4a.5.5 0 0 0-.812-.39L5.825 5.5H3.5A.5.5 0 0 0 3 6v4a.5.5 0 0 0 .5.5h2.325l2.363 1.89A.5.5 0 0 0 9 12V4zM6.312 6.39 8 5.04v5.92L6.312 9.61A.5.5 0 0 0 6 9.5H4v-3h2a.5.5 0 0 0 .312-.11zM12.025 8a4.486 4.486 0 0 1-1.318 3.182L10 10.475A3.489 3.489 0 0 0 11.025 8 3.49 3.49 0 0 0 10 5.525l.707-.707A4.486 4.486 0 0 1 12.025 8z"/> </svg>';
    }
    if(volume_bar.value == 0){
        document.getElementById('logo-volume').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-volume-mute" viewBox="0 0 16 16"> <path d="M6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06zM6 5.04 4.312 6.39A.5.5 0 0 1 4 6.5H2v3h2a.5.5 0 0 1 .312.11L6 10.96V5.04zm7.854.606a.5.5 0 0 1 0 .708L12.207 8l1.647 1.646a.5.5 0 0 1-.708.708L11.5 8.707l-1.646 1.647a.5.5 0 0 1-.708-.708L10.793 8 9.146 6.354a.5.5 0 1 1 .708-.708L11.5 7.293l1.646-1.647a.5.5 0 0 1 .708 0z"/> </svg>';
    }
    
}
let volume_bar = document.getElementById('volume-bar');
volume_bar.value = document.getElementById('player').volume*10;

console.log(volume_bar.value);

setInterval(setVolume, 100);