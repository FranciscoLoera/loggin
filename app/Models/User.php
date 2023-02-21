<?php
namespace App\Models;
require 'Database.php';
class User{
 
    function createUser($name,$email,$password){

        require 'Database.php';
        
        $query=$mysqli->prepare("INSERT INTO users (name,email,password) VALUES(?,?,?)");

        $hash=password_hash($password, PASSWORD_DEFAULT);
        $query->bind_param('sss',$name,$email,$hash);
        $query->execute();
        $insertedId = $query->insert_id;
        $query->close();
        return $insertedId;
    }
    function getUser($email){

        require 'Database.php';
        
        $query=$mysqli->prepare("SELECT * FROM users WHERE email = ?");

        $query->bind_param('s',$email);
        $query->execute();
        $result=$query->get_result();
        $query->close();
        return $result->fetch_assoc();
    }

    public function createSecret($secret,$id){
        require 'Database.php';
        $query=$mysqli->prepare("UPDATE users SET two_factor_key =  ? WHERE id = ?");
        $query->bind_param('si',$secret,$id);
        $query->execute();
    }

    public function deleteSecret($id){
        require 'Database.php';
        $query=$mysqli->prepare("UPDATE users SET two_factor_key = NULL WHERE id = ?");
        $query->bind_param('i',$id);
        $query->execute();
    }
}