    <?php

    require_once __DIR__. '/../../Models/User.php';
    require_once __DIR__. '/../../../config/database.php';

    class AuthController{

        private $user;

        public function __construct(){

            $database = new Database();
            $pdo = $database->connect();
            $this->user = new User($pdo);

        }

        public function register(){

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if ($_SERVER['REQUEST_METHOD'] !=='POST') {
                return;
            }
                $firstName = trim($_POST['first_name']);
                $lastName = trim($_POST['last_name']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $password = $_POST['password'];

            if (empty($firstName)||empty($lastName)||empty($email)||empty($phone)||empty($password)) {
                $_SESSION['error'] = "All fields are required";
                header("Location: register.php");
                exit;
            }

            if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid Email";
                header("Location: register.php");
                exit;
            }

            $userphone = $this->user->findByPhone($phone);

            if ($userphone) {
                $_SESSION['error'] = "Phone number Already exists";
                header("Location: register.php");
                exit;
            }

            $user = $this->user->findByEmail($email);

            if ($user) {
                $_SESSION['error'] = "Email already exists";
                header("Location: register.php");
                exit;
            }

                $roleId = 2;

                $data = [
                    "role_id" => $roleId,
                    "first_name" => $firstName,
                    "last_name" => $lastName,
                    "email" => $email,
                    "phone" => $phone,
                    "password" => $password
                ];

                $result = $this->user->create($data);
                
                if ($result) {
                    $_SESSION['success'] = "Registration Successful. Please Login";
                    header("Location: login.php");
                    exit;
                }else {
                    $_SESSION['error'] = "Registration Failed";
                    header("Location: register.php");
                    exit;
                }
        }

        public function login(){

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if ($_SERVER['REQUEST_METHOD'] !=='POST') {
                return;
            } 

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "All fields are required";
                header("Location: login.php");
                exit;
            }
            // EMAIL VALIDATION 
            if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid Email";
                header("Location: login.php");
                exit;
            }

            $result =  $this->user->findByEmail($email);
            
            if (!$result) {
                $_SESSION['error']="Email Not Found";

                header("Location: login.php");
                exit;
            }

            if (!password_verify($password,$result['password'])) {
                $_SESSION['error']="Incorrect Password";
                header("Location: login.php");
                exit;
            }

            $_SESSION['id']      = $result['id'];
            $_SESSION['role_id'] = $result['role_id'];
            $_SESSION['first_name'] = $result['first_name'];

            header("Location: index.php");
            exit;
        }
        public function logout(){

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }   
                session_unset();
                session_destroy();

                header("Location: login.php");
                exit;
            }
    }


    ?>