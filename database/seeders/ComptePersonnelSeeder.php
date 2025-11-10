<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ComptePersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // === Données des 5 comptes personnel ===
        $personnel = [
            [
                'matricule' => 'PERS001',
                'login' => 'personnel1',
                'motdepasse' => Hash::make('password1'),
                'nom' => 'Moreau',
                'prenom' => 'Luc',
                'email' => 'personnel1@example.com',
                'photo' => null,
                'type_compte' => 'personnel',
            ],
            [
                'matricule' => 'PERS002',
                'login' => 'personnel2',
                'motdepasse' => Hash::make('password2'),
                'nom' => 'Bernard',
                'prenom' => 'Marie',
                'email' => 'personnel2@example.com',
                'photo' => null,
                'type_compte' => 'personnel',
            ],
            [
                'matricule' => 'PERS003',
                'login' => 'personnel3',
                'motdepasse' => Hash::make('password3'),
                'nom' => 'Dubois',
                'prenom' => 'Pierre',
                'email' => 'personnel3@example.com',
                'photo' => null,
                'type_compte' => 'personnel',
            ],
            [
                'matricule' => 'PERS004',
                'login' => 'personnel4',
                'motdepasse' => Hash::make('password4'),
                'nom' => 'Simon',
                'prenom' => 'Julie',
                'email' => 'personnel4@example.com',
                'photo' => null,
                'type_compte' => 'personnel',
            ],
            [
                'matricule' => 'PERS005',
                'login' => 'personnel5',
                'motdepasse' => Hash::make('password5'),
                'nom' => 'Laurent',
                'prenom' => 'Thomas',
                'email' => 'personnel5@example.com',
                'photo' => null,
                'type_compte' => 'personnel',
            ],
        ];

        // === Insertion avec foreach ===
        foreach ($personnel as $pers) {
            DB::table('comptes')->insert([
                'matricule' => $pers['matricule'],
                'login' => $pers['login'],
                'motdepasse' => $pers['motdepasse'],
                'nom' => $pers['nom'],
                'prenom' => $pers['prenom'],
                'email' => $pers['email'],
                'photo' => $pers['photo'],
                'type_compte' => $pers['type_compte'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('5 comptes personnel créés avec succès!');
    }
}