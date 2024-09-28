<?php

namespace App\Service;

use App\Models\User;

class UserService
{
    public function updateUser($id, $data): User
    {
        $timezones = config('app.available_timezones');
        if (!in_array($data['timezone'], $timezones)) {
            throw new \Exception('Invalid timezone');
        }

        $user = User::findOrFail($id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'timezone' => $data['timezone'],
        ]);
        return $user;
    }
}
