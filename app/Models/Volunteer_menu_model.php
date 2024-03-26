<?php

namespace App\Models;

class Volunteer_menu_model
{
    private $menu_items;

    public function __construct()
    {
        $this->menu_items = array(
            array('name' => lang('Text.registeredVolunteers'), 'title' => lang('Text.registeredVolunteers'), 'link' => 'volunteers?menutitle=Registered+Volunteers', 'classname' => 'active'),
            array('name' => lang('Text.unRegisteredVolunteers'), 'title' => lang('Text.unRegisteredVolunteers'), 'link' => 'volunteers?menutitle=Unregistered+Volunteers', 'classname' => 'inactive')
        );
    }

    private function set_active($menutitle)
    {
        foreach ($this->menu_items as &$item) {
            if (strcasecmp($menutitle, $item['name']) == 0) {
                $item['classname'] = 'active';
            } else {
                $item['classname'] = 'inactive';
            }
        }
    }

    public function get_menuitems($menutitle = 'Registered Volunteers')
    {
        $this->set_active($menutitle);
        return $this->menu_items;
    }
}
