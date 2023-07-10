<?php

use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracion')->insert([
            'id'            	=> '1',
            'cantidadMensajes' 	=> '10',
            'velocidad'      	=> '300',
            'created_at'    	=> date('Y-m-d H:m:s'),
            'updated_at'    	=> date('Y-m-d H:m:s')
        ]);
    }
}
