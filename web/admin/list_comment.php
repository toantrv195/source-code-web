<?php
	require("template/header.php");
?>
    	<div id="wrapper">
        	<table>
            	
            	<tr style="background:#096; color:#FFF;">
                	<th width="37">STT</th>
                    <th width="103">Name</th>
                    <th width="512">Nội dung</th>
                     <th width="51">Link</th>
                    <th width="101">Duyệt</th>
                    <th width="68">Delete</th>
                </tr>
                <?php
				//mở kết nối csdl
				require("../library/config.php");
				//thực hiện câu truy vấn
				$STT=1;
				$result=mysql_query("select cm_id,name,message,cm_check,news_id from comment order by cm_id desc");
				while($data=mysql_fetch_assoc($result))
				{
               	echo"<tr>";
                	echo"<td>$STT</td>";
                    echo"<td>$data[name]</td>";
                    echo"<td>$data[message]</td>";
                    echo"<td><a href='http://localhost/www/webtintuc/detail.php?id=$data[news_id]' target='_blank' style='color:#F00'>xem</a></td>";
					if($data['cm_check']=='N')
					{
                    	echo"<td><a href='edit_comment.php?id=$data[cm_id]' style='color:#09F;'>chưa duyệt</a></td>";
					}
					else
					{
						echo"<td><a href='edit_comment.php?id=$data[cm_id]' style='color:#09F;'>Đã duyệt</a></td>";
					}
                    echo"<td><a href='del_comment.php?id=$data[cm_id]' onclick='return show_confirm();' style='color:#F0F;'>delete</a></td>";
             	echo"</tr>";
				$STT++;
				}
				//đóng kết nối csdl
				mysql_close($conn);
				?>
				 
            </table>
        
        </div>
  
  
  
 <?php
 	require("template/footer.php");
 ?>      