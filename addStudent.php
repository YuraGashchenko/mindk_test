<?php
/**
 * Add student controller
 */

 /**
  * I does not create a class for this controller
  * because it very simple
  */
include 'Student.php';
$student = new Student();
echo $student->add($_POST);