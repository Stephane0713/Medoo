<?php

session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

require_once './classes/TblUsers.php';

include("./templates/header.php");
if (isset($_GET["mode"])) {
    if ($_GET["mode"] === "add") {
        include("./templates/signIn.php");
    } elseif ($_GET["mode"] === "edit") {
        include("./templates/edit.php");
    } else {
        include("./templates/userList.php");
    }
} else {
    include("./templates/userList.php");
}
include("./templates/footer.php");
