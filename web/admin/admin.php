<?php

	session_start();
	if($_SESSION["level"]==2)
	{
		require("template/header.php");
		require("template/footer.php");
	}
	else
	{
		header("location:../index.php");
		exit();
	}
?>