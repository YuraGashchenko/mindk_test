<?php
/**
 * Edit student controller
 */

 /**
  * I doesn't create a class because it very simple
  */
include 'Student.php';
$student = new Student();
if ($student->edit_student($_POST)) {
	echo 'done';
}