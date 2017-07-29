<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class SeedingQuestionTable extends Seeder
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

        foreach ( range( 1, 40 ) as $idx ):

            $question = new Question ;
            $question->the_question = $faker->text( 100 ) ;
            $question->details = $faker->text(50) ;
            $question->user_id = $faker->randomElement($userIds) ;
            $question->asked_at = $faker->dateTimeThisYear ;
            $question->save() ;

        endforeach;
    }
}
