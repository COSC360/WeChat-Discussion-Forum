<?php
        session_start();
        //code to check if user logged in
        if (isset($_SESSION['user_id'])) {
        $response = array('loggedIn' => true);
        } else {
        $response = array('loggedIn' => false);
        }
        echo json_encode($response);
?>