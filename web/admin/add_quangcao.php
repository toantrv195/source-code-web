<?php
	require("template/header.php");
	$loi=array();
	$loi["intro"]=$loi["url"]=$loi["image"]=NULL;
	$intro=$url=$image=NULL;
	if(isset($_POST["ok"]))
	{
		//check có nhập mô tả quảng cáo chưa
		if(empty($_POST["txtintro"]))
		{
			$loi["intro"]="* xin vui lòng nhập mô tả quảng cáo</br/>";	
		}	
		else
		{
			$intro=$_POST["txtintro"];	
		}
		//check có nhập url quảng cáo chưa
		if(empty($_POST["url"]))
		{
			$loi["url"]="* xin vui lòng nhập Url quảng cáo<br/>";
		}
		else
		{
			$url=$_POST["url"];
		}
		//check có upload hình ảnh chưa
		if($_FILES["image"]["error"]>0)
		{
			$loi["image"]="* xin vui lòng chọn hình ảnh<br/>";	
		}
		else
		{
			$image=$_FILES["image"]["name"];	
		}
		
		if($intro && $url && $image )
		{
			//mở kết nối csdl
			require("../library/config.php");
			//thực hiện câu truy vấn thêm dữ liệu quảng cáo vào csdl
			mysql_query("insert into quangcao(MoTa,Url,images,cm_check)
										value('$intro','$url','$image','N')");
			//đóng kết nối csdl
			mysql_close($conn);
			
			//upload hình ảnh
			move_uploaded_file($_FILES["image"]["tmp_name"],"../library/imageqc/".$_FILES["image"]["name"]);	
		}
	}
?>

    
    <div id="wrapper2">
        <fieldset>
            <legend><h3>Thêm quảng cáo</h3></legend>
            <form action="add_quangcao.php" method="post" enctype="multipart/form-data">
                <table>
                	<tr>
                    	<td>Mô tả quảng cáo</td>
                        <td><input type="text" size="50px" name="txtintro"></td>
                    </tr>
                    <tr>
                    	<td>Url quảng cáo</td>
                        <td><input type="text" size="30px" name="url"/></td>
                    </tr>
                    <tr>
                    	<td>Hình ảnh</td>
                        <td><input type="file" name="image"/></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td><input type="submit" value="Add" name="ok"></td>
                    </tr>
                
                </table>
            
            </form>
        
        </fieldset>
         <div style="width:290px; margin:10px auto; color:#F00;">
    	<?php
			echo $loi["intro"];
			echo $loi["url"];
			echo $loi["image"];
			
			
		?>
    </div>
    
    
    </div>









<?php
	require("template/footer.php");
?>