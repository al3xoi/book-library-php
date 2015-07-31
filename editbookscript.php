<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

// variabile pentru upload poza
//$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Define book values
$titlu = $_POST['titlu'];
$autor = $_POST['autor'];
$editura = $_POST['editura'];
$isbn = $_POST['isbn'];
$anaparitie = $_POST['anaparitie'];
$id = $_POST["bookID"];


if (isset($_POST['editbook'])) {

    if (empty($_POST['titlu']) || empty($_POST['autor']) || empty($_POST['editura']) || empty($_POST['isbn']) || empty($_POST['anaparitie'])) {
        $error = "Unul sau mai multe campuri au fost lasate necompletate";
        header('location: librarie.php?id=' . $error);
    }
    elseif (!(preg_match('/^[0-9]{13}$/', $_POST['isbn']))){
            $error = "Codul ISBN invalid. Codul ISBN trebuie sa contina 13 cifre";
            header('location: librarie.php?id=' . $error);
    }
    elseif (!(preg_match('/^[0-9]{4}$/', $_POST['anaparitie']))){
            $error = "Anul trebuie sa fie introdus in format de 4 cifre";
            header('location: librarie.php?id=' . $error);
    } else {

        include('connect.php');

// Select db
            $db = mysqli_select_db($connection, "dani3la_testing");

// To protect MySQL injection for Security purpose
            $titlu = stripslashes($titlu);
            $autor = stripslashes($autor);
            $editura = stripslashes($editura);
            $isbn = stripslashes($isbn);
            $anaparitie = stripslashes($anaparitie);

            $titlu = mysqli_real_escape_string($connection, $titlu);
            $autor = mysqli_real_escape_string($connection, $autor);
            $editura = mysqli_real_escape_string($connection, $editura);
            $isbn = mysqli_real_escape_string($connection, $isbn);
            $anaparitie = mysqli_real_escape_string($connection, $anaparitie);


            /*// Check for existing book, existing ISBN

                    $sql_existing_book = mysqli_query($connection, "SELECT * FROM carti WHERE Titlu LIKE '$titlu' AND Isbn LIKE '$isbn'");
                    $data_existing_book = mysqli_num_rows($sql_existing_book);

                    if ($data_existing_book != 0) {

                        $error = 'Cartea introdusa exista deja in baza de date';
                        header('location: http://www.lovefairy.com/test2/librarie/librarie.php?id='.$error); // Redirecting To Other Page


                    } else {*/

// Update database with edited book details
            $query = mysqli_query($connection, "UPDATE carti2 SET Titlu='$titlu', AutorID='$autor', Editura='$editura', Isbn='$isbn', AnulAparitiei='$anaparitie' WHERE ID='$id'");


            if ($query) {

                $error = "Cartea a fost editata cu success";
                header('location: librarie.php?id=' . $error); // Redirecting To Other Page


            } else {
                $error = "Something went wrong";
            }

            mysqli_close($connection); // Closing Connection
        }
    }

    ?>

