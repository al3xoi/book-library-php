<?php
$value = $_GET['query'];
$formfield = $_GET['field'];


// Check Valid or Invalid user name when user enters user name in username input field.
if ($formfield == "name") {
if (strlen($value) < 3) {
echo "<div class=errortxt>Name must be 3+ letters</div>";
} else {
echo "<span class=validtxt>Valid</span>";
}
}

if ($formfield == "email") {
if (!filter_var(($value), FILTER_VALIDATE_EMAIL)) {
echo "<div class=errortxt>Invalid email address</div>";
} else {
echo "<span class=validtxt>Valid</span>";
}
}

if ($formfield == "username") {
if (strlen($value) < 4) {
echo "<div class=errortxt>Username must be at least 4 letters</div>";
} else {
echo "<span class=validtxt>Valid</span>";
}
}

if ($formfield == "password") {
$caca = $value;
if (strlen($caca) < 6) {
echo "<div class=errortxt>Password too short</div>";
} else {
echo "<span class=validtxt>Valid</span>";
}
}
?>