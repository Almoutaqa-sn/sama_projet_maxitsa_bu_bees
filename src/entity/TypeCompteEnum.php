<?php
namespace Src\Entity;


enum TypeCompteEnum: string
{
   case PRINCIPAL = 'ComptePrincipal';
   case SECONDAIRE = 'secondaire';
}