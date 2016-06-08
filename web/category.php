<?php
	$id=$_GET["id"];
	session_start();
	require("templates/header.php");
	
?>
	<div id="left">
    <?php
	//mở kết nối csdl
	require("library/config.php");
	//thực hiện câu truy vấn trong bảng category
	
	$result=mysql_query("select cate_title from category where cate_id=$id");
	$data=mysql_fetch_assoc($result);
    	echo"<h2>$data[cate_title]</h2>";
        echo"<div class='news_category'>";
            echo"<ul>";
	//thực hiện câu truy vấn trong bảng news
	if(isset($_GET["begin"]))
	{
		$position=$_GET["begin"];
	}
	else
	{
		$position=0;//lấy vị trí bài biết trong csdl
	}
	$display=4;
	$result2=mysql_query("select news_id,title,images,introduce from news where cate_id=$id order by news_id desc limit $position,$display");
	while($data2=mysql_fetch_assoc($result2))
		{
	?>
            <li style='height:400px;'>
                <a href='detail2.php?id=<?php echo"$data2[news_id]"?>'>
                <img src='library/images/<?php echo"$data2[images]"?>' width='280'/>
                <h3><?php echo $data2['title']?></h3>
                <p><?php echo"$data2[introduce]"?></p>
                <p class='xemthem'><a href='detail2.php?id=<?php echo"$data2[news_id]";?>'>xem thêm>></a></p>
                </a>
           </li>
	<?php
    }
	//đóng kết nối csdl
	mysql_close($conn);
    ?>
      </ul>
	
        </div>
        <div style="clear:both"></div>
    	<div id="pagination">
        	
            <?php
			
			//mở kết nối csdl
			require("library/config.php");
			
			//thực hiện câu truy vấn
			$result3=mysql_query("select * from news where cate_id=$id");
			$sum_news=mysql_num_rows($result3);
			//tổng số trang cần phân chia
			$sum_page=ceil($sum_news/$display);
			echo"<ul>";
        
				if($sum_page>1)
				{
					//tính số trang hiện tại mà người dùng đang xem
					$current=($position/$display)+1;
					$prev=$position-$display;
					if($current!=1)
					{
						echo"<li><a href='category.php?id=$id&begin=$prev'>Prev</a></li>";	
					}
					for($page=1;$page<=$sum_page;$page++)
					{	$begin=($page-1)*$display;
						
						if($current==$page)
						{
							echo"<li style='background:#C39;'><a href='category.php?id=$id&begin=$begin' style='color:#FFF;'>$page</a></li>";
						}
						else
						{
							echo"<li><a href='category.php?id=$id&begin=$begin'>$page</a></li>";
						}
						
					}
					
					if($current!=$sum_page)
					{	
						$next=$position+$display;
						echo"<li><a href='category.php?id=$id&begin=$next'>next</a></li>";
					}
						
				}
			echo"</ul>";
				//đóng kết nối csdl
				mysql_close($conn);
                
				
			?>
            
        </div>
    </div>
    

<?php
	require("templates/content-right.php");
	require("templates/footer.php");
?>