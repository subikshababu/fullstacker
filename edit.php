<?php require_once('server.php'); 
if (isset($_GET['edit_tab'])) {
	$tab_id=$_GET['edit_tab'];
	$rec=mysqli_query($db,"SELECT tab_id, tab_name, tab_icon, tab_icon_path, no_of_slider FROM tabs WHERE tab_id=$tab_id ORDER BY tab_id ASC");
	$record=mysqli_fetch_array($rec);
	
	$res=mysqli_query($db,"SELECT slider_id, slider_title, slider_description, slider_img, slider_img_path FROM sliders WHERE tab_id=$tab_id ORDER BY slider_id ASC");
}
?>
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
		  <form class="form-horizontal" method="POST" action="edit.php?edit_tab=<?php echo $record['tab_id']; ?>" enctype="multipart/form-data" onsubmit="return validatorupdate(this);">
			<div class="form-group">
				<input type="hidden" name="tab_id" value="<?php echo $record['tab_id']; ?>">
				<label>Tab Name:</label>
				<input type="text" class="form-control" id="name" autocomplete="off" placeholder="Tab Name" value="<?php echo $record['tab_name']; ?>" name="name" />
			</div>
			
			<div class="form-group">
				<label>Tab Icon:</label>
				<input type="file" class="form-control" accept=".svg" id="icon" name="icon" value="<?php echo $record['tab_icon']; ?>" onchange="read_URL(this);"/>
				<div id="dbpreview0">
					<img src="<?php echo $record['tab_icon_path']; ?>" width="100" height="100" /><br><br>
				</div>
				<div id="preview0">							
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="count_res" id="count_res" value="<?php echo mysqli_num_rows($res); ?>">
				<input type="hidden" name="number" id="number" value="<?php echo $record['no_of_slider']; ?>">
				  <?php $k=0;
					while ($row=mysqli_fetch_array($res)) { ?>
						<input type="hidden" name="slider_id_<?php echo $k; ?>" value="<?php echo $row['slider_id']; ?>">
						<label>Slider No. <?php echo $k; ?>:</label>
						<input type="text" class="form-control" id="title_<?php echo $k; ?>" autocomplete="off" placeholder="Title" name="title_<?php echo $k; ?>"value="<?php echo $row['slider_title']; ?>" />
						<textarea class="form-control" id="description_<?php echo $k; ?>" name="description_<?php echo $k; ?>" placeholder="Description" rows="3"><?php echo $row['slider_description']; ?></textarea>
						<input type="file" class="form-control" accept=".jpg" id="sliderimg_<?php echo $k; ?>" name="sliderimg_<?php echo $k; ?>" onchange="readURL(this,this.id);"/><br>
						<div id="dbpreview_<?php echo $k; ?>">
							<img src="<?php echo $row['slider_img_path']; ?>" width="100" height="100" /><br><br>
						</div>
						<div id="preview_<?php echo $k; ?>">							
						</div>
						<a class="btn btn-danger" href="server.php?del_slider=<?php echo $row['slider_id']; ?>&edit_tabid=<?php echo $record['tab_id']; ?>">DELETE</a><br><br><br><br>
						
				  <?php $k++;
				  } ?>
			</div>
			<div class="form-group">
				<label>Add More Slider</label>
				<input class="form-control" type="number" min="1" max="10" name="addnum" id="addnum" />&nbsp;<span id="errmsg"></span>
			</div>
			<div class="form-group">
				<div id="slidersarea">
				</div>
			</div>
			<button type="submit" name="updatetab" class="btn btn-default">Update</button>
			<button class="btn btn-default"><a href="list.php">Back</a></button>
		  </form>
		</div>
	</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
		$("#addnum").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				$("#errmsg").html("Digits Only").show().fadeOut("slow");
				return false;
			}
		});
	});
	
	$("#addnum").change(function () {
		$("#slidersarea").empty();
		var count = $('#count_res').val();
		var numInputs = $(this).val();
		var total = +numInputs + +count;
		for (var i = count; i < total; i++)
			$("#slidersarea").append('<label>Slider No. '+i+':</label><input type="text" class="form-control" id="title_'+i+'" autocomplete="off" placeholder="Title" name="title_'+i+'" /><textarea class="form-control" id="description_'+i+'" name="description_'+i+'" placeholder="Description" rows="3"></textarea><input type="file" class="form-control" accept=".jpg" id="sliderimg_'+i+'" name="sliderimg_'+i+'" /><br>');
	});

	function validatorupdate(form)
	{
		if (form.name.value=="") {
			alert("Please Enter Tab Name!");
			form.name.focus();
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
				
				if (title=="") {
					alert("Please Enter Slider Title!");
					return false;
				}
				if (description=="") {
					alert("Please Enter Slider Description!");
					return false;
				}
			}
		}
		return true;
	}
	
	function readURL(input,id) {
		var split_id = id.split("_");
		var dbprew="#dbpreview_"+split_id[1];
		var prew="#preview_"+split_id[1];
		var prewres0="previewres_"+split_id[1];
		var prewres="#previewres_"+split_id[1];
		$(dbprew).empty();
		$(prew).empty();
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			$(prew).append('<img id="'+prewres0+'" src="#" width="100" height="100" /><br><br>');
			
			reader.onload = function (e) {
				$(prewres).attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
    }
	
	function read_URL(input) {
		$("#dbpreview0").empty();
		$("#preview0").empty();
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			$("#preview0").append('<img id="previewres0" src="#" width="100" height="100" /><br><br>');
			
			reader.onload = function (e) {
				$('#previewres0').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
    }
</script>