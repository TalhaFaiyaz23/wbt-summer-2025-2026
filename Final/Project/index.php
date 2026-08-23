<?php
session_start();
require 'controllers/RegistrationController.php';

$controller = new RegistrationController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
} else {
    $controller->index();
}
