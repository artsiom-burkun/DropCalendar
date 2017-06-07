<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 01.06.2017
 * Time: 20:39
 */
try {
    $bdd = new PDO('mysql:host=localhost;dbname=kalendar', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch(Exception $e) {
    exit('Impossible to connect to database');
}