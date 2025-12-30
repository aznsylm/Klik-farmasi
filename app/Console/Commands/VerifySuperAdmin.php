<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class VerifySuperAdmin extends Command
{
    protected $signature = 'superadmin:verify';
    protected $description = 'Verify super admin setup';

    public function handle()
    {
        $email = env('SUPER_ADMIN_EMAIL');
        
        if (!$email) {
            $this->error('SUPER_ADMIN_EMAIL not found in .env');
            return 1;
        }

        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error('Super admin user not found in database');
            return 1;
        }

        $this->info('Super Admin Details:');
        $this->info('Name: ' . $user->name);
        $this->info('Email: ' . $user->email);
        $this->info('Role: ' . $user->role);
        $this->info('Is Super Admin: ' . ($user->isSuperAdmin() ? 'Yes' : 'No'));
        
        if ($user->isSuperAdmin()) {
            $this->info('✅ Super admin setup is correct!');
            return 0;
        } else {
            $this->error('❌ Super admin setup has issues');
            return 1;
        }
    }
}