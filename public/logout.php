<?php 

include_once '../config.php';

session_destroy();

header("location: " . $route . "index.php?logout");