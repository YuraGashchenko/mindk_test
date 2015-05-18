<?php
// delete studetn controller
include 'Student.php';
$student = new Student();
if ($student->delete($_POST['student_id'])) {
	echo 'done';
}