<?php require_once('connect.php');  

if(!empty($_POST["tab_id"])) {
	$tab_id=$_POST["tab_id"];
	
	$arrdisplay=array();
	$display=mysqli_query($db,"SELECT * FROM sliders WHERE tab_id=$tab_id ORDER BY slider_id ASC");
	if(isset($display) && $display!="") { 
		if(mysqli_num_rows($display) >= 1) {
			while ($roww=mysqli_fetch_array($display)) {				
				$arrdisplay[]=array(
				'slider_title'=>$roww['slider_title'],
				'slider_description'=>$roww['slider_description']
				);
			}
		}
	}

		$data='<div>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
						
						for($n=1;$n<count($arrdisplay);$n++) { 
						  $data.='<li data-target="#myCarousel" data-slide-to="'.$n.'"></li>';
						}
					$data.='</ol>
					<div class="carousel-inner">
						<div class="item active">
							<p class="slider_title">'.$arrdisplay[0]['slider_title'].'</p>
							<p class="slider_description">'.$arrdisplay[0]['slider_description'].'</p>
							<p class="learnmore">Learn More<img src="arrow-right.svg" width="100" height="100" /></p>
						  </div>';
						for($nn=1;$nn<count($arrdisplay);$nn++) { 
						  $data.='<div class="item">
							<p class="slider_title">'.$arrdisplay[$nn]['slider_title'].'</p>
							<p class="slider_description">'.$arrdisplay[$nn]['slider_description'].'</p>
							<p class="learnmore">Learn More<img src="arrow-right.svg" width="100" height="100" /></p>
						  </div>';
						 }
					$data.='</div>';
					$data.='<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					  <span class="glyphicon glyphicon-chevron-left"></span>
					  <span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
					  <span class="glyphicon glyphicon-chevron-right"></span>
					  <span class="sr-only">Next</span>
					</a>
			</div>
		</div>';
					
}
echo $data;
?>