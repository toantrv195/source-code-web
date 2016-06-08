<?php
	require("template/header.php");
	$id=$_GET["id"];
	
	//lựa chọn duyệt quảng cáo người dùng
	if(isset($_POST["ok"]))
	{
		$check=$_POST["txtcheck"];
		//mở kết nối csdl
		require("../library/config.php");
		
		//update csdl
		mysql_query("update quangcao set cm_check='$check' where id_Qc=$id");
		
		//đóng kết nối csdl
		mysql_close($conn);
		
		header("location:list_quangcao.php");
		exit();
	}
	
?>


    	<div id="wrapper2">
        	<fieldset style="width:250px; margin:20px auto 10px;">
        	<legend><h3>Xét duyệt quảng cáo</h3></legend>
            <form action="" method="post">
            	<table>
                	<tr>
                    	<td height="36">Duyệt quảngcáo</td>
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