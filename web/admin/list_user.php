<?php
	require("template/header.php");
	
?>
    	<div id="wrapper">
        	<table>
            	<tr style="background:#096; color:#FFF;">
                	<th width="63">STT</th>
                    <th width="166">Username</th>
                    <th width="354">Email</th>
                    <th width="165">Level</th>
                    <th width="128">Delete</th>
                </tr>
                <?php
					//mở kết nối csdl
					require("../library/config.php");
					//thực hiện câu truy vấn
					$stt=1;
					$result=mysql_query("select user_id,username,email,level from user");
					while($data=mysql_fetch_assoc($result))
				{
					echo"<tr>";
						echo"<td>$stt</td>";
						echo"<td>$data[username]</td>";
						echo"<td>$data[email]</td>";
						if($data['level']==1)
						{
							echo"<td>thành viên</td>";
						}
						else
						{
							echo"<td>admin</td>";	
						}
						echo"<td><a href='del_user.php?id=$data[user_id]' style='color:#F0F;' onclick='return show_confirm();'>delete</a></td>";
							
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