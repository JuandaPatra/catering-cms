<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * 
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First time application setup';

    /**
     * Execute the console command.
     */
   public function handle()
    {
        // if (User::count() > 0) {
        //     $this->error('Application already installed.');
        //     return Command::FAILURE;
        // }

        $name = $this->ask('Admin name');
        $email = $this->ask('Admin email');

        $password = $this->secret('Admin password');
        $confirm  = $this->secret('Confirm password');

        if ($password != $confirm) {
            $this->error('Password confirmation does not match');
            return Command::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('super-admin');

        $this->info('Application installed successfully.');
        return Command::SUCCESS;
    }

}
