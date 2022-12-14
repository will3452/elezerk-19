<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roomTypes = [
                [

                'name' => 'Superior',
                'description' => 'This type of room is most often misconstrued in the hospitality world. The right superior rooms should be better than standard rooms, both in terms of interior and room size. However, most hotels actually categorize superior rooms as rooms with better view and location than standard rooms.',
                ],
                [
                    'name' => 'Deluxe',
                    'description' => 'It’s good to ask before reserving a hotel room. Because the meaning of the right deluxe room should have deluxe rooms have a wider area, facilities and better views from the superior rooms. But in fact, many hotels place deluxe room rankings under superior rooms.',
                ],
                [
                    'name' => 'Executive',
                    'description' => 'An executive suite in its most general definition is a collection of offices or rooms—or suite—used by top managers of a business—or executives. Over the years, this general term has taken on a variety of specific meanings. The oldest use of the term “executive suites” referred to the suite of offices on or near the top floor of a skyscraper where the top executives of a company worked, usually including at least the president or chief executive officer, various vice presidents and their staff.'
                ],
                [
                    'name' => 'Suite',
                    'description' => 'Unlike the junior suite rooms, the suite rooms have a living room with different living room and living room. Of course, the facilities, services, and facilities gained from the guest suite type rooms are much different from other guest room types.'
                ]
            ];

            foreach ($roomTypes as $item) {
                RoomType::create($item);
            }
    }
}
