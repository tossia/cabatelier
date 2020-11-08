// Affichage Date et l'heure 
function clock() {
    var d = new Date();
    var day = d.getDate();
    var month_num = d.getMonth();
    var dayweek_num = d.getDay();
    var hours = d.getHours();
    var minutes = d.getMinutes();
    var seconds = d.getSeconds();
    weekday = new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    month = new Array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septempbre", "octobre", "novembre", "decembre");
    if (day <= 9)
        day = "0" + day;
    if (hours <= 9)
        hours = "0" + hours;
    if (minutes <= 9)
        minutes = "0" + minutes;
    if (seconds <= 9)
        seconds = "0" + seconds;
    date_time = weekday[dayweek_num] + " le " + day + " " + month[month_num] + " " + d.getFullYear() +
            " " + " - " + hours + "h" + minutes + "m" + seconds;
    document.getElementById("doc_time").innerHTML = date_time;
    setTimeout("clock()", 1000);
};

if ($("p").is("#doc_time")) {
    clock();
};

function numSerie() {
    smoke.prompt("Scanner le code barre", function (result) {
        if (result === false)
            return;
        smoke.confirm("Vérifiez le résultat <b>" + result + "</b>", function (confirmation) {
            if (confirmation === false) {
                return;
            } else {
                document.getElementById("num_serie").value = result;
            }
        });
    });
}


function new_article() {
    let num_affaire = document.forms['form']["num_affaire"].value;
    let fabricant = document.forms['form']["fabricant"].value;
    if (num_affaire == '') {
        smoke.alert("Il faut choisir le numero d'affaire");
    }
    else if (fabricant == '') {
        smoke.alert("Il faut choisir le fabricant");
    }
}

