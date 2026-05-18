<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed admin and sample users.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@solvehub.com',
            'password' => Hash::make('password'),
            'bio' => 'Platform administrator and lead developer.',
            'location' => 'India',
            'reputation' => 5000,
            'is_admin' => true,
        ]);

        // Sample users
        $users = [
            ['name' => 'Sarah Chen', 'email' => 'sarah@example.com', 'bio' => 'Full-stack developer specializing in Laravel and Vue.js', 'location' => 'San Francisco', 'reputation' => 2480],
            ['name' => 'Alex Mercer', 'email' => 'alex@example.com', 'bio' => 'Senior Infrastructure Architect focusing on distributed systems', 'location' => 'Berlin', 'reputation' => 1850],
            ['name' => 'Priya Sharma', 'email' => 'priya@example.com', 'bio' => 'Data scientist and AI/ML enthusiast', 'location' => 'Mumbai', 'reputation' => 3200],
            ['name' => 'James Wilson', 'email' => 'james@example.com', 'bio' => 'Backend developer with expertise in Python and Go', 'location' => 'London', 'reputation' => 1200],
            ['name' => 'Mei Lin', 'email' => 'mei@example.com', 'bio' => 'Computer Science student exploring web technologies', 'location' => 'Tokyo', 'reputation' => 450],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'bio' => $user['bio'],
                'location' => $user['location'],
                'reputation' => $user['reputation'],
                'is_admin' => false,
            ]);
        }
    }
}
