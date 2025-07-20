<?php
namespace Src\Entity;
use App\Core\Abstract\AbstractEntity;


class Transaction extends AbstractEntity{
    private int $id;
    private TypeTransactionEnum $typeTransaction;
    private date $dateTransaction;
    private Users  $user;
    private Compte $compte;
    private float $montant;

    public function __construct(int $id=0,TypeTransactionEnum $typeTransaction=null, date $dateTransaction, float $montant=0.0)
    {
        $this->typeTransaction = $typeTransaction;
        $this->dateTransaction = $dateTransaction;
        $this->montant = $montant;
    }

    public function getCompte(): Compte
    {
        return $this->compte;
    }

    public function setCompte(Compte $compte): void
    {
        $this->compte = $compte;
    }
    public function getUser(): Users
    {
        return $this->user;
    }
    public function setUser(Users $user): void
    {
        $this->user = $user;
    }
    public function getTypeTransaction(): TypeTransactionEnum
    {
        return $this->typeTransaction;
    }

    public function setTypeTransaction(TypeTransactionEnum $typeTransaction): void
    {
        $this->typeTransaction = $typeTransaction;
    }

    public function getDateTransaction(): date
    {
        return $this->dateTransaction;
    }
    public function setDateTransaction(date $dateTransaction): void
    {
        $this->dateTransaction = $dateTransaction;
    }
    public function getMontant(): float
    {
        return $this->montant;
    }
    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }

    public function getId(): int
     {
          return $this->id;
     }
    public function setId(int $id): void
    {
        $this->id = $id;
    }


   public static function toArray(object $object): array{
       return [
           'id' => $object->getId(),
           'typeTransaction' => $object->getTypeTransaction(),
           'dateTransaction' => $object->getDateTransaction(),
           'montant' => $object->getMontant(),
           'user' => $object->getUser(),
           'compte' => $object->getCompte()
       ];
   }

public static function toObject(array $data): Transaction {
    $transaction = new Transaction();
    $transaction->setId($data['id'] ?? 0);
    $transaction->setTypeTransaction($data['typeTransaction'] ?? null);
    $transaction->setDateTransaction($data['dateTransaction'] ?? new \DateTime());
    $transaction->setMontant($data['montant'] ?? 0.0);
    $transaction->setUser($data['user'] ?? null);
    $transaction->setCompte($data['compte'] ?? null);
    return $transaction;
   }

}