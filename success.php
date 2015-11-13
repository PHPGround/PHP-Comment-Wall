<?php 
session_start();
require('new_connection.php');
if(!isset($_SESSION['session_id']))
{	
	$_SESSION['error'][] = "Please log in.";
	header("location: index.php");
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Wall</title>
	<meta name="description" value="index">
	<link rel="stylesheet" type="text/css" href="success_css.css">
</head>
<body>

	<div id="container">
		<div id="header">
			<h2>CodingDojo Wall<h2>
			<?php 
			$user = fetch_record("SELECT * FROM users WHERE id = {$_SESSION['session_id']}");
			// var_dump($user);

			if($_GET['new'] == "false")
			{
				echo '<p id="top-p"> Welcome back, ';
			}
			elseif($_GET['new'] == "true")
			{
				echo '<p id="top-p"> Thanks for registering, ';
			}
			echo $user['first_name'] . "!  <a href='process.php'>Log Off</a></p>";

			 ?>
		</div>
		<div id="message-box">
			<p>Post a message</p>
			<form action="process.php" method="post">
				<input type="hidden" name="action" value="msg">
				<input type="hidden" name="userid" value= <?= '"' . $user['id'] . '"'?>>
				<div id="txt">
					<textarea name="message"></textarea>
				</div>
				<input id="message-post" type="submit" value="Post a message">
			</form>
		</div>
		<?php 


			$messages = fetch_all("SELECT * FROM thewall.messages ORDER BY updated_at DESC");
			// var_dump($messages);
			// die();

			foreach ($messages as $message) 
			{
				//re-formats date
				$phpdate = strtotime($message['created_at']);
				$date = date('F j, Y h:i:s', $phpdate); 
				//creates message divs
				$name = fetch_record("SELECT * FROM users WHERE id = '{$message['user_id']}'");
				echo "<h4>" . $name['first_name'] . " " . $name['last_name'] . " at " . $date . "<div class='mb'><p class='messages'>" . $message['message'] . "</p></div>";

				$comments = fetch_all("SELECT * FROM thewall.comments WHERE message_id = {$message['id']} ORDER BY updated_at DESC");

				foreach ($comments as $comment) 
				{
					$name = fetch_record("SELECT * FROM users WHERE id = '{$comment['user_id']}'");
					$phpdate = strtotime($comment['created_at']);
					$date = date('F j, Y h:i:s', $phpdate); 
					echo "<h5>" . $name['first_name'] . " " . $name['last_name'] . " - " . $date . "</h5><p class='comments'>" . $comment['comment'] . "</p>";
				}
				echo "

						<div class='comment-box'>
							<p>Post a comment</p>
							<form action='process.php' method='post'>
							<input type='hidden' name='action' value='cmt'>
							<input type='hidden' name='userid' value= "  . $user['id'] . ">
							<input type='hidden' name='messageid' value = " . $message['id'] . ">
							<div class='comt'>
								<textarea rows='10' cols='100' name='comment'></textarea>
							</div>
							<input class='comment-post' type='submit' value='Post a comment'>
							</form>
						</div>
					";	
			}
		?>
		<div><audio autoplay="true" loop="true" src="thewall.mp3"></div>
	</div>
</body>
</html>