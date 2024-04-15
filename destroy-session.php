<?php
    session_start();
    session_destroy();
    header("Location: http://lab4.local/login.php");
