<?php

namespace Src\Entity;
use App\Core\Abstract\AbstractEntity;


class Compte  extends AbstractEntity {
    private int $id;
    private ?TypeCompteEnum $typeCompte = null;
    private string $numeroCompte;
    private ?\DateTime $dateCreation = null;
    private string $solde;
    private ?Users $users = null;
    private array $transactions = [];
    private ?int $userId = null;
    private ?string $numeroTelephone = null;
    private ?string $type = null;

    public function __construct(string $numeroCompte = '', ?\DateTime $dateCreation = null, string $solde = ''){
        $this->numeroCompte = $numeroCompte;
        $this->dateCreation = $dateCreation ?? new \DateTime();
        $this->solde = $solde;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }
    public function setUsers(?Users $users): void
    {
        $this->users = $users;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }
    public function setNumeroTelephone(?string $numeroTelephone): void
    {
        $this->numeroTelephone = $numeroTelephone;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getNumeroCompte(): string
    {
        return $this->numeroCompte;
    }
    public function setNumeroCompte(string $numeroCompte): void
    {
        $this->numeroCompte = $numeroCompte;
    }

    public function getSolde(): string
    {
        return $this->solde;
    }
    public function setSolde(string $solde): void
    {
        $this->solde = $solde;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }
    public function setDateCreation(?\DateTime $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    public function getTransanctions(): array
    {
        return $this->transactions;
    }
    public function addTransaction(array $transaction): void
    {
        $this->transactions[] = $transaction;   
    }

    public function getTypeCompte(): ?TypeCompteEnum
    {
        return $this->typeCompte;
    }
    public function setTypeCompte(?TypeCompteEnum $typeCompte): void
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