<?php
/**
 * A View in my framework
 */


/**
 * View class represents a View in my framework.
 * Need to render html pages.
 * 
 * @author Yura
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