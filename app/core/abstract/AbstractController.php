<?php

namespace App\Core\Abstract;
use App\Core\Session;

abstract class AbstractController
{
    protected Session $session;
    private string $communLayout = 'base';

    protected function  __construct(){

      $this->session = Session::getInstance();

    }


    abstract public  function index() ;
    abstract public function create();
    abstract public function destroy() ;
    abstract public function show();
    abstract public function edit() ;
    abstract public function store() ;
  
    public function render($view){
      ob_start();
      require_once "../template/".$view.".html.php";
      $content = ob_get_clean();
      require_once "../template/layout/".$this->communLayout.".layout.php";
    }

}
