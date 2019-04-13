<?php require_once('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fullstacker</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<h2 class="header">List Tabs</h2>  
			<?php if (isset($_SESSION['msg'])): ?>
				<div class="msg">
					<?php echo $_SESSION['msg'];
					unset($_SESSION['msg']);
					 ?>
				</div>
			<?php endif ?>
			<?php if(isset($res_tabs) && $res_tabs!="") { 
				if(mysqli_num_rows($res_tabs) >= 1) {?>
				  <table class="table table-bordered">
					<thead>
					  <tr>
						<th>Tabs Name</th>
						<th>Edit</th>
						<th>Delete</th>
					  </tr>
					</thead>
					<tbody>
					<?php while ($row=mysqli_fetch_array($res_tabs)) { ?>
					  <tr>
						<td><?php echo $row['tab_name']; ?></td>
						<td><a class="btn btn-success" href="edit.php?edit_tab=<?php echo $row['tab_id']; ?>">EDIT</a></td>
						<td><a class="btn btn-danger" href="server.php?del_tab=<?php echo $row['tab_id']; ?>">DELETE</a></td>
					  </tr>
					<?php } ?>
					</tbody>
				  </table>
				<?php } 
			} ?>
			<button class="btn btn-default"><a href="index.php">Back</a></button>
		</div>
	</body>
</html>