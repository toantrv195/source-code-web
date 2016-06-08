<?php
	$id=$_GET["id"];
	//mở kết nối csdl
	require("../library/config.php");
	//thực hienj câu truy vấn xóa comment
	
	mysql_query("delete from comment where cm_id=$id");
	
	//đóng kết nối csdl
	mysql_close($conn);
	
	//chuyển về trang list_comment
	header("location:list_comment.php");
	exit();

?>