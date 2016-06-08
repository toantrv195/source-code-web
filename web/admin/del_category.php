<?php
	$id=$_GET["id"];
	//mở kết nối csdl
	require("../library/config.php");
	// thực hiện câu truy vấn 
	mysql_query("delete from category where cate_id=$id");
	
	//đóng kết nối csdl
	mysql_close($conn);
	
	header("location:list_category.php");
	eccit();
?>