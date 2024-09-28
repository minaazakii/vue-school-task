<?php

namespace App\Console\Commands;

use App\Service\UserService;
use Illuminate\Console\Command;

class UpdateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data['id'] = $this->ask('Enter the User id');

        if (!$data['id'] || !is_numeric($data['id'])) {
            $this->error('Invalid id');
            return;
        }
        $data['name'] = $this->ask('Enter the updated name');
        $data['email'] = $this->ask('Enter the updated email');
        $data['timezone'] = $this->choice('Select the timezone', config('app.available_timezones'));
        (new UserService)->updateUser($data['id'], $data);
        $this->info('User updated successfully');
    }
}
