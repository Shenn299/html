<?php
   session_start();  

   //On r�cup�re qui seront les �xp�diteurs et les d�stinataires
	$from = $_GET["message_sender_id"];
	$to = $_GET["message_receiver_id"];
   
?>

<!DOCTYPE HTML> 
 
<html>

   <head>
      
      <link href="./css/style.css" rel="stylesheet" media="all" type="text/css">

   </head>

   <body>  

      <h1>STI Administrator page</h1>
	  
	  <h2>Answer</h2>
	  
	  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
         
         <div class="centre">
            <input type="text" name="message" id="message" placeholder="Type your message here"/>
            <br>
         </div>
         
         <br>
         
         <div class="container">
            <input type="submit" class="btn" name="send" value="send">  
         </div>
         
      </form>
	
	<?php
	
		$answer = $_POST['message'];
		echo "[debug] from: ". $from . "  to: ". $to;
		if(!empty($answer)){echo "[debug] answer: ". $answer}
	?>
      

   </body>
</html>
