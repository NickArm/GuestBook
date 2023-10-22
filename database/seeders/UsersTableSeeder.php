<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    User::create([
        'account_id' => $this->generateAccountId(),
        'name' => 'armenisnick',
        'email' => 'armenisnick@gmail.com',
        'password' => bcrypt('n@261186'),  // Using bcrypt to hash the password
        'token' => Str::random(60),  // Using Laravel's Str helper to generate a random 60-character string
        'activate' => true
    ]);
    }
    private function generateAccountId()
    {
        $accountId = Str::random(8);  // Generates an 8-character random string

        // Check if the generated account_id already exists in the database
        while (User::where('account_id', $accountId)->exists()) {
            $accountId = Str::random(8);  // Regenerate a new account_id
        }

        return $accountId;
    }
}
