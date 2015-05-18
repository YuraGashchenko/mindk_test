<?php

/** 
 * @author Yura
 * 
 */
class View {
	
	/**
	 * Render an html page
	 * 
	 * @param string $page
	 */
	function render($page) {
		include $page;
	}
}

?>