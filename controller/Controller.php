<?php
include_once("model/Model.php");
include_once("model/saveDB.php");

class Controller {
	public $model;
        
	public function __construct()  
        {  
            $this->model = new Model();
            $this->model1 = new dbModel();
        } 
	
	public function start()
	{
		if (!isset($_GET['kierunek']))
		{
			echo 'Dodaj na końcu adresu ?kierunek={podaj kierunek}';
		}
		else
		{
			
			$curl = $this->model->curl($_GET['kierunek']);
                        
                        $this->model1->savetoDB($curl, $_GET['kierunek']);
			include 'view/link.php';
		}
	}
}

?>