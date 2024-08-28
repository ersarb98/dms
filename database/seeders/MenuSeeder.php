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
        $menus = array(
            array(
                "MenuID" => 1,
                "ParentMenuID" => null,
                "DisplayMenu" => "Booking Kit",
                "UrlMenu" => null,
                "OrderMenu" => 1,
                "IsHeader" => 1,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 2,
                "ParentMenuID" => 1,
                "DisplayMenu" => "Order Delivery",
                "UrlMenu" => "outbound",
                "OrderMenu" => 1,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 3,
                "ParentMenuID" => 1,
                "DisplayMenu" => "Order Receiving",
                "UrlMenu" => "inbound",
                "OrderMenu" => 2,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 4,
                "ParentMenuID" => null,
                "DisplayMenu" => "Management",
                "UrlMenu" => null,
                "OrderMenu" => 4,
                "IsHeader" => 1,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 5,
                "ParentMenuID" => 4,
                "DisplayMenu" => "Master Data",
                "UrlMenu" => null,
                "OrderMenu" => 1,
                "IsHeader" => 0,
                "IsAccordion" => 1,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 6,
                "ParentMenuID" => 5,
                "DisplayMenu" => "Yard Management",
                "UrlMenu" => "yardmanagement",
                "OrderMenu" => 1,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 7,
                "ParentMenuID" => null,
                "DisplayMenu" => "Request Approval",
                "UrlMenu" => null,
                "OrderMenu" => 2,
                "IsHeader" => 1,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 8,
                "ParentMenuID" => 7,
                "DisplayMenu" => "Request Delivery",
                "UrlMenu" => "approvaldelivery",
                "OrderMenu" => 1,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 9,
                "ParentMenuID" => 7,
                "DisplayMenu" => "Request Receiving",
                "UrlMenu" => "approvalreceiving",
                "OrderMenu" => 1,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 10,
                "ParentMenuID" => null,
                "DisplayMenu" => "Planner",
                "UrlMenu" => null,
                "OrderMenu" => 3,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 11,
                "ParentMenuID" => 10,
                "DisplayMenu" => "Gate In Truck",
                "UrlMenu" => "gatein",
                "OrderMenu" => 1,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 12,
                "ParentMenuID" => 10,
                "DisplayMenu" => "Set Pergerakan",
                "UrlMenu" => "set_pergerakan",
                "OrderMenu" => 2,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 13,
                "ParentMenuID" => 10,
                "DisplayMenu" => "Realisasi Pergerakan",
                "UrlMenu" => "set_realisasi",
                "OrderMenu" => 3,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 14,
                "ParentMenuID" => 10,
                "DisplayMenu" => "Inspeksi",
                "UrlMenu" => "set_inspeksi",
                "OrderMenu" => 4,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            ),
            array(
                "MenuID" => 15,
                "ParentMenuID" => 10,
                "DisplayMenu" => "Gate Out",
                "UrlMenu" => "gateout",
                "OrderMenu" => 5,
                "IsHeader" => 0,
                "IsAccordion" => 0,
                "icon" => null,
                "created_at" => null,
                "updated_at" => null
            )
        );

        DB::table('menus')->insert($menus);
    }
}
