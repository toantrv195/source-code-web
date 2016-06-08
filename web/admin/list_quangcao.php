<?php
	require("template/header.php");
?>
    	<div id="wrapper">
        	<table>
            	<tr>
                	<td colspan="4"></td>
                    <td colspan="2" ><a href="add_quangcao.php" style="color:#903;">Thêm quảng cáo</a></td>
                </tr>
            	<tr style="background:#096; color:#FFF;">
                	<th width="35">STT</th>
                    <th width="226">Mô tả Quảng cáo</th>
                    <th width="246">Hình ảnh</th>
                     <th width="174">Link</th>
                    <th width="93">Duyệt</th>
                    <th width="98">Delete</th>
                </tr>
               <?php
			   //mở kết nối csdl
			   require("../library/config.php");
			   //thực hiện câu truy vấn
			   $STT=1;
			   $result=mysql_query("select id_Qc,MoTa,Url,images,cm_check from quangcao order by id_Qc desc");
			   while($data=mysql_fetch_assoc($result))
			   {
               	echo"<tr>";
                	echo"<td>$STT</td>";
                    echo"<td>$data[MoTa]</td>";
                   	echo"<td><img src='../library/imageqc/$data[images]' width='200px' height='150px'></td>";
                   	echo"<td>$data[Url]</td>";
					if($data['cm_check']=='N')
					{
						echo"<td><a href='edit_quangcao.php?id=$data[id_Qc]' style='color:#09F;'>NO</a></td>";
					}
					else
					{
						echo"<td><a href='edit_quangcao.php?id=$data[id_Qc]' style='color:#09F;'>YES</a></td>";
					}
                   echo"<td><a href='del_quangcao.php?id=$data[id_Qc]' onclick='return show_confirm();' style='color:#F0F;'>delete</a></td>";
             	echo"</tr>";
				$STT++;
			   }
				?>
            </table>
        
        </div>
  
  
  
 <?php
 	require("template/footer.php");
 ?>      