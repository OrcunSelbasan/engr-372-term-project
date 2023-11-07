<?php
    class ControllerAuth
    {
        public function __construct()
        {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
        }

        static public function isLoggedIn()
        {
            return $_SESSION['logged_in'] == true;
        }

        static public function setLogin(bool $login = false)
        {
            $_SESSION['logged_in'] = $login;
        }

        public function login($email, $password)
        {
            $db = new Database($_ENV["USERNAME"], $_ENV["PASSWORD"]);
            $result = $db->queryRaw("SELECT * FROM auth WHERE email = '$email' AND password = '$password'");

            if ($result->num_rows > 0) {
                var_dump($result);
            }
        }

        public function checkAuth()
        {
            $root = self::getRoot();

            // If user is not logged in
            if (!self::isLoggedIn()) {
                header("Location: $root");
                exit;
            }
        }

        static function getRoot()
        {
            $isHTTPS = !empty($_SERVER['HTTPS']);
            $protocol = $isHTTPS ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $root = $protocol . '://' . $host;

            return $root;
        }
    }
?>
