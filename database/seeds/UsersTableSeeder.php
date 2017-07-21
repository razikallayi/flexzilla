<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 50)->create()->each(function($u) {
        //      $u->posts()->save(factory(App\Post::class)->make());
        //  });

        DB::table('users')->insert([
            'name' => config('whyte.admin.name'),
            'username' => config('whyte.admin.username'),
            'email' => config('whyte.admin.email'),
            'password' => bcrypt(config('whyte.admin.password')),
        ]);
    }
}
