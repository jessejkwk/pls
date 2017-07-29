<?php

use App\Answer;
use Illuminate\Database\Seeder;

class SeedingAnswersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        $userIds =  DB::table('users')->pluck('id')->toArray();

        $questionIds = DB::table('questions')->pluck('id')->toArray() ;


        foreach ( range( 1, 100 ) as $idx ):

            $answer =  new Answer ;
            $answer->the_answer = $faker->text(150) ;
            $answer->answred_at = $faker->dateTimeThisMonth ;
            $answer->question_id = $faker->randomElement($questionIds) ;
            $answer->user_id = $faker->randomElement($userIds) ;
            $answer->save();

        endforeach;
    }
}
