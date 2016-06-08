<?php
	require("template/header.php");
	$id=$_GET["id"];
	
	$loi=array();
	$loi["catename"]=NULL;
	$catename=NULL;
	if(isset($_POST["ok"]))
	{
		//check có nhập catename mới chưa
		if(empty($_POST["txtname"]))
		{
			$loi["catename"]="* xin vui lòng nhập tên chuyên mục mới";	
		}
		else
		{
			$catename=$_POST["txtname"];
		}
		if($catename)
		{
			//mở kết nối csdl
			require("../library/config.php");
			//thực hiện câu truy vấn update dữ liệu
			mysql_query("update category set cate_title='$catename' where cate_id=$id");
			//đóng kết nối csdl
			mysql_close($conn);
			header("location:list_category.php");
			exit();
		}
	}
	
	
	//mở kết nối csdl
	require("../library/config.php");
	//thực hiện câu truy vấn lấy cate_title bỏ bào form chỉnh sửa
	$result=mysql_query("select cate_title from category where cate_id=$id");
	$data=mysql_fetch_assoc($result);
	//đóng kết nối csdl
	mysql_close($conn);
?>


    	<div id="wrapper2">
        	<form action="edit_category.php?id=<?php echo $id;?>" method="post">
            <fieldset style="width:140px; height:90px; margin:20px auto;">
            	<legend style="font-weight:bold;">chỉnh sửa chuyên mục</legend>
                <table>
                	<tr>
                    	<td>Name</td>
                        <td><input type="text" name="txtname" size="20px" value="<?php echo $data['cate_title'];?>"/></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td><input type="submit" value="update" name="ok"/></td>
                    </tr>
                </table>
            </fieldset>
            </form>
            <div style="width:290px; margin:20px auto; color:#F00;">
            	<?php
                	echo $loi["catename"];
				?>
            </div>
        	        
        </div>
  
  
  
 <?php
 	require("template/footer.php");
 ?>      