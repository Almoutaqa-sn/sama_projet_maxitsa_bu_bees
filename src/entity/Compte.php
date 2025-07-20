<?php

namespace Src\Entity;
use App\Core\Abstract\AbstractEntity;


class Compte  extends AbstractEntity {
    private int $id;
    private TypeCompteEnum $typeCompte;
    private string $numeroCompte;
    private date $dateCreation;
    private string $solde;
    private Users $users;
    private array $transactions;

    public function __construct(string $numeroCompte='',date $dateCreation, string $solde=''){
        $this->id=$id;
        $this->numeroCompte=$numeroCompte;
        $this->dateCreation=$dateCreation;
        $this->solde=$solde;
    }

    public function getUsers(): Users
    {
        return $this->users;
    }
    public function setUsers(Users $users): void
    {
        $this->users = $users;
    }

    public function getTransanctions(): array
    {
        return $this->transactions;
    }
    public function addTransaction(array $transaction): void
    {
        $this->transactions[] = $transaction;   
    }

    public function getTypeCompte(): TypeCompteEnum
    {
        return $this->typeCompte;
    }
    public function setTypeCompte(TypeCompteEnum $typeCompte): void
    {
        $this->typeCompte = $typeCompte;
    }

    public function toObject(array $data): object
    {
        $compte = new Compte();
        $compte->setId($data['id'] ?? 0);
        $compte->setTypeCompte($data['typeCompte'] ?? null);
        $compte->setNumeroCompte($data['numeroCompte'] ?? '');
        $compte->setDateCreation($data['dateCreation'] ?? new \DateTime());
        $compte->setSolde($data['solde'] ?? '0.0');
        $compte->setUsers($data['users'] ?? null);
        return $compte;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'typeCompte' => $this->typeCompte,
            'numeroCompte' => $this->numeroCompte,
            'dateCreation' => $this->dateCreation,
            'solde' => $this->solde,
            'users' => $this->users,
            'transactions' => $this->transactions
        ];
    }

    public function toJSON():string {
        return json_encode($this->toArray());
    }


}