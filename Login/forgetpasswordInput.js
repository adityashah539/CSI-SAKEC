class time {
    constructor(remaining) {
        this.remaining = 120;
        this.stopTimer = false;
    }
    startTimer() {
        this.remaining = 120;
        this.stopTimer = false;
        this.timer(this);
    }
    timer(reference){
        var self = reference;
        this.remaining = self.remaining;
        this.stopTimer = self.stopTimer;
        var timerTag = document.getElementById("timer");
        if (timerTag != null) {
            var m = Math.floor(this.remaining / 60);
            var s = this.remaining % 60;
            m = m < 10 ? "0" + m : m;
            s = s < 10 ? "0" + s : s;
            timerTag.innerHTML = m + ":" + s;
            this.remaining -= 1;
            if (this.stopTimer) {
                return;
            }
            if (this.remaining > 0 && !this.stopTimer) {
                setTimeout(function () {
                    self.timer(self);
                }, 1000);
                return;
            }
        }
    }
    restartTimer() {
        this.remaining = 120;
    }
    getTime() {
        return this.remaining;
    }
    nextStep() {
        if (this.remaining > 0) {
            $("#step").load("forgetpasswordInput.php", { step: 3 }, function () { animation(); });
        } else {
            if ($("#resendOtp").hasClass("d-none")) {
                $("#error").load("forgetpasswordInput.php", { step: "error", error: "Restart the process again." });
            }
            else {
                $("#error").load("forgetpasswordInput.php", { step: "error", error: "Rest the OTP and try again." });
            }
        }
    }
    stopTimer() {
        this.stopTimer;
    }
}
let myTimer  = new time(120);
var otp = null;
var enteredEmail = null;
var error = null;


function generateOTP() {
    var digits = "0123456789";
    let OTP = "";
    for (let i = 0; i < 6; i++) {
        OTP += digits[Math.floor(Math.random() * 10)];
    }
    return OTP;
}

function sendEmailOtp(email) {
    var OTP = generateOTP();
    error = null;

    Email.send({
        SecureToken: "79d8b9d6-2130-4b96-8a56-35ae62ea5697",
        To: email,
        From: "guptavan96@gmail.com",
        Subject: "Resetting Password for CSI-SAKEC.",
        Body: "OTP:" + OTP,
    })
        // .then(function (message) {
        //     if (message == "OK") {
        //         otp = OTP;
        //     } else {
        //         error = message;
        //     };
        // })
        ;
    otp = OTP;
}

function animation() {
    anime({
        targets: ".down-1",
        translateY: 65,
        duration: 1750,
    });
    anime({
        targets: ".down-2",
        translateY: 125,
        duration: 1750,
    });
    anime({
        targets: ".down-3",
        translateY: 200,
        duration: 1750,
    });
    console.log("Animation started");
}

$(document).on("click", "button[name='submit']", function () {
   
    var value = $(this).val();
    if (value == 1) {
        $("#step").load(
            "forgetpasswordInput.php", {
            step: value,
        }, function () {
            animation();
        });
    } else if (value == 2) {
        var email = $("#Email").val().trim();
        $.ajax({
            url: 'doesuserexists.php',
            type: 'post',
            data: { "email": email },
            dataType: 'JSON',
            success: function (response) {
                var msg = response.msg;
                if (msg == "YES") {
                    enteredEmail = email;
                    sendEmailOtp(email);
                    if (otp != null) {
                        $("#step").load(
                            "forgetpasswordInput.php", {
                            step: value,
                        }, function () {
                            animation();
                            if (value == 2) {
                                myTimer.startTimer();
                                $('.digit-group').find('input').each(function () {
                                    $(this).attr('maxlength', 1);
                                    $(this).on('keyup', function (e) {
                                        var parent = $($(this).parent());
                                        if (e.keyCode === 8 || e.keyCode === 37) {
                                            var prev = parent.find('input#' + $(this).data('previous'));
                                            if (prev.length) {
                                                $(prev).select();
                                            }
                                        } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
                                            var next = parent.find('input#' + $(this).data('next'));
                                            if (next.length) {
                                                $(next).select();
                                            } else {
                                                if (parent.data('autosubmit')) {
                                                    parent.submit();
                                                }
                                            }
                                        }
                                    });
                                });
                            }
                        }
                        );
                    }
                } else {
                    $("#error").load("forgetpasswordInput.php", { step: "error", error: "This user name does not exist in database." });
                }
            }
        });

    } else if (value == 3) {
        var enteredOtp = "";
        for (var i = 1; i <= 6; i++) {
            enteredOtp = enteredOtp + $("#digit-" + i).val();
        }
        if (otp != null) {
            if (enteredOtp == otp) {
                myTimer.nextStep();
            } else {
                $("#error").load("forgetpasswordInput.php", { step: "error", error: "The OTP does not match." });
            }
        } else {
            $("#error").load("forgetpasswordInput.php", { step: "error", error: "The OTP was not send." });
        }
    } else if (value == 4) {
        if (enteredEmail != null) {
            sendEmailOtp(enteredEmail);
            $(this).addClass("d-none");
            myTimer.restartTimer();
        } else {
            $("#error").load("forgetpasswordInput.php", { step: "error", error: "You have not entered the Username." });
        }
    } else if (value == 5) {
        var password = $("#Password").val();
        var passwordConfirm = $("#ConfirmPassword").val();
        if (password == passwordConfirm) {
            $("#step").load("forgetpasswordInput.php", { step: value, email: enteredEmail, password: password });
        } else {
            $("#error").load("forgetpasswordInput.php", { step: "error", error: "The password and confirm password are not matching." });
        }
    }
});

$(document).on("keypress", ".onenumber", function (e) {
    if ($(this).val().length >= 1) {
        e.preventDefault();
    }
});

animation();
