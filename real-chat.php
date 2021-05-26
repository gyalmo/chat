<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $id_out = mysqli_real_escape_string($conn, $_POST['id_out']);
        $id_in = mysqli_real_escape_string($conn, $_POST['id_in']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO msgs (in_msg_id, out_msg_id, msg)
                                VALUES ({$id_in}, {$id_out}, '{$message}')") or die();
        }
        
    }else {
        header("../login.php");
    }
?>