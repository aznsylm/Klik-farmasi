<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    protected $signature = 'superadmin:setup';
    protected $description = 'Setup super admin account from environment variables';

    public function handle()
    {
        $name = env('SUPER_ADMIN_NAME');
        $email = env('SUPER_ADMIN_EMAIL');
        $password = env('SUPER_ADMIN_PASSWORD');

        if (!$name || !$email || !$password) {
            $this->error('Super admin credentials not found in .env file!');
            $this->info('Please add these variables to your .env:');
            $this->info('SUPER_ADMIN_NAME="Super Administrator"');
            $this->info('SUPER_ADMIN_EMAIL="superadmin@klikfarmasi.com"');
            $this->info('SUPER_ADMIN_PASSWORD="YourSecurePassword"');
            return 1;
        }

        // Check if super admin already exists by email
        $existingSuperAdmin = User::where('email', $email)->first();
        
        if ($existingSuperAdmin) {
            // Update existing user to be super admin
            $existingSuperAdmin->update([
                'name' => $name,
                'role' => 'superadmin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);
            $this->info('Existing user updated to super admin: ' . $email);
        } else {
            // Create new super admin
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'superadmin',
                'email_verified_at' => now(),
                'nomor_hp' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'usia' => 30,
            ]);
            $this->info('Super admin created successfully!');
        }

        $this->info('Email: ' . $email);
        $this->warn('Make sure to keep your .env file secure in production!');
        return 0;
    }
}