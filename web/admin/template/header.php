<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>blogteen.com</title>
    <script language="javascript">
    	function show_confirm(){
			if(confirm("bạn có muốn xóa dòng dữ liệu này?"))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
    </script>
    <script type="text/javascript" src="../library/ckeditor/ckeditor.js"></script>
    </head>
    
    <body>
    	<div id="top">
        	<h3 style="color:#FFF; font-weight:bold;">Trang quản trị Admin, <a href="../logout.php">(logout)</a></h3>
            
        </div>
            <div id="menu">
            	<ul>
                	 
                	<li style="padding-right: 26.5px;"><a href="list_user.php">quản lí thành viên</a></li>
                    <li style="padding-right: 26.5px;"><a href="list_category.php">quản lí chuyên muc</a></li>
                    <li style="padding-right: 26.5px;"><a href="list_article.php">quản lí bài viết</a></li>
                    <li style="padding-right: 26.5px;"><a href="list_comment.php">quản lí bình luận</a></li>
                    <li style="padding-right: 26.5px;"><a href="list_quangcao.php">quản lí quảng cáo</a></li>
                   
                </ul>
            </div>
        <div style="clear:both;"></div>