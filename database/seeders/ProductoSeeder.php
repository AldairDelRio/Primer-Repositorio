<?php
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
                'categoria_id' => 1, // Asegúrate de que la categoría 1 existe
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mouse Inalámbrico',
                'descripcion' => 'Mouse ergonómico con conexión Bluetooth.',
                'precio' => 599.99,
                'stock' => 50,
                'imagen' => 'accesorios/mouse.jpg',
                'categoria_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'descripcion' => 'Teclado mecánico con retroiluminación RGB y switches azules.',
                'precio' => 1299.99,
                'stock' => 30,
                'imagen' => 'teclados/teclado_mecanico.jpg',
                'categoria_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}