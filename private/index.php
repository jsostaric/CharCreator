<?php include_once '../config.php'; checkLogin(); ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../templates/_head.php'; ?>
	</head>
	<body>
		
		<?php include_once '../templates/_nav.php'; ?>
		<div class="col-md-8 offset-2">
			<div class="jumbotron">
				<h1 class="display-4">Characters</h1>
				
				<a href="<?php echo $route; ?>private/characters/create.php" class="btn btn-primary">Add New Character</a>
				
				<table class="table table-striped table-dark">
					<thead>
						<tr>						
						<th scope="col">Name</th>
						<th scope="col">Race</th>
						<th scope="col">Class</th>
						<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query="select a.id, a.users, a.name, a.races, b.name as race, d.name as class  from characters a
						inner join races b on a.races = b.id
						inner join character_klass c on a.id = c.characters
						inner join klasses d on d.id = c.klasses where a.users = :id";

						$stmt = $conn->prepare($query);
						$stmt->execute(array("id" => $_SESSION["session"]->id));
						$result = $stmt->fetchAll(PDO::FETCH_OBJ);

						foreach($result as $row):
						?>
						<tr>
						<td><?php echo $row->name; ?></th>				
						<td><?php echo $row->race; ?></td>						
						<td><?php echo $row->class; ?></td>

						<td><a href="<?php echo $route?>private/characters/show.php?id=<?php echo $row->id; ?>" >View</a>/
						<a href="<?php echo $route?>private/characters/delete.php?id=" >Delete</a>
						</td>
						</tr>
						
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php include_once '../templates/_scripts.php'; ?>
	</body>
</html>