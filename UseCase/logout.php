<?php
    include_once '../User/User.php';
    User::logout();
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';