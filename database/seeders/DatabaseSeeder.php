<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Laptop Gamer',
                'descripcion' => 'Laptop de alto rendimiento para gaming y desarrollo.',
                'precio' => 25999.99,
                'stock' => 10,
                'imagen' => 'laptops/laptop_gamer.jpg',
                'categoria_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
