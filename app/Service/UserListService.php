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
        $existingPhoneNumbers = $user->phones()->pluck('phone_num')->toArray();

        // Видаляємо лише ті телефонні номери, які більше не використовуються
        $phonesToDelete = array_diff($existingPhoneNumbers, $data['phones']);
        $user->phones()->whereIn('phone_num', $phonesToDelete)->delete();

        foreach ($data['phones'] as $phoneNumber) {
            $user->phones()->create(['phone_num' => $phoneNumber]);
        }
    }
}
