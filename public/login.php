<?php include_once '../config.php'; ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../templates/_head.php';
		?>
	</head>
	<body>
		
		<?php include_once '../templates/_nav.php'; ?>
		<div class="row">
			<div class="col-md-4 offset-4">
                <div class="jumbotron">
                <form method="post" action="<?php echo $route; ?>auth.php">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" value="jurica" />
                    
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value="j" />
                    
                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Submit" />
				</form>
                    
                <?php if(isset($_GET["oops"])) {
                    echo "Wrong name or password!";
                } 
                
                if(isset($_GET["success"])) {
                    echo "Registered! Try to log in.";
                }
                
                if(isset($_GET["stop"])) {
                    echo "Please, log in first!";
                }
                
                ?>
						
				</div>
			</div>
		</div>
		
		<?php
		include_once '../templates/_scripts.php';
		?>
	</body>
</html>