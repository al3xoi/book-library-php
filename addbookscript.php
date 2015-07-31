<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message


// variabile pentru upload poza
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);


// Define book values
$titlu = $_POST['titlu'];
$autor = $_POST['autor'];
$editura = $_POST['editura'];
$isbn = $_POST['isbn'];
$anaparitie = $_POST['anaparitie'];




if (isset($_POST['adauga'])) {


    if (empty($_POST['titlu']) || empty($_POST['autor']) || empty($_POST['editura']) || empty($_POST['isbn']) || empty($_POST['anaparitie'])) {
        $error = "Unul sau mai multe campuri au fost lasate necompletate";
       header('location: librarie.php?id='.$error.'&t='.$titlu.'&a='.$autor.'&e='.$editura.'&i='.$isbn.'&aa='.$anaparitie);

    }

    elseif (!(preg_match('/^[0-9]{13}$/', $_POST['isbn']))){
        $error = "Codul ISBN invalid. Codul ISBN trebuie sa contina 13 cifre";
        header('location: librarie.php?id='.$error.'&t='.$titlu.'&a='.$autor.'&e='.$editura.'&i='.$isbn.'&aa='.$anaparitie);
    }
    elseif (!(preg_match('/^[0-9]{4}$/', $_POST['anaparitie']))){
        $error = "Anul trebuie sa fie introdus in format de 4 cifre";
        header('location: librarie.php?id='.$error.'&t='.$titlu.'&a='.$autor.'&e='.$editura.'&i='.$isbn.'&aa='.$anaparitie);
    }
    elseif (isset($_FILES['file'])) {

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if ($check !== true) {
        $error = "File selectat nu este o imagine";
        header('location: librarie.php?id='.$error.'&t='.$titlu.'&a='.$autor.'&e='.$editura.'&i='.$isbn.'&aa='.$anaparitie);
        }
    }
    elseif ($_FILES["fileToUpload"]["size"] > 600000){
        $error = "Imaginea selectat este prea mare. Marimea maxima acceptata este 600 Kb ";
        header('location: librarie.php?id='.$error.'&t='.$titlu.'&a='.$autor.'&e='.$editura.'&i='.$isbn.'&aa='.$anaparitie);
    }
    elseif ( (!empty($_FILES['fileToUpload']['name'])) && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $error = "Sunt acceptate doar fisiere imagine in format  JPG, JPEG, PNG sau GIF";
        header('location: librarie.php?id='.$error.'&t='.$titlu.'&a='.$autor.'&e='.$editura.'&i='.$isbn.'&aa='.$anaparitie);
    }
    else {

        if (!empty($_FILES['fileToUpload']['name'])) {

            $bookphoto = basename($_FILES["fileToUpload"]["name"]);
        } else {
            $bookphoto =  "book-256.png";
            $error = "Cartea a fost adaugata cu success";
            header('location: librarie.php?id='.$error);

        }


include ('connect.php');

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

// Selecting Database
        $db = mysqli_select_db($connection, "dani3la_testing");


// Check for existing book (existing title and existing ISBN)

        $sql_existing_book = mysqli_query($connection, "SELECT * FROM carti2 WHERE Titlu LIKE '$titlu' AND Isbn LIKE '$isbn'");
        $data_existing_book = mysqli_num_rows($sql_existing_book);


        if ($data_existing_book != 0) {

            $error = 'Cartea introdusa exista deja in baza de date';
            header('location: librarie.php?id='.$error.'&t='.$titlu.'&a='.$autor.'&e='.$editura.'&i='.$isbn.'&aa='.$anaparitie); // Redirecting To Other Page


        } else {

// Insert new book details into database
        $query = mysqli_query($connection, "INSERT INTO carti2 (Titlu, AutorID, Editura, Isbn, AnulAparitiei, BookPhoto) VALUES ('$titlu','$autor','$editura','$isbn','$anaparitie','$bookphoto');");

        //print_r($_POST["fileToUpload"]);
        //print_r($_FILES["fileToUpload"]);
        if ($query && (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))) {

            $error = "Cartea a fost adaugata cu success";
            header('location: http://www.lovefairy.com/test2/librarie/librarie.php?id='.$error); // Redirecting To Other Page


        } else {
            $error = "Something went wrong";
        }

        mysqli_close($connection); // Closing Connection
    }
}
}
?>

