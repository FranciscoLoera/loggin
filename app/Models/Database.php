<?php





        //$this->bd= new mysqli('localhost','root','','usuarios');

        $mysqli= new mysqli('localhost','root','','usuarios');
        if ($mysqli ->connect_errno):
            echo "Error al conectarse".$mysqli->connect_error;
        endif;
    
?>
    
   


