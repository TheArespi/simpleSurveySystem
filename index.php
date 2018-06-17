<?php 
	include_once "include/surveyform.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Survey System</title>

		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1 align="center">Welcome, create a survey and let our visitors answer them! <a href="surveycreationform.php">Create a question!</a></h1>
		<hr>
		<h4>Answer a survey here:</h4>

		<?php
			$numOfForms = surveyFormDao::countSurveyForms();

			if ($numOfForms < 1){
		?>
			<div class="container">
				<h2>Be the first to create a survey question! <a href="surveycreationform.php">Create a survey form!</a></h2>
			</div>
		<?php
			} else {
				$surveyForms = surveyFormDao::getAllSurveyForms();

				foreach ($surveyForms as $form) {
					
		?>
			<a href="answersurvey.php?id=<?php echo $form->getId() ?>" class="surveyLink" style="text-decoration: none;">
				<div class="container" style="margin-top: 0.5em">
					<h2><?php echo $form->getTitle() ?> <span class="badge"><?php if ($form->getParticipants() == 0) echo "Be the first to answer!"; else echo $form->getParticipants()." answered"; ?></span></h2>
					<pre class="surveyDescription" style="margin-left: 1.5em"><?php echo $form->getDescription() ?></pre>
					<hr>
					<div class="buttons" style="margin-bottom: 0.7em; margin-right: 1em; text-align: right;">
						<a href="deleteSurveyForm.php?id=<?php echo $form->getId() ?>"><button type="button">Delete</button></a> | <a href="surveytally.php?id=<?php echo $form->getId() ?>"><button type="button">View Survey Result</button>
					</div>

				</div>
			</a>
		<?php
				}
			}
		?>

	</body>
</html>