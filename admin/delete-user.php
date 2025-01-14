<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id =filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    //fetch user from db
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    //make sure we got one user
    if(mysqli_num_rows($result) == 1){
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        //delete iage if availabe
        if($avatar_path){
            unlink($avatar_path);
        }
    }
    //for later
    //fetch all thumbnails of users posts and delete them



    //delete user from data
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if(mysqli_errno($connection)){
        $_SESSION['delete-user'] = "Couldnt delete '{$user['firstname']}' '{$user['lastname']}'";
    } else{
        $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();