<!DOCTYPE html>
<html>

<head>
	<title>Send Mail</title>
	<script src="https://smtpjs.com/v3/smtp.js">
	</script>
	<style>
		.rectangle{
			height: 100px;
			width: 100px;
			background-color: bule;
		}
	</style>

	<script type="text/javascript">
		function sendEmail() {
			Email.send({
				SecureToken: "79d8b9d6-2130-4b96-8a56-35ae62ea5697",
				To: "aditya.shah_19@sakec.ac.in",
				From: "guptavan96@gmail.com",
				Subject: "Sending Email using javascript",
				Body: "Well that was easy!!",
			}).then(function(message) {
				alert()
			});
		}
	</script>
</head>

<body>
	<form method="post">
		<input type="button" class="move" value="Send Email" onclick="sendEmail()" />
		<div class="rectangle"></div>
	</form>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<script src="plugins/anime.min.js"></script>
	<script>
		anime({
			targets: '.move',
			translateY: 100,
			loop:true
		});
	</script>
</body>

</html>