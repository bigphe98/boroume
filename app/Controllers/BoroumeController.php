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
        $view = 'calendarVolun';

        $this->data2['farmersMarkets'] = $this->database->get_all_farmers_markets_open();

        $requestData = $this->request->getPost();
        log_message('debug', 'AJAX Request Data: ' . json_encode($requestData));

        // Pass the AJAX request data to the view
        $this->data2['requestData'] = $requestData;

        $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
        $userID = $loggedUser['user']['peopleId'];
        $this->data2['userID'] = $userID;

        $emailTo = $loggedUser['user']['peopleEmailAddress'];
        $firstName = $loggedUser['user']['peopleFirstName'];
        $request = \Config\Services::Request();

        $this->data2['language'] = \Config\Services::language()->getLocale();
        $this->data2['peopleId'] = $userID;
        $this->data2['mySpots'] = $this->database->getMySpotsTaken($userID);

        $farmersMarketId = $request->getVar('farmersMarketID');
        $dateOfActivity = $request->getVar('date');
        $action = $request->getVar('action');

        $farmersMarketName = $this->request->getPost('farmersMarketName');
        $charityName = $this->request->getPost('charityName');
        $time = $this->request->getPost('time');
        $weekday = $this->request->getPost('weekday');
        $meetingPoint = $this->request->getPost('meetingPoint');
        $address = $this->request->getPost('address');



        $hasSpotForDate = false;
        foreach ($this->data2['mySpots'] as $spot) {
            if ($spot->actionDate == $dateOfActivity) {
                $hasSpotForDate = true;
                break;
            }
        }

        if ($farmersMarketId && $dateOfActivity) {
                if ($action == 0 && !$hasSpotForDate) {
                    if($farmersMarketName && $charityName && $time && $weekday && $meetingPoint && $address){
                        $subject = "BOROUME: New Market Spot Selected";
                        $body = "Dear $firstName,<br><br>";
                        $body .= "The data of your selected spot is the following:<br><br>";
                        $body .= "Name Market: $farmersMarketName<br>";
                        $body .= "Meeting point: $meetingPoint, $address<br>";
                        $body .= "Charity Name: $charityName<br>";
                        $body .= "Date: $weekday<br>";
                        $body .= "Time: $time<br>";
                        // Send email
                        $this->sendEmail($emailTo, $subject, $body);

                        $subject2 = "Ο/Η $firstName ΠΑΕΙ ΣΕ ΔΡΑΣΗ: $farmersMarketName";
                        $body2 = "Ο/Η $firstName,<br><br>";
                        $body2 .= "Έκλεισε θέση στην παρακάτω λαϊκή:<br><br>";
                        $body2 .= "Λαική: $farmersMarketName<br>";
                        $body2 .= "Σημείο συνάντησης ομάδας: $meetingPoint, $address<br>";
                        $body2 .= "Κοινωφελής φορέας: $charityName<br>";
                        $body2 .= "Ημερομηνεία: $weekday<br>";
                        $body2 .= "Ώρα συνάντησης: $time<br>";
                        // Send email
                        $this->sendEmail('plomis888@gmail.com', $subject2, $body2);

                        $this->database->pickSpotForAt($userID, $farmersMarketId, $dateOfActivity);
                    }

                } else if ($action == 1) {
                    if($farmersMarketName && $charityName && $time && $weekday && $meetingPoint && $address){
                        $subject = "BOROUME: Spot Cancelled";
                        $body = "Dear $firstName,<br><br>";
                        $body .= "The data of your canceled spot is the following:<br><br>";
                        $body .= "Name Market: $farmersMarketName<br>";
                        $body .= "Meeting point: $meetingPoint, $address<br>";
                        $body .= "Charity Name: $charityName<br>";
                        $body .= "Date: $weekday<br>";
                        $body .= "Time: $time<br>";
                        // Send email
                        $this->sendEmail($emailTo, $subject, $body);

                        $subject2 = "Ο/Η $firstName ΑΚΥΡΩΣΕ ΤΗΝ ΔΡΑΣΗ: $farmersMarketName";
                        $body2 = "Ο/Η $firstName,<br><br>";
                        $body2 .= "Ακύρωσε τη δράση στην παρακάτω λαϊκή:<br><br>";
                        $body2 .= "Λαική: $farmersMarketName<br>";
                        $body2 .= "Σημείο συνάντησης ομάδας: $meetingPoint, $address<br>";
                        $body2 .= "Κοινωφελής φορέας: $charityName<br>";
                        $body2 .= "Ημερομηνεία: $weekday<br>";
                        $body2 .= "Ώρα συνάντησης: $time<br>";

                        // Send email
                        $this->sendEmail('plomis888@gmail.com', $subject2, $body2);

                        $this->database->removeMySpot($userID, $farmersMarketId, $dateOfActivity);
                    }
                }
            }

            $this->data2['farmersMarketId'] = $farmersMarketId;
            $this->data2['dateOfActivity'] = $dateOfActivity;

            $this->data['content'] = view($view, $this->data2);

            return view('template', $this->data);
        }

        private function sendEmail($to, $subject, $body) {
            $email = \Config\Services::email();
            $email->setFrom('typwindcontroller@gmail.com', 'Boroume Org');
            $email->setTo($to);
            $email->setSubject($subject);
            $email->setMessage($body);

            if (!$email->send()) {
                return false;
            }

            return true;
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
        $this->set_common_data('Boroume', lang('Text.SaveFoodText'),'What do you want to do?' );

        $view = 'savingFood';

        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.SaveFoodText'));
        $this->data['content'] = view($view);
        return view('template', $this->data);
    }

    public function addActivityData(){
        $this->set_common_data('Boroume', lang('Text.SaveFoodText'),'Add activity information' );

        $view = 'addActivityData';

        $this->data2['non_saved_past_activities'] = $this->database->getAllPastActions();

        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.SaveFoodText'));
        $this->data['content'] = view($view, $this->data2);
        return view('template', $this->data);
    }

    public function confirmActivityData(){
        $this->set_common_data('Boroume', lang('Text.SaveFoodText'),'Confirm activity information' );

        $view = 'confirmActivityInformation';

        // Retrieve the parameters from the request
        $actionDate = $this->request->getGet('actionDate');
        $farmersMarket = $this->request->getGet('farmersMarket');

        // Load past activities
        $this->data2['non_saved_past_activities'] = $this->database->getAllPastActions();

        // Add the retrieved parameters to the data array
        $this->data2['actionDate'] = $actionDate;
        $this->data2['farmersMarket'] = $farmersMarket;

        $this->data2['peopleWentToMarket'] = $this->database->getInfoOfPeopleAtMarketOnDate($farmersMarket, $actionDate);
        $this->data2['foodInfo'] = $this->database->getAllFoodMeasuringData();

        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.SaveFoodText'));
        $this->data['content'] = view($view, $this->data2);
        return view('template', $this->data);
    }

    public function changeMeasuringInfo(){
        $this->set_common_data('Boroume', lang('Text.SaveFoodText'),'Change Measurement Information' );
        $view = 'measurementInformationChange';

        $foodName = $this->request->getVar('foodName');
        $kgsPerBag = $this->request->getVar('bagWeight');
        $kgsPerBox = $this->request->getVar('boxWeight');

        if($foodName && $kgsPerBag && $kgsPerBox){
            if($this->database->changeMeasuringData($foodName,$kgsPerBox, $kgsPerBag))
                return redirect()->to('/BoroumeController/changeMeasuringInfo'); // Redirect to the same method
        }

        $nameFood = $this->request->getVar('nameFood');
        $kgBox = $this->request->getVar('kgBox');
        $kgBag = $this->request->getVar('kgBag');
        $idMeasurement = $this->request->getVar('idMeasurement');

        if ($nameFood && $kgBox && $kgBag && $idMeasurement) {
            if ($this->database->confirmChangedMeasuringData($nameFood, $kgBox, $kgBag, $idMeasurement)) {
                return redirect()->to('/BoroumeController/changeMeasuringInfo'); // Redirect to the same method
            }
        }


        $this->data2['food_data'] = $this->database->getAllFoodMeasuringData();

        $this->data['menu_items'] = $this->menu_model_org->get_menuitems(lang('Text.SaveFoodText'));
        $this->data['content'] = view($view, $this->data2);
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
        $view = 'calendarOrg';
        $this->data2['farmersMarkets'] = $this->database->get_all_farmers_markets();
        $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
        $userID = $loggedUser['user']['peopleId'];
        $request = \Config\Services::Request();

        $this->data2['language'] = \Config\Services::language()->getLocale();
        $this->data2['peopleId'] = $userID;
        $this->data2['spotsOver'] = true;

        $this->data2['spotsSelected'] = $this->database->getAllSpotsFromAllMarkets();
        $this->data2['volunteers'] = $this->database->get_people_registered();

        $action = $request->getPost('action');
        $farmersMarketId = $request->getVar('farmersMarketId');
        $farmersMarketNameGreek = $request->getVar('farmersMarketNameGreek');
        $farmersMarketNameEnglish = $request->getVar('farmersMarketNameEnglish');
        $charityNameGreek = $request->getVar('charityNameGreek');
        $charityNameEnglish = $request->getVar('charityNameEnglish');
        $weekday = $request->getVar('weekday');
        $timeStart = $request->getVar('timeStart');
        $timeEnd = $request->getVar('timeEnd');
        $meetingPoint = $request->getVar('meetingPoint');
        $meetingPointEnglish = $request->getVar('meetingPointEnglish');
        $meetingPointGreek = $request->getVar('meetingPointGreek');
        $meetingPointUrl = $request->getVar('meetingPointUrl');
        $spotsMarket = $request->getVar('spotsMarket');
        $personID = $request->getVar('peopleId');
        $date = $request->getVar('actionDay');

        $this->data2['actionClicked'] = 0;



           if ($action === 'lock') {
                $this->database->lockMarket($farmersMarketId);
           } else if ($action === 'unlock') {
                $this->database->unlockMarket($farmersMarketId);
           } else if($action === 'update'){
               log_message('debug', 'Update Action: ' . json_encode($_POST));
               $this->database->updateMarketInfo($farmersMarketId, $farmersMarketNameGreek, $farmersMarketNameEnglish, $charityNameGreek, $charityNameEnglish,
                    $weekday, $timeStart, $timeEnd, $meetingPoint, $meetingPointEnglish, $meetingPointGreek, $meetingPointUrl, $spotsMarket);
           } else if($action === 'remove'){
               $this->database->removePersonFromMarket($farmersMarketId, $personID);
           } else if($action === 'add'){
               $this->database->addPersonToMarket($farmersMarketId, $personID, $date);
           }



        $this->data['content'] = view($view, $this->data2);

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

    public function calendarChangeForm(){
        $this->data['title'] = 'Add Farmers Market';
        $this->data['content'] = view("calendarChangeForm");
        return view("calendarChangeForm");
    }

    public function addFarmersMarket(){
        $name = $this->request->getPost('nameEnglish');
        $nameGreek = $this->request->getPost('nameGreek');
        $charityName = $this->request->getPost('charityNameEnglish');
        $charityNameGreek = $this->request->getPost('charityNameGreek');
        $dayOfTheWeek = $this->request->getPost('dayMarket');
        $timeBegin = $this->request->getPost('timeStart');
        $timeStop = $this->request->getPost('timeEnd');
        $supermarket = $this->request->getPost('supermarket');
        $supermarketLocEn = $this->request->getPost('meetingPointEnglish');
        $supermarketLocGr = $this->request->getPost('meetingPointGreek');
        $supermarketUrl = $this->request->getPost('meetingPointUrl');
        $spotsMarket = $this->request->getPost('spotsMarket');

        $result = $this->database->add_new_farmers_market($name, $nameGreek, $charityName, $charityNameGreek, $dayOfTheWeek, $timeBegin, $timeStop, $supermarket, $supermarketLocEn, $supermarketLocGr, $supermarketUrl, $spotsMarket);

        if($result == 0 ){
            return redirect()->to('BoroumeController/CalendarOrg')->with('fail', lang('Validation.failGeneral'));
        }else{
            return redirect()->to('BoroumeController/CalendarOrg')->with('success', lang('Validation.marketSuccess'));
        }

    }

}