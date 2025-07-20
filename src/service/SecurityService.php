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
}