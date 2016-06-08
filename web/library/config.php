<?php
	$user="root";
	$pass="";
	$conn=mysql_connect("localhost",$user,$pass);
	mysql_select_db("blogteen",$conn);
	mysql_query("SET NAMES 'UTF8'");
?>