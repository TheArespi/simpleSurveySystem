<?php
	include_once "dbconnection.php";

	class surveyQuestion {
		private $id, $question, $numOfChoices, $surveyId, $canPickMany, $canSpecifyOther;

		public function setId($id){
			$this->id  = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function setQuestion($question){
			$this->question  = $question;
		}

		public function getQuestion(){
			return $this->question;
		}

		public function setSurveyId($surveyId){
			$this->surveyId  = $surveyId;
		}

		public function getSurveyId(){
			return $this->surveyId;
		}

		public function setCanPickMany($canPickMany){
			$this->canPickMany  = $canPickMany;
		}

		public function getCanPickMany(){
			return $this->canPickMany;
		}

		public function setCanSpecifyOther($canSpecifyOther){
			$this->canSpecifyOther  = $canSpecifyOther;
		}

		public function getCanSpecifyOther(){
			return $this->canSpecifyOther;
		}
	}

	class surveyQuestionDAO {

		public static function addQuestion($question){

			$conn = dbconnection::getDBConnection();

			$questionId = NULL;

			$text = $question->getQuestion();
			$surveyId = $question->getSurveyId();
			$canPickMany = $question->getCanPickMany();
			$canSpecifyOther = $question->getCanSpecifyOther();

			$conn->query("INSERT INTO survey_question(question,survey_id,canPickMany,canSpecifyOther) VALUES('$text',$surveyId,$canPickMany,$canSpecifyOther)") or die("line 61 ".mysqli_error($conn));

			$result = $conn->query("SELECT id FROM survey_question WHERE question='$text' AND survey_id=$surveyId AND canPickMany=$canPickMany AND canSpecifyOther=$canSpecifyOther") or die(mysqli_error($conn));

			while($row = $result->fetch_assoc()){
				$questionId = $row["id"];
			}

			return $questionId;
		}

		public static function deleteQuestionOfASurvey($surveyId){

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("DELETE FROM survey_question WHERE survey_id=$surveyId") or die(mysqli_error($conn));

			return $result;

		}

		public static function getQuestionsofASurvey($surveyId){

			$conn = dbconnection::getDBConnection();

			$questions = array();

			$result = $conn->query("SELECT * FROM survey_question WHERE survey_id=$surveyId") or die(mysqli_error($conn));

			while($row = $result->fetch_assoc()){
				$question = new surveyQuestion();

				$question->setId($row['id']);
				$question->setQuestion($row['question']);
				$question->setSurveyId($row['survey_id']);
				$question->setCanPickMany($row['canPickMany']);
				$question->setCanSpecifyOther($row['canSpecifyOther']);

				array_push($questions, $question);
			}

			return $questions;

		}

	}
?>