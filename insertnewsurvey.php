<?php
	include_once "include/surveyform.php";

	$survey = new surveyForm();

	$survey->setTitle($_POST["title"]);
	$survey->setDescription($_POST["description"]);
	$survey->setNumOfQuestion($_POST['numOfQuestions']);

	$id = surveyFormDao::createSurveyForm($survey);

	header("Location: addSurveyQuestion.php?id=".$id."&qn=1");
?>