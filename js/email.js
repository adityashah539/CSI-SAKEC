async function sendingEmail(to, subject, body) {
    var msg = await Email.send({
        SecureToken: "79d8b9d6-2130-4b96-8a56-35ae62ea5697",
        To: to,
        From: "guptavan96@gmail.com",
        Subject: subject,
        Body: body,
    });
    return msg;
}
function successClassAdder(){
    if ($(".toast-body").hasClass('alert-danger')) {
        $(".toast-body").removeClass('alert-danger');
    }
    if (!$(".toast-body").hasClass('alert-success')) {
        $(".toast-body").addClass('alert-success');
    }
}
function dangerClassAdder(){
    if ($(".toast-body").hasClass('alert-success')) {
        $(".toast-body").removeClass('alert-success');
    }
    if (!$(".toast-body").hasClass('alert-danger')) {
        $(".toast-body").addClass('alert-danger');
    }
}
function disableContactUsButton(email) {
    $("button[name='contactUsButton']").prop('disabled', true);
    $(".toast-body").text("Acknowledgement Email to EmailId(" + email + ").");
    successClassAdder ();
    $("#myToast").toast('show');
    setTimeout(function () {
        $("button[name='contactUsButton']").prop('disabled', false);
    }, 10000);
}
function error(msg) {
    $(".toast-body").text(msg);
    dangerClassAdder();
    $("#myToast").toast('show');
}
function successMessage(msg) {
    $(".toast-body").text(msg);
    successClassAdder();
    $("#myToast").toast('show');
}
function disableGoogleButton(email) {
    $(".g_id_signin").hide(750);
    $(".toast-body").text("Acknowledgement Email to EmailId(" + email + ").");
    $("#myToast").toast('show');
    setTimeout(function () {
        $(".g_id_signin").show(750);
    }, 10000);
}
function removeRow(id,email) {
    $('#sendEmailModal'+id).modal('toggle');
    $("#row"+id).hide(1000,function () {
        $("#row"+id).remove();
    });
    $(".toast-body").text("The Email has been sended to EmailId(" + email + ").");
    $("#myToast").toast('show');
}
async function sendEmail(email,type) {
    var msg = $("textarea[name='message']").val();
    var subject = "Acknowledgement from CSI-sakec.";
    var body = "Hey, \nThankyou for contacting us this is to acknowledge you that we received your request and our coordinators will soon get in touch with you at the earliest possible.\n Have a great day ";
    var sendEmailMessage = await sendingEmail(email, subject, body);
    if (sendEmailMessage == "OK") {
        $.ajax({
            url: 'http://localhost/csi-sakec/api/queryEntry.php',
            type: 'post',
            data:
            {
                "email": email,
                "message": msg
            },
            dataType: 'JSON',
            success: function (response) {
                var dataEntry = response.dataEntry;
                if (dataEntry) {
                    if(type=="Login"){
                        disableContactUsButton(email);
                    }else if (type = "Google"){
                        disableGoogleButton(email);
                    }
                } else {
                    error("Error in Sending Data to server.");
                }
            }
        });
    } else {
        error(sendEmailMessage);
    }
}
async function resolvedEmail(email,subject,body,queryId,repliedBy) {
    var sendEmailMessage = await sendingEmail(email, subject, body);
    if (sendEmailMessage == "OK") {
        $.ajax({
            url: 'http://localhost/csi-sakec/Query/entryReplied.php',
            type: 'post',
            data:
            {
                "id": queryId,
                "subject": subject,
                "body": body,
                "repliedBy": repliedBy
            },
            dataType: 'JSON',
            success: function (response) {
                var dataEntry = response.dataEntry;
                if (dataEntry) {
                    removeRow(queryId,email);
                } else {
                    error("Error in Sending Data to server.");
                }
            }
        });
    } else {
        error(sendEmailMessage);
    }
}
async function registerEmailNewsletter(email) {
    $.ajax({
        url: 'http://localhost/csi-sakec/api/registrationNewsletter.php',
        type: 'post',
        data:{"email": email},
        dataType: 'JSON',
        success: function (response) {
            var registration = response.registration;
            var registered = response.registered;
            $('#newsletter').modal('toggle');
            if (!registered) {
                if(registration){
                    successMessage("You have been registered for the newsletter.");
                }else{
                    error("Error in Registering.");
                }
            } else {
                error("You have already registered. for newsletter through this account("+email+").");
            }
        }
    });
}
