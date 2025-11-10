<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Compte extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'matricule';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'matricule',
        'login',
        'motdepasse',
        'nom',
        'prenom',
        'email',
        'photo',
        'type_compte',
    ];

    protected $hidden = [
        'motdepasse',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Cette méthode indique à Laravel quel champ utiliser pour l'authentification
    public function getAuthIdentifierName()
    {
        return 'email'; // Changé de 'login' à 'email'
    }

    // Cette méthode indique à Laravel quel champ de mot de passe utiliser
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'matricule', 'matricule');
    }

    public function isAdmin()
    {
        return $this->type_compte === 'admin';
    }

    public function isPersonnel()
    {
        return $this->type_compte === 'personnel';
    }
}