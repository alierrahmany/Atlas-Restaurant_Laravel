<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // === Données des 5 comptes administrateurs ===
        $admins = [
            [
                'matricule' => 'ADM001',
                'login' => 'admin1',
                'motdepasse' => Hash::make('password1'),
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'admin1@example.com',
                'photo' => null,
                'type_compte' => 'admin',
            ],
            [
                'matricule' => 'ADM002',
                'login' => 'admin2',
                'motdepasse' => Hash::make('password2'),
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'email' => 'admin2@example.com',
                'photo' => null,
                'type_compte' => 'admin',
            ],
            [
                'matricule' => 'ADM003',
                'login' => 'admin3',
                'motdepasse' => Hash::make('password3'),
                'nom' => 'Benali',
                'prenom' => 'Karim',
                'email' => 'admin3@example.com',
                'photo' => null,
                'type_compte' => 'admin',
            ],
            [
                'matricule' => 'ADM004',
                'login' => 'admin4',
                'motdepasse' => Hash::make('password4'),
                'nom' => 'Lefevre',
                'prenom' => 'Claire',
                'email' => 'admin4@example.com',
                'photo' => null,
                'type_compte' => 'admin',
            ],
            [
                'matricule' => 'ADM005',
                'login' => 'admin5',
                'motdepasse' => Hash::make('password5'),
                'nom' => 'Rahmani',
                'prenom' => 'Ali',
                'email' => 'admin5@example.com',
                'photo' => null,
                'type_compte' => 'admin',
            ],
        ];

        // === Insertion avec foreach ===
        foreach ($admins as $admin) {
            DB::table('comptes')->insert([
                'matricule' => $admin['matricule'],
                'login' => $admin['login'],
                'motdepasse' => $admin['motdepasse'],
                'nom' => $admin['nom'],
                'prenom' => $admin['prenom'],
                'email' => $admin['email'],
                'photo' => $admin['photo'],
                'type_compte' => $admin['type_compte'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // === Création de 10 réservations liées à ces admins ===
        foreach (range(1, 10) as $i) {
            DB::table('reservations')->insert([
                'date_reservation' => Carbon::now()->subDays(rand(1, 15))->toDateString(),
                'petit_dejeuner' => rand(0, 1),
                'dejeuner' => rand(0, 1),
                'diner' => rand(0, 1),
                'annulation' => rand(0, 1),
                'matricule' => 'ADM00' . rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
