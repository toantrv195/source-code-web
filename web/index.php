<?php
	session_start();
	require("templates/header.php");
?>			
            
    <div id="left">
        <div class="title">tin nổi bật</div>
        <div id="content">
            <div id="content-left">
            <?php
            //mở kết nối csdl
            require("library/config.php");
            $result=mysql_query("select news_id,images,title,introduce from news where hot_news=1 order by news_id desc");
            
            $data=mysql_fetch_assoc($result);
            ?>
                
                <img src='library/images/<?php echo"$data[images]"?>'>
                <h3><a href='detail.php?id=<?php echo"$data[news_id]"?>' target='_brank'><?php echo "$data[title]"?></a></h3>
                <p><?php echo"$data[introduce]"?></p>
                
            <?php
            //đóng kết nối csdl
            mysql_close($conn);
            ?>
            </div>
            <div id="content-right">
                <ul>
                <?php
                    //mở kết nối csdl
                    require("library/config.php");
                    //thực hiện câu truy vấn
                    $result2=mysql_query("select news_id,title from news where hot_news=1 order by news_id desc limit 1,6");
                    while($data2=mysql_fetch_assoc($result2))
                    {
                ?>
                    <li><a href='detail.php?id=<?php echo"$data2[news_id]"?>'target='_brank'><?php echo"$data2[title]"?></a></li>
                <?php
                    }
                    //đóng kết nối csdl
                    mysql_close($conn);
                ?>
                </ul>
            </div>
        </div>
        <div style="clear:both"></div>
        
        
        
       <?php
       // mở kết nối csdl
        require("library/config.php");
        
        echo"<div class='news'>";
        //thực hiện câu truy vấn
        $result5=mysql_query("select cate_id,cate_title from category");
        while($data5=mysql_fetch_assoc($result5))
        {
        ?>
           <div class='title'><?php echo"$data5[cate_title]"?></div>
           <div class='article'>
           
            <?php 
            //thực hiện câu truy vấn
            $result3=mysql_query("select news_id,title,images,introduce from news where cate_id=$data5[cate_id] order by news_id desc");
            $data3=mysql_fetch_assoc($result3);
            ?>
              <img src='library/images/<?php echo"$data3[images]"?>' width='320px'/>
               <h3><a href='detail2.php?id=<?php echo "$data3[news_id]"?>' target='_brank'><?php echo"$data3[title]"?></a></h3>
               <p><?php echo"$data3[introduce]"?></p>   
            </div>
            <div class='list-article'>
               <ul>
                   <li>
                   
                   <?php
                    //thực hiện câu truy vấn
                    $result4=mysql_query("select news_id,title,images from news where cate_id=$data5[cate_id] order by news_id desc limit 1,3");
                    while($data4=mysql_fetch_assoc($result4))
                    {
                    ?>
                         <a href='detail2.php?id=<?php echo"$data4[news_id]"?>' target='_brank'>
                        <div class='list-img'>
                            <img src='library/images/<?php echo"$data4[images]"?>' width='100px'/>
                       </div>
                        <div class='list-title'>
                            <h4><?php echo"$data4[title]"?></h4>
                        </div>
                      <div style='clear:both'></div>
                            </a>
                    <?php
                    } 
                    ?>
                  
                    </li>
                </ul>
          </div>
    <div style='clear:both'></div>
    <?php 
		}
    //đóng kết nối csdl
    mysql_close($conn);
    ?>
    </div>  
    </div> 
   </div>
                 
                
<?php
	require("templates/content-right.php");
	require("templates/footer.php");
?>