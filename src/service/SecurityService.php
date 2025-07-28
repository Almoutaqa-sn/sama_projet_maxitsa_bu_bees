<?php
namespace Src\Service;
use Src\Repository\UsersRepository;
use Src\Entity\Users;
class SecurityService
{
    private UsersRepository $usersrepository;

    public function __construct(){
     $this->usersrepository= UsersRepository::getInstance();
    }

  public function login($login,$password):?Users{
   
   return $this->usersrepository->selectByLoginAndPassword($login,$password);
  }

  public function register($data): array
  {
      try {
          // Vérifier si le login existe déjà
          if ($this->usersrepository->findByLogin($data['login'])) {
              return [
                  'success' => false,
                  'message' => 'Ce login est déjà utilisé'
              ];
          }

          // Vérifier si la carte d'identité existe déjà
          if ($this->usersrepository->findByCarteIdentite($data['numero_carte_identite'])) {
              return [
                  'success' => false,
                  'message' => 'Ce numéro de carte d\'identité est déjà enregistré'
              ];
          }

          // Hasher le mot de passe
          $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

          // Créer l'utilisateur
          $user = new Users();
          $user->setNom($data['nom']);
          $user->setPrenom($data['prenom']);
          $user->setAdresse($data['adresse']);
          $user->setNumeroCarteIdentite($data['numero_carte_identite']);
          $user->setLogin($data['login']);
          $user->setPassword($hashedPassword);
          $user->setTypeId($data['type_id']);

          // Sauvegarder l'utilisateur
          $userId = $this->usersrepository->save($user);

          if ($userId) {
              // Créer automatiquement un compte principal pour l'utilisateur
              $this->createDefaultAccount($userId, $data['numero_telephone']);
              
              return [
                  'success' => true,
                  'message' => 'Compte créé avec succès',
                  'user_id' => $userId
              ];
          } else {
              return [
                  'success' => false,
                  'message' => 'Erreur lors de la création du compte'
              ];
          }

      } catch (Exception $e) {
          return [
              'success' => false,
              'message' => 'Erreur: ' . $e->getMessage()
          ];
      }
  }

  private function createDefaultAccount($userId, $numeroTelephone)
  {
      // Cette méthode créera automatiquement un compte principal
      // Vous pouvez l'adapter selon votre logique métier
      require_once __DIR__ . '/../repository/CompteRepository.php';
      require_once __DIR__ . '/../entity/Compte.php';
      
      $compteRepo = \Src\Repository\CompteRepository::getInstance();
      $compte = new \Src\Entity\Compte();
      
      $compte->setNumeroCompte($this->generateAccountNumber());
      $compte->setSolde(0);
      $compte->setUserId($userId);
      $compte->setType('principal');
      $compte->setNumeroTelephone($numeroTelephone);
      
      $compteRepo->save($compte);
  }

  private function generateAccountNumber(): string
  {
      return 'ACC' . date('Y') . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
  }
}