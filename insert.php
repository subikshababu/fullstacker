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
		  <h2 class="header">Add Tabs</h2>
			<?php if (isset($_SESSION['msg'])): ?>
				<div class="msg">
					<?php echo $_SESSION['msg'];
					unset($_SESSION['msg']);
					 ?>
				</div>
			<?php endif ?>
		  <form class="form-horizontal" method="POST" action="insert.php" enctype="multipart/form-data" onsubmit="return validator(this);">
			<div class="form-group">
				<label>Tab Name:</label>
				<input type="text" class="form-control" id="name" autocomplete="off" placeholder="Tab Name" name="name" />
			</div>
			
			<div class="form-group">
				<label>Tab Icon:</label>
				<input type="file" class="form-control" accept=".svg" id="icon" name="icon" />
			</div>
			<div class="form-group">
				<label>Number of Slider</label>
				<input class="form-control" type="number" min="1" max="10" name="number" id="number" />&nbsp;<span id="errmsg"></span>
			</div>
			<div class="form-group">
			  <div id="slidersarea"></div>
			</div>
			<button type="submit" name="inserttab" class="btn btn-default">Submit</button>
			<button class="btn btn-default"><a href="index.php">Back</a></button>
		  </form>
		</div>
	</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
		$("#number").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				$("#errmsg").html("Digits Only").show().fadeOut("slow");
				return false;
			}
		});
	});
	
	$("#number").change(function () {
		$("#slidersarea").empty();
		var numInputs = $(this).val();
		for (var i = 0; i < numInputs; i++)
			$("#slidersarea").append('<label>Slider No. '+i+':</label><input type="text" class="form-control" id="title_'+i+'" autocomplete="off" placeholder="Title" name="title_'+i+'" /><textarea class="form-control" id="description_'+i+'" name="description_'+i+'" placeholder="Description" rows="3"></textarea><input type="file" class="form-control" accept=".jpg" id="sliderimg_'+i+'" name="sliderimg_'+i+'" /><br>');
	});

	function validator(form)
	{
		if (form.name.value=="") {
			alert("Please Enter Tab Name!");
			form.name.focus();
			return false;
		}

		if (form.icon.value=="") {
			alert("Please choose icon for the tab!");
			form.icon.focus();
			return false;
		}
		
		if (form.number.value=="") {
			alert("Please choose number of sliders!");
			form.number.focus();
			return false;
		}
		
		if (form.number.value!="") {
			var num = form.number.value;
			for (var j = 0; j < num; j++) {
				var title=document.getElementById('title_'+j).value;
				var description=document.getElementById('description_'+j).value;
				var sliderimg=document.getElementById('sliderimg_'+j).value;
				
				if (title=="") {
					alert("Please Enter Slider Title!");
					return false;
				}
				if (description=="") {
					alert("Please Enter Slider Description!");
					return false;
				}
				if (sliderimg=="") {
					alert("Please choose image for the slider!");
					return false;
				}
			}
		}
		return true;
	}
</script>