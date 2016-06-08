<?php
	require("template/header.php");
	
	$loi=array();
	$loi["image"]=$loi["cate_news"]=$loi["title"]=$loi["title"]=$loi["intro"]=$loi["content"]=NULL;
	$image=$cate_news=$title=$intro=$content=NULL;
	if(isset($_POST["ok"]))
	{
		//lấy cate_id mà người dùng đã lựa chọn
		$cate_id=$_POST["txtcate"];
		
		//check có chọn image chưa
		if($_FILES["image"]["error"]>0)
		{
			$loi["image"]="* xin vui lòng chọn image<br/>";
		}
		else
		{
			$image=$_FILES["image"]["name"];
		}
		//check có chọn loại tin chưa
		if(empty($_POST["cate_news"]))
		{
			$loi["cate_news"]="* xin vui lòng chọn loại tin <br/>";
		}
		else
		{
			$cate_news=$_POST["cate_news"];
		}
		//check có nhập tiêu đề bài viết chưa
		if(empty($_POST["txttitle"]))
		{
			$loi["title"]="* xin vui lòng nhập tiêu đề bài viết<br/>";
		}
		else
		{
			$title=mysql_escape_string($_POST["txttitle"]);
		}
		//check có nhập introduce chưa
		if(empty($_POST["txtintro"]))
		{
			$loi["intro"]="* xin vui lòng nhập mô tả bài viết<br/>";
		}
		else
		{
			$intro=mysql_escape_string($_POST["txtintro"]);
		}
		//check có nhập content chưa
		if(empty($_POST["content"]))
		{
			$loi["content"]="* xin vui lòng nhập nội dung bài viết";
		}
		else
		{
			$content=mysql_escape_string($_POST["content"]);
		}
		
		if($image && $cate_news && $title && $intro && $content)
		{
		//mở kết nối csdl
			require("../library/config.php");
		//thực hiện câu truy vấn thêm dữ liệu vào bảng
			mysql_query("insert into news(title,images,introduce,content,hot_news,cate_id)
									value('$title','$image','$intro','$content','$cate_news','$cate_id')");
		//đóng kết nối csdl
		mysql_close($conn);
		
		//upload hình ảnh
		move_uploaded_file($_FILES["image"]["tmp_name"],"../library/images/".$_FILES["image"]["name"]);
			
		}
	}
?>

	<div id="wrapper2">
    	<fieldset>
        	<legend style="font-weight:bold; padding-left:5px;">Thêm bài viết</legend>
            <form action="add_article.php" method="post" enctype="multipart/form-data">	
            	<table>
                	<tr>
                    	<td>chuyên mục</td>
                        <td><select name="txtcate">
                        <?php
							//mở kết nối csdl
							require("../library/config.php");
							//thực hiện câu truy vấn lấy dữ liệu bsor vào select
							$result=mysql_query("select cate_id,cate_title from category");
							while($data=mysql_fetch_assoc($result))
							{
                               echo"<option value='$data[cate_id]'>$data[cate_title]</option>";
							}
							//đóng kết nối csdl
							mysql_close($conn);
                          ?>
                        	</select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Hình ảnh</td> 
                        <td><input type="file" size="25px" style="padding-left:0px;" name="image"/></td>
                    </tr>
                    <tr>
                    	<td>loại tin</td>
                        <td><input type="radio" name="cate_news" value="1">tin nổi bật
                        	<input type="radio" name="cate_news" value="2">tin thường
                        </td>
                    </tr>
                    <tr>
                    	<td>tiêu đề</td>
                        <td><input type="text" size="50px" name="txttitle"/></td>
                    </tr>
                    
                    <tr>
                    	<td>Mô tả</td>
                        <td><textarea cols="55px" rows="5px" name="txtintro"></textarea></td>
                    </tr>
                    <tr>
                    	<td>Nôị dung</td>
                        <td><textarea cols="55px" rows="10px" name="content"/></textarea></td>
                     </tr>
                      <script type="text/javascript">
						CKEDITOR.replace( 'content' );
					 </script>
                     <tr>
                        <td></td>
                        <td><input type="submit" value="Add" name="ok"/></td>
                      </tr>
                </table>
          </form>
         
            
        </fieldset>
         <div style="width:290px; margin:10px auto; color:#F00;">
    	<?php
			echo $loi["image"];
			echo $loi["cate_news"];
			echo $loi["title"];
			echo $loi["intro"];
			echo $loi["content"];
		?>
    </div>
    
    </div>



 
<?php
	require("template/footer.php");
?>