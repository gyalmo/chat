<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }  
?>

<body>
    <div class="main">
        <section class="chat-area">
            <header>
              <?php 
                  include_once "php/config.php";
                  $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                  if(mysqli_num_rows($sql) > 0){
                      $row = mysqli_fetch_assoc($sql);
                  }
              ?>
              <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                  <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                  <p><?php echo $row['status'] ?></p>
                </div>
            </header>
            <div class="chat-box">
              
            </div>
            <form action="#" class="typing-area" autocomplete="off">
              <input type="text" name="id_out" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
              <input type="text" name="id_in" value="<?php echo $user_id; ?>" hidden>
              <input type="text" name="message" class="inputMsg" placeholder="Type a message here..">
              <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>

</body>
</html>
