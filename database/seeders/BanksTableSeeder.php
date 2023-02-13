<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Eloquent\Models\Bank;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banksList = [
            [
                'name' => 'Ameriabank'
            ],
            [
                'name' => "ArmBusinessBank"
            ],
            [
                'name' => "Ardshinbank"
            ],
            [
                'name' => "Acba bank"
            ],
            [
                'name' => "Inecobank"
            ],
            [
                'name' => "Converse Bank Corp"
            ],
            [
                'name' => "VTB Bank Armenia"
            ],
            [
                'name' => "AraratBank"
            ],
            [
                'name' => "HSBC Bank Armenia"
            ],
            [
                'name' => "UniBank"
            ],
            [
                'name' => "ArmEconomBank"
            ],
            [
                'name' => "ArmSwissBank"
            ],
            [
                'name' => "ArtsakhBank"
            ],
            [
                'name' => "ID Bank"
            ],
            [
                'name' => "Evocabank"
            ],
            [
                'name' => "Byblos Bank Armenia"
            ],
            [
                'name' => "Mellat Bank"
            ],


        ];

        foreach($banksList as $bank){
            Bank::firstOrCreate($bank);
        }
    }
}
