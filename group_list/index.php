<?php
include_once '../db-connect.php';
session_start();
if (array_key_exists('group_id', $_SESSION)) {
    include_once 'st_list.php';
}

else header("Location: /");