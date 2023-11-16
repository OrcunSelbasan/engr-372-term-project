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
            return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
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

            // Checks if user is inactive for a while
            $this->checkLastInteraction();

            // Checks if user is not logged in
            if (!self::isLoggedIn()) {
                header("Location: $root");
                exit;
            }
        }


        private function checkLastInteraction()
        {
            $lastInteractionTime = isset($_SESSION['LastInteractionTime']) ? $_SESSION['LastInteractionTime'] : 0;
            $timeDifference = time() - $lastInteractionTime;
            $oneHour = 3600;
            if ($lastInteractionTime > 0 && $timeDifference > $oneHour) {
                session_unset();
                session_destroy();
                header('Location: index.php');
                return false;
            } else if ($lastInteractionTime >= 0) {
                $_SESSION['LastInteractionTime'] = time();
                return true;
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
