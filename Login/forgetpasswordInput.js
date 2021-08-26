let timerOn = true;
var otp=123456;

function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;
    m = m < 10 ? "0" + m : m;
    s = s < 10 ? "0" + s : s;
    document.getElementById("timer").innerHTML = m + ":" + s;
    remaining -= 1;
    if (remaining >= 0 && timerOn) {
        setTimeout(function () {
            timer(remaining);
        }, 1000);
        return;
    }
    if (!timerOn) {
        // Do validate stuff here
        return;
    }
    // Do timeout stuff here
    alert("Timeout for otp");
}
// timer(120);

function generateOTP() {
    // Declare a digits variable 
    // which stores all digits
    var digits = '0123456789';
    let OTP = '';
    for (let i = 0; i < 6; i++) {
        OTP += digits[Math.floor(Math.random() * 10)];
    }
    return OTP;
}

function sendEmailOtp(email) {
    var OTP = generateOTP();
    Email.send({
        SecureToken: "79d8b9d6-2130-4b96-8a56-35ae62ea5697",
        To: email,
        From: "guptavan96@gmail.com",
        Subject: "Resetting Password for CSI-SAKEC.",
        Body: "OTP:" + OTP,
    }).then(function (message) {
        if (message == "OK") {
            otp = OTP;
            return true;
        } else {
            alert(message);
            return false;
        }
    });
}
$(document).ready(function () {
    $(document).on('click', "button[name='submitEmail']",function () {
        $("#step").load("forgetpasswordInput.php",{step:2});
        // if (sendEmailOtp($("#Email").val().trim())) {
        // }
    });
})
$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		var parent = $($(this).parent());
		if(e.keyCode === 8 || e.keyCode === 37) {
			var prev = parent.find('input#' + $(this).data('previous'));
			if(prev.length) {
				$(prev).select();
			}
		} else if((e.keyCode >= 48 && e.keyCode <= 57)|| (e.keyCode >= 96 && e.keyCode <= 105)) {
			var next = parent.find('input#' + $(this).data('next'));
			if(next.length) {
				$(next).select();
			} else {
				if(parent.data('autosubmit')) {
					parent.submit();
				}
			}
		}
	});
});
$(document).on('click',"button[name='submit_opt']", function() {
    var enteredOtp=0;
    for(var i=1;i<=6;i++){
        enteredOtp = enteredOtp +  $('#digit-'+i).val();
    }
});
$(document).on('keypress', '.onenumber', function (e) {
    if ($(this).val().length >= 1) {
        e.preventDefault();
    }
});
anime({
    targets: '.down-1',
    translateY: 65,
    duration: 1750
});
anime({
    targets: '.down-2',
    translateY: 125,
    duration: 1750
});
anime({
    targets: '.down-3',
    translateY: 215,
    duration: 1750
});