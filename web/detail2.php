<?php
session_start();
	$id=$_GET["id"];
	require("templates/header.php");
	
	
	
	$loi=array();
	$loi["name"]=$loi["image"]=$loi["mess"]=NULL;
	$name=$image=$mess=NULL;
	
	if(isset($_POST["ok"]))
	{
	//check có nhập name chưa
		if(empty($_POST["txtname"]))
		{
			$loi["name"]="* xin vui lòng nhập tên";
		}	
		else
		{
			$name=$_POST["txtname"];
		}
		//check có upload ảnh chưa
		if($_FILES["image"]["error"]>0)
		{
			$loi["image"]="* xin vui lòng chọn hình ảnh<br/>";
		}
		else
		{
			$image=$_FILES["image"]["name"];
		}
		//check có nhập mess chưa
		if(empty($_POST["txtmess"]))
		{
			$loi["mess"]="* xin vui lòng nhập nội dung";	
		}
		else
		{
			$mess=$_POST["txtmess"];
		}
		if($name && $image && $mess)
		{
		//mở kết nối csdl
		require("library/config.php");
		
		//thực hiện câu truy vấn
		mysql_query("insert into comment(name,images,message,time,cm_check,news_id)
									value('$name','$image','$mess',now(),'N','$id')");
			
		//upload hình ảnh
		move_uploaded_file($_FILES["image"]["tmp_name"],"library/images/".$_FILES["image"]["name"]);
		
		//đóng kết nối csdl
		mysql_close($conn);
		
		echo"<script language='javascript'>";
		echo"alert('bình luận của bạn đã gửi thành công và đang chờ kiểm duyệt trước khi hiển thị lên trang!')";
		echo"</script>";	
		}
	}
?>
	
    <div id="left">
    	<div id="detail-article">
        <?php
		//mở kết nối csdl
		require("library/config.php");
		//thực hiện câu truy vấn
		mysql_query("update news set views = views+1 where news_id=$id");
		$result=mysql_query("select title,introduce,content,cate_id from news where news_id=$id");
		$data=mysql_fetch_assoc($result);
		?>
            <h3 style='margin:10px 0px 10px 0px; font-size:25px; padding-left:3px;'><?php echo"$data[title]"?></h3>
            <p style='font-weight:bold; font-size:20px; color:#333; text-indent:10px;'><?php echo"$data[introduce]"?></p>
            <p style='margin:20px 0px 10px 0px; padding-left:10px;'><?php echo"$data[content]"?></p>
		<?php	
        //đóng kết  nối csdl
        mysql_close($conn);
        ?>
        </div>
        <div class="clear"></div>
        <div style='clear:both'></div>
    	<?php
		//mở kết nối csdl
		require("library/config.php");
		//thự hiện câu truy vấn
		$result2=mysql_query("select views from news where news_id=$id");
		$data2=mysql_fetch_assoc($result2);
    	echo"<div style=' padding-top:10px;'><span style='color:#900;'>quan tâm: $data2[views]</span></div>";
		echo"<div style='clear:both'></div>";
		?>
        
        <?php
		//mở kết nối csdl
		require("library/config.php");
		//thực hiện câu truy ván
		$result3=mysql_query("select news_id,title,images from news where cate_id=$data[cate_id] and news_id< $id order by news_id desc limit 3");
		if(mysql_num_rows($result3)!=0)
		{
			echo"<div id='diffirent-article'>";
				echo"<p>tin khác</p>";
			echo"</div>";
			echo"<div id='diffirent'>";
				echo"<ul>";
				while($data3=mysql_fetch_assoc($result3))
				{
					echo"<li>";
						echo"<a href='detail2.php?id=$data3[news_id]'>";
							echo"<img src='library/images/$data3[images]'width='190px' height='120px'/>";
							echo"<p>$data3[title]</p>";
						echo"</a>";
				   echo"</li>";
				}
				
				echo"</ul>";
			echo"</div>";
			//đóng kết nối csdl
				mysql_close($conn);
		}
		?>
        <div style="clear:both"></div>
        <div id="comment">
        	<p>hãy nói điều gì đó về bài này</p>
            <fieldset>
                <legend>comment</legend>
                <form action="detail2.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>name</td>
                            <td><input type="text" size="25px" name="txtname" value="<?php echo $loi["name"];?>"></td>
                        <tr>
                        <tr>
                        	<td>hình ảnh:</td>
                            <td><input type="file" name="image" value="<?php echo $loi["image"];?>"/></td>
                        </tr>
                        <tr>
                            <td>mes</td>
                            <td><textarea cols="60" rows="5" name="txtmess" ><?php echo $loi["name"];?></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="submit" name="ok"></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
           <?php
			//mở kết nối csdl
			require("library/config.php");
			//thực hiện câu truy vấn 
			$result4=mysql_query("select name,images,message,time from comment where cm_check='Y' and news_id=$id");
			
		   echo"<div id='show-comment'>";
		  	while($data4=mysql_fetch_assoc($result4))
				{
					echo"<div class='comm'>";
						echo"<img src='library/images/$data4[images]'style='width:60px; height:60px;'/>";
					echo"</div>";
					echo"<div class='mes'>";
						$sqltime=$data4['time'];
						$timestamp=strtotime($sqltime);
						$time=date('d-m-Y H:i:s', $timestamp);
						echo"<p style='color:#06C;'>$data4[name] :<span style='color:#666;'>$time</span></p>";
						echo"<p>$data4[message]</p>";
					echo"</div>";
					echo"<div style='clear:both'></div>";
				}
		   echo"</div>";
		   //đóng kết nối csdl
		   mysql_close($conn);
	   ?>
    </div>
    
<?php
	require("templates/content-right.php");
	require("templates/footer.php");
?>