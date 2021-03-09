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

    // $("#alias").on("keydown", function()
    // {
    //     let size = $("#alias").val().length;
    //     if (size < 3){
    //         $_SESSION['aliasError'] = "L'alias doit contenir au moins 3 caractères";
    //     }
    // });
});