<?php
	include_once "include/surveyform.php";
	include_once "include/questionChoices.php";
	include_once "include/surveyQuestion.php";

	$survey = surveyFormDao::getSurveyForm($_GET["id"]);
	$questions = surveyQuestionDao::getQuestionsofASurvey($_GET['id']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $survey->getTitle() ?></title>
		<link rel="stylesheet" type="text/css" href="./style.css">
	</head>
	<body>
		<a href="index.php">Go Back</a>

		<h1 align="center"><?php echo $survey->getTitle() ?></h1>

		<form action="submitanswer.php?id=<?php echo $survey->getId() ?>" method="POST">

			<?php
				$counter = 0;
				foreach($questions as $q){
			?>

				<fieldset class="questions">
					<h4><?php echo $q->getQuestion() ?></h4>
					<div class="choices">
						<?php
							$choices = questionChoicesDao::getChoicesOfAQuestion($q->getId());
							
							foreach($choices as $choice){
						?>
							<input type="<?php if ($q->getCanPickMany()) echo "checkbox"; else echo "radio"; ?>" name="question<?php echo $counter ?>" value="<?php echo $choice->getId() ?>"><?php echo $choice->getChoice(); ?><br>
						<?php 
							}

							if ($q->getCanSpecifyOther()) {
						?>
							<input type="<?php if ($q->getCanPickMany()) echo "checkbox"; else echo "radio"; ?>" name="question<?php echo $choice->getQuestionId() ?>" id="other"> <input type="text" name="otherText">
						<?php
							}
						?>
					</div>
				</fieldset>

			<?php
				$counter++;
				}
			?>

			<button type="submit" class="proceed">Submit answers</button>

		</form>

	</body>
</html>