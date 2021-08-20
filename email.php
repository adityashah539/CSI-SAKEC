<!DOCTYPE html>
<html>

<head>
<title>Send Mail</title>
<script src="https://smtpjs.com/v3/smtp.js">
</script>

<script type="text/javascript">
	function sendEmail() {
	Email.send({
		SecureToken : "79d8b9d6-2130-4b96-8a56-35ae62ea5697",
		To: "aditya.shah_19@sakec.ac.in",
		From: "guptavan96@gmail.com",
		Subject: "Sending Email using javascript",
		Body: "Well that was easy!!",
	}).then(function (message) {
		alert(message)
		});
	}
</script>
</head>

<body>
<form method="post">
	<input type="button" value="Send Email"
		onclick="sendEmail()" />
</form>
</body>

</html>