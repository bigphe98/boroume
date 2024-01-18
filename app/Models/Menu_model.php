<?php

namespace App\Models;

class Menu_model
{

    private $menu_items;


    public function __construct()
    {
        $this->menu_items = array(
            array('name' => 'Home', 'title' => 'Go Home', 'link' => 'home','classname' => 'active'),
            array('name' => 'Announcements', 'title' => 'Check the latest updates', 'link' => 'announcements','classname' => 'inactive'),
            array('name' => 'Save Food', 'title' => 'Go Save Food', 'link' => 'savingfood','classname' => 'inactive'),
            array('name' => 'Upcoming Events', 'title' => 'Checkout events', 'link' => 'events','classname' => 'inactive')
        );
    }

    private function set_active($menutitle){
        foreach ($this->menu_items as &$item){
            if (strcasecmp($menutitle, $item['name']) == 0){
                $item['classname'] = 'active';
            }
            else{
                $item['classname'] = 'inactive';
            }
        }

}
    public function get_menuitems($menutitle = 'Home'){

        $this->set_active($menutitle);
        return $this->menu_items;
    }
}