<?php

if (isset($_GET["id"]))

     $error = $_GET["id"];

else

    $error = "";


include ('connect.php');
$db = mysqli_select_db($connection, "dani3la_testing");

$sql_autori = mysqli_query($connection, "SELECT * FROM autori");
//  $data_autori = mysqli_num_rows($sql_autori);

?>


<a href="#openModal" class="modalcarte"><b>+ </b>Adauga o carte</a>

<div id="openModal" class="modalDialog">
    <div>
        <a href="#close" title="Close" class="close">X</a>

        <h2>Adauga datele cartii si poza cu coperta</h2>
        Campurile marcate cu * sunt obligatorii!<br><br>

        <form id="f1" class="modalcarte" method="post" action="addbookscript.php" enctype="multipart/form-data">

            <span>Autor *</span>&nbsp;&nbsp;<select name="autor" form="f1">
                <option value="none" selected disabled>Selecteaza Autorul</option>

                <?php
                while($row = mysqli_fetch_array($sql_autori)){   //loop through results
                   // echo "<option value='",$row['AutorID'],"'>".$row['NumeAutor']."</option>";
                    echo "<option value='${row['AutorID']}' ". (($_GET['a'] == $row['AutorID']) ? "selected='selected'":"").">${row['NumeAutor']}</option>";

                }
                ?>

            </select><br><br>

            <span>Titlu *</span>&nbsp;&nbsp;<input id="titlu" name="titlu" type="text" value='<?php echo $_GET['t'] ;?>'><br><br>


            <span>Editura *</span>&nbsp;&nbsp;<input id="editura" name="editura" type="text" value='<?php echo $_GET['e'] ;?>'><br><br>
            <span>ISBN *</span>&nbsp;&nbsp;<input id="isbn" name="isbn" type="text" value='<?php echo $_GET['i'] ;?>'><br><br>
            <span>Anul Aparitiei *</span>&nbsp;&nbsp;<input id="anaparitie" name="anaparitie" type="text" value='<?php echo $_GET['aa'] ;?>'><br><br>


            Selectati imaginea cu coperta cartii:<br><br>
            <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            <input id="submit" type="submit" name="adauga" value=" Adauga "><br><br>

        </form>


    </div>
</div>

