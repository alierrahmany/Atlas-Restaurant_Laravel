<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_reservation',
        'petit_dejeuner',
        'dejeuner',
        'diner',
        'annulation',
        'matricule',
    ];

    protected $casts = [
        'date_reservation' => 'date',
        'petit_dejeuner' => 'boolean',
        'dejeuner' => 'boolean',
        'diner' => 'boolean',
        'annulation' => 'boolean', 
        
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'matricule', 'matricule');
    }
}