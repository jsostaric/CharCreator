<?php include_once 'config.php'; ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once 'templates/_head.php'; ?>
	</head>
	<body>
		
		<?php include_once 'templates/_nav.php'; ?>
		
		<div class="row">
			<div class="col-md-10 offset-2">
				<h1>PATHFINDER Character Creator</h1>
				<p>Characters and Adventures at your hand.</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4 offset-4">
                <div class="jumbotron">
                    <a href="<?php $route; ?>public/login.php" class="btn btn-success btn-block">Log In</a>
                    <p style="text-align: center;">or</p>
                    <a href="<?php $route; ?>public/register.php" class="btn btn-primary btn-block">Register</a>
                    <?php
                    if(isset($_GET["logout"])) {
                            echo "You successfully logged out!";
                        }  
                        ?>
							
						
				</div>
			</div>
		</div>
		
		<?php include_once 'templates/_scripts.php'; ?>
	</body>
</html>