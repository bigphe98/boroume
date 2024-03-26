<?php

namespace App\Models;

class Menu_model_org
{

    private $menu_items;


    public function __construct()
    {
        $this->menu_items = array(
            array('name' => lang('Text.VolunteersText'), 'title' => 'Go Home', 'link' => 'volunteers','classname' => 'active'),
            array('name' => lang('Text.AnnouncementsText'), 'title' => 'Check the latest updates', 'link' => 'announcementsOrg','classname' => 'inactive'),
            array('name' => lang('Text.SaveFoodText'), 'title' => 'Go Save Food', 'link' => 'savingfood','classname' => 'inactive'),
            array('name' => lang('Text.CalendarText'), 'title' => 'Checkout calendar', 'link' => 'calendarOrg','classname' => 'inactive')
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
    public function get_menuitems($menutitle = 'Volunteers'){

        $this->set_active($menutitle);
        return $this->menu_items;
    }
}