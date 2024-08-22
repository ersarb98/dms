<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'MenuID' => 1,
                'ParentMenuID' => null,
                'DisplayMenu' => 'Booking Kit',
                'UrlMenu' => null,
                'OrderMenu' => 1,
                'IsHeader' => true,
                'IsAccordion' => false,
                'icon' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'MenuID' => 2,
                'ParentMenuID' => 1,
                'DisplayMenu' => 'Outbound',
                'UrlMenu' => 'outbound',
                'OrderMenu' => 1,
                'IsHeader' => false,
                'IsAccordion' => false,
                'icon' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'MenuID' => 3,
                'ParentMenuID' => 1,
                'DisplayMenu' => 'Inbound',
                'UrlMenu' => 'inbound',
                'OrderMenu' => 2,
                'IsHeader' => false,
                'IsAccordion' => false,
                'icon' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'MenuID' => 4,
                'ParentMenuID' => null,
                'DisplayMenu' => 'Management',
                'UrlMenu' => null,
                'OrderMenu' => 1,
                'IsHeader' => true,
                'IsAccordion' => false,
                'icon' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'MenuID' => 5,
                'ParentMenuID' => 4,
                'DisplayMenu' => 'Master Data',
                'UrlMenu' => null,
                'OrderMenu' => 1,
                'IsHeader' => false,
                'IsAccordion' => true,
                'icon' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'MenuID' => 6,
                'ParentMenuID' => 5,
                'DisplayMenu' => 'Yard Management',
                'UrlMenu' => 'yardmanagement',
                'OrderMenu' => 1,
                'IsHeader' => false,
                'IsAccordion' => false,
                'icon' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
