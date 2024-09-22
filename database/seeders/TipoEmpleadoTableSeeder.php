<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipoempleado')->insert([
            ['descripcion' => 'SUPERVIS', 'formato' => 1],
            ['descripcion' => 'SEGURIDAD', 'formato' => 1],
            ['descripcion' => 'COCINA', 'formato' => 1],
            ['descripcion' => 'MINA', 'formato' => 1],
            ['descripcion' => 'LOGISTICA', 'formato' => 1],
            ['descripcion' => 'INGENIERO', 'formato' => 1],
            ['descripcion' => 'MANTENIMIENTO', 'formato' => 1],
            ['descripcion' => 'TOPOGRAFO', 'formato' => 1],
            ['descripcion' => 'CHOFER', 'formato' => 1],
        ]);
    }
}
