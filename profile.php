<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['access_token'])) {
    header('Location: login.php'); // Redirect to the login page if not authenticated
    exit;
}

// Retrieve user info from the access token
$client->setAccessToken($_SESSION['access_token']);
$service = new Google_Service_Oauth2($client);
$userInfo = $service->userinfo->get();

// Display user information
echo 'Welcome, ' . $userInfo->getName() . '! Your email: ' . $userInfo->getEmail();
?>
