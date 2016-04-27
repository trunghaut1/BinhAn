<?php
$dbhost = 'localhost'; //Ten MySQL host
$dbuser = 'root'; // Ten tai khoan dang nhap host
$dbpass = ''; // Mat khau dang nhap
$dbname = 'database'; // Ten co so du lieu

$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die('Không thể kết nối cơ sở dữ liệu!');
mysql_set_charset('utf8', $conn);
mysql_select_db($dbname) or die('Không có cơ sở dữ liệu');
?>