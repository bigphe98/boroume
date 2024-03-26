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
            // Manually set the session language to English
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
                    'required' => 'First name is required',
                    'alpha' => 'First name should be only letters',
                    'min_length' => 'First name should be minimum 2 characters long',
                    'regex_match' => 'First letter should be uppercase',
                ],
            ],
            'surname' => [
                'rules' => 'required|alpha_space|min_length[3]|regex_match[/^[A-Z][a-zA-Z\s]*$/]',
                'errors' => [
                    'required' => 'Last name is required',
                    'alpha' => 'Last name should be only letters',
                    'min_length' => 'Last name should be minimum 3 characters long',
                    'regex_match' => 'First letter should be uppercase',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique['.$table_name.'.peopleEmailAddress]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Not a valid email format',
                    'is_unique' => 'Email has already been taken',
                ],
            ],
            'password' => [
                'rules'  =>  'required|min_length[6]|max_length[20]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have at least 6 characters in length',
                    'max_length' => 'Password must not have characters more thant 20 in length',
                    'regex_match' => 'Password needs: 1 lowercase, 1 uppercase, 1 number',
                ],
            ],
            'cpassword' => [
                'rules'  => 'matches[password]',
                'errors' => [
                    'required' => 'Password confirmation is required',
                    'matches' => 'Passwords do not match',
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
            $telephone = $this->request->getPost('telephoneNumber');
            $location = $this->request->getPost('location');

            $result = $this->database->make_temp_account($email, $password, $firstName, $lastName, $telephone, $location);
            if ($result == 0) {
                return redirect()->to('AuthController/SignUp')->with('fail', 'Something went wrong');
            } else {
                $emailTo = $this->request->getPost('email');
                $subject = "Welcome to Boroume";
                $body = "Welcome to Boroume". "\r\n";
                $body .= $firstName;
                $body .= ". Please sign read, fill in, sign these forms and send them back. We will check your documents and open your account.";


                $email = \Config\Services::email();
                $email->setFrom('typwindcontroller@gmail.com', 'Boroume Org');
                $email->setTo($this->request->getPost('email'));

                $email->setSubject($subject);
                $email->setMessage($body);

                $email->attach('public/pdfs/Μπορούμε στη Λαϊκή_Οδηγός εθελοντών_review 2023.pdf');
                $email->attach('public/pdfs/Οδηγός Εθελοντή_Γενικές αρχές.pdf');
                $email->attach('public/pdfs/Σύμβαση Παροχής Εθελοντικής Εργασίας ΜΠΟΡΟΥΜΕ_2023 (1).pdf');
                if ($email->send()) {
                    return redirect()->to('AuthController/SignIn')->with('success', 'You successfully registered! Check your email address.');
                }else{
                        return  redirect()->to('AuthController/SignIn')->with('fail', 'Something went wrong.');
                    }
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
                        'required' => 'Email is required.',
                        'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                        'is_not_unique' => 'Email is not registered in our server.',
                    ],
                ],
                'password' => [
                    'rules'  => 'required|min_length[6]|max_length[20]',
                    'errors' => [
                        'required' => 'Password is required.',
                        'min_length' => 'Password must have atleast 6 characters in length.',
                        'max_length' => 'Password must not have characters more thant 20 in length.',
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

                return  redirect()->to('AuthController/SignIn')->with('fail', 'Incorrect password.')->withInput();

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
        if($_COOKIE['lang'] == "en")
            return  redirect()->to('/public/AuthController/login')->with('fail', 'You are now logged out.');
        if($_COOKIE['lang'] == "nl")
            return  redirect()->to('/public/AuthController/login')->with('fail', 'Je bent nu afgemeld.');
    }

    public function recoverPassword(){
        $userModel = new UserModel();
        $table_name = $userModel->getTableName();
        $validation = $this->validate([
                'email' => [
                    'rules'  => 'required|valid_email|is_not_unique['.$table_name.'.email]',
                    'errors' => [
                        'required' => 'Email is required.',
                        'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                        'is_not_unique' => 'Email is not registered in our server.',
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
                    return redirect()->to('AuthController/SignIn')->with('success', 'The email is send succesfully!');
                }else{
                    return  redirect()->to('AuthController/SignIn')->with('fail', 'Something went wrong.');
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

    function codeOfConduct(){
        $this->data['title'] = 'Code Of Conduct';
        $this->data['content'] = view("code_of_conduct");
        return view("login_template", $this->data);
    }
}