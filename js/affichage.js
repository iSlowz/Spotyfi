let id_user=document.getElementById("id_user").innerText
ajaxRequest("GET", "request.php/historique/"+id_user, loadHistorique)

function loadHistorique(musiques){
    console.log(musiques)
    $(".flex-page").html()
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