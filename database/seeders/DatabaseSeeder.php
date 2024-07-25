<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Compliant;
use App\Models\Level;
use Illuminate\Database\Seeder;
use App\Models\Record;
use App\Models\Main_level;
use App\Models\Role;
use App\Models\Premission;
use App\Models\Premission_role;
use App\Models\Student;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this ->call(StudentSeeder::class);
        // $this ->call(RecordSeeder::class);
        $roles=
        [
            [
                'title'=>'Admins',
                'display'=>'المالك',
            ],
            [
                'title'=>'teacher',
                'display'=>'معلم'
            ],
        ];
        Role::insert($roles);
        $permissions = [
            ['title'=>'main_level'],
            ['title'=>'levels'],

            //// Record
            ['title'=>'get_all_students'],
            ['title'=>'add_new_student'],
            ['title'=>'update_info_student'],
            ['title'=>'delete_student'],
            ['title'=>'back_from_soft_delete_student'],
            ['title'=>'trashed_Student'],
            ['title'=>'search_name_student'],

           ////teacher
           ['title'=>'get_all_Teacher'],
           ['title'=>'add_teacher'],
           ['title'=>'update_teacher'],
           ['title'=>'delete_teacher'],
           ['title'=>'back_from_soft_delete_te'],
           ['title'=>'search_name_teacher'],

           ///compliants
           ['title'=>'get_all_compliants'],
           ['title'=>'add_compliants'],
           ['title'=>'solution_compliant'],
           ['title'=>'get_solved_list'],

           ///lessons
           ['title'=>'get_all_T'],
           ['title'=>'add_lesson'],
           ['title'=>'update_Lesson'],
           ['title'=>'delete_lesson'],

           ///quizs
           ['title'=>'get_all_quizs'],
           ['title'=>'add_quiz'],
           ['title'=>'update_question'],

           ///profile
           ['title'=>'show_profile'],

          ////archeivement
          ['title'=>'quiz_result'],
          ['title'=>'game_result'],

        ];
            Premission::insert($permissions);
            $permission_role = [

                ///////// Admin
           [
             'premission_id'=>'1',
             'role_id'=>'1',
            ],
            [
                'premission_id'=>'2',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'3',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'4',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'5',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'6',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'7',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'8',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'9',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'10',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'11',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'12',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'13',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'14',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'15',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'16',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'17',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'18',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'19',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'20',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'21',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'22',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'23',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'24',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'25',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'26',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'27',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'28',
                'role_id'=>'1',
            ],
            [
                'premission_id'=>'29',
                'role_id'=>'1',
            ],

               ///////// Teacher
               [
                'premission_id'=>'1',
                'role_id'=>'2',
               ],
               [
                 'premission_id'=>'2',
                  'role_id'=>'2',
                  ],
                  [
                    'premission_id'=>'20',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'21',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'22',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'23',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'24',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'25',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'26',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'27',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'28',
                    'role_id'=>'2',
                ],
                [
                    'premission_id'=>'29',
                    'role_id'=>'2',
                ],
        ];


         Premission_role::insert($permission_role);


        $main_level=[
            ['level_name'=>'The first level for Arabic speakers'],
            ['level_name'=>'The second level for Arabic speakers'],
            ['level_name'=>'Non-Arabic speaking level'],

            ];
            Main_level::insert($main_level);

            $level=[
                ['main_level_id'=> 1,
                'is_quiz'=>'false',
                 ],
                 ['main_level_id'=> 1,
                 'is_quiz'=>'false',
                  ],
                 ['main_level_id'=> 1,
                  'is_quiz'=>'false',
                   ],
                 ['main_level_id'=> 1,
                   'is_quiz'=>'false',
                  ],
                  ['main_level_id'=> 1,
                  'is_quiz'=>'false',
                 ],
                 ['main_level_id'=> 1,
                    'is_quiz'=>'true',
                  ],
                  ['main_level_id'=> 1,
                  'is_quiz'=>'false',
                   ],
                   ['main_level_id'=> 1,
                   'is_quiz'=>'false',
                    ],
                   ['main_level_id'=> 1,
                    'is_quiz'=>'false',
                     ],
                   ['main_level_id'=> 1,
                     'is_quiz'=>'false',
                    ],
                    ['main_level_id'=> 1,
                    'is_quiz'=>'false',
                   ],
                   ['main_level_id'=> 1,
                      'is_quiz'=>'true',
                    ],
                  ['main_level_id'=> 2,
                     'is_quiz'=>'false',
                  ],
                  ['main_level_id'=> 2,
                     'is_quiz'=>'false',
                   ],
                  ['main_level_id'=> 2,
                    'is_quiz'=>'false',
                    ],
                  ['main_level_id'=> 2,
                    'is_quiz'=>'false',
                    ],
                    ['main_level_id'=> 2,
                    'is_quiz'=>'false',
                    ],
                  ['main_level_id'=> 2,
                    'is_quiz'=>'true',
                     ],
                     ['main_level_id'=> 2,
                     'is_quiz'=>'false',
                  ],
                  ['main_level_id'=> 2,
                     'is_quiz'=>'false',
                   ],
                  ['main_level_id'=> 2,
                    'is_quiz'=>'false',
                    ],
                  ['main_level_id'=> 2,
                    'is_quiz'=>'false',
                    ],
                    ['main_level_id'=> 2,
                    'is_quiz'=>'false',
                    ],
                  ['main_level_id'=> 2,
                    'is_quiz'=>'true',
                     ],
                  ['main_level_id'=> 3,
                    'is_quiz'=>'false',
                   ],
                  ['main_level_id'=> 3,
                     'is_quiz'=>'false',
                   ],
                  ['main_level_id'=> 3,
                     'is_quiz'=>'false',
                   ],
                   ['main_level_id'=> 3,
                    'is_quiz'=>'false',
                   ],
                   ['main_level_id'=> 3,
                   'is_quiz'=>'false',
                  ],
                   ['main_level_id'=> 3,
                     'is_quiz'=>'true',
                   ],
                   ['main_level_id'=> 3,
                   'is_quiz'=>'false',
                  ],
                 ['main_level_id'=> 3,
                    'is_quiz'=>'false',
                  ],
                 ['main_level_id'=> 3,
                    'is_quiz'=>'false',
                  ],
                  ['main_level_id'=> 3,
                   'is_quiz'=>'false',
                  ],
                  ['main_level_id'=> 3,
                  'is_quiz'=>'false',
                 ],
                  ['main_level_id'=> 3,
                    'is_quiz'=>'true',
                  ],

                ];
            Level::insert($level);
            $admin=
               [
               [
               'role_id'=>1,
                'name'=>'admin',
                'level'=>'1,2,3',
                'email'=>'admin@gmail.com',
                'password'=>'$2y$10$SdqkIEs9Wo16cuQgAJnDrOHds1HYop2oINxVo/q1jkRVTEjRPNraK',//123456789
                'phone'=>'99876432',
              ]
               ];

               User::insert($admin);
               $record=
               [
               [
               'main_level_id'=>1,
                'first_name'=>'raghad',
                'last_name'=>'kh',
                'gender'=>'famele',
                'birthdate'=>'2000-11-12',
                'phone'=>'87542356',
                'address'=>'mazah',
                'id_number'=>'6483',
              ]
               ];
               Record::insert($record);
               $student=
               [
               [
               'record_id'=>1,
                'email'=>'raghad@gmail.com',
                'password'=>'6483',
                'owner'=>'father',
                'name'=>'raghad',
                'nickname'=>'roghoda',
                'photo'=>'ttedjjjb',
              ]
               ];
               Student::insert($student);

        $compliants=[
            ['student_id'=>'1',
             'description'=>'Quiz in the fifth level is difficult',

             ],
             ['student_id'=>'1',
             'description'=>'lesson in the fifth level is difficult',

             ],

            ];
            Compliant::insert($compliants);
    }
}
