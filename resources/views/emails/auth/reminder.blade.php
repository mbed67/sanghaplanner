<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Wachtwoord vernieuwen</h2>

		<div>
			Om je wachtwoord te vernieuwen verzoeken we je het volgende formulier in te vullen: {{ URL::to('password/reset', array($token)) }}.<br/>
			Deze link verloopt over {{ Config::get('auth.reminder.expire', 60) }} minuten.
		</div>
	</body>
</html>
