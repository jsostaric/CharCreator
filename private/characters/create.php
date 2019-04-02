<?php include_once '../../config.php'; checkLogin(); ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../templates/_head.php'; ?>
	</head>
	<body>
		
		<?php include_once '../../templates/_nav.php'; ?>
		<div class="col-md-8 offset-2">
			<div class="jumbotron">
				<h1 class="display-4">Create new character</h1>
				
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
						<tr>
						<td>Bark</th>
						<td>Half-Orc</td>
						<td>Ranger</td>
						<td>View/Delete</td>
						</tr>
						<tr>
						<td>2</th>
						<td>Jacob</td>
						<td>Thornton</td>
						<td>@fat</td>
						</tr>
						<tr>
						<td>3</th>
						<td>Larry</td>
						<td>the Bird</td>
						<td>@twitter</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php include_once '../../templates/_scripts.php'; ?>
	</body>
</html>