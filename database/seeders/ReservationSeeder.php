<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'date_reservation' => '2025-11-11',
                'petit_dejeuner' => true,
                'dejeuner' => false,
                'diner' => true,
                'annulation' => false,
                'matricule' => 'ADM001',
            ],
            [
                'date_reservation' => '2025-11-12',
                'petit_dejeuner' => false,
                'dejeuner' => true,
                'diner' => true,
                'annulation' => false,
                'matricule' => 'ADM002',
            ],
            [
                'date_reservation' => '2025-11-13',
                'petit_dejeuner' => true,
                'dejeuner' => true,
                'diner' => false,
                'annulation' => false,
                'matricule' => 'ADM003',
            ],
            [
                'date_reservation' => '2025-11-14',
                'petit_dejeuner' => false,
                'dejeuner' => true,
                'diner' => false,
                'annulation' => true,
                'matricule' => 'ADM004',
            ],
            [
                'date_reservation' => '2025-11-15',
                'petit_dejeuner' => true,
                'dejeuner' => true,
                'diner' => true,
                'annulation' => false,
                'matricule' => 'ADM005',
            ],
            [
                'date_reservation' => '2025-11-16',
                'petit_dejeuner' => false,
                'dejeuner' => false,
                'diner' => true,
                'annulation' => false,
                'matricule' => 'ADM001',
            ],
            [
                'date_reservation' => '2025-11-17',
                'petit_dejeuner' => true,
                'dejeuner' => false,
                'diner' => false,
                'annulation' => false,
                'matricule' => 'ADM002',
            ],
            [
                'date_reservation' => '2025-11-18',
                'petit_dejeuner' => false,
                'dejeuner' => true,
                'diner' => true,
                'annulation' => false,
                'matricule' => 'ADM003',
            ],
            [
                'date_reservation' => '2025-11-19',
                'petit_dejeuner' => true,
                'dejeuner' => true,
                'diner' => false,
                'annulation' => true,
                'matricule' => 'ADM004',
            ],
            [
                'date_reservation' => '2025-11-20',
                'petit_dejeuner' => true,
                'dejeuner' => false,
                'diner' => true,
                'annulation' => false,
                'matricule' => 'ADM005',
            ],
        ];

        foreach ($reservations as $reservation) {
            DB::table('reservations')->insert(array_merge($reservation, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
