<?php
	class dbconnection {
		public static function getDBConnection(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$databasename = "survey_system";

			$conn =  mysqli_connect($servername,$username,$password,$databasename) or die("can't connect to database");

			return $conn;
		}
	}
?>