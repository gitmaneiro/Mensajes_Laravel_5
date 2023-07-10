<?php

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'id'            => '1',
            'name'          => 'Miguel Carmona',
            'username'      => 'miguelcar18',
            'email'         => 'miguelcar18@gmail.com',
            'cedula'        => '19257684',
            'password'      => bcrypt('1234'),
            'path'          => '25miguel.jpeg',
            'details'		=> '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
    }
}
