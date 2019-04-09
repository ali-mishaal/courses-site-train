<?php



    $servername_db = 'localhost';
    $username_db = 'root';
    $password_db = '';
    $db_name = 'courses';

    try{

        $conn = new PDO("mysql:host=$servername_db;dbname=$db_name" , $username_db , $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        

    }catch(Exception $e){

        die('connection failed' . $e->getMessage()); 

    }








?>