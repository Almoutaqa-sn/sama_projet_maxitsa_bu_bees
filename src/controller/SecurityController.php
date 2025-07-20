<?php
namespace Src\Controller;
use App\Core\Abstract\AbstractController;
use Src\Service\SecurityService;

class SecurityController extends AbstractController
{
    public function __construct(){

        parent::__construct();
        $this->communLayout= "base";
        $this->securityservice= new SecurityService;
    }
 

  public function index(){

    require_once '../template/login/login.html.php';

    
  }
  public function create()
  {
    require_once '../template/compte/createcompte.html.php';
  }
    public function destroy()
    {
        // Logic to destroy a session or user account
    }
    public function show()
    {
        // Logic to show a specific resource
    }
    public function edit()
    {
        // Logic to edit a specific resource
    }
    public function store()
    {
        // Logic to store a new resource
    }

    function page1()
    {
        require_once '../template/login/login.html.php';
    }
   function createcompte()
    {
        require_once '../template/compte/createcompte.html.php';
    }

    function accueil()
    {
        
       $login=$_POST['login'] ;
       $password=$_POST['password'];
       $user = $this->securityservice->login($login,$password);
       
       
       if($user){
           $this->session->set("user",$user->toArray()); 
        //    var_dump($_SESSION); die;
            //   var_dump($user->getTelephones());die;
            // $this->session->set('login', $user->getLogin());

        //  echo '<pre>';
        //  echo '<\pre>';
        
        // die;

        header('location: compte');



        }
        else{
        require_once '../template/login/login.html.php';

        }

    }
}
