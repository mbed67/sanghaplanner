<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Welkom bij sangha {{ $sangha->sanghaname }}</h2>

		<div>
			Hallo {{ $user->firstname }},

			Welkom bij sangha {{ $sangha->sanghaname }}.
			Je kunt je nu aanmelden voor sangha-evenementen, en eventueel meehelpen door taakjes op je te nemen.

			Met vriendelijke groet,

			Sanghaplanner
		</div>
	</body>
</html>
