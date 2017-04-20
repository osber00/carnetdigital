<?php

use Illuminate\Database\Seeder;
use Cdig\Facultad;
use Cdig\Programa;
use Cdig\User;

class DatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->facultades();
    	$this->programas();
        $this->admin();
        $this->usuarios();
    }

    private function facultades(){
        for ($i=1; $i <= 2 ; $i++) { 
            Facultad::create([
                'facultad' => 'facultad_'.$i
            ]);
        }
    }

    private function programas(){
    	for ($i=1; $i <= 6 ; $i++) { 
	    	Programa::create([
	    		'programa' => 'programa'.$i,
                'facultad_id' => rand(1,2)
	    	]);
    	}
    }

    private function admin(){
    	User::create([
    		'nombre' => 'Oscar Bertel Peralta',
    		'identificacion' => '1102796781',
    		'email' => 'oscar.bertelp@cecar.edu.co',
    		'password' => bcrypt('Cecar!"#'),
    		'programa_id' => 1,
    		'admin' => true
    	]);
    }

    private function usuarios(){
    	for ($i=1; $i <= 30 ; $i++) { 
    		User::create([
	    		'nombre' => 'usuario'.$i,
	    		'identificacion' => '123456'.$i,
	    		'email' => 'usuario'.$i.'@email.edu.co',
	    		'password' => bcrypt('0'),
	    		'programa_id' => rand(1,6),
	    		'admin' => false
    		]);
    	}
    }
}
