$(document).ready(function(){
    let stepSubmit = 0;
    let errorAddItem = $("#errorAddItem");



    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageDisplayAddItem').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileInput").change(function(){
        readURL(this);
    });

    $("#addItemForm").submit(function(e) {
        let inputName = $("#itemName").val();
        let inputQt = $("#qtStock").val();
        let inputPrice = $("#price").val();
        let inputEfficacite = $("#efficacite").val();
        let inputGenre = $("#genre").val();
        let inputDescriptionArme = $("#descriptionArme").val();
        let inputMatiere = $("#matiere").val();
        let inputPoids = $("#poids").val();
        let inputTaille = $("#taille").val();
        let inputEffet = $("#effet").val();
        let inputDuree = $("#duree").val();
        let inputDescriptionRes = $("#descriptionRes").val();


        stepSubmit++;
        errorAddItem.css("display","none");
        if(stepSubmit < 2) {
            e.preventDefault()
            
            //$(".step1").css("display","block");
            //$("#uploadFileCustom").css("display","flex");

            if(inputName && inputQt && inputPrice && $("#selectAddItem").val()) {
                $(".step1").css("display","none");
                $("#uploadFileCustom").css("display","none");
                $("." + $("#selectAddItem").val()).css("display","block");
                $("#backAddItem").css("display","block");
            }
            else {
                errorAddItem.css("display","block");
                stepSubmit--;
            }

        }
        else {
            switch($("#selectAddItem").val()){
            case "wpn":
                if(!inputEfficacite || !inputGenre || !inputDescriptionArme) {
                    e.preventDefault() 
                    errorAddItem.css("display","block");
                    stepSubmit--;
                }
                break;
            case "arm":
                if(!inputMatiere || !inputPoids || !inputTaille) {
                    e.preventDefault() 
                    errorAddItem.css("display","block");
                    stepSubmit--;
                }
                break;
            case "pot":
                if(!inputEffet || !inputDuree) {
                    e.preventDefault() 
                    errorAddItem.css("display","block");
                    stepSubmit--;
                }
                break;
            case "res":
                if(!inputDescriptionRes) {
                    e.preventDefault() 
                    errorAddItem.css("display","block");
                    stepSubmit--;
                }
                break;
        }
        }
        
    });

    $("#backAddItem").click(function() {
        stepSubmit--;
        $(".step1").css("display","block");
        $("#uploadFileCustom").css("display","flex");
        $("." + $("#selectAddItem").val()).css("display","none");
        $("#backAddItem").css("display","none");
    });
})