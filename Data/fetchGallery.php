<?php
// Data to send to JavaScript
session_start();
$data = $_SESSION['GalleryData'];

// Send data as JSON
header('Content-Type: application/json');
echo json_encode($data);