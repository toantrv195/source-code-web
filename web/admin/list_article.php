<?php
	require("template/header.php");
?>
    	<div id="wrapper">
        	<table>
            	<tr>
                	<td colspan="3"></td>
                    <td colspan="3"><a href="add_article.php" style="color:#C03;">Thêm bài viết</a></td>
                </tr>
            	<tr style="background:#096; color:#FFF;">
                	<th width="27">STT</th>
                    <th width="115">Chuyên mục</th>
                    <th width="538">Tiêu đề bài viết</th>
                    <th width="78">số lần xem</th>
                    <th width="50">Edit</th>
                    <th width="64">Delete</th>
                </tr>
                <?php
				//mở kết nối csdl
				require("../library/config.php");
				//thục hiện câu truy vấn
				$STT=1;
				$result=mysql_query("select a.news_id,a.title,a.views,b.cate_title from news as a,category as b where a.cate_id=b.cate_id");
				while($data=mysql_fetch_assoc($result))
				
				{
                echo"<tr>";
                	echo"<td>$STT</td>";
                    echo"<td>$data[cate_title]</td>";
                    echo"<td>$data[title]</td>";
                    echo"<td style='color:#900;'>$data[views]</td>";
                    echo"<td><a href='edit_article.php?id=$data[news_id]' style='color:#09C;'>edit</a></td>";
                    echo"<td><a href='del_article.php?id=$data[news_id] ' onclick='return show_confirm();' style='color:#F0F;'>delete</a></td>";
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