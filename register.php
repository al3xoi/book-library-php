<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message


if (isset($_POST['register'])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confpassword'])) {
        $error = "One or more required fields were left blank";
    } elseif (($_POST['password']) != ($_POST['confpassword'])) {
        $error = "your passwords do not match!";
    } elseif (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address!";
    } elseif (strlen($_POST['username']) < 4) {
        $error = "Your username should be at least 4 letters long";
    } else {

// Define user registration details
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];

// Connecting to database
        $servername = "localhost";
        $u_name = "dani3la_librarie";
        $pass = ".W+ko-;IkbA}";

        $connection = mysqli_connect($servername, $u_name, $pass);

// Check connection
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

// To protect MySQL injection for Security purpose
        $name = stripslashes($name);
        $email = stripslashes($email);
        $username = stripslashes($username);
        $password = stripslashes($password);

// encrypt password
        $encrypted_mypassword = md5($password);

        $name = mysqli_real_escape_string($connection, $name);
        $email = mysqli_real_escape_string($connection, $email);
        $username = mysqli_real_escape_string($connection, $username);
        $password_final = mysqli_real_escape_string($connection, $encrypted_mypassword);

// Selecting Database
        $db = mysqli_select_db($connection, "dani3la_testing");

// Check for existing user or existing email
        $sql_username = mysqli_query($connection, "SELECT * FROM login WHERE username='$username'");
        $data_username = mysqli_num_rows($sql_username);

        $sql_email = mysqli_query($connection, "SELECT * FROM login WHERE email='$email'");
        $data_email = mysqli_num_rows($sql_email);


        /*if (!$data_username) {
        $error = "A database error occurred in processing your '.
        'submission.<br>If this error persists, please '.
        'contact you@example.com.";
        }*/

        if ($data_username == 1) {
            $error = 'A user already exists with your chosen username. Please try another.';

        } elseif ($data_email == 1) {
            $error = 'The email address you entered is already in use. Please try another.';
        } else {

// Insert new user details into database
            $query = mysqli_query($connection, "INSERT INTO login (username, password, name, email) VALUES ('$username','$password_final','$name','$email');");
            $message = "Hi " . $_POST['name'] . " and welcome to Library.com \n Your login details are: \n UserName: " . $_POST['username'] . " \n Password: " . $_POST['password'] . "\n";

            if ($query) {
                $_SESSION['login_user'] = $username; // Initializing Session
                header("location: welcome.php"); // Redirecting To Other Page
                mail($_POST['email'], "Your account has been created",
                    $message, "From:Librarie.com <admin@librarie.com>");
            } else {
                $error = "Something went wrong";
            }
            mysqli_close($connection); // Closing Connection
        }
    }
}
?>