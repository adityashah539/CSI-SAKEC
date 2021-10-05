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