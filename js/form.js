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

    $("select").on("change", function(){
        let alias = $(this).val();
        if (alias != "Choisir Joueur"){
            $.post("Includes/backend.php", {"alias": alias});
            location.reload();
        }
    });
});

