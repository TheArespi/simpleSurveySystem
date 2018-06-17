<?php
	include_once "dbconnection.php";

	class surveyForm {
		private $id, $title, $description, $numOfQuestion, $participants;

		public function setId($id){
			$this->id  = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function setTitle($title){
			$this->title  = $title;
		}

		public function getTitle(){
			return $this->title;
		}

		public function setDescription($description){
			$this->description  = $description;
		}

		public function getDescription(){
			return $this->description;
		}

		public function setNumOfQuestion($numOfQuestion){
			$this->numOfQuestion  = $numOfQuestion;
		}

		public function getNumOfQuestion(){
			return $this->numOfQuestion;
		}

		public function setParticipants($participants){
			$this->participants  = $participants;
		}

		public function getParticipants(){
			return $this->participants;
		}
	}

	class surveyFormDAO{

		public static function countSurveyForms(){

			$numOfForms = 0;

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("SELECT count(*) FROM survey_form");

			while($row = $result->fetch_assoc()){
				$numOfForms = $row["count(*)"];
			}

			return $numOfForms;
		}

		public static function createSurveyForm($survey){

			$id = NULL;

			$conn = dbconnection::getDBConnection();
			$title = $survey->getTitle();
			$description = $survey->getDescription();
			$numOfQuestion = $survey->getNumOfQuestion();

			$conn->query("INSERT INTO survey_form(title,description,num_of_questions) VALUES('$title','$description',$numOfQuestion)") or die(mysqli_error($conn));

			$result = $conn->query("SELECT id FROM survey_form WHERE title='$title' AND description='$description' AND num_of_questions=$numOfQuestion") OR die(mysqli_error($conn));

			while($row = $result->fetch_assoc()){
				$id = $row["id"];
			}

			return $id;

		}

		public static function getAllSurveyForms(){

			$surveyForms = array();

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("SELECT * FROM survey_form");

			while ($row = $result->fetch_assoc()) {
				$survey = new surveyForm();

				$survey->setId($row["id"]);
				$survey->setTitle($row["title"]);
				$survey->setDescription($row["description"]);
				$survey->setNumOfQuestion($row["num_of_questions"]);
				$survey->setParticipants($row["participants"]);

				array_push($surveyForms, $survey);
			}

			return $surveyForms;
		}

		public static function getSurveyForm($id){

			$survey = new surveyForm();

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("SELECT * FROM survey_form WHERE id=$id");

			while ($row = $result->fetch_assoc()) {
				$survey->setId($row["id"]);
				$survey->setTitle($row["title"]);
				$survey->setDescription($row["description"]);
				$survey->setNumOfQuestion($row["num_of_questions"]);
				$survey->setParticipants($row["participants"]);
			}

			return $survey;
		}

		public static function deleteSurveyForm($id){

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("DELETE FROM survey_form WHERE id=$id");

			return $result;
		}

		public static function addParticipant($id){

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("UPDATE survey_form SET participants=(participants + 1) WHERE id=$id") or die(mysqli_error($conn));

			return $result;
		}

	}
?>