<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class EnsureSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:ensure-superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure superadmin user exists with correct password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = 'superadmin';
        $password = 'admin123';
        
        $admin = Admin::where('username', $username)->first();
        
        if ($admin) {
            // Update password to ensure it's correctly hashed
            $admin->password = Hash::make($password);
            $admin->role = 'superadmin';
            $admin->save();
            $this->info("Superadmin user updated with password: {$password}");
        } else {
            // Create new superadmin user
            Admin::create([
                'username' => $username,
                'password' => Hash::make($password),
                'role' => 'superadmin',
            ]);
            $this->info("Superadmin user created with password: {$password}");
        }
        
        return Command::SUCCESS;
    }
}
