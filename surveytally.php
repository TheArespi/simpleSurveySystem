<?php
	include_once "include/surveyform.php";
	include_once "include/surveyQuestion.php";
	include_once "include/questionChoices.php";

	$survey = surveyFormDao::getSurveyForm($_GET['id']);
	$questions = surveyQuestionDao::getQuestionsofASurvey($_GET['id']);
?>

<!DOCTYPE html>
	<html>
	<head>
		<title><?php echo $survey->getTitle()?></title>
		<link rel="stylesheet" type="text/css" href="./style.css">
	</head>
	<body>
		<a href="index.php">Go Back</a>
		<?php if ($survey->getParticipants() > 0){ ?>
			<h1 align="center"><?php echo $survey->getTitle() ?></h1>

			<?php
				foreach($questions as $q){
					$choices = questionChoicesDao::getChoicesOfAQuestion($q->getId());
			?>
				<fieldset class="questions">
					<h4><?php echo $q->getQuestion()?></h4>
					<div class="choices">
						<ul>
							<?php 
								foreach ($choices as $choice) { ?>
								<li><?php echo $choice->getChoice() ?> = <?php echo $choice->getAnswered() ?> out of <?php echo $survey->getParticipants() ?> participants answered <?php echo $choice->getChoice() ?> <span class="badge"><?php echo ($choice->getAnswered() / $survey->getParticipants()) * 100 ?>%</span></li>
							<?php } ?>
						</ul>
					</div>
				</fieldset>
		<?php
				} 
			} else {
		?>
			<h1 align="center">Currently there are no data to be tallied, because this survey has no participants yet!<br>be the first to answer this survey! <a href="answersurvey.php?id=<?php $survey->getId() ?>">Answer Survey!</a></h1>
		<?php
			}
		?>
	</body>
</html>