var cd;
var IsAllowed = false;
  var baseUrl = "<?php echo base_url('')?>";
$(document).ready(function () {
    CreateCaptcha();
});


// Create Captcha
function CreateCaptcha() {
    //$('#InvalidCapthcaError').hide();
    var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    var i;
    for (i = 0; i < 6; i++) {
        var a = alpha[Math.floor(Math.random() * alpha.length)];
        var b = alpha[Math.floor(Math.random() * alpha.length)];
        var c = alpha[Math.floor(Math.random() * alpha.length)];
        var d = alpha[Math.floor(Math.random() * alpha.length)];
        var e = alpha[Math.floor(Math.random() * alpha.length)];
        var f = alpha[Math.floor(Math.random() * alpha.length)];
    }
    cd = a + ' ' + b + ' ' + c + ' ' + d + ' ' + e + ' ' + f;
    $('#CaptchaImageCode').empty().append('<canvas id="CapCode" class="capcode" width="300" height="80"></canvas>')

    var c = document.getElementById("CapCode"),
        ctx = c.getContext("2d"),
        x = c.width / 2,
        img = new Image();

    img.src =baseUrl +"/img/bg-capcha.jpg";
    img.onload = function () {
        var pattern = ctx.createPattern(img, "repeat");
        ctx.fillStyle = pattern;
        ctx.fillRect(0, 0, c.width, c.height);
        ctx.font = "46px Roboto Slab";
        ctx.fillStyle = '#ccc';
        ctx.textAlign = 'center';
        ctx.setTransform(1, -0.12, 0, 1, 0, 15);
        ctx.fillText(cd, x, 55);
    };


}

// Validate Captcha
function ValidateCaptcha() {
    var string1 = removeSpaces(cd);
    var string2 = removeSpaces($('#captcha-code').val());
    if (string1 == string2) {
        return true;
    }
    else {
        return false;
    }
}

// Remove Spaces
function removeSpaces(string) {
    return string.split(' ').join('');
}

// Check Captcha
function CheckCaptcha() {
    var result = ValidateCaptcha();
    if ($("#captcha-code").val() == "" || $("#captcha-code").val() == null || $("#captcha-code").val() == "undefined") {
        $('#captcha-error').text('Please enter code given below in a picture.').show();
        $('#captcha-code').focus();
    } else {
        if (result == false) {
            IsAllowed = false;
            $('#captcha-error').text('Invalid Captcha! Please try again.').show();
            CreateCaptcha();
            $('#captcha-code').focus().select();
        }
        else {
            IsAllowed = true;
            $('#captcha-code').val('').attr('place-holder', 'Enter Captcha - Case Sensitive');
            CreateCaptcha();
            $('#captcha-error').fadeOut(100);
            $('#success-message').fadeIn(500).css('display', 'block').delay(5000).fadeOut(250);
        }
    }
}


function Submit() {

    if (IsAllowed === false) {
        alert("Invalid captcha");
    } else {
        document.getElementsByClassName("btnSubmit").style.visibility = "visible";
    }

}