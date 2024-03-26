<?php

namespace App\Models;

class Menu_model
{

    private $menu_items;
    private $lang;

    public function __construct()
    {

        $this->menu_items = array(
            array('name' => lang('Text.HomeText'), 'title' => 'Go Home', 'link' => 'home','classname' => 'active'),
            array('name' => lang('Text.AnnouncementsText'), 'title' => 'Check the latest updates', 'link' => 'announcements','classname' => 'inactive'),
            array('name' => lang('Text.CalendarText'), 'title' => 'Checkout calendar', 'link' => 'calendar','classname' => 'inactive')
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