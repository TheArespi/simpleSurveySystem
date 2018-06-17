<?php

	include_once "dbconnection.php";

	class questionChoices {
		private $id, $choice, $questionId, $answered;

		public function setId($id){
			$this->id  = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function setChoice($choice){
			$this->choice  = $choice;
		}

		public function getChoice(){
			return $this->choice;
		}

		public function setQuestionId($questionId){
			$this->questionId  = $questionId;
		}

		public function getQuestionId(){
			return $this->questionId;
		}

		public function setAnswered($answered){
			$this->answered  = $answered;
		}

		public function getAnswered(){
			return $this->answered;
		}
	}

	class questionChoicesDao {

		public static function addChoice($choice){

			$conn = dbconnection::getDBConnection();

			$id = NULL;

			$text = $choice->getChoice();
			$questionId = $choice->getQuestionId();

			$conn->query("INSERT INTO question_choices(choice,questionId) VALUES('$text',$questionId)") or die(mysqli_error($conn));

			$result = $conn->query("SELECT id FROM question_choices WHERE choice='$text' AND questionId=$questionId") or die(mysqli_error($conn));

			while($row = $result->fetch_assoc()){
				$id = $row["id"];
			}

			return $id;

		}

		public static function getChoicesOfAQuestion($questionId){

			$conn = dbconnection::getDBConnection();

			$choices = array();

			$result = $conn->query("SELECT * FROM question_choices WHERE questionId=$questionId") or die(mysqli_error($conn));

			while($row = $result->fetch_assoc()){
				$choice = new questionChoices();

				$choice->setId($row['id']);
				$choice->setChoice($row['choice']);
				$choice->setQuestionId($row['questionId']);
				$choice->setAnswered($row['answered']);

				array_push($choices, $choice);
			}

			return $choices;
		}

		public static function getAChoice($id){

			$conn = dbconnection::getDBConnection();

			$choice = new questionChoices();

			$result = $conn->query("SELECT * FROM question_choices WHERE id=$id") or die(mysqli_error($conn));

			while($row = $result->fetch_assoc()){
				$choice->setId($row['id']);
				$choice->setChoice($row['choice']);
				$choice->setQuestionId($row['questionId']);
				$choice->setAnswered($row['answered']);
			}

			return $choice;

		}

		public static function deleteChoicesOfAQuestion($questionId){

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("DELETE FROM question_choices WHERE questionId=$questionId") or die(mysqli_error($conn));

			return $result;

		}

		public static function addAnswered($id){

			$conn = dbconnection::getDBConnection();

			$result = $conn->query("UPDATE question_choices SET answered=(answered + 1) WHERE id=$id") or die(mysqli_error($conn));

			return $result;

		}

	}



?>