<?php session_start();?>
<div class="topmenuwrap">
    <div class="topmenu">
        <ul>
            <li><a href="http://lovefairy.com/librariev2/librarie">Librarie</a></li>
            <li><a href="http://lovefairy.com/librariev2/contact.php">Contact</a></li>
            <li><button>About</button></li>


            <li class="r"><a href="http://lovefairy.com/librariev2/logout.php">Logout</a></li>

            <li class="a"><?php include_once('addbook.php'); ?></li>
            <li class="l">Bine ai revenit <b> <?php echo $_SESSION['login_user']; ?> !</b></li>
        </ul>
    </div>
    <div id="div1"> <div class="divinfo">Librarie.com Versiunea 1.0 Proiect finantat de Alabalaportocala.ro</div> </div>
</div>