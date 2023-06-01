ajaxRequest("GET", "../models/request.php/musique/", loadMusique)

function loadMusique(musiques){
    console.log(musiques)
    $("zzz").html()
    musiques.forEach(function (musique){
        console.log(musique)
        $("zzz").append('<p>'+musique["titre_musique"]+'</p>')
    })

}