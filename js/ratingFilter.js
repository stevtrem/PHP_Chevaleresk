let currentFilter = 0;
let count1 = $('.ratingAvg1').length / 2;
let count2 = $('.ratingAvg2').length / 2;
let count3 = $('.ratingAvg3').length / 2;
let count4 = $('.ratingAvg4').length / 2;
let count5 = $('.ratingAvg5').length / 2;

countRating();


$("#starFilter1").click(function() {
    currentFilter = currentFilter == 1 ? 0 : 1

    $(".ratingFilterError").remove();
    
    if(count2 < 1 && currentFilter == 1) {
        $("#boutique").append("<div class=\"ratingFilterError\">Il n'y aucun item avec l'évaluation selectionner pour le moment");
    }
    if(currentFilter == 1) {
        HideItemsRatings(1)
        manageCss(1);
    }
    else UnHideItems()   
});


$("#starFilter2").click(function() {
    currentFilter = currentFilter == 2 ? 0 : 2

    $(".ratingFilterError").remove();
    if(count2 < 1 && currentFilter == 2) {
        $("#boutique").append("<div class=\"ratingFilterError\">Il n'y aucun item avec l'évaluation selectionner pour le moment");
    }
    if(currentFilter == 2) {
        HideItemsRatings(2)
        manageCss(2);
    }
    else UnHideItems() 
});

$("#starFilter3").click(function() {
    currentFilter = currentFilter == 3 ? 0 : 3

    $(".ratingFilterError").remove();

    if(count3 < 1 && currentFilter == 3) {
        $("#boutique").append("<div class=\"ratingFilterError\">Il n'y aucun item avec l'évaluation selectionner pour le moment");
    }
    if(currentFilter == 3) {
        HideItemsRatings(3)
        manageCss(3);
    }
    else UnHideItems() 
});

$("#starFilter4").click(function() {
    currentFilter = currentFilter == 4 ? 0 : 4

    $(".ratingFilterError").remove();

    if(count4 < 1 && currentFilter == 4) {
        $("#boutique").append("<div class=\"ratingFilterError\">Il n'y aucun item avec l'évaluation selectionner pour le moment");
    }
    if(currentFilter == 4) {
        HideItemsRatings(4)
        manageCss(4);
    }
    else UnHideItems() 
});

$("#starFilter5").click(function() {
    currentFilter = currentFilter == 5 ? 0 : 5

    $(".ratingFilterError").remove();

    if(count5 < 1 && currentFilter == 5) {
        $("#boutique").append("<div class=\"ratingFilterError\">Il n'y aucun item avec l'évaluation selectionner pour le moment");
    }
    if(currentFilter == 5) {
        HideItemsRatings(5)
        manageCss(5);
    }
    else UnHideItems() 
});

function HideItemsRatings($ratingToNotHide) {

    if($ratingToNotHide == 1)$(".ratingAvg1").css("display", "table-row")
    else $(".ratingAvg1").css("display", "none")
    
    if($ratingToNotHide == 2)$(".ratingAvg2").css("display", "table-row")
    else $(".ratingAvg2").css("display", "none")

    if($ratingToNotHide == 3)$(".ratingAvg3").css("display", "table-row")
    else $(".ratingAvg3").css("display", "none")

    if($ratingToNotHide == 4)$(".ratingAvg4").css("display", "table-row")
    else $(".ratingAvg4").css("display", "none")

    if($ratingToNotHide == 5)$(".ratingAvg5").css("display", "table-row")
    else $(".ratingAvg5").css("display", "none")

    $(".ratingAvg0").css("display", "none")
}
function UnHideItems() {
    $(".ratingAvg1").css("display", "table-row")
    $(".ratingAvg2").css("display", "table-row")
    $(".ratingAvg3").css("display", "table-row")
    $(".ratingAvg4").css("display", "table-row")
    $(".ratingAvg5").css("display", "table-row")
    $(".ratingAvg0").css("display", "table-row")
    uncheckRatings()
    $(".ratingFilterError").remove();
}
function manageCss($starRating){
    for (let i = 1; i <= 5; i++){
        if (i != $starRating)
            $("#starFilter" + i + " > .glyphicon-star").css("color", 'white');
        else{
            $("#starFilter" + i + " > .glyphicon-star").css("color", '#FFBD03');
        }
    }
}
function uncheckRatings(){
    for (let i = 1; i <= 5; i++)
        $("#starFilter" + i + " > .glyphicon-star").css("color", 'white');
}
function countRating() {
    $("#ratingCount1").text("(" + count1 + ")");
    $("#ratingCount2").text("(" + count2 + ")");
    $("#ratingCount3").text("(" + count3 + ")");
    $("#ratingCount4").text("(" + count4 + ")");
    $("#ratingCount5").text("(" + count5 + ")");
}