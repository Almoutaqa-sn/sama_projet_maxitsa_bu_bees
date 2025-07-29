<?php

namespace Src\Repository;
use Src\Entity\Users;
use App\Core\Database;

class UsersRepository{
    private static ?UsersRepository $instance = null;
    private Database $db;
    
    private function __construct(){
        $this->db = Database::getInstance();

    }

    public function selectByLoginAndPassword($login,$password) : ?Users {
        try {
               $sql='Select * from "utilisateur" where  login= :login and password= :password';
               
               $stmt=$this->db->pdo->prepare($sql);
               $stmt->execute([
                   ':login'=>$login,
                   ':password'=>$password
               ]);
               $result=$stmt->fetch(\PDO::FETCH_ASSOC);
               if($result){
                // var_dump($result["telephone"]);die;
                 
                   $user=Users::toObject($result);
                   $user->getLogin($result);
                    //  var_dump($user->getTelephones());die;
                //    var_dump($user->getNom());
               
                return $user;
               }
               return null;

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
            
        }
        
    }

    public static function getInstance(): self{
        if(self::$instance===null){
            self::$instance = new Self();
        }
        return self::$instance;
    }
}