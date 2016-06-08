<?php
	require("template/header.php");
	$id=$_GET["id"];
	
	//lựa chọn duyệt comment của người dùng
	if(isset($_POST["ok"]))
	{
		$check=$_POST["txtcheck"];
		//mở kết nối csdl
		require("../library/config.php");
		
		//thực hiện câu truy vấn
		mysql_query("update comment set cm_check='$check' where cm_id=$id");
		//đóng kết nối csdl
		mysql_close($conn);
		
		//
		header("location:list_comment.php");
		exit();	
	}
?>


    	<div id="wrapper2">
        	<fieldset style="width:250px; margin:20px auto 10px;">
        	<legend><h3>Xét duyệt bình luận</h3></legend>
            <form action="edit_comment.php?id=<?php echo $id ;?>" method="post">
            	<table>
                	<tr>
                    	<td>Duyệt comment</td>
                        <td>
                        	<select name="txtcheck">
                            	<option value="N">Chưa duyệt</option>
                                <option value="Y">Đã duyệt</option>
                            </select>
                        </td>
                    </tr
                    ><tr>
                    	<td></td>
                        <td><input type="submit" value="update" name="ok"></td>
                    </tr>
                </table>
            </form>
        </fieldset>
            
        	        
        </div>
  
  
  
 <?php
 	require("template/footer.php");
 ?>      