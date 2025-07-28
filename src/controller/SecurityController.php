<?php
namespace Src\Controller;
use App\Core\Abstract\AbstractController;
use Src\Service\SecurityService;

class SecurityController extends AbstractController
{
    private string $communLayout;
    private SecurityService $securityservice;
    
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'adresse' => $_POST['adresse'] ?? '',
                'numero_carte_identite' => $_POST['numero_carte_identite'] ?? '',
                'login' => $_POST['login'] ?? '',
                'password' => $_POST['password'] ?? '',
                'confirm_password' => $_POST['confirm_password'] ?? '',
                'numero_telephone' => $_POST['numero_telephone'] ?? '',
                'type_id' => $_POST['type_id'] ?? 1 // Par défaut utilisateur normal
            ];

            $errors = $this->validateRegistrationData($data);
            
            if (empty($errors)) {
                $result = $this->securityservice->register($data);
                
                if ($result['success']) {
                    $this->session->set('success_message', 'Compte créé avec succès. Vous pouvez maintenant vous connecter.');
                    header('Location: /login');
                    exit;
                } else {
                    $this->session->set('error_message', $result['message']);
                }
            } else {
                $this->session->set('errors', $errors);
                $this->session->set('old_data', $data);
            }
        }
        
        header('Location: /register');
        exit;
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

    private function validateRegistrationData($data)
    {
        $errors = [];

        if (empty($data['nom'])) {
            $errors['nom'] = 'Le nom est requis';
        }

        if (empty($data['prenom'])) {
            $errors['prenom'] = 'Le prénom est requis';
        }

        if (empty($data['adresse'])) {
            $errors['adresse'] = 'L\'adresse est requise';
        }

        if (empty($data['numero_carte_identite'])) {
            $errors['numero_carte_identite'] = 'Le numéro de carte d\'identité est requis';
        }

        if (empty($data['login'])) {
            $errors['login'] = 'Le login est requis';
        } elseif (strlen($data['login']) < 3) {
            $errors['login'] = 'Le login doit contenir au moins 3 caractères';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Le mot de passe est requis';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'Le mot de passe doit contenir au moins 6 caractères';
        }

        if ($data['password'] !== $data['confirm_password']) {
            $errors['confirm_password'] = 'Les mots de passe ne correspondent pas';
        }

        if (empty($data['numero_telephone'])) {
            $errors['numero_telephone'] = 'Le numéro de téléphone est requis';
        }

        return $errors;
    }
}
