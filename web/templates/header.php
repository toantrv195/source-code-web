<!DOCTYPE html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <?php
		if(isset($id))
		{
		//lấy title ở trong ccsdl hiển thị lên title
		
		//mở kết nối csdl
		require("library/config.php");
		//thực hiện câu truy vấn
		$result3=mysql_query("select title from news where news_id=$id");
		$data3=mysql_fetch_assoc($result3);
		echo"<title>$data3[title]</title>";
		
		//đóng kết nối csdl
		mysql_close($conn);	
		}
		else
		{
    		echo"<title>Bloggiotre.com</title>";
		}
	
	?>
    	<style>
        	#ads_right{
				position:fixed; bottom:0px; right:0px;	
			}
			#exit-ads{
				text-align:right; font-size:15px;	
			}
			#exit-ads a{
				background:#09F; padding:2px 4px; color:#FFF;
			}
			#content-ads{
				border:1px solid #06C;
			}
			#look-ads{
				display:none; text-align:right; font-size:15px;	
			}
			#look-ads a{
				background:#09F; padding:2px 4px; color:#FFF;
			}

        </style>
        
        <script type="text/javascript">
        	function hide_ads_right(){
				//ẩn div tắt quảng cáo
				document.getElementById("exit-ads").style.display="none";
				//ẩn div có chứa image
				document.getElementById("content-ads").style.display="none";
				//hiện div xem quảng cáo
				document.getElementById("look-ads").style.display="block";
				
			}
			function block_ads_right(){
				//hiện div tắt quảng cáo
				document.getElementById("exit-ads").style.display="block";
				//hiện div có chứa image
				document.getElementById("content-ads").style.display="block";
				//ẩn div xem quảng cáo
				document.getElementById("look-ads").style.display="none";
				
				}
        </script>
        <!-- Thêm ruồi -->
		<!--<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
		<script src='http://www.techrum.vn/js/fly/flies-obj.js' type='text/javascript' var_1='true' var_2='false' var_3='false'></script>
<!-- Hết ruồi -->
    </head>
    
    <body>
    	
    	
            <div id="top">
            	<div id="top-left">
                	<a href="index.php">
                    	<img src="image/logo-bloggioitre.png" width="272" height="70">
                    </a>
                </div>
            	<div id="top-right">
                
                	<ul>
                    	<li>
                        	<form action="seach.php" method="get">
                        	  <input type="text" placeholder="nhập nội dung tìm kiếm" size="25px" name="seach"/>
                        	  <input type="submit" value="search" style="margin-right:5px;"/>
                          	</form>
                        </li>
                        
                    <?php
						//kiểm tra có tồn tại session["username"] không?
						if(isset($_SESSION["username"]))
						{
							echo "Welcome  ".$_SESSION['username']. " ,<a href='logout.php'>(logout)</a>";
						}
						else
						{
                    	echo"<li><img src='image/login.png'></li>";
                        echo"<li>|</li>";
                        echo"<li><a href='login.php'>Đăng nhập</a></li>";
                        echo"<li>|</li>";
                        echo"<li><a href='register.php'>Đăng kí</a></li>";
						}
					?>
                    
                    </ul>
                </div>
            </div>
            <div id="website">
            <div id="menu">
                <ul>
                    <li><a href="index.php"><img src="home_icon.png" width="16px" height="18px"/></a></li>
                    <?php
					//mở kết nối csdl
					require("library/config.php");
					//thực hiện câu truy vấn lấy cate_title ở trong csdl
					$result=mysql_query("select cate_id,cate_title from category");
					while($data=mysql_fetch_assoc($result))
					{ 
                    	echo"<li><a href='category.php?id=$data[cate_id]'>$data[cate_title]</li>";
					}
					//đóng kết nối csdl
					mysql_close($conn);
                    ?>
                </ul>
        	</div>
            <div style="clear:both"></div>
            <?php
			//mở kết nối csdl
			require("library/config.php");
			//thực hiện câu truy vấn
			$result2=mysql_query("select Url,images from quangcao where cm_check='Y' order by id_Qc desc");
			$data2=mysql_fetch_assoc($result2);
            echo"<div id='ads_right'>";
                	echo"<div id='exit-ads'><a href='javascript:void(0)' onclick='hide_ads_right()'>Tắt Quảng Cáo [X]</a></div>";
                    echo"<div id='content-ads'><a href='$data2[Url]' target='_blank'>";
                    echo"<img src='library/imageqc/$data2[images]' width='350px' height='250px'></a></div>";
                    echo"<div id='look-ads'><a href='javascript:void(0)' onclick='block_ads_right()'>Xem Quảng Cáo...</a></div>";
            echo"</div>";
			//đóng kết nối csdl
			mysql_close($conn);
			?>
            
            
            <div id="wrapper">