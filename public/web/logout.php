<?php

require_once __DIR__ . '/../../app/Controllers/Web/AuthController.php';

$authController = new AuthController();
$authController->logout();