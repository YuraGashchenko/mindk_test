<?php
//edit student controller
include 'Student.php';
$student = new Student();
if ($student->edit_student($_POST)) {
	echo 'done';
}