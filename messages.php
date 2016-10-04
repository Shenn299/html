<?php
   session_start();
   include("databaseConnection.php");
?>

<!DOCTYPE HTML> 
 
<html>

	<head>

		<?php
			include("includes/header.html");
		?>
      
	</head>
	
	<body>  

		<h1>STI Messenger - Boîte de réception</h1>

		<p> 
			<?php
            // Check if user session exist
            if (isset($_SESSION['userId'])) {
				   echo "Welcome ";
				   echo $_SESSION['userName'];
				   echo " !</br>";
				}
				else {
				   echo "Sorry, you must log in to access this page.";
				}
			?>
		</p>
		
		<?php
			include("includes/menu.php");
		?>
		
		<?php
			// take user messages
		$userId = $_SESSION['userId'];
		//print_r($_SESSION);
		$sql = "SELECT * FROM messages WHERE message_receiver_id = $userId ORDER BY message_time DESC";
		//echo $sql;
               global $file_db;
               $result =  $file_db->query($sql);
		//print_r($result);
		?>

		<table class="table table-striped">
			<tr>
				<th>Date</th>
				<th>Sender</th>
				<th>Subject</th>
				<th>Reply</th>
				<th>Delete</th>
				<th>Open</th>
			</tr>
			
		
			<?php
				foreach($result as $row){ 
				//echo "Row = ";
				//print_r($row);
			?>
			<?php
				// Get the sender's user_name for each message
				$sql2 = 'SELECT user_name FROM users WHERE user_id = ' . $row['message_sender_id'];
				global $file_db;
				$name =  $file_db->query($sql2);
				$name->setFetchMode(PDO::FETCH_ASSOC);
				$name = $name->fetch();

						
			?>

			<tr>
					<?php echo "<td>" . $row['message_time'] . "</td>"; ?>
					<?php echo "<td>" . $name['user_name'] . "</td>"; ?>
					<?php echo "<td>" . $row['message_subject'] . "</td>"; ?>
					<?php echo "<td><a class=\"btn btn-primary\" href=\"answer.php?receiver=" . $row['message_sender_id'] . "\"> Reply </a></td>"; ?>
					<?php echo "<td><a class=\"btn btn-primary\" href=\"deleteMessage.php?id=" . $row['message_id'] . "\"> Delete </a></td>"; ?>
					<?php echo "<td><button data-toggle=\"collapse\" data-target=\"#message" . $row['message_id'] . "\"> Display / Hide </button></td>";?>
					
					
			</tr>
			
			
			
			<?php 
				};
				echo "</table>";
				$result =  $file_db->query($sql);
				foreach($result as $row){ 
			?>
				<div class="container">
					
					<?php echo "<div id=\"message" . $row['message_id'] . "\" class=\"collapse\">" ;?>
						<?php echo "<table class=\"table table-bordered\"><tr class=\"info\"><td>" . $row['message_message'] . "</td></tr></table>";  ?>
					<?php echo "</div>" ?>
				</div>
				<?php
					};

				?>
		
		
		
	</body>

</html>