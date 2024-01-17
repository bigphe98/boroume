<?php

namespace App\Models;

class Menu_model
{

    private $menu_items;


    public function __construct()
    {
        $this->menu_items = array(
            array('name' => 'Home', 'title' => 'Go Home', 'link' => 'home','classname' => 'active'),
            array('name' => 'Tips', 'title' => 'Tips for the website', 'link' => 'tips','classname' => 'inactive'),
            array('name' => 'Upcoming Events', 'title' => 'Checkout events', 'link' => 'events','classname' => 'inactive'),
            array('name' => 'Create', 'title' => 'Start new event', 'link' => 'create','classname' => 'inactive'),
            array('name' => 'About', 'title' => 'About this website', 'link' => 'about','classname' => 'inactive')
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