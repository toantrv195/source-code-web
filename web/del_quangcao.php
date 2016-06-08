<?php
	
	$id=$_GET["id"];
	
	//mở kết nối csdl
	require("../library/config.php");
	
	//thực hiện câu truy vấn
	mysql_query("delete from quangcao where id_Qc=$id");
	
	//đóng kết nối csdl
	mysql_close($conn);
	
	header("location:list_quangcao.php");
	exit();
?>