<?php
class session {

    public static function ClientConnected(){
        return isset($_SESSION['Id_Client']) && !isset($_SESSION['isAdmin']);
    }

    public static function adminConnected(){
        return isset($_SESSION['Id_Client']) && isset($_SESSION['isAdmin']);
    }

    public static function ClientConnecting(){
        return isset($_GET["action"]) && $_GET["action"] == "connect";
    }

}
?>