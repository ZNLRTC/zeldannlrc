<?php



$dbuser = 'root';

$dbpass = '';

$message = '';

try{

    $options = array(

        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

        PDO::MYSQL_ATTR_LOCAL_INFILE => true

    );

    $db = new PDO('mysql:host=localhost;dbname=znlrcdb',$dbuser,$dbpass,$options);

    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e){

    die('cannot connect to database!');

}