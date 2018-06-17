<?php
	include_once "include/surveyform.php";

	$id = $_GET["id"];
	$qn = $_GET["qn"];

	$survey = surveyFormDao::getSurveyForm($id);
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Question Number <?php  echo $qn ?></title>

		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1 align="center">Question Number <?php echo $qn ?></h1>

		<form action="insertnewquestion.php?id=<?php echo $id ?>&qn=<?php echo $qn ?>" method="POST">
			<table width="100%" >
				<tr>
					<td width="20%">
						Question
					</td>
					<td>
						<input type="text" class="input-text" name="question" required>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<hr>
					</td>
				</tr>
				<?php
					for ($i = 1; $i <= 10; $i++){
				?>
					<tr>
						<td width="20%">
							Choice <?php echo $i ?>
						</td>
						<td>
							<input type="text" class="input-text" name="choice<?php echo $i ?>">
						</td>
					</tr>
				<?php
					}
				?>
				<tr>
					<td colspan="2">
						<hr>
					</td>
				</tr>
				<tr>
					<td width="20%">
						Can check more than one answer
					</td>
					<td>
						<input type="checkbox" name="canPickMany"> Yes
					</td>
				</tr>
				<tr>
					<td width="20%">
						Can Specify if Other
					</td>
					<td>
						<input type="checkbox" name="canSpecifyOther"> Yes
					</td>
				</tr>
			</table>
			<button class="proceed">Proceed</button>
		</form>
	</body>
</html>