// Main page
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
    let repere_schema = document.forms['form']["repere"].value;
    let emplacement = document.forms['form']["emplacement"].value;
    let fabricant = document.forms['form']["fabricant"].value;
    if (repere_schema == '') {
        smoke.alert("Il faut choisir une repére schema");
        return false;
    } else if (emplacement == '') {
        smoke.alert("Il faut choisir un emplacemnt ");
        return false;
    } else if (fabricant == '') {
        smoke.alert("Il faut choisir le fabricant");
        return false;
    } else {
        return true;
    }
}

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
}
;
if ($("p").is("#doc_time")) {
    clock();
}

//Check Nomenclature file for import

function verifImport() {
    let file = document.getElementById("uploadCSV");
    let ext = file.name.split('.').pop();

    
    if (ext == 'csv') {
        smoke.alert("Fichier doit être en format CSV");
        return false;
    } else {
        return true;
    }
}
