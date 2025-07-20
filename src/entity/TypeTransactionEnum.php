<?php

namespace App\Entity;

enum TypeTransactionEnum: string
{
    case TRQNSFERT = 'transfert';
    case RETRAIT = 'retrait';
    case PAIEMENT = 'paiement';
}
