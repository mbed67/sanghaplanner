<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			Hallo {{ $user->firstname }},

			Helaas is je verzoek om lid te worden van {{ $sangha->sanghaname }} afgewezen.
			Voor meer informatie kun je contact opnemen met de beheerder van de sangha.

			Met vriendelijke groet,

			Sanghaplanner
		</div>
	</body>
</html>
