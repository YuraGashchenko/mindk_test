<?php
/**
 * Main Controller
 */

include 'Student.php';
include 'View.php';

/**
 * Main controller
 * 
 * It's a main controller in my little framework
 * 
 * @author Yura
 */
class FrontController {
	
	/**
	 * Run controller
	 * 
	 * Controller create new model instance and new view instance. Render view
	 */
	function run() {
		$view = new View();
		
		$students = new Student();
		if ($view->students_tbl = $students->get_students_as_tbl_arr() ) {
			$view->error = $students->get_error();
		}

		$view->student_desc = $students->get_student_desc();
		$view->render('main_page.php');
	}
}

?>