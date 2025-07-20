<?php

namespace Src\Service;
use Src\Entity\Compte;
use Src\Repository\CompteRepository;


class CompteService {
    private CompteRepository $compteRepository;

    public function __construct(){
     $this->compteRepository= CompteRepository::getInstance();
    }

  public function getSoldeByUserIdComptePrincipale(int $userId): float{
   
   return $this->compteRepository->getSoldeByUserId($userId);
  }
}