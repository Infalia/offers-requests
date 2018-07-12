<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        // Initiative types
        $initiativeTypes = array(0 => array('id' => 1, 'name' => 'Offers'),
                                 1 => array('id' => 2, 'name' => 'Demands'));

        $initiativeTypesTranslations = array(0 => array('id' => 1, 'initiative_type_id' => 1, 'name' => 'Offers', 'locale' => 'en'),
                                             1 => array('id' => 3, 'initiative_type_id' => 1, 'name' => 'Offerte', 'locale' => 'it'),
                                             2 => array('id' => 2, 'initiative_type_id' => 2, 'name' => 'Demands', 'locale' => 'en'),
                                             3 => array('id' => 4, 'initiative_type_id' => 2, 'name' => 'Richieste', 'locale' => 'it'));

        
        for($i=0; $i<count($initiativeTypes); $i++) {
            DB::table('initiative_types')->insert([
                'id' => $initiativeTypes[$i]['id'],
                'name' => $initiativeTypes[$i]['name'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Initiative types translations
        for($i=0; $i<count($initiativeTypesTranslations); $i++) {
            DB::table('initiative_type_translations')->insert([
                'id' => $initiativeTypesTranslations[$i]['id'],
                'initiative_type_id' => $initiativeTypesTranslations[$i]['initiative_type_id'],
                'name' => $initiativeTypesTranslations[$i]['name'],
                'locale' => $initiativeTypesTranslations[$i]['locale'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
