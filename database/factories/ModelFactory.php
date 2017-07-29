<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker)
{
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Question::class , function (\Faker\Generator $generator)
{
    $userIds =  DB::table('users')->pluck('id')->toArray();

    return [
       'the_question' => $generator->text(100) ,
        'details' => $generator->text('200') ,
        'user_id' => $generator->randomElement($userIds) ,
        'asked_at' => $generator->dateTimeThisMonth
    ] ;
}) ;

$factory->define(\App\Answer::class , function (\Faker\Generator $generator)
{

    $userIds =  DB::table('users')->pluck('id')->toArray();

    $questionIds = DB::table('questions')->pluck('id')->toArray() ;

    return [
        'the_answer' =>  $generator->text(150) ,
        'answred_at' => $generator->dateTimeThisMonth ,
        'question_id' => $generator->randomElement($questionIds) ,
        'user_id' => $generator->randomElement($userIds)
    ] ;

});
