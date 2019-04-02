<?php
include_once '../config.php'; 

$err = array();



if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["email"])) {
	if (trim($_POST["name"]) === "") {
		$err["name"] = "Please enter a name!";
	}

	if ($_POST["password"] === "") {
		$err["password"] = "Please enter a password!";
	}

	if (trim($_POST["email"]) === "") {
		$err["email"] = "Please enter an email address!";
	}
	
	if (count($err) == 0) {
		
		try {
			$stmt = $conn->prepare("insert into users(name, password, email) values(:name, md5(:password), :email)");
			$result = $stmt->execute($_POST);
			header("location: " . $route . "index.php");
			
		} catch(PDOException $e) {
			echo $e -> getMessage();
			var_dump($conn->errorInfo());

		}
	}
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <?php include_once '../templates/_head.php'; ?>
</head>

<body>

    <?php include_once '../templates/_nav.php';	?>

    <div class="row">
        <div class="col-md-4 offset-4">
            <div class="row">
                <div class="jumbotron">
                    <div class="container">
                        <?php if(isset($err["username"])) {
                            echo $err["username"] . "<br>";
                        } 
                        
                        if(isset($err["password"])) {
                            echo $err["password"]. "<br>";
                        } 
                        
                        if(isset($err["email"])) {
                            echo $err["email"]. "<br>";
                        } 
                        ?>
                        
                        <form method="post">
                            <label for="username">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>" />

                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" />

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="" />

                            <input class="button expanded" type="submit" value="Register" />
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once '../templates/_scripts.php'; ?>
</body>
</html>