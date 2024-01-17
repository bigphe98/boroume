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

        $this->set_common_data('UXWD Potluck', 'Welcome at my potluck demo site','Who\'s cooking tonight ?' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model->get_menuitems('Home');

        return view('template', $this->data);
    }
}