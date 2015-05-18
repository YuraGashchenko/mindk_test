<?php
// add student controller
include 'Student.php';
$student = new Student();
echo $student->add($_POST);