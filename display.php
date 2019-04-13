<?php require_once('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Easy Responsive Tabs to Accordion Demos</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="stylesheet" href="easy-responsive-tabs.css">
		<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style>
		.demo{
			width: 980px;
			margin-left: 150px;
			margin-right: 150px;
			margin-top: 50px;
			margin-bottom: 50px;
			width:980px;
			}
		.demo h1{margin:0 0 25px;}
		.demo h3{margin:10px 0;}
		pre{background-color:#FFF;}
		@media only screen and (max-width:780px){
		.demo{margin:5%;width:90%;}
		.how-use{display:none;float:left;width:300px;}
		}
		#tabInfo{display:none;}
		
		</style>
	</head>
	<body>
		<h2>DelphianLogic in Action</h2>
		<h6>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo</h6>
		<div class="demo">
		<?php if(count($arr_tab)>0 && count($arrdisplay)>0) { ?>
			<div id="verticalTab">
				<ul class="resp-tabs-list resp-tabs-container">
				<?php foreach ($arr_tab as $tab_id => $data){ ?>
					<li id="tab_part" value="<?php echo $tab_id; ?>" onClick="getcarousel(this.value);"><img src="<?php echo $data['tab_icon_path']; ?>" width="100" height="100" /><p class="tabs"><?php echo $data['tab_name']; ?></p></li>
				<?php } ?>
				</ul>
				<div class="resp-tabs-container" id="slider_part">
					<?php foreach ($arrdisplay as $tabid => $data0){ ?>
					<div>
						<div id="myCarousel" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<?php for($n=1;$n<count($data0);$n++) {  ?>
							  <li data-target="#myCarousel" data-slide-to="<?php echo $n; ?>"></li>
							<?php } ?>
							</ol>
							
							<div class="carousel-inner">
							<div class="item active" value="<?php echo $tabid; ?>_0">
								<p class="slider_title"><?php echo $data0[0]['slider_title']; ?></p>
								<p class="slider_description"><?php echo $data0[0]['slider_description']; ?></p>
								<p class="learnmore">Learn More<img src="arrow-right.svg" width="100" height="100" /></p>
							  </div>
							<?php for($nn=1;$nn<count($data0);$nn++) {  ?>
							  <div class="item" value="<?php echo $tabid."_".$nn; ?>">
								<p class="slider_title"><?php echo $data0[$nn]['slider_title']; ?></p>
								<p class="slider_description"><?php echo $data0[$nn]['slider_description']; ?></p>
								<p class="learnmore">Learn More<img src="arrow-right.svg" width="100" height="100" /></p>
							  </div>
							<?php } ?>
							</div>
							<a class="left carousel-control" href="#myCarousel" data-slide="prev">
							  <span class="glyphicon glyphicon-chevron-left"></span>
							  <span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">
							  <span class="glyphicon glyphicon-chevron-right"></span>
							  <span class="sr-only">Next</span>
							</a>
							
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="resp-tabs-container imagecontainer" id="slider_img">
					<img src="<?php echo $data0[0]['slider_img_path']; ?>" class="sliderimg" width="100" height="100" />
				</div>
			</div>
			<?php } ?>
			<br />
			<div style="height: 30px; clear: both"></div>
		</div>
	</body>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="easy-responsive-tabs.js"></script>
	<script>
	$(document).ready(function () {
	$('#verticalTab').easyResponsiveTabs({
	type: 'vertical',
	width: 'auto',
	fit: true
	});
	
	});
	</script>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-36251023-1']);
	  _gaq.push(['_setDomainName', 'jqueryscript.net']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	  function getcarousel(val) {
			$.ajax({
				type: "POST",
				url: "getcarousel.php",
				data:'tab_id='+val,

			   success: function(data){
				$("#slider_part").html(data);
			  }
			});
		  }
	</script>
</html>