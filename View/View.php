<?php


class View implements ToUser{

	public function __construct(){
		/* we start buffering */
		ob_start();
	}
	
	public function displayContact($contact){
		echo "<li>" . $contact->toString() . "</li>";
	}
	
	public function displayErrorMessage($message){
		echo "<li class='error'>$message</li>";
	}
	
	public function displaySuccessMessage($message){
		echo "<li class='success'>$message</li>";
	}

	public function render(){

		$content = ob_get_clean();

		?>

		<!DOCTYPE html>
		    <head>
		        <meta charset="UTF-8" />
		        <title>Baladier Julien - Challenge LOGICnow</title>
		        <meta name="description" content="Challenge internship LOGICnow" />
		        <meta name="keywords" content="LOGICnow, internship" />
		        <meta name="author" content="Julien Baladier" />
		        <link href="https://az533283.vo.msecnd.net/prodibi-web/2b069e4e-521b-4378-9326-33e7892923f2.png" rel="icon" type="image/png">
		        <link rel="stylesheet" type="text/css" href="css/main.css" />
		    </head>

				<section id="contact_operations">
					<form method="post" action="index.php" enctype="multipart/form-data">
						<input type="text" placeholder="ID" name="id"/><br/>
						<input type="text" placeholder="FIRST NAME" name="first_name"/><br/>
						<input type="text" placeholder="LAST NAME" name="last_name"/><br/>
						<button name="action" type="submit" value="add">ADD →</button>
						<button name="action" type="submit" value="delete">DELETE →</button>
					</form>
				</section
				><section id="contact">
					<ul>
		    			<?php echo $content; ?>
		    		</ul>
		    	</section>

		    </body>
		</html>

		<?php

	}


}


?>