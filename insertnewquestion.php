<?php 
	include_once "include/surveyQuestion.php";
	include_once "include/surveyform.php";
	include_once "include/questionChoices.php";

	$survey = surveyFormDao::getSurveyForm($_GET["id"]);

	$question = new surveyQuestion();

	$question->setQuestion($_POST["question"]);
	$question->setSurveyId($_GET["id"]);

	if(isset($_POST['canPickMany']))
		$question->setCanPickMany(1);
	else 
		$question->setCanPickMany(0);

	if(isset($_POST['canSpecifyOther']))
		$question->setCanSpecifyOther(1);
	else 
		$question->setCanSpecifyOther(0);

	$questionId = surveyQuestionDao::addQuestion($question);

	for ($i = 0; $i <= 10; $i++){
		if (!empty($_POST["choice".$i])){
			$choice = new questionChoices();

			$choice->setChoice($_POST["choice".$i]);
			$choice->setQuestionId($questionId);

			questionChoicesDao::addChoice($choice);
		}
	}

	if ($_GET["qn"] < $survey->getNumOfQuestion()){
		header("Location: addSurveyQuestion.php?id=".$_GET['id']."&qn=".(++$_GET['qn']));
	} else {
		header("Location: index.php");
	}

?>