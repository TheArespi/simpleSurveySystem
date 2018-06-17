<!DOCTYPE html>
<html>
	<head>
		<title>Create a Survey Form</title>

		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<a href="index.php">Go back</a>

		<h1 align="center">Create a Survey Form</h1>

		<form action="insertnewsurvey.php" method="POST">
			<table width="100%" >
				<tr>
					<td width="20%">
						Title
					</td>
					<td>
						<input type="text" class="input-text" name="title" required>
					</td>
				</tr>
				<tr>
					<td width="20%">
						Description
					</td>
					<td>
						<textarea name="description" required></textarea>
					</td>
				</tr>
				<tr>
					<td width="20%">
						Number of Questions
					</td>
					<td>
						<input type="Number" max="30" min="1" value="1s" name="numOfQuestions" required>
					</td>
				</tr>
			</table>
			<button class="proceed">Proceed</button>
		</form>
	</body>
</html>