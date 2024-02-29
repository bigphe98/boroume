<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use CodeIgniter\HTTP\Request;

use App\Models\Menu_model;
use App\Libraries\Hash;
use Config\Services;

class BoroumeController extends BaseController {

    private $menu_model;
    private $data;

    public function index(){
        echo base_url();
    }

    public function __construct()
    {
        $this->menu_model = new Menu_model();
        //$this->event_model = new Event_model();
        //$this->data['upcomming_eventtitels'] = $this->event_model->get_upcoming_event_titels();
    }

    private function set_common_data($title, $content_title_1, $content_title_2){
        $this->data['title'] = $title;
        $this->data['content_title_1'] = $content_title_1;
        $this->data['content_title_2'] = $content_title_2;
    }

    public function home(){

        $this->set_common_data('Boroume', 'Welcome at the Boroume demo site','Let\'s save some food today ?' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model->get_menuitems('Home');

        return view('template', $this->data);
    }

    public function announcements(){
        $this->set_common_data('Boroume', 'Announcements','' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model->get_menuitems('Announcements');

        return view('template', $this->data);
    }

    public function savingfood(){
        $this->set_common_data('Boroume', 'Save Food','Start saving food' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model->get_menuitems('Save Food');

        return view('template', $this->data);
    }

    public function calendar(){
        $this->set_common_data('Boroume', 'Calendar','Check the calender');
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model->get_menuitems('Calendar');

        return view('template', $this->data);
    }
}