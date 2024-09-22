<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TurnosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('turnos')->insert([
            ['nombre_turno' => 'GRUPO A', 'hora_inicio' => '07:00', 'hora_fin' => '19:00', 'regimen_id' => 3, 'horaalmuerzo' => '0', 'hora_inicio_almuerzo' => '00:00', 'hora_fin_almuerzo' => '00:45', 'tolerancia' => 20, 'iniciociclo' => '2023-06-28'],
            ['nombre_turno' => 'GRUPO B', 'hora_inicio' => '07:00', 'hora_fin' => '19:00', 'regimen_id' => 3, 'horaalmuerzo' => '0', 'hora_inicio_almuerzo' => '12:00', 'hora_fin_almuerzo' => '13:00', 'tolerancia' => 10, 'iniciociclo' => '2023-06-08'],
            ['nombre_turno' => 'OFICINA', 'hora_inicio' => '08:00', 'hora_fin' => '18:00', 'regimen_id' => 2, 'horaalmuerzo' => '1', 'hora_inicio_almuerzo' => '12:00', 'hora_fin_almuerzo' => '14:00', 'tolerancia' => 15, 'iniciociclo' => '2023-07-03'],
            // Agregar más datos según sea necesario
        ]);
    }
}
