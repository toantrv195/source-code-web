<?php

	$id=$_GET["id"];
	//mở kết nối csdl
	require("../library/config.php");
	//thực hiện câu truy vấn xóa dữ liệu người dùng
	mysql_query("delete from news where news_id=$id");
	//đóng kết nối csdl
	mysql_close($conn);
	
	//
	header("location:list_article.php");
	exit();
?>