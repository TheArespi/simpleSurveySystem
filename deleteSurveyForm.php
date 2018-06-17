<?php

	include_once "include/surveyForm.php";
	include_once "include/surveyQuestion.php";
	include_once "include/questionChoices.php";

	$questions = surveyQuestionDao::getQuestionsofASurvey($_GET['id']);

	foreach ($questions as $q) {
		questionChoicesDao::deleteChoicesOfAQuestion($q->getId());
	}

	surveyQuestionDao::deleteQuestionOfASurvey($_GET["id"]);
	surveyFormDao::deleteSurveyForm($_GET["id"]);

	header("Location: index.php");
?>