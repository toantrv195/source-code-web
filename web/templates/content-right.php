
            
            <div id="right">
                	<div id="category">xem nhiều nhât</div>
                	<div class="list-box">
                    <?php
					//mở kết nối csdl
					require("library/config.php");
					//thực hiện câu truy vấn
					$result=mysql_query("select news_id,title,images from news order by views desc limit 10");
                   		echo"<ul>";
						while($data=mysql_fetch_assoc($result))
						{
                        	echo"<li>";
                            	echo"<a href='detail.php?id=$data[news_id]'>";
                            
                                   echo"<div class='img'>";
                                        echo"<img src='library/images/$data[images]' width='100px'/>";
                                    echo"</div>";
                                    echo"<div class='list-category'>";
                                        echo"<h4>$data[title]</h4>";
                                    echo"</div>";
                                    echo"<div style='clear:both'></div>";
                             
                            	echo"</a>";
                            echo"</li>";
						}
						//đóng kết nối csdl
						mysql_close($conn);
                       echo"</ul>";
					   ?>
                   </div>     	
                </div>