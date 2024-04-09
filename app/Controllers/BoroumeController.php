<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use CodeIgniter\HTTP\Request;

use App\Models\Menu_model;
use App\Models\Menu_model_org;
use App\Models\Volunteer_menu_model;
use App\Libraries\Hash;
use Config\Services;

class BoroumeController extends BaseController {

    private $menu_model;
    private $menu_model_org;
    private $volunteer_menu_model;
    private $data;
    private $database;

    public function index(){
        echo base_url();
        echo locale_get_default();
    }

    public function __construct()
    {
        $session = \Config\Services::session();
        $language = \Config\Services::language();
        $language->setLocale($session->lang);
        $this->menu_model = new Menu_model();
        $this->menu_model_org = new Menu_model_org();
        $this->volunteer_menu_model = new Volunteer_menu_model();
        $this->database = new \App\Models\Database_Model();
        //$this->event_model = new Event_model();
        //$this->data['upcomming_eventtitels'] = $this->event_model->get_upcoming_event_titels();
    }

    private function set_common_data($title, $content_title_1, $content_title_2){
        $this->data['title'] = $title;
        $this->data['content_title_1'] = $content_title_1;
        $this->data['content_title_2'] = $content_title_2;
    }


    /*VOLUNTEERS*/
    public function home(){

        $this->set_common_data('Boroume', 'Welcome at the Boroume demo site','Let\'s save some food today ?' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model->get_menuitems(lang('Text.HomeText'));

        return view('template', $this->data);
    }

    public function announcements(){
        $this->set_common_data('Boroume', lang('Text.AnnouncementsText'),'' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model->get_menuitems(lang('Text.AnnouncementsText'));

        return view('template', $this->data);
    }

    public function calendar(){
        $this->set_common_data('Boroume', lang('Text.CalendarText'),'');

        $this->data['menu_items'] = $this->menu_model->get_menuitems(lang('Text.CalendarText'));

        $this->data['content'] = view('calendarOrg');

        return view('template', $this->data);
    }


    /* ORGANISATION*/
    public function volunteers() {
        $menutitle = $this->request->getGet('menutitle') ?? 'Registered Volunteers';
        if ($menutitle === 'Registered Volunteers') {
            $view = 'registeredVolunteers';
            $menutitle2 = lang('Text.registeredVolunteers');
        } elseif ($menutitle === 'Unregistered Volunteers') {
            $view = 'unregisteredVolunteers';
            $menutitle2 = lang('Text.unRegisteredVolunteers');
        } else {
            // Handle invalid menu titles
            // You may redirect to a default page or show an error message
            return redirect()->back()->with('error', 'Invalid menu selection');
        }

        $this->set_common_data('Boroume', lang('Text.VolunteersText') ,$menutitle2 );

        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.VolunteersText'));
        $this->data['volunteer_menu_items'] = $this->volunteer_menu_model->get_menuitems($menutitle);
        $this->data2['unregistered_people'] = $this->database->get_people_unregistered();
        $this->data2['registered_people'] = $this->database->get_people_registered();

        $request = \Config\Services::Request();
        $peopleId = $request->getVar('peopleId');
        $emailTo = $request->getVar('peopleEmailAddress');
        $firstName = $request->getVar('peopleFirstName');
        if($peopleId && $emailTo && $firstName) {

            $subject = "Registration Complete";
            $body = "Welcome to Boroume". "\r\n";
            $body .= $firstName;
            $body .= "You can login to the website now and start saving food.";


            $email = \Config\Services::email();
            $email->setFrom('typwindcontroller@gmail.com', 'Boroume Org');
            $email->setTo($this->request->getPost('peopleEmailAddress'));

            $email->setSubject($subject);
            $email->setMessage($body);

            if($email->send()){
                $this->database->approve_temp_account($peopleId);
            }else{
                return redirect()->back()->with('error', 'Invalid email');
            }

        }

        $this->data['content'] = view($view, $this->data2);

        return view('template_volunteers', $this->data);
    }

    public function savingfood(){
        $this->set_common_data('Boroume', lang('Text.SaveFoodText'),'Start saving food' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.SaveFoodText'));

        return view('template', $this->data);
    }

    public function announcementsOrg(){
        $this->set_common_data('Boroume', lang('Text.AnnouncementsText'),'Start saving food' );
        $this->data['content'] = 'Here comes content';

        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.AnnouncementsText'));

        return view('template', $this->data);
    }

    public function calendarOrg(){
        $this->set_common_data('Boroume', lang('Text.CalendarText'),'Start saving food' );
        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.CalendarText'));

        $this->data['content'] = view('calendarOrg');

        return view('template', $this->data);
    }

    public function approveVolunteer(){
        // Check if it's a POST request
        if ($this->request->isAJAX() && $this->request->isMethod('post')) {
            // Get the peopleID from the POST data
            $peopleID = $this->request->getVar('peopleID');

            // Call the method to update the database
            $result = $this->database->approve_temp_account($peopleID);

            // You can send a JSON response back if needed
            return $this->response->setJSON(['result' => $result]);
        } else {
            // Handle other request methods if needed
            // For example, you might want to return an error response
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }
    }


}