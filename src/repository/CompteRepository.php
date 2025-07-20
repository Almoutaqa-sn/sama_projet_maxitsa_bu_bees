<?php
namespace Src\Repository;
use Src\Entity\Compte;
use App\Core\Database;
use Src\Entity\TypeCompteEnum;

class CompteRepository{

    private static  ?CompteRepository $instance=null;
    public Database $db;


    public function __construct(){
    
        $this->db=Database::getInstance();

    }

    public static function getInstance(): self{
        if(self::$instance===null){
            self::$instance = new Self();
        }
        return self::$instance;
    }

  public function getSoldeByUserId(int $userId)
    {
        try {
            $sql = "SELECT solde FROM compte WHERE user_id = :user_id AND type= :type ";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':type' => TypeCompteEnum::PRINCIPAL->value
            ]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            // extract($result);
            // var_dump((float) $solde); die;
            return $result ? (float) $result['solde'] : 0.0;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            
                return 0.0;
        }
    }

}