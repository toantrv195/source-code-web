
<?php
	require("templates/header.php");
	
?>

		<div id="left">
		<?php
		
	        echo"<div class='news_category'>";
            echo"<ul>";
	
	
	
	
	if(isset($_GET["seach"]))
	{
		$search=$_GET["seach"];
		if(isset($search))
		{
		//mở kết nối csdl
		require("library/config.php");
		
		
		$result2=mysql_query("select news_id,title,images,introduce from news where title like '%$search%' order by news_id desc ");
		$row=mysql_num_rows($result2);
			echo"<h3 style='padding-left:20px; border-bottom:1px solid #0CF; padding-bottom:5px;'>Có <span style='color:red;'>$row</span> kết quả với từ <span style='color:red;'>'$search'</span>.</h3>";
		while($data2=mysql_fetch_assoc($result2))
			{
					echo"<li style='height:400px;'>";
						echo"<a href='detail2.php?id=$data2[news_id]'>";
						echo"<img src='library/images/$data2[images]' width='280'/>";
						echo"<h3>$data2[title]</h3>";
						echo"<p>$data2[introduce]</p>";
						echo"<p class='xemthem'><a href='detail2.php?id=$data2[news_id]'>xem thêm>></a></p>";
						 echo"</a>";
					echo"</li>";
			}
		//đóng kết nối csdl
		mysql_close($conn);
		}
		else
		{
			echo "<span style='color:red;'>* không có kết quả nào với từ khóa cần tìm</span>";
		}
				  echo"</ul>";
		
	
	}
	
			  ?>
        </div>
        <div style="clear:both"></div>

	</div>


<?php
	require("templates/content-right.php");
	require("templates/footer.php");
?>