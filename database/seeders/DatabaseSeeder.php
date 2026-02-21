<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'FullName' => 'Admin',
            'Username' => 'admin',
            'Password' => Hash::make('admin123'),
            'Role' => 'Owner/Admin',
            'Status' => 'Active',
            'DateAdded' => now(),
            'DateModified' => now(),
        ]);
        
        // Output confirmation to console
        $this->command->info('Default Owner/Admin account created successfully.');
    }
}