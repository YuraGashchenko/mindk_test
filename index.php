<?php
/**
 * Index file
 */

 /**
  * Create a FrontController instance and run it
  */
include 'FrontController.php';
$main_controller = new FrontController();
$main_controller->run();