<?php

    session_start();
    unset($_SESSION['pfp']);
    unset($_SESSION['username']);
    header("Location: login.php");