<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Record;
use App\Models\Main_level;

class RecordSeeder extends Seeder
{
    public function run()
    {   $records = Record::all();
        foreach ($records as $record) {
            printf("ID: %d, Main Level ID: %d, First Name: %s, Last Name: %s, Birthdate: %s, Code: %d\n",
                $record->id,
                $record->main_level_id,
                $record->first_name,
                $record->last_name,
                $record->birthdate,
                $record->code
            );
        }
           $records = Record::all();
    foreach ($records as $record) {
        printf("ID: %d, Main Level ID: %d, First Name: %s, Last Name: %s, Birthdate: %s, Code: %d\n",
            $record->id,
            $record->main_level_id,
            $record->first_name,
            $record->last_name,
            $record->birthdate,
            $record->code
        );
    }
}
    }