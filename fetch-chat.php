<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $id_out = mysqli_real_escape_string($conn, $_POST['id_out']);
        $id_in = mysqli_real_escape_string($conn, $_POST['id_in']);
        $output = "";

        $sql = "SELECT * FROM msgs 
                LEFT JOIN users ON users.unique_id = msgs.out_msg_id
                WHERE (out_msg_id = {$id_out} AND in_msg_id = {$id_in})
                OR (out_msg_id = {$id_in} AND in_msg_id = {$id_out}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['out_msg_id'] === $id_out){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['img'] . '" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
            echo $output;
        }
    }else {
        header("../login.php");
    }
?>