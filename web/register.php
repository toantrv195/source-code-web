<?php
	require("templates/top.php");
	
	$loi=array();
	$loi["username"]=$loi["password"]=$loi["email"]=$loi["birthday"]=$loi["gender"]=$loi["register"]=NULL;
	$username=$password=$email=$day=$month=$year=$gender=NULL;
	if(isset($_POST["ok"]))
	{	//check có nhập username chưa
		if(empty($_POST["txtname"]))
		{
			$loi["username"]="* xin vui lòng nhập username<br/>";
		}
		else
		{
			$username=$_POST["txtname"];
		}
		//check có nhập password chưa
		if(empty($_POST["txtpass"]))
		{
			$loi["password"]="* xin vui lòng nhập password<br/>";
		}
		else
		{
			$password=$_POST["txtpass"];
		}
		//checks có nhập e mail chưa
		if(empty($_POST["txtmail"]))
		{
			$loi["email"]="*xin vui lòng nhập email<br/>";
		}
		else
		{
			$email=$_POST["txtmail"];
		}
		//check có chọn birthday chưa
		if($_POST["day"]=="ngay" || $_POST["month"]=="thang" || $_POST["year"]=="nam")
		{
			$loi["birthday"]="*xin vui lòng chọn birthday<br/>";
		}
		else
		{
			$day=$_POST["day"];
			$month=$_POST["month"];
			$year=$_POST["year"];
		}
		//check có chọn gender chưa
		if(empty($_POST["gender"]))
		{
			$loi["gender"]="*xin vui lòng chọn gender<br/>";
		}
		else
		{
			$gender=$_POST["gender"];	
		}
		//xử lí đăng nhập
		if($username && $password && $email && $day && $month && $year && $gender)
		{
		//mở kết nối csdl
		require("library/config.php");
		
		//thưc hiện câu truy vấn
			$result=mysql_query("select * from user where username='$username'");
			if(mysql_num_rows($result)==0)
			{
				mysql_query("insert into user(username,password,email,birthday,gender,level)
										value('$username','$password','$email','$year-$month-$day','$gender','1')");
				$loi["register"]="đăng kí thành công, <a href='login.php'>login</a>vào website<br/>";
			}
			else
			{
				$loi["register"]="username của bạn đã có người đăng ký";
			}
				
		//đóng kết nối csdl
		mysql_close($conn);
		}
	}
		
?>

	<fieldset style="width:290px; height:190px; margin:100px auto 100px;">
    	<legend><h3>Register</h3></legend>
        <form action="register.php" method="post">
        	<table>
            	<tr>
                	<td>username</td>
                    <td><input type="text" size="22" name="txtname"/></td>
                </tr>
                <tr>
                	<td>password</td>
                    <td><input type="password" size="22px" name="txtpass"/></td>
                </tr>
                <tr>
                	<td>email</td>
                    <td><input type="email" size="22" name="txtmail"/></td>
                </tr>
                <tr>
                	<td>birthday</td>
                    <td>
                    	<select name="day">
                        	<option value="ngay">ngày</option>
                            <?php
                            	for($i=1;$i<=31;$i++)
								{
									echo"<option>$i</option>";
								}
							?>
                        </select>
                        <select name="month">
                        	<option value="thang">tháng</option>
                        	<?php
                            	$thang=array(1=>"jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
								foreach($thang as $key=>$tam)
								{
									echo"<option value='$key'>$tam</option>";
								}
							?>
                        </select>
                        <select name="year">
                        	<option value="nam">năm</option>
                            <?php
                            	for($j=1950;$j<=date("Y");$j++)
								{
									echo"<option>$j</option>";	
								}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>gender</td>
                    <td>
                    	<input type="radio" name="gender" value="1"/>mail
                        <input type="radio" name="gender" value="2"/>femail
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" value="Register" name="ok"/></td>
                </tr>
            </table>
            
        </form>
        
        <div style=" width:250px; height:170px; margin:40px auto 40px; color:#F00;">
    	<?php
        	echo $loi["username"];
			echo $loi["password"];
			echo $loi["email"];
			echo $loi["birthday"];
			echo $loi["gender"];
			echo $loi["register"];
		?>
    	</div>

    </fieldset>
    

<?php
	require("templates/footer.php");
?>