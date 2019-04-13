<?php  
session_start();
require_once('connect.php');

//insert
if(isset($_POST['inserttab'])) {
	$name=mysqli_real_escape_string($db,$_POST['name']);
	$icon=$_FILES['icon']['name'];
	$number=mysqli_real_escape_string($db,$_POST['number']);
	
	if (isset($_FILES['icon']) && $_FILES['icon']['size'] > 0) {
		$word = array_merge(range('a', 'z'), range('A', 'Z'));
		shuffle($word);
		$random=substr(implode($word), 0, 10);
		$split=explode(".",$icon);
		$icon_name=$split[0]."_".$random.".".$split[1];
		$icon_path="./icons/".$icon_name;
		move_uploaded_file($_FILES['icon']['tmp_name'],$icon_path);
	}
	
	if(!empty($name) && !empty($number) && isset($_FILES['icon']))
	{
		$sql="insert into tabs(tab_name,tab_icon,tab_icon_path,no_of_slider) 
			values('$name','$icon_name','$icon_path','$number')";
		mysqli_query($db, $sql);
		$current_id=mysqli_insert_id($db);
	}else{
		$_SESSION['msg']="Please Fill Required Fields!!!";
	}
	
	$insert="";
	$insertarr=array();
	for ($x = 0; $x < $number; $x++) {
		$title0='title_'.$x;
		$description0='description_'.$x;
		$sliderimg0='sliderimg_'.$x;
		$title=mysqli_real_escape_string($db,$_POST[$title0]);
		$description=mysqli_real_escape_string($db,$_POST[$description0]);
		$sliderimg=$_FILES[$sliderimg0]['name'];
		
		$word0 = array_merge(range('a', 'z'), range('A', 'Z'));
		shuffle($word0);
		$random0=substr(implode($word0), 0, 10);
		$split0=explode(".",$sliderimg);
		$img_name=$split0[0]."_".$random0.".".$split0[1];
		$img_path="./img/".$img_name;
		move_uploaded_file($_FILES[$sliderimg0]['tmp_name'],$img_path);
		
		$insertarr[]= "('$current_id','$title','$description','$img_name','$img_path')";
	}
	$insert = implode(",", $insertarr);
	if($insert!="")
	{
		$sql="insert into sliders(tab_id,slider_title,slider_description,slider_img,slider_img_path) 
			values$insert";
		mysqli_query($db, $sql);
		$_SESSION['msg']="Record saved Successfully!!!";
	}else{
		$_SESSION['msg']="Please Fill Required Fields!!!";
	}
	
	header('location: insert.php');
	exit();

}

//listing
$res_tabs=mysqli_query($db,"SELECT * FROM tabs ORDER BY tab_id ASC");

$arrdisplay=array();
$arr_tab=array();
$display=mysqli_query($db,"SELECT * FROM tabs inner join sliders on tabs.tab_id = sliders.tab_id ORDER BY tabs.tab_id,sliders.slider_id ASC");
if(isset($display) && $display!="") { 
	if(mysqli_num_rows($display) >= 1) {
		while ($roww=mysqli_fetch_array($display)) {
			$arr_tab[$roww['tab_id']]=array(
			'tab_name'=>$roww['tab_name'],
			'tab_icon'=>$roww['tab_icon'],
			'tab_icon_path'=>$roww['tab_icon_path']
			);
			
			$arrdisplay[$roww['tab_id']][]=array(
			'slider_title'=>$roww['slider_title'],
			'slider_description'=>$roww['slider_description'],
			'slider_img'=>$roww['slider_img'],
			'slider_img_path'=>$roww['slider_img_path']
			);
		}
	}
}
/* echo "<pre>";
print_r($arrdisplay);
echo "</pre>"; */

//delete tab
if (isset($_GET['del_tab'])) {
	$id=$_GET['del_tab'];

	mysqli_query($db,"DELETE FROM tabs WHERE tab_id= $id");
	mysqli_query($db,"DELETE FROM sliders WHERE tab_id= $id");
	
	$_SESSION['msg']="Record Deleted Successfully!!!";
	header('Location: list.php');
	exit();
}

//delete slider
if (isset($_GET['del_slider'])) {
	$id=$_GET['del_slider'];
	$edit_tabid=$_GET['edit_tabid'];
	
	mysqli_query($db,"DELETE FROM sliders WHERE slider_id= $id");
	header('Location: edit.php?edit_tab='.$edit_tabid);
}

//update
if (isset($_POST['updatetab'])) {
	$tab_id=$_POST['tab_id'];
	$name=mysqli_real_escape_string($db,$_POST['name']);
	$num=$_POST['number'];
	$addnum=mysqli_real_escape_string($db,$_POST['addnum']);
	
	$tt_slider_qry=mysqli_query($db,"SELECT count(slider_id) as count FROM sliders WHERE tab_id=$tab_id");
	$tt_slider_res=mysqli_fetch_array($tt_slider_qry);
	$tt_slider=$tt_slider_res['count']+(int)$addnum;
	if($tt_slider=="" || $tt_slider==0) {
		$_SESSION['msg']="Please Select Sliders!!!";
		header('Location: edit.php?edit_tab='.$tab_id);
		exit();		
	}
	
	if($addnum!="")
	{
		$sql_update="UPDATE tabs SET no_of_slider='$tt_slider' WHERE tab_id=$tab_id";
		mysqli_query($db, $sql_update);
		
		$insert="";
		$insertarr=array();
		for ($xx = $tt_slider_res['count']; $xx < $tt_slider; $xx++) {
			$title0='title_'.$xx;
			$description0='description_'.$xx;
			$sliderimg0='sliderimg_'.$xx;
			$title=mysqli_real_escape_string($db,$_POST[$title0]);
			$description=mysqli_real_escape_string($db,$_POST[$description0]);
			
			$sliderimg=$_FILES[$sliderimg0]['name'];
			
			if(empty($sliderimg)){
				$_SESSION['msg']="Please Select Slider Image!!!";
				header('Location: edit.php?edit_tab='.$tab_id);
				exit();
			}
			
			$word0 = array_merge(range('a', 'z'), range('A', 'Z'));
			shuffle($word0);
			$random0=substr(implode($word0), 0, 10);
			$split0=explode(".",$sliderimg);
			$img_name=$split0[0]."_".$random0.".".$split0[1];
			$img_path="./img/".$img_name;
			move_uploaded_file($_FILES[$sliderimg0]['tmp_name'],$img_path);
			
			if(!empty($title) && !empty($description) && !empty($sliderimg))
			{
				$insertarr[]= "('$tab_id','$title','$description','$img_name','$img_path')";
			}
		}
		$insert = implode(",", $insertarr);
		if($insert!="")
		{
			$sql="insert into sliders(tab_id,slider_title,slider_description,slider_img,slider_img_path) 
				values$insert";
			mysqli_query($db, $sql);
		}
	}
	if (isset($_FILES['icon']) && $_FILES['icon']['size'] > 0) { 
		$icon=$_FILES['icon']['name'];
		$word = array_merge(range('a', 'z'), range('A', 'Z'));
		shuffle($word);
		$random=substr(implode($word), 0, 10);
		$split=explode(".",$icon);
		$icon_name=$split[0]."_".$random.".".$split[1];
		$icon_path="./icons/".$icon_name;
		move_uploaded_file($_FILES['icon']['tmp_name'],$icon_path);
		$sql_icon="UPDATE tabs SET tab_icon='$icon_name',tab_icon_path='$icon_path' 
			WHERE tab_id=$tab_id";
		mysqli_query($db, $sql_icon);
	}
			
	$sql_update="UPDATE tabs SET tab_name='$name',no_of_slider='$num' WHERE tab_id=$tab_id";
	mysqli_query($db, $sql_update);
	
	for ($xx = 0; $xx < $num; $xx++) {
		$slider_id0='slider_id_'.$xx;
		$title0='title_'.$xx;
		$description0='description_'.$xx;
		$sliderimg0='sliderimg_'.$xx;
		$slider_id=$_POST[$slider_id0];
		$title=mysqli_real_escape_string($db,$_POST[$title0]);
		$description=mysqli_real_escape_string($db,$_POST[$description0]);
		
		if (isset($_FILES[$sliderimg0]) && $_FILES[$sliderimg0]['size'] > 0) { 
			$sliderimg=$_FILES[$sliderimg0]['name'];
			$word0 = array_merge(range('a', 'z'), range('A', 'Z'));
			shuffle($word0);
			$random0=substr(implode($word0), 0, 10);
			$split0=explode(".",$sliderimg);
			$img_name=$split0[0]."_".$random0.".".$split0[1];
			$img_path="./img/".$img_name;
			move_uploaded_file($_FILES[$sliderimg0]['tmp_name'],$img_path);
			
			$sql_img="UPDATE sliders SET slider_img='$img_name',slider_img_path='$img_path' 
			WHERE slider_id=$slider_id";
			mysqli_query($db, $sql_img);
		}
		
		$sql_slider="UPDATE sliders SET slider_title='$title',slider_description='$description' 
			WHERE slider_id=$slider_id";
		mysqli_query($db, $sql_slider);
	}
	
	$_SESSION['msg']="Record updated Successfully!!!";
	header('Location: edit.php?edit_tab='.$tab_id);
	exit();

}
?>