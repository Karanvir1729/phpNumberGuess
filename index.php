
<?php 
	session_save_path("sess");
	session_start(); // must be first thing in the php file
	
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Welcome to guessGame</h1>
    <p>Guess the secret number between 1 and 100 (inclusive)...</p>
    <form action= "index.php">
        <label for="guess">Your guess:</label>
        <input type="text" id="guess" name="guess">
        <input type="submit" value="check my guess">
    </form>
</body>
</html>
<?php
    if (!isset($_SESSION['guess_history'])) {
	    $_SESSION['guess_history'] = array();
	}

    if (!isset($_SESSION['random_number'])) {
        // Generate a random number if not already set and store it in the session
        $_SESSION['random_number'] = rand(1, 100);        
    }

    // Display the user's guess if it's submitted
    if(isset($_REQUEST['guess'])) {
        
        $answer = $_REQUEST['guess'];
    
        if (is_numeric($answer)) {
	        
	        if ($answer < $_SESSION['random_number']) {
                $_SESSION['guess_history'][] = "guess $answer was too low<br>";
	        } elseif ($answer > $_SESSION['random_number']) {
	            $_SESSION['guess_history'][] = "guess $answer was too high<br>";
	        } else {
                $_SESSION['guess_history'][] = "guess $answer was correct<br>enter a new guess to start again";

                session_destroy();

	        }
	    }
    }

   

    ?>


<?php 
        // Display the guess history
        foreach ($_SESSION['guess_history'] as $guess) {
            echo $guess;
        }
    ?>
