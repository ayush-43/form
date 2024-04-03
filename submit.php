<?php
// submit.php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // Here you can do additional processing like saving to database
    
    // Return the submitted data as JSON response
    echo json_encode(['name' => $name, 'email' => $email]);
    exit;
}
?>
