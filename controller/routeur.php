<?php
require_once 'ControllerVoiture.php';
if (isset($_GET['action'])){
    $action = $_GET['action'];
} else {
    $action = 'readAll';
}
if(in_array($action,get_class_methods('ControllerVoiture'))){
    ControllerVoiture::$action();
} else {
    ControllerVoiture::error();
}
// Appel de la méthode statique $action de ControllerVoiture

?>