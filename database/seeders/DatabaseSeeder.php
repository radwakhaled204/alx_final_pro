<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        Admin::create([
            'name' => 'radwa',
            'email' => 'radwa@admin.com',
            'password' => Hash::make('radwa123'),
        ]);
    }
}
