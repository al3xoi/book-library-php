<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("input.ifields, .ifields_select").focus(function () {
                $(this).css("border", "2px solid #0097cf");
            });
            $("input.ifields, .ifields_select").blur(function () {
                $(this).css("border", "2px solid #ccc");
            });
        });


    </script>
</head>
<body>
<?php

include('connect.php');

// Select db
$db = mysqli_select_db($connection, "dani3la_testing");


$id = $_GET["bookID"];
$selected_value = $_GET['edit_book'];


$query = "SELECT * FROM carti2 WHERE ID = '$id'";
$result = mysqli_query($connection, $query);

$sql_autori = mysqli_query($connection, "SELECT * FROM autori");


echo "<div class=editbookinner><h2>Editati Detaliile Cartii</h2><br><form id=f2 method=post action=editbookscript.php>";
echo "Autor *<br><select name=autor form=f2 class=ifields_select>";
echo "<option value=none selected disabled>Selecteaza Autorul</option>";


while ($row = mysqli_fetch_array($sql_autori)) {   //loop through results

    echo "<option value='${row['AutorID']}' ". (($selected_value == $row['AutorID']) ? "selected='selected'":"").">${row['NumeAutor']}</option>";

}

echo "</select><br><br>";

while ($row = mysqli_fetch_array($result)) {
    echo "Titlu *<br><input class=ifields id=titlu name=titlu type=text value='", $row['Titlu'], "'><br><br>";


    echo "Editura *<br><input class=ifields id=editura name=editura type=text value='", $row['Editura'], "'><br><br>";
    echo "ISBN *<br><input class=ifields id=isbn name=isbn type=text value='", $row['Isbn'], "'><br><br>";
    echo "Anul Aparitiei *<br><input class=ifields id=anaparitie name=anaparitie type=text value='", $row['AnulAparitiei'], "'><br><br>";
    echo "<span><input type=hidden name=bookID value='", $id, "'>";

    echo "<input class=buton name=editbook type=submit value='Submit Changes'><br><br></div>";

}
?>


</body>
</html>

