let currentFilter = 0;


$("#starFilter1").click(function() {
    currentFilter = currentFilter == 1 ? 0 : 1

    if(currentFilter == 1) {
        HideItemsRatings(1)
        manageCss(1);
    }
    else UnHideItems()   
});


$("#starFilter2").click(function() {
    currentFilter = currentFilter == 2 ? 0 : 2

    if(currentFilter == 2) {
        HideItemsRatings(2)
        manageCss(2);
    }
    else UnHideItems() 
});

$("#starFilter3").click(function() {
    currentFilter = currentFilter == 3 ? 0 : 3

    if(currentFilter == 3) {
        HideItemsRatings(3)
        manageCss(3);
    }
    else UnHideItems() 
});

$("#starFilter4").click(function() {
    currentFilter = currentFilter == 4 ? 0 : 4

    if(currentFilter == 4) {
        HideItemsRatings(4)
        manageCss(4);
    }
    else UnHideItems() 
});

$("#starFilter5").click(function() {
    currentFilter = currentFilter == 5 ? 0 : 5

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