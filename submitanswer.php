<?php
	include_once "include/surveyform.php";
	include_once "include/questionChoices.php";

	surveyFormDao::addParticipant($_GET["id"]);
	$survey = surveyFormDao::getSurveyForm($_GET["id"]);

	for ($i = 0; $i < $survey->getNumOfQuestion(); $i++){
		$choice = questionChoicesDao::getAChoice($_POST["question".$i]);

		questionChoicesDao::addAnswered($_POST["question".$i]);
	}

	header("Location: index.php");
?>