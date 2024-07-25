<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Student;
use App\Models\Compliant;
use App\Models\Quiz_result;
use App\Models\Archeivement;
use App\Models\Record;
class StudentSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $compliant_id = rand(1, 10);
            $quiz_result_id = rand(1, 10);
            $archeivement_id = rand(1, 10);
            $record_id = rand(1, 10);
            $email = Str::random(10).'@example.com';
            $password = Hash::make('password');
            $nickname = Str::random(10);
            $photo = 'path/to/photo' . $i;

            // Check if the quiz_result_id exists in the quizs_results table
            $quiz_result = DB::table('quizs_results')->find($quiz_result_id);

            if ($quiz_result) {
                $student = new Student;
                $student->compliant_id = $compliant_id;
                $student->quiz_result_id = $quiz_result_id;
                $student->archeivement_id = $archeivement_id;
                $student->record_id = $record_id;
                $student->email = $email;
                $student->password = $password;
                $student->nickname = $nickname;
                $student->photo = $photo;

                $student->save();
            } else {
                // Insert the missing quiz result record
                DB::table('quizs_results')->insert([
                    'id' => $quiz_result_id,
                    // Add other required fields
                ]);
            }
        }
    }
}