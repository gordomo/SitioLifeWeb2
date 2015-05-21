<?php
include_once 'conf/constantes.php';
class conf
{
    public static function getConection($db = 'general')
    {
        $usr = "root";
        $pass = "021415";
    
        if($_SERVER["HTTP_HOST"] != "localhost")
        {
            $usr = "m2000364_mail";
            $pass = "nu68SEkizi";
        }
        
        $con=mysqli_connect("localhost",$usr,$pass,$db);
        // Check connection
        if (mysqli_connect_errno())
        {
            //TODO guardar log del error
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            
            return false;
        }
        
        return $con;
        
    }
}   