// cambio select in pagina trova-clienti.php

$(document).ready(function(){
   $('#mega').on('change', function() {
       var mega_id = this.value;
       var dataString = 'id='+ mega_id;

       $.ajax
       ({
           type: "POST",
           url: "../php/getMacro.php",
           data: dataString,
           cache: false,
           success: function(html)
           {
               $("#macro").html(html);
           }
       });
   });

    $('#trovaClienti').on('click', function() {
        var macro_id = $();
        var macro_id = this.value;
        
        var dataString = 'id='+ mega_id;

        $.ajax
        ({
            type: "POST",
            url: "../php/getMacro.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $("#macro").html(html);
            }
        });
    });
});

// parte form

$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Hai completato correttamente i campi?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content
    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();

    $.ajax({
        type: "POST",
        url: "php/form-process.php",
        data: "name=" + name + "&email=" + email + "&message=" + message,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Messaggio inviato!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}

