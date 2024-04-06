<?php

namespace App\Controllers;
use App\Models\Temp_User_Model;
use App\Models\UserModel;
use App\Models\Database_Model;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;

class AuthController extends BoroumeController
{
    protected $helpers = ['url', 'form', 'Form_helper'];
    private $database;

    public function __construct()
    {
        $this->database=new \App\Models\Database_Model();

        if (!session('lang')) {
            // Manually set the session language to Greek
            $session = \Config\Services::session();
            $session->set('lang', 'gr');
        }
    }

    public function login(){
        $this->data['title'] = 'Login';

        $this->data['content'] = view("login");
        return view("login_template", $this->data);
    }

    public function redirect()
    {
        // Ensure the destination is set in the POST request
        if (isset($_POST['destination'])) {
            $destination = $_POST['destination'];

            // Debugging statement
            error_log("Destination received: " . $destination);

            // Redirect to the appropriate controller/action
            if ($destination === lang("Text.SignIn")) {
                return redirect()->to('AuthController/SignIn');
            } elseif ($destination === lang("Text.SignUp")) {
                return redirect()->to('AuthController/SignUp');
            }
        }

        // If destination is not set or invalid, redirect to a default location
        return redirect()->to('AuthController/SignIn');
    }



    public function SignIn()
    {

        $this->data['title'] = 'Sign In';
        $this->data['content'] = view("SignIn");
        return view("login_template", $this->data);
    }

    public function SignUp()
    {
        $this->data['title'] = 'Sign Up';
        $this->data['content'] = view("SignUp");
        return view("login_template", $this->data);
    }

    public function create_login(){

        $userModel = new UserModel();
        $table_name=$userModel->getTableName();

        $validation = $this->validate([
            'name' => [
                'rules' => 'required|alpha|min_length[2]|regex_match[/^[A-Z][a-zA-Z]*$/]',
                'errors' => [
                    'required' => lang('Validation.Required'),
                    'alpha' => lang('Validation.alphaFirstName'),
                    'min_length' => lang('Validation.minLengthFirstName'),
                    'regex_match' => lang('Validation.regexUpper'),
                ],
            ],
            'surname' => [
                'rules' => 'required|alpha_space|min_length[2]|regex_match[/^[A-Z][a-zA-Z\s]*$/]',
                'errors' => [
                    'required' => lang('Validation.Required'),
                    'alpha' => lang('Validation.alphaLastName'),
                    'min_length' => lang('Validation.minLengthLastName'),
                    'regex_match' => lang('Validation.regexUpper'),
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique['.$table_name.'.peopleEmailAddress]',
                'errors' => [
                    'required' => lang('Validation.Required'),
                    'valid_email' => lang('Validation.validEmail'),
                    'is_unique' => lang('Validation.uniqueEmail'),
                ],
            ],
            'telephone' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => lang('Validation.Required'),
                    'numeric' => lang('Validation.numeric'),
                ],
            ],
            'password' => [
                'rules'  =>  'required|min_length[6]|max_length[20]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/]',
                'errors' => [
                    'required' => lang('Validation.Required'),
                    'min_length' => lang('Validation.minLengthPassword'),
                    'max_length' => lang('Validation.maxLengthPassword'),
                    'regex_match' => lang('Validation.regexPassword'),
                ],
            ],
            'cpassword' => [
                'rules'  => 'matches[password]',
                'errors' => [
                    'required' => lang('Validation.Required'),
                    'matches' => lang('Validation.matchingPassword'),
                ],
            ],
        ]);

        if(!$validation){

            return  redirect()->to('AuthController/SignUp')->with('validation', $this->validator)->withInput();

        }else{
            $firstName = $this->request->getPost('name');
            $lastName = $this->request->getPost('surname');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $telephone = $this->request->getPost('telephone');
            $location = $this->request->getPost('location');

            /*$result = $this->database->make_temp_account($email, $password, $firstName, $lastName, $telephone, $location);
            if ($result == 0) {
                return redirect()->to('AuthController/SignUp')->with('fail', 'Something went wrong');
            } else {*/
                //$user_info = $userModel->where('peopleEmailAddress', $email)->first();
                $session_data = ['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => $password, 'telephone' => $telephone, 'location' => $location];
                $session_data_json = json_encode($session_data);
                $expiry = time() + (60 * 60 * 24);
                $options = [
                    'expires' => $expiry,
                    'path' => '/',
                    'domain' => '',
                    'secure' => true,
                    'httponly' => false,
                    'SameSite' => 'Lax',
                ];

                setcookie('LoggedUser', $session_data_json, $options);

                if (isset($_COOKIE['LoggedUser'])) {
                    return redirect()->to('AuthController/CodeOfConduct');
                }else{
                        return  redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.failGeneral'));
                    }
            }

    }


    public function check_login(){

        $userModel = new UserModel();
        $table_name = $userModel->getTableName();
        $validation = $this->validate([
                'email' => [
                    'rules'  => 'required|valid_email|is_not_unique['.$table_name.'.peopleEmailAddress]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'valid_email' => lang('Validation.validEmail'),
                        'is_not_unique' => lang('Validation.unregisteredEmail'),
                    ],
                ],
                'password' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                    ],
                ],
            ]);

        if(!$validation){

            return  redirect()->to('AuthController/SignIn')->with('validation', $this->validator)->withInput();

        }else{

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user_info = $userModel->where('peopleEmailAddress', $email)->first();

            $check_password = $user_info['peoplePassword'];

            if( $check_password!=$password ){

                return  redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.incorrectPassword'))->withInput();

            }else{
                if (!$userModel->isFromOrganization($email)) {
                    return redirect()->to('BoroumeController/home');
                }
                $session_data = ['user' => $user_info];
                $session_data_json = json_encode($session_data);
                    $expiry = time() + (60 * 60 * 24);
                    $options = [
                        'expires' => $expiry,
                        'path' => '/',
                        'domain' => '',
                        'secure' => true,
                        'httponly' => false,
                        'SameSite' => 'Lax',
                    ];

                    setcookie('LoggedUser', $session_data_json, $options);
                    //if above does not work use below
                    //setcookie('LoggedUser', $session_data_json, $expiry,'/');
                if (!$userModel->isFromOrganization($email)) {
                    return redirect()->to('BoroumeController/home');
                }else{
                    return redirect()->to('BoroumeController/volunteers');
                }

            }
        }
    }

    public function logout(){
        $expiry=time() - (60 * 60 * 24);
        $options = [
            'expires' => $expiry,
            'path' => '/',
            'domain' => '',
            'secure' => true,
            'httponly' => false,
            'SameSite' => 'Lax',
        ];
        setcookie('LoggedUser', '', $options);
        setcookie('button1', '', $options);
        //if above does not work, use below
        //setCookie('LoggedUser','',$expiry,'/');
        //setCookie('button1','',$expiry,'/');
        //setCookie('lang','',$expiry,'/');

        return  redirect()->to('/public/AuthController/login')->with('fail', lang('Validation.loggedOff'));

    }

    public function recoverPassword(){
        $userModel = new UserModel();
        $table_name = $userModel->getTableName();
        $validation = $this->validate([
                'email' => [
                    'rules'  => 'required|valid_email|is_not_unique['.$table_name.'.email]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'valid_email' => lang('Validation.validEmail'),
                        'is_not_unique' => lang('Validation.unregisteredEmail'),
                    ],
                ]
        ]);


        if($validation){
            $emailTo = $this->request->getPost('email');

            $token = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $password_length = 4;
            $shuffeled_token = str_shuffle($token);
            $new_pass = substr($shuffeled_token, 0, $password_length) . "A1a";

            $subject = "Typwind: Wachtwoord Herstel | Password recovery";
            $body = "Je kan inloggen met je nieuwe wachtwoord. You can log in with your new password.". "\r\n";
            $body .= $new_pass;


            $email = \Config\Services::email();
            $email->setFrom('typwindcontroller@gmail.com', 'Typwind Support');
            $email->setTo($this->request->getPost('email'));

            $email->setSubject($subject);
            $email->setMessage($body);

            if ($email->send()){
                $affectedRows = $this->database->update_password_expert($new_pass, $emailTo);
                if($affectedRows > 0 ){
                    return redirect()->to('AuthController/SignIn')->with('success', lang('Validation.emailSuccess'));
                }else{
                    return  redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.failGeneral'));
                }

            }else{
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }

        }

        $this->data['title'] = 'Recover Password';
        $this->data['content'] = view("auth/forgotPassword");
        return view("auth/login_template", $this->data);
    }

    public function codeOfConduct(){
        $signupData = session()->getFlashdata('signup_data');
        $this->data['title'] = 'Code Of Conduct';
        $this->data['content'] = view("code_of_conduct", ['signupData' => $signupData]);

        return view("login_template", $this->data);
    }

    public function confirmCodeOfConduct(){

        $userModel = new UserModel();

        $validation = $this->validate([
            'volunteerPlace' => [
                'rules' => 'required|alpha|regex_match[/^[A-Z][a-zA-Z]*$/]',
                'errors' => [
                    'required' => lang('Validation.Required'),
                    'alpha' => lang('Validation.alphaVolunteerPlace'),
                    'regex_match' => lang('Validation.regexUpper'),
                ],
            ],
            'volunteerAFM' => [
                'rules'  => 'numeric',
                'errors' => [
                    'numeric' => lang('Validation.numeric'),
                ],
            ],
            'volunteerDOY' => [
                'rules'  => 'numeric',
                'errors' => [
                    'numeric' => lang('Validation.numeric'),
                ],
            ],
            'serviceOne' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => lang('Validation.requiredService'),
                ],
            ],
            'volunteerHosp' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => lang('Validation.Required'),
                ],
            ]
        ]);


        if(!$validation){
            return redirect()->to('AuthController/CodeOfConduct')->with('validation', $this->validator)->withInput();
        }else{
            $email = $loggedUser['email'] ?? null;
            $password = $loggedUser['password'] ?? null;
            $firstName = $loggedUser['firstName'] ?? null;
            $lastName = $loggedUser['lastName'] ?? null;
            $telephone = $loggedUser['telephone'] ?? null;
            $location = $loggedUser['location'] ?? null;

            $residentOf = $this->request->getPost('volunteerPlace');
            $AFM = $this->request->getPost('volunteerAFM');
            $DOY = $this->request->getPost('volunteerDOY');
            $firstService = $this->request->getPost('firstService');
            $secondService = $this->request->getPost('secondService');
            $thirdService = $this->request->getPost('thirdService');

            $medicalInstitute = $this->request->getPost('volunteerHospitalisation');

            $result = $this->database->make_temp_account($email, $password, $firstName, $lastName, $telephone, $location, $residentOf, $AFM, $DOY, $firstService, $secondService, $thirdService, $medicalInstitute);
            if ($result == 0) {
                return redirect()->to('AuthController/SignUp')->with('fail', lang('Validation.failGeneral'));
            } else {
                $user_info = $userModel->where('peopleEmailAddress', $email)->first();
                $session_data = ['user' => $user_info];
                $session_data_json = json_encode($session_data);
                $expiry = time() + (60 * 60 * 24);
                $options = [
                    'expires' => $expiry,
                    'path' => '/',
                    'domain' => '',
                    'secure' => true,
                    'httponly' => false,
                    'SameSite' => 'Lax',
                ];

                setcookie('LoggedUser', $session_data_json, $options);

                $subject = "ΝΕΟΣ ΕΘΕΛΟΝΤΗΣ";
                $body = "Ο/Η " . "\r\n";
                $body .= $firstName;
                $body .= " εγήνε μέλος.";


                $email = \Config\Services::email();
                $email->setFrom('typwindcontroller@gmail.com', 'Boroume Org');
                $email->setTo('plomis888@gmail.com');

                $email->setSubject($subject);
                $email->setMessage($body);

                if ($email->send()) {
                    return redirect()->to('AuthController/SignIn')->with('succes', lang('Validation.registrationSuccess'));
                } else {
                    return redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.failGeneral'));
                }

            }
        }


    }

    function volunteersGuide(){
        $this->data['title'] = 'Volunteers Guide';
        $this->data['content'] = view("volunteersGuide");
        return view("login_template", $this->data);
    }
    function volunteersGuideGeneral(){
        $this->data['title'] = 'Volunteers Guide';
        $this->data['content'] = view("volunteersGeneralGuide");
        return view("login_template", $this->data);
    }
}