<?php

namespace Src\Entity;
use App\Core\Abstract\AbstractEntity;

class Users  extends AbstractEntity {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $login;
    private string $password;
    private TypeUser $Typeuser;
    private string $adresse;
    private Compte $compte;
    private string $numerocni;
    private string $photocnirecto;
    private string $photocniverso;
    private array $telephones = [];

    public function __construct(int $id=0, string $nom='',string $prenom='', string $login='', string $password='',  string $adresse='',  string $numerocni='', string $photocnirecto='', string $photocniverso='')
    {
     $this->id=$id;
     $this->nom=$nom;
     $this->prenom=$prenom;
     $this->login=$login;
     $this->password=$password;
     $this->adresse=$adresse;
     $this->numerocni=$numerocni;
     $this->photocnirecto=$photocnirecto;
     $this->photocniverso=$photocniverso;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCompte(): Compte
    {
        return $this->compte;
    }
    public function addCompte(Compte $compte): void
    {
        $this->compte = $compte;
    }
    public function getTypeUser(): TypeUser
    {
        return $this->Typeuser;
    }
    public function setTypeUser(TypeUser $Typeuser): void
    {
        $this->Typeuser = $Typeuser;
    }

    

    

    
    public function getNom()
    {
        return $this->nom;
    }
 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
  

    public static function toObject(array $data): object
{
    $user = new Users(
        id: $data['id'] ?? 0,
        nom: $data['nom'] ?? '',
        prenom: $data['prenom'] ?? '',
        login: $data['login'] ?? '',
        password: $data['password'] ?? '',
        adresse: $data['adresse'] ?? '',
        numerocni: $data['numerocni'] ?? '',
        photocnirecto: $data['photocnirecto'] ?? '',
        photocniverso: $data['photocniverso'] ?? ''
    );

    if (isset($data['compte'])) {
        $user->addCompte(Compte::toObject($data['compte']));
    }

    if (isset($data['typeuser'])) {
        $user->setTypeUser(TypeUser::toObject($data['typeuser']));
    }
   

    

    return $user;
}

public function getTelephones(): array
{
    return $this->telephones;
}

public function setTelephones(array $telephones): void
{
    $this->telephones = $telephones;
}

public function addTelephone($telephone): void
{
    $this->telephones[] = $telephone;
}

public function toArray(): array
{
    return [
        'id' => $this->id,
        'nom' => $this->nom,
        'prenom' => $this->prenom,
        'login' => $this->login,
        'password' => $this->password,
        'adresse' => $this->adresse,
        'numerocni' => $this->numerocni,
        'photocnirecto' => $this->photocnirecto,
        'photocniverso' => $this->photocniverso,
        'telephones' => is_array($this->telephones)
            ? array_map(fn($tel) => $tel->toArray(), $this->telephones)
            : $this->telephones
    ];
}


   
    public function getTelephones()
    {
        return $this->telephones;
    }

 
    public function addTelephones($telephones)
    {
        $this->telephones[] = $telephones;
    }

   
    public function getLogin()
    {
        return $this->login;
    }

   
    public function addLogin($login)
    {
        $this->login[] = $login;
    }
}