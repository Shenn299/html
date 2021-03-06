<?php
   /*
     ---------------------------------------------------------------------------
     Projet      : STI Messenger
     Fichier     : changeUserPassword.php
     Auteurs     : Thibault Schowing, Sébastien Henneberger
     Date        : 12.10.2016
     Description : Page permettant à un admin de changer le mot de passe d'un
                   utilisateur.
     ---------------------------------------------------------------------------
    */
?>

<?php
   session_start();
   include("checkAdminSession.php");
   require('password.php');
   include("databaseConnection.php");
   // User that the admin wants to change password
   $userId = $_GET['userId'];
   $userName = $_GET['userName'];
?>

<!DOCTYPE HTML> 

<html>

   <head>

      <meta charset="utf-8" />

      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <title>Change password</title>

   </head>

   <body>  
       <?php include("includes/menu.php"); ?>

      <h1>STI Messenger</h1>

      <h2><?php echo $_SESSION['userName']; ?>, you can change <?php echo $userName; ?>'s password here !</h2>

      <form method="post">  

         <div class="container">
            <input type="password" name="newPassword" id="newPassword" placeholder="New password"/>
            <br>
            <input type="password" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm new password"/>
         </div>

         <br>

         <div class="container">
            <input type="submit" class="btn" name="changePasswordBtn" value="Change the password">  
         </div>

      </form>

      <?php
         $changePasswordBtn = isset($_POST['changePasswordBtn']) ? $_POST['changePasswordBtn'] : NULL;

         // If changePasswordBtn was clicked 
         if ($changePasswordBtn) {
            $newPassword = $confirmNewPassword = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $newPassword = $_POST["newPassword"];
               $confirmNewPassword = $_POST["confirmNewPassword"];

               if ($newPassword != "") {

                  // Check if confirmation new password is ok
                  if ($newPassword == $confirmNewPassword) {

                     // Update password in DB
                     $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                     $sql = "UPDATE users SET user_pwd_hash = '$newPasswordHash' WHERE user_id = '$userId'";
                     $result = $file_db->query($sql);
                     echo "<h2>Password changed !</h2>";
                  } else {
                     echo "<h2>Confirmation password doesn't match new password !</h2>";
                  }
               } else {
                  echo "<h2>Your new password must contain at least one caracter !</h2>";
               }
            }
         }
      ?>     
      <?php include("includes/footer.php"); ?>
   </body>
</html>
