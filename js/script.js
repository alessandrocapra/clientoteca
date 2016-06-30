function validateEmail(email) {
    var re = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return re.test(email);
}

function processForm() {

    // check email
    var $email = $('#email');
    var $mega = $('#mega');
    var $macro = $('#macro');
    var $regione = $('#regione');
    var $result = $('#result');

    if (!$email.val()) {
        console.log("Email vuota");
        $result.show();
        $result.removeClass().addClass("error").html('<i class="glyphicon glyphicon-thumbs-down"></i>Inserire un indirizzo email');
        return false;
    } else {
        if (!validateEmail($email.val())) {
            console.log("Email non valida");
            $result.show();
            $result.removeClass().addClass("error").html('<i class="glyphicon glyphicon-thumbs-down"></i>Formato email non valido');
            return false;
        }
    }

    // check selected options
    if ($mega.val().is('defaultMega')) {
        console.log("Selezionare settore");
        $result.show();
        $result.removeClass().addClass("error").html('<i class="glyphicon glyphicon-thumbs-down"></i>Selezionare settore');
        return false;
    }

    if ($macro.val().is('defaultMacro')) {
        console.log("Selezionare attività");
        $result.show();
        $result.removeClass().addClass("error").html('<i class="glyphicon glyphicon-thumbs-down"></i>Selezionare attività');
        return false;
    }

    if ($regione.val().is('defaultRegione')) {
        console.log("Selezionare regione");
        $result.show();
        $result.removeClass().addClass("error").html('<i class="glyphicon glyphicon-thumbs-down"></i>Selezionare regione');
        return false;
    }

    // send email
    $.ajax({
        type: "POST",
        url: "../php/form-process.php",
        data: "id=" + $macro.val() + "&regione=" + $regione.val() + "&email=" + $email.val() ,
        success : function(text){
            $result.show().removeClass().addClass("success").html('<i class="glyphicon glyphicon-thumbs-up"></i><span>Iscrizione effettuata con successo!</span>');
        }
    });
}



// cambio select in pagina trova-clienti.php

$(document).ready(function(){

    // validation
    console.log($('select#mega option:selected').val());

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

    $('#macro').on('change', function() {
        $.ajax
        ({
            type: "POST",
            url: "../php/getRegioni.php",
            // data: dataString,
            cache: false,
            success: function(html)
            {
                console.log(html);
                $("#regione").html(html);
            }
        });
    });
    

    $('#trovaClienti').on('submit', function() {
        var macro_id = $('#macro').val();
        var regione_id = $('#regione').val();

        var dataString = 'id='+ macro_id + '&regione=' + regione_id;

        $.ajax
        ({
            type: "POST",
            url: "../php/getLeads.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                $("#potenzialiClienti").html(html);
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

