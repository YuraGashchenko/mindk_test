<?php
/**
 * Delete controller
 */

 /**
  * I doesn't create a class because it very simplee
  */
include 'Student.php';
$student = new Student();
if ($student->delete($_POST['student_id'])) {
	echo 'done';
}