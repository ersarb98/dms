<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Fetch all menu items from the database
        $menus = Menu::orderBy('OrderMenu')->get();

        // Format the data into a hierarchical structure
        $formattedMenus = $this->formatMenuData($menus);

        // Pass the formatted data to the view
        return view('menus.index', ['menu' => $formattedMenus]);
    }
    public function getData()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }
    private function formatMenuData($menus)
    {
        $menuArray = [];
        $menuItems = [];

        foreach ($menus as $menu) {
            $menuItems[$menu->MenuID] = [
                'MenuID' => $menu->MenuID,
                'ParentMenuID' => $menu->ParentMenuID,
                'DisplayMenu' => $menu->DisplayMenu,
                'UrlMenu' => $menu->UrlMenu,
                'OrderMenu' => $menu->OrderMenu,
                'IsHeader' => (bool) $menu->IsHeader,
                'IsAccordion' => (bool) $menu->IsAccordion,
                'submenu' => []
            ];
        }

        foreach ($menuItems as $id => &$item) {
            if ($item['ParentMenuID']) {
                $menuItems[$item['ParentMenuID']]['submenu'][] = &$item;
            } else {
                $menuArray[] = &$item;
            }
        }

        return $menuArray;
    }

    public function getMenusData()
    {
        $menus = Menu::orderBy('OrderMenu')->get();
        $formattedMenus = $this->formatMenuData($menus);
        return response()->json($formattedMenus);
    }
}
