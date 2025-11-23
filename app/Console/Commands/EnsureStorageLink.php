<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EnsureStorageLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:ensure-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure storage symbolic link exists for public access to uploaded files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $target = storage_path('app/public');
        $link = public_path('storage');

        // Check if target directory exists
        if (!File::exists($target)) {
            File::makeDirectory($target, 0755, true);
            $this->info('Created storage/app/public directory');
        }

        // Check if link already exists
        if (File::exists($link)) {
            // Check if it's a valid symlink
            if (is_link($link)) {
                $this->info('Storage link already exists and is valid.');
                return Command::SUCCESS;
            } else {
                // Remove invalid link/file
                File::delete($link);
                $this->warn('Removed invalid storage link/file.');
            }
        }

        // Create the symbolic link
        try {
            if (PHP_OS_FAMILY === 'Windows') {
                // Windows requires admin privileges for symlinks, so we'll use junction or copy
                // For development, we can use mklink command
                $this->info('Creating storage link for Windows...');
                $this->info('If this fails, run as administrator: mklink /D "' . $link . '" "' . $target . '"');
                
                // Try to create symlink
                if (symlink($target, $link)) {
                    $this->info('Storage link created successfully!');
                } else {
                    $this->error('Failed to create storage link. Please run as administrator or manually create the link.');
                    $this->info('Manual command: mklink /D "' . $link . '" "' . $target . '"');
                    return Command::FAILURE;
                }
            } else {
                // Unix/Linux/Mac
                symlink($target, $link);
                $this->info('Storage link created successfully!');
            }
        } catch (\Exception $e) {
            $this->error('Failed to create storage link: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

