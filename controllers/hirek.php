<?php

class Hirek_Controller
{
	public $baseName = 'hirek';
	public function main(array $vars)
	{
        if(isset($vars['cim']) && isset($vars['szoveg'])){
            $hirekModel = new Hirek_Model;
			$retData = $hirekModel->add_news($vars);
			$view = new View_Loader($this->baseName.'_main');
            foreach($retData as $name => $value)
				$view->assign($name, $value);
        }
        else{
		    $view = new View_Loader($this->baseName."_main");
        }
	}
}

?>