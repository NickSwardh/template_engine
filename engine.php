<?php


	// Template engine by Nick Swardh
	//
	// www.nswardh.com


class Engine {
 


	// Declare a class-member. This will hold the template data.
	protected $template;



	// Constructor which takes 1 parameter, path to template.
	public function __construct($file) {

		// Does $file exist?
		if (file_exists($file))

			// Get contents from $file and stor in class member $this->template.
			$this->template = file_get_contents($file);
		else
			die("Template '{$file}' not found!");

	}
	
	

	// Replace template-{TAGS}.
	public function Set($tag, $value) {

		// Search for {$tag} in class-member $this->template and replace with $value.
		$this->template = str_replace('{' . $tag . '}', $value, $this->template);

	}
	
	

	// Out put the results.
	public function Out() {

		echo $this->template;

	}


	
}