<?php

use App\User;
use Illuminate\Database\Seeder;

class MyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach ( range( 1, 40 ) as $idx ):
            $user = new User ;
            $user->name = $faker->name ;
            $user->email = $faker->email ;
            $user->password = $faker->password ;
            $user->created_at = $faker->dateTimeThisYear ;
            $user->save() ;
        endforeach;



    }
}
