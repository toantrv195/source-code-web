<?php
	require("template/header.php");
?>
    	<div id="wrapper">
        	<table>
            	<tr>
                	<td colspan="2"></td>
                    <td colspan="2"><a href="add_category.php" style="color:#C06;">Thêm chuyên mục</a></td>
                </tr>
            	<tr style="background:#096; color:#FFF;">
                	<th width="141">STT</th>
                    <th width="533">Chuyên mục</th>
                    <th width="104">Edit</th>
                    <th width="102">Delete</th>
                </tr>
                <?php
				//mở kết nối csdl
				require("../library/config.php");
				//thực hiện câu truy vấn
				$stt=1;
				$result=mysql_query("select cate_id,cate_title from category");
				while($data=mysql_fetch_assoc($result))
				{
                echo"<tr>";
                	echo"<td>$stt</td>";
                    echo"<td>$data[cate_title]</td>";
                    echo"<td><a href='edit_category.php?id=$data[cate_id]' style='color:#09F;'>Edit</a></td>";
                    echo"<td><a href='del_category.php?id=$data[cate_id]' onclick='return show_confirm();' style='color:#F0F;'>delete</a></td>";
                echo"</tr>";
				$stt++;
				}
				
				//đóng kết nối csdl
				mysql_close($conn);
				?>
                               
            </table>
        
        </div>
  
  
  
 <?php
 	require("template/footer.php");
 ?>      