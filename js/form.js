$(document).ready(function(){

    $("#firstName").on("keydown", function(ev)
    {
        let listeValide = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXRZ ";
        let backspace = "Backspace";
        let tab = "Tab";
        
        let touche = ev.key;

        if (touche != backspace && touche != tab && listeValide.indexOf(touche) == -1)
        {
            ev.preventDefault();
        }
    });

    $("#lastName").on("keydown", function(ev)
    {
        let listeValide = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXRZ ";
        let backspace = "Backspace";
        let tab = "Tab";
        
        let touche = ev.key;

        if (touche != backspace && touche != tab && listeValide.indexOf(touche) == -1)
        {
            ev.preventDefault();
        }
    });

    $("#alias").on("keydown", function(ev)
    {
        let listeValide = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXRZ ";
        let backspace = "Backspace";
        let tab = "Tab";
        
        let touche = ev.key;

        if (touche != backspace && touche != tab && listeValide.indexOf(touche) == -1)
        {
            ev.preventDefault();
        }
    });

    $('#addFundsInput').on("keydown", function(ev)
    {
        let listeValide = "1234567890";
        let backspace = "Backspace";
        let tab = "Tab";

        let touche = ev.key;

        if (touche != backspace && touche != tab && listeValide.indexOf(touche) == -1){
            ev.preventDefault();
        }
    })

    $("#selectPlayer").on("change", function(){
        let alias = $(this).val();
        if (alias != "Choisir Joueur"){
            $('#selectPlayerForm').submit();
        }
    });
});

