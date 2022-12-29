<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Month;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Rohit',
            'email' => 'rohitryansh@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        Month::create([
            'name' => 'January',
        ]);

        Month::create([
            'name' => 'Febrary',
        ]);

        Month::create([
            'name' => 'March',
        ]);

        Month::create([
            'name' => 'April',
        ]);

        Month::create([
            'name' => 'May',
        ]);

        Month::create([
            'name' => 'June',
        ]);

        Month::create([
            'name' => 'July',
        ]);

        Month::create([
            'name' => 'August',
        ]);

        Month::create([
            'name' => 'September',
        ]);

        Month::create([
            'name' => 'October',
        ]);

        Month::create([
            'name' => 'November',
        ]);

        Month::create([
            'name' => 'December',
        ]);

        Category::factory()->count(10)->create();
    }
}
