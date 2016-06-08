<?php
	require("template/header.php");
	$loi=array();
	$loi["catename"]=NULL;
	$catename=NULL;
	
	if(isset($_POST["ok"]))
	{
		//check có nhập tên chuyên mục chưa?
		if(empty($_POST["catename"]))
		{
			$loi["catename"]="* xin vui lòng nhập tên chuyên mục mới";
		}
		else
		{
			$catename=$_POST["catename"];
		}
		//xử lí dữ liệu
		if($catename)
		{
			//mở kết nối csdl
			require("../library/config.php");
			
			//thực hiện câu truy vấn
			mysql_query("insert into category(cate_title) value('$catename')");
			
			//đóng kết nối csdl
			mysql_close($conn);
			header("location:list_category.php");
			exit();
		}
	}
	
?>
    	<div id="wrapper2">
        	<form action="add_category.php" method="post">
            <fieldset style="width:140px; height:90px; margin:20px auto;">
            	<legend style="font-weight:bold;">Thêm chuyên mục</legend>
                <table>
                	<tr>
                    	<td>Name</td>
                        <td><input type="text" name="catename" size="20px"/></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td><input type="submit" value="Add" name="ok"/></td>
                    </tr>
                </table>
            </fieldset>
            </form>
        	<div style="width:290px; margin:10px auto; color:#F00;">
            	<?php
                
					echo $loi["catename"];
				?>
            </div>       
        </div>
  
  
  
 <?php
 	require("template/footer.php");
 ?>      