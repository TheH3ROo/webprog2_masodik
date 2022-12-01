<?php

class Mnb_Controller
{
	public $baseName = 'mnb';
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>