<?php

namespace App\Service;

use App\Models\Phone;

class UserListService
{
    public function store($data, $user)
    {
        foreach ($data['phones'] as $phoneNumber) {
            $user->phones()->create(['phone_num' => $phoneNumber]);
        }
    }

    public function update($data, $user)
    {
        $user->update($data);
        $user->phones()->delete();

        foreach ($data['phones'] as $phoneNumber) {
            $user->phones()->create(['phone_num' => $phoneNumber]);
        }
    }
}
