<?php
	session_start();
	require("templates/top.php");
	
	$loi=array();
	$loi["username"]=$loi["password"]=$loi["login"]=NULL;
	$username=$password=NULL;
	if(isset($_POST["ok"]))
	{
		//check có nhập user name  chưa
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
			$loi["password"]="* xin vui lòng nhập password";
		}
		else
		{
			$password=$_POST["txtpass"];
		}
		//xử lí đăng nhập
		if($username && $password)
		{
		//mở kết nối csdl
		require("library/config.php");
		//thực hiện câu truy vấn
			$result=mysql_query("select * from user where username='$username' and password='$password'");
			if(mysql_num_rows($result)==1)
			{
				$data=mysql_fetch_assoc($result);
				$_SESSION["level"]=$data["level"];
				if($_SESSION["level"]==2)
				{
					header("location:admin/admin.php");
					exit();	
				}
				else
				{
					$_SESSION["username"]=$username;
					header("location:index.php");
					exit();
				}
			}
			else
			{
				$loi["login"]="* thông tin đăng nhập không chính xác";	
			}
			
		//đóng kết nối csdl
			mysql_close($conn);	
		}
	}
?>

	<fieldset style="width:290px; height:100px; margin:100px auto 100px;">
    	<legend><h3>Login</h3></legend>
        <form action="login.php" method="post">
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
                	<td></td>
                    <td><input type="submit" value="login" name="ok"/></td>
                </tr>
            </table>
        </form>
        <div style=" width:250px; height:170px; margin:40px auto 40px; color:#F00;">
    	<?php
        	echo $loi["username"];
			echo $loi["password"];
			echo $loi["login"];
		?>
        </div>
    </fieldset>


<?php
	require("templates/footer.php");
?>