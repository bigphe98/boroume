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
                return redirect()->to('AuthController/SignUp/ageCheck');
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

        // Determine if the user is signing up as an adult or a child
        $isAdult = strpos(current_url(), 'adultSignup');

        session()->setFlashdata('isAdult', $isAdult);

        // Load the regular signup view
        $this->data['content'] = view("SignUp", $this->data);

        return view("login_template", $this->data);
    }

    public function create_login(){

        $userModel = new UserModel();
        $table_name=$userModel->getTableName();

        $isAdult = session()->getFlashdata('isAdult');



        if ($isAdult) {
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required|regex_match[/^([A-ZΑ-Ω][a-zα-ω]*|[A-ZΑ-Ω]+)$/]|min_length[2]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'regex_match' => lang('Validation.regexName'),
                        'min_length' => lang('Validation.minLengthFirstName'),
                    ],
                ],
                'surname' => [
                    'rules' => 'required|regex_match[/^([A-ZΑ-Ω][a-zα-ω]*\s?|[A-ZΑ-Ω]+\s?)$/]|min_length[2]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'regex_match' => lang('Validation.regexSurname'),
                        'min_length' => lang('Validation.minLengthLastName'),
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
                    return  redirect()->to('AuthController/SignUp/adultSignup')->with('validation', $this->validator)->withInput();
            } else{
                $firstName = $this->request->getPost('name');
                $lastName = $this->request->getPost('surname');
                $firstNameKid = $this->request->getPost('nameKid');
                $lastNameKid = $this->request->getPost('surnameKid');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $telephone = $this->request->getPost('telephone');
                $location = $this->request->getPost('location');

                /*$result = $this->database->make_temp_account($email, $password, $firstName, $lastName, $telephone, $location);
                if ($result == 0) {
                    return redirect()->to('AuthController/SignUp')->with('fail', 'Something went wrong');
                } else {*/
                //$user_info = $userModel->where('peopleEmailAddress', $email)->first();
                $session_data = ['firstName' => $firstName, 'lastName' => $lastName, 'firstNameKid' => $firstNameKid, 'lastNameKid' => $lastNameKid,'email' => $email, 'password' => $password, 'telephone' => $telephone, 'location' => $location];
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


                    return redirect()->to('AuthController/privateAgreement');


            }
        } else {
            $validation = $this->validate([
                'name' => [
                    'rules' => 'required|regex_match[/^([A-ZΑ-Ω][a-zα-ω]*|[A-ZΑ-Ω]+)$/]|min_length[2]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'regex_match' => lang('Validation.regexName'),
                        'min_length' => lang('Validation.minLengthFirstName'),
                    ],
                ],
                'surname' => [
                    'rules' => 'required|regex_match[/^([A-ZΑ-Ω][a-zα-ω]*\s?|[A-ZΑ-Ω]+\s?)$/]|min_length[2]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'regex_match' => lang('Validation.regexSurname'),
                        'min_length' => lang('Validation.minLengthLastName'),
                    ],
                ],
                'nameKid' => [
                    'rules' => 'required|regex_match[/^([A-ZΑ-Ω][a-zα-ω]*|[A-ZΑ-Ω]+)$/]|min_length[2]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'regex_match' => lang('Validation.regexName'),
                        'min_length' => lang('Validation.minLengthFirstName'),
                    ],
                ],
                'surnameKid' => [
                    'rules' => 'required|regex_match[/^([A-ZΑ-Ω][a-zα-ω]*\s?|[A-ZΑ-Ω]+\s?)$/]|min_length[2]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'regex_match' => lang('Validation.regexSurname'),
                        'min_length' => lang('Validation.minLengthLastName'),
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
                return  redirect()->to('AuthController/SignUp/childSignup')->with('validation', $this->validator)->withInput();
            } else{
                $firstName = $this->request->getPost('name');
                $lastName = $this->request->getPost('surname');
                $firstNameKid = $this->request->getPost('nameKid');
                $lastNameKid = $this->request->getPost('surnameKid');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $telephone = $this->request->getPost('telephone');
                $location = $this->request->getPost('location');

                /*$result = $this->database->make_temp_account($email, $password, $firstName, $lastName, $telephone, $location);
                if ($result == 0) {
                    return redirect()->to('AuthController/SignUp')->with('fail', 'Something went wrong');
                } else {*/
                //$user_info = $userModel->where('peopleEmailAddress', $email)->first();
                $session_data = ['firstName' => $firstName, 'lastName' => $lastName, 'firstNameKid' => $firstNameKid, 'lastNameKid' => $lastNameKid,'email' => $email, 'password' => $password, 'telephone' => $telephone, 'location' => $location];
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
                return redirect()->to('AuthController/adultConsent');
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


            $check_active = $user_info['peopleIsVolunteer'];
            $check_password = $user_info['peoplePassword'];

            if($check_active == 1){
                if( $check_password!=$password ){

                    return  redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.incorrectPassword'))->withInput();

                }else{
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



            }else{
                return  redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.emailNotActive'))->withInput();
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

        return  redirect()->to('AuthController/login')->with('fail', lang('Validation.loggedOff'));

    }

    public function forgotPassword(){

        $this->data['title'] = 'Recover Password';
        $this->data['content'] = view("recoverPassword");
        return view("login_template", $this->data);
    }

    public function recoverPassword(){
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
            ]
        ]);


        if(!$validation){
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }else{
            $emailTo = $this->request->getPost('email');

            $token = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $password_length = 4;
            $shuffeled_token = str_shuffle($token);
            $new_pass = substr($shuffeled_token, 0, $password_length) . "A1a";

            $subject = "Boroume: Password recovery | Επανέκδοση Κωδικού ";
            $body = "You can log in with your new password. Μπορείτε να συνδεθείτε με τον καινούριο κωδικό σας". "\r\n";
            $body .= $new_pass;


            $email = \Config\Services::email();
            $email->setFrom('typwindcontroller@gmail.com', 'Boroume Support');
            $email->setTo($this->request->getPost('email'));

            $email->setSubject($subject);
            $email->setMessage($body);

            if ($email->send()){
                $affectedRows = $this->database->update_password($new_pass, $emailTo);
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
    }

    public function privateAgreement(){
        $signupData = session()->getFlashdata('signup_data');
        $this->data['title'] = 'Private Agreement';
        $this->data['content'] = view("code_of_conduct", ['signupData' => $signupData]);

        return view("login_template", $this->data);
    }

    public function confirmCodeOfConduct(){

        $userModel = new UserModel();

        $AFM = $this->request->getPost('volunteerAFM');
        $DOY = $this->request->getPost('volunteerDOY');
        if($AFM == NULL && $DOY == NULL){
            $validation = $this->validate([
                'volunteerPlace' => [
                    'rules' => 'required|alpha|regex_match[/^[A-Z][A-Za-zΑ-Ωα-ω]*$/]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'alpha' => lang('Validation.alphaVolunteerPlace'),
                        'regex_match' => lang('Validation.regexUpper'),
                    ],
                ],
                'programs' => [
                    'label' => 'Programs',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please select at least one program.',
                    ],
                ],
                'volunteerHosp' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                    ],
                ]
            ]);
        }else{
            $validation = $this->validate([
                'volunteerPlace' => [
                    'rules' => 'required|alpha|regex_match[/^[A-Za-zΑ-Ωα-ω][A-Za-zΑ-Ωα-ω]*$/]',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                        'alpha' => lang('Validation.alphaVolunteerPlace'),
                        'regex_match' => lang('Validation.regexUpper'),
                    ],
                ],
                'volunteerAFM' => [
                    'rules'  => 'numeric',
                    'errors' => [
                        'numeric_if_filled' => lang('Validation.numeric'),
                    ],
                ],
                'volunteerDOY' => [
                    'rules'  => 'numeric',
                    'errors' => [
                        'numeric' => lang('Validation.numeric'),
                    ],
                ],
                'programs' => [
                    'label' => 'Programs',
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang('Validation.programSelection'),
                    ],
                ],
                'volunteerHosp' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => lang('Validation.Required'),
                    ],
                ]
            ]);
        }

        if(!$validation){
            return redirect()->to('AuthController/privateAgreement')->with('validation', $this->validator)->withInput();
        }else{
            $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
            $email = $loggedUser['email'] ?? null;
            $password = $loggedUser['password'] ?? null;
            $firstName = $loggedUser['firstName'] ?? null;
            $lastName = $loggedUser['lastName'] ?? null;
            $telephone = $loggedUser['telephone'] ?? null;
            $location = $loggedUser['location'] ?? null;

            $residentOf = $this->request->getPost('volunteerPlace');
            $AFM = $this->request->getPost('volunteerAFM');
            $DOY = $this->request->getPost('volunteerDOY');
            $programs = $this->request->getPost('programs');
            $medicalInstitute = $this->request->getPost('volunteerHosp');

            $result = $this->database->make_temp_account($email, $password, $firstName, $lastName, $telephone, $location, $residentOf, $AFM, $DOY, $medicalInstitute, NULL);
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

                $session_data2 = ['programs' => $programs];
                $session_data_json2 = json_encode($session_data2);
                setcookie('Prog', $session_data_json2, $options);

                setcookie('LoggedUser', $session_data_json, $options);
                $peopleId = $user_info['peopleId'];
                $result2 = $this->database->addToProgram($peopleId, $programs);
                if ($result2 == 0) {
                    return redirect()->to('AuthController/SignUp')->with('fail', lang('Validation.failGeneral'));
                }else{
                    $subject = "ΝΕΟΣ ΕΘΕΛΟΝΤΗΣ";
                    $body = "Η/Ο " . "\r\n";
                    $body .= $firstName;
                    $body .= " έγινε μέλος." . "\r\n";
                    $body .= " Αυτό είναι το email της/του: " . $email;


                    $email = \Config\Services::email();
                    $email->setFrom('typwindcontroller@gmail.com', 'Boroume Org');
                    $email->setTo('plomis888@gmail.com');

                    $email->setSubject($subject);
                    $email->setMessage($body);

                    if ($email->send()) {
                        return redirect()->to('AuthController/SignIn')->with('success', lang('Validation.registrationSuccess'));
                    } else {
                        return redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.failGeneral'));
                    }
                }
            }
        }
    }

    public function adultConsent(){
        $signupData = session()->getFlashdata('signup_data');
        $this->data['title'] = 'Adult Consent';
        $this->data['content'] = view("adult_consent", ['signupData' => $signupData]);

        return view("login_template", $this->data);
    }

    public function acceptAdultConsent(){
        $userModel = new UserModel();

        $validation = $this->validate([
            'endTerm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validation.Required'),
                ],
            ]
        ]);

        if(!$validation){
            return redirect()->to('AuthController/adultConsent')->with('validation', $this->validator)->withInput();
        }else {
            $loggedUser = json_decode($_COOKIE['LoggedUser'], true);
            $email = $loggedUser['email'] ?? null;
            $password = $loggedUser['password'] ?? null;
            $firstName = $loggedUser['firstNameKid'] ?? null;
            $lastName = $loggedUser['lastNameKid'] ?? null;
            $telephone = $loggedUser['telephone'] ?? null;
            $location = $loggedUser['location'] ?? null;

            $parentFirstName = $loggedUser['firstName'] ?? null;
            $parentLastName = $loggedUser['lastName'] ?? null;

            $endTerm = $this->request->getPost('endTerm');

            $result = $this->database->make_temp_account($email, $password, $firstName, $lastName, $telephone, $location, NULL, NULL, NULL, NULL, $endTerm);
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
                $peopleId = $user_info['peopleId'];
                $result2 = $this->database->link_parent_to_account($peopleId, $parentFirstName, $parentLastName);
                if ($result2 == 0) {
                    return redirect()->to('AuthController/SignUp')->with('fail', lang('Validation.failGeneral'));
                }else{
                    $subject = "ΝΕΟΣ ΕΘΕΛΟΝΤΗΣ";
                    $body = "Η/Ο " . "\r\n";
                    $body .= $firstName;
                    $body .= " έγινε μέλος." . "\r\n";
                    $body .= " Αυτό είναι το email της/του: " . $email;


                    $email = \Config\Services::email();
                    $email->setFrom('typwindcontroller@gmail.com', 'Boroume Org');
                    $email->setTo('plomis888@gmail.com');

                    $email->setSubject($subject);
                    $email->setMessage($body);

                    if ($email->send()) {
                        return redirect()->to('AuthController/SignIn')->with('success', lang('Validation.registrationSuccess'));
                    } else {
                        return redirect()->to('AuthController/SignIn')->with('fail', lang('Validation.failGeneral'));
                    }
                }
            }


        }

    }

    public function volunteersGuide(){
        $this->data['title'] = 'Volunteers Guide';
        $this->data['content'] = view("volunteersGuide");
        return view("volunteersGuide");
    }
    public function volunteersGuideGeneral(){
        $this->data['title'] = 'Volunteers Guide General';
        $this->data['content'] = view("volunteersGeneralGuide");
        return view("volunteersGeneralGuide");
    }

    public function ageCheck(){
        $this->data['title'] = 'Age Check';
        $this->data['content'] = view("ageCheck");
        return view("login_template", $this->data);
    }

    public function redirectAgeCheck()
    {
        $isAdult = $this->request->getPost('isAdult');

        if ($isAdult == '1') {
            // User is over 18, redirect to adult signup page
            return redirect()->to('AuthController/SignUp/adultSignup');
        } else {
            // User is under 18, redirect to child signup page
            return redirect()->to('AuthController/SignUp/childSignup');
        }
    }
}