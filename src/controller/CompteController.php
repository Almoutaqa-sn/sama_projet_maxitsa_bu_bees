<?php
namespace Src\Controller;
use App\Core\Abstract\AbstractController;
use Src\Service\CompteService;
use Src\Entity\Users;

class CompteController extends AbstractController
{
    private CompteService $compteService;
    public function __construct(){

        parent::__construct();
        $this->communLayout= "base";
        $this->compteService= new CompteService;
    }
 

  public function index(){    
  }
  public function create()
  {
    
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
       
    }
   function createcompte()
    {
       
    }

    function accueil()
    {
        
        

        $userId = (Users::toObject($this->session->get('user')))->getId();
        
        $solde = $this->compteService->getSoldeByUserIdComptePrincipale($userId);
        // var_dump($solde);
        // die();
        
        $this->session->set('solde', $solde);
        $this->render("accueil/accueil");
        


        }
       

    }

