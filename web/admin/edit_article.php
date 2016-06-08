<?php
	require("template/header.php");
	
	$id=$_GET["id"];
	
	$loi=array();
	$loi["hot_news"]=$loi["title"]=$loi["intro"]=$loi["content"]=NULL;
	$image=$hot_news=$title=$intro=$content=NULL;
	if(isset($_POST["ok"]))
	{
		//lấy id chuyên mục người dùng đã chỉnh sửa
		$cate_id=$_POST["txtcate"];
		//check hình ảnh
		if($_FILES["image"]["error"]>0)//tức là hình ảnh cũ lỗi => người dùng không chọn hình ảnh mới để update
		{
			$image="none";//=> viết câu truy vấn không update hình ảnh
		}
		else
		{
			$image=$_FILES["image"]["name"];//=> có update hình ảnh	
		}
		//lấy loại tin mà người dùng đã chỉnh sửa
		if(empty($_POST["tin"]))
		{
			$loi["hot_news"]="* xin vui lòng chọn loại tin<br/>";	
		}
		else
		{
			$hot_news=$_POST["tin"];	
		}	
		//lấytiêu đề mà người dùng đã chỉnh sửa
		if(empty($_POST["txttitle"]))
		{
			$loi["title"]="* xin vui lòng nhập tiêu đề bài viết mới <br/>";
		}
		else
		{
			$title=mysql_escape_string($_POST["txttitle"]);	
		}
		//lấy nội dung mô tả mà người dùng đã chỉnh sửa
		if(empty($_POST["txtintro"]))
		{
			$loi["intro"]="* xin vui lòng nhập mô tả bài viết <br/>";	
		}
		else
		{
			$intro=mysql_escape_string($_POST["txtintro"]);
		}
		//lấy nội dung bài viết mà người dùng đã chỉnh sửa
		if(empty($_POST["content"]))
		{
			$loi["content"]="* xin vui lòng nhập nôi dung bài viêt";
		}
		else
		{
			$content=mysql_escape_string($_POST["content"]);
		}
		
		//
		if($title && $image && $intro && $content && $hot_news)
		{
		//mở kết nối csdl
		require("../library/config.php");
		//thực hiện câu truy vấn update thông tin chỉnh sửa vào trong csdl
			if($image=='none')
			{
				mysql_query("update news set cate_id='$cate_id',title='$title',introduce='$intro',content='$content',hot_news='$hot_news' where news_id=$id");	
			}
			else
			{
				mysql_query("update news set cate_id='$cate_id',title='$title',images='$image',introduce='$intro',content='$content',hot_news='$hot_news' where news_id=$id");	
			}
			//update tấm hình vào thư mục image
			move_uploaded_file($_FILES["image"]["tmp_name"],"../library/images/".$_FILES["image"]["name"]);
			
			//đóng kết nối csdl
			mysql_close($conn);
			//
			header("location:list_article.php");
			exit();
		}
	}
	
	//mở kết nối csdl
	require("../library/config.php");
	//thực hiện câu truy vấn lấy thông tin trong csdl bỏ vào fom để người dùng chỉnh sửa
	$result=mysql_query("select cate_id,title,images,introduce,content,hot_news from news  where news_id=$id");
	$data=mysql_fetch_assoc($result);
	//đóng kết nối csdl
	mysql_close($conn);
	
?>

	<div id="wrapper2">
    	<fieldset>
        	<legend style="font-weight:bold; padding-left:5px;">Chỉnh sửa bài viết</legend>
            <form action="edit_article.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">	
            	<table>
                	<tr>
                    	<td>chuyên mục</td>
                        <td>
                        	<select name="txtcate">
                            <?php
							//mở kết nối csdl
							require("../library/config.php");
							//thực hiện câu truy vấn
							$result2=mysql_query("select cate_id,cate_title from category");
							while($data2=mysql_fetch_assoc($result2))
							{
								if($data['cate_id']==$data2['cate_id'])
								{
                                	echo"<option value='$data2[cate_id]' selected='selected'>$data2[cate_title]</option>";
								}
								else
								{
									 echo"<option value='$data2[cate_id]'>$data2[cate_title]</option>";
								}
							}
							//đóng kết nối csdl
							mysql_close($conn);
							?>
                        	</select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Hình ảnh cũ</td> 
                        <td><img src="../library/images/<?php echo $data["images"];?>" width="140px;"></td>
                    </tr>
                    <tr>
                    	<td>Hình ảnh mới</td> 
                        <td><input type="file" size="25px" style="padding-left:0px;" name="image"/></td>
                    </tr>
                    <tr>
                    	<td>loại tin</td>
                        <td>
                        	<input <?php if($data['hot_news']==1){echo "checked='check'";}?> type="radio" name="tin" value="1">tin nổi bật
                        	<input <?php if($data['hot_news']==2){echo "checked='check'";}?> type="radio" name="tin" value="2">tin thường
                        </td>
                    </tr>
                    <tr>
                    	<td>tiêu đề</td>
                        <td><input type="text" size="50px" name="txttitle" value="<?php echo $data['title'];?>"/></td>
                    </tr>
                    
                    <tr>
                    	<td>Mô tả</td>
                        <td><textarea cols="55px" rows="5px" name="txtintro"><?php echo $data["introduce"]?></textarea></td>
                    </tr>
                     
                    <tr>
                    	<td>Nôị dung</td>
                        <td><textarea cols="55px" rows="10px" name="content"/><?php echo $data["content"]?></textarea></td>
                     </tr>
                     <script type="text/javascript">
						CKEDITOR.replace( 'content' );
					 </script>
                     <tr>
                        <td></td>
                        <td><input type="submit" value="update" name="ok"/></td>
                      </tr>
                </table>
            </form>
            
        </fieldset>
        <div style="width:290px; margin:10px auto; color:#F00;">
    	<?php
			echo $loi["hot_news"];
        	echo $loi["title"];
			echo $loi["intro"];
			echo $loi["content"];
		?>
    </div>
    
    </div>



 
<?php
	require("template/footer.php");
?>