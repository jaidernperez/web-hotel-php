<?php
require_once "../../../config/loader.php";

use Config\Session;

Session::init();
Session::destroy();
header("Location: ../../views/login.php");
