function sendEmail(email,subject,body) {
    Email.send({
        SecureToken: "79d8b9d6-2130-4b96-8a56-35ae62ea5697",
        To: email,
        From: "guptavan96@gmail.com",
        Subject: subject,
        Body: body,
    }).then(function (message) {
        if (message == "OK") {
            return true;
        } else {
            alert(message);
            return false;
        }
    });
}