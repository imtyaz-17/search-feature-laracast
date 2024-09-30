<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(10000)->create()->each(function ($company) {
            User::factory(10)->create([
                'company_id' => $company->id, // Associate users with the current company
                'password' => bcrypt('password'), // Ensure password is hashed
            ]);
        });
        $user = User::find(1000);
        $user->update([
            'full_name' => 'Bill Gates',
            'email' => 'bill.gates@microsoft.com',
        ]);
        $user->company->update([
            'name' => 'Microsoft Corporation',
        ]);

        $user = User::find(200);
        $user->update([
            'full_name' => 'Tim O\'Reilly',
            'email' => 'tim@oreilly.com',
        ]);
        $user->company->update([
            'name' => 'O\'Reilly Media Inc.',
        ]);
    }
}
