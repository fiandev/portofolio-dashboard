<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
      User::create([
          "username" => "fiandev",
          "name" => "fian",
          "email" => "fiandev1234@gmail.com",
          "password" => bcrypt("fianskuy_13"),
          "email_verified_at" => now()
        ]);
    }
}
