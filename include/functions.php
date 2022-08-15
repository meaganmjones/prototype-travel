<?php

// Test to determine if this is a POST event
function postRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

// Test to determine if this is a GET event
function getRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' && !empty($_GET) );
}

// Test to determine if the user is logged in
function loggedIn()
{
    // Check session staus and start session if not running
    if (session_status() !== PHP_SESSION_ACTIVE) 
    {
        session_start();
    }

    // Check if isLoggedIn is set, check its status
    return (array_key_exists('loggedIn', $_SESSION) && ($_SESSION['loggedIn']));
}

//function uploadImage()

?>