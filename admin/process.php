<?php
session_start();
//<editor-fold desc="Log Process">
if(isset($_POST['user']))
{
    require('../opendb.php');
    $sql = sprintf('select * from user where ID = "%s"',$_POST['user']);
    $recordset = mysql_query($sql);
    if(mysql_num_rows($recordset) != 1)
    {
        require('../closedb.php'); 
        echo "errID"; exit;
    }
    else
    {
        $record = mysql_fetch_assoc($recordset);
        $pass = crypt($_POST['pass'],'$1$acc$');
        if($record['Password'] == $pass)
        {
            $_SESSION['admin']['Name'] = $record['Name'];
            $_SESSION['admin']['ID'] = $record['ID'];
            require('../closedb.php');
            echo "success"; exit;
        }
        else {
            require('../closedb.php');
            echo "errPass"; exit;
        }
    }
}
if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == 1)
{
    $_SESSION['admin'] = NULL;
    header('Location:index.php');
}
//</editor-fold>
//<editor-fold desc="Info Process"> 
if(isset($_POST['txtShortName']))
{
    $des = str_replace("\n", "<br/>", $_POST['txtDes']);
    require('../opendb.php'); 
    $sql = sprintf("update information set ShortName = '%s', LongName = '%s', Description = '%s', Email = '%s', "
            . "Phone1 = '%s', Phone2 = '%s', Fax = '%s', Address = '%s', OpenHour = '%s', Facebook = '%s' where ID = 1"
            ,$_POST['txtShortName'],$_POST['txtLongName'],$des,$_POST['txtEmail'],
            $_POST['txtPhone1'],$_POST['txtPhone2'],$_POST['txtFax'],$_POST['txtAddress'],
            $_POST['txtOpenHour'],$_POST['txtFacebook']);
    $maps = sprintf("update googlemaps set Latitude = '%s', Longitude = '%s' where ID = 1",$_POST['txtLatitude'],
            $_POST['txtLongitude']);
    $path = '../images/';
    $result = mysql_query($sql);
    $result2 = mysql_query($maps);
    if($result && $result2)
    {
        require('../closedb.php');
        if($_FILES['imgPic']['name'] != NULL)
            move_uploaded_file($_FILES['imgPic']['tmp_name'],$path.'logo.png');
        echo "success"; exit;
    }
    else
    {
        require('../closedb.php'); 
        echo "err"; exit;
    }
}
//</editor-fold>
//<editor-fold desc="Slider Process">
if(isset($_POST['SliderAdd']))
{
    require('../opendb.php'); 
    $path = 'images/slider/';
    $img = $path.$_FILES['imgPic']['name'];
    $sql = sprintf("insert into slider (Img,Cap1,Cap2,Href,Href_text) value ('%s','%s','%s','%s','%s')",
            $img,$_POST['txtCap1'],$_POST['txtCap2'],$_POST['txtHref'],$_POST['txtHref_text']);
    $result = mysql_query($sql);
    if($result)
    {
        $path = '../'.$path;
        if($_FILES['imgPic']['name'] != NULL)
            move_uploaded_file($_FILES['imgPic']['tmp_name'],$path.$_FILES['imgPic']['name']);
        require('../closedb.php'); 
        echo "add_done"; exit;
    }
    else
    {
        require('../closedb.php'); 
        echo "err_add"; exit;
    }
}
if(isset($_POST['SliderEdit']))
{
    require('../opendb.php'); 
    $path = 'images/slider/';
    if($_FILES['imgPic']['name'] != NULL)
    {
        $img = $path.$_FILES['imgPic']['name'];
        $sql = sprintf("update slider set Img = '%s', Cap1 = '%s', Cap2 = '%s', Href = '%s', Href_text = '%s' where ID = '%s'",
                $img,$_POST['txtCap1'],$_POST['txtCap2'],$_POST['txtHref'],$_POST['txtHref_text'],$_POST['txtID']);
        $result = mysql_query($sql);
        if($result)
        {
            $path = '../'.$path;
            move_uploaded_file($_FILES['imgPic']['tmp_name'],$path.$_FILES['imgPic']['name']);
            require('../closedb.php');
            echo "edit_done"; exit;
        }
        else {
            require('../closedb.php');
            echo "err_edit"; exit;
        }
    }
 else {
        $sql = sprintf("update slider set Cap1 = '%s', Cap2 = '%s', Href = '%s', Href_text = '%s' where ID = '%s'",
                $_POST['txtCap1'],$_POST['txtCap2'],$_POST['txtHref'],$_POST['txtHref_text'],$_POST['txtID']);
        $result = mysql_query($sql);
        if($result)
        {
            require('../closedb.php');
            echo "edit_done"; exit;
        }
        else {
            require('../closedb.php');
            echo "err_edit"; exit;
        }
    }
}
if(isset($_REQUEST['slider_del']))
{
    require('../opendb.php'); 
    $sql = sprintf("delete from slider where ID = '%s'",$_REQUEST['slider_del']);
    $result = mysql_query($sql);
    if($result)
    {
        require('../closedb.php');
        header('Location:slider.php');
    }
 else {
       require('../closedb.php');
       header('Location:slider.php?error');
    }
} 
//</editor-fold>
//<editor-fold desc="Service Process"> 
if(isset($_POST['ServiceAdd']))
{
    require('../opendb.php'); 
    $sql = sprintf("insert into service (Name,Icon,Description) value ('%s','%s','%s')",
            $_POST['txtName'],$_POST['txtIcon'],$_POST['txtDes']);
    $result = mysql_query($sql);
    if($result)
    {
        require('../closedb.php'); 
        echo "success"; exit;
    }
    else
    {
        require('../closedb.php'); 
        echo "err"; exit;
    }
}
if(isset($_POST['ServiceEdit']))
{
    require('../opendb.php'); 
        $sql = sprintf("update service set Name = '%s', Icon = '%s', Description = '%s' where ID = '%s'",
                $_POST['txtName'],$_POST['txtIcon'],$_POST['txtDes'],$_POST['txtID']);
        $result = mysql_query($sql);
        if($result)
        {
            require('../closedb.php');
            echo "success"; exit;
        }
        else {
            require('../closedb.php');
            echo "err"; exit;
        }
}
if(isset($_REQUEST['service_del']))
{
    require('../opendb.php'); 
    $sql = sprintf("delete from service where ID = '%s'",$_REQUEST['service_del']);
    $result = mysql_query($sql);
    if($result)
    {
        require('../closedb.php');
        header('Location:service.php');
    }
 else {
       require('../closedb.php');
       header('Location:service.php?error');
    }
}
//</editor-fold>
//<editor-fold desc="Team Process">
if(isset($_POST['TeamAdd']))
{
    require('../opendb.php'); 
    $path = 'images/team/';
    $img = $path.$_FILES['imgPic']['name'];
    $sql = sprintf("insert into founder (Name,Position,Description,Picture,Facebook) value ('%s','%s','%s','%s','%s')",
            $_POST['txtName'],$_POST['txtPos'],$_POST['txtDes'],$img,$_POST['txtFacebook']);
    $result = mysql_query($sql);
    if($result)
    {
        $path = '../'.$path;
        if($_FILES['imgPic']['name'] != NULL)
            move_uploaded_file($_FILES['imgPic']['tmp_name'],$path.$_FILES['imgPic']['name']);
        require('../closedb.php'); 
        echo "success"; exit;
    }
    else {
        require('../closedb.php'); 
        echo "err"; exit;
    }
}
if(isset($_POST['TeamEdit']))
{
    require('../opendb.php'); 
    $path = 'images/slider/';
    if($_FILES['imgPic']['name'] != NULL)
    {
        $img = $path.$_FILES['imgPic']['name'];
        $sql = sprintf("update founder set Name = '%s', Position = '%s', Description = '%s', Picture = '%s',"
                . " Facebook = '%s' where ID = '%s'",
                $_POST['txtName'],$_POST['txtPos'],$_POST['txtDes'],$img,$_POST['txtFacebook'],$_POST['txtID']);
        $result = mysql_query($sql);
        if($result)
        {
            $path = '../'.$path;
            move_uploaded_file($_FILES['imgPic']['tmp_name'],$path.$_FILES['imgPic']['name']);
            require('../closedb.php');
            echo "success"; exit;
        }
        else {
            require('../closedb.php');
            echo "err"; exit;
        }
    }
 else {
        $sql = sprintf("update founder set Name = '%s', Position = '%s', Description = '%s',"
                . " Facebook = '%s' where ID = '%s'",
                $_POST['txtName'],$_POST['txtPos'],$_POST['txtDes'],$_POST['txtFacebook'],$_POST['txtID']);
        $result = mysql_query($sql);
        if($result)
        {
            require('../closedb.php');
            echo "success"; exit;
        }
        else {
            require('../closedb.php');
            echo "err"; exit;
        }
    }
}
if(isset($_REQUEST['team_del']))
{
    require('../opendb.php'); 
    $sql = sprintf("delete from founder where ID = '%s'",$_REQUEST['team_del']);
    $result = mysql_query($sql);
    if($result)
    {
        require('../closedb.php');
        header('Location:team.php');
    }
 else {
       require('../closedb.php');
       header('Location:team.php?error');
    }
}
//</editor-fold>
//<editor-fold desc="News Process"> 
if(isset($_POST['NewsEdit']))
{
    require('../opendb.php'); 
    $path = 'images/blog/';
    if(file_exists($_FILES['imgPic']['tmp_name']) || is_uploaded_file($_FILES['imgPic']['tmp_name']))
    {
        $img = $path.$_FILES['imgPic']['name'];
    }
    if($_FILES['imgPic']['name'] != NULL) {
        $img = $path.$_FILES['imgPic']['name'];
        $sql = sprintf("update news set Title = '%s', Description = '%s', Picture = '%s', Content = '%s' "
                . "where ID = '%s'",$_POST['txtTitle'],$_POST['txtDes'],$img,$_POST['txtContent'],$_POST['txtID']);
        $result = mysql_query($sql);
        if($result)
        {
            $path = '../'.$path;
            move_uploaded_file($_FILES['imgPic']['tmp_name'],$path.$_FILES['imgPic']['name']);
            require('../closedb.php'); 
            echo "success"; exit;
        }
        else {
            require('../closedb.php'); 
            echo "err"; exit;
        }
    }
    else
    {
        $sql = sprintf("update news set Title = '%s', Description = '%s', Content = '%s' "
                . "where ID = '%s'",$_POST['txtTitle'],$_POST['txtDes'],$_POST['txtContent'],$_POST['txtID']);
        $result = mysql_query($sql);
        if($result)
        {
            require('../closedb.php'); 
            echo "success"; exit;
        }
        else {
            require('../closedb.php'); 
            echo "err"; exit;
        }
    }
}
if(isset($_POST['NewsAdd']))
{
    require('../opendb.php'); 
    $path = 'images/blog/';
    $img = $path.$_FILES['imgPic']['name'];
    $date = new DateTime();
    $sql = sprintf("insert into news (Title,Description,Content,Picture,Date) value ('%s','%s','%s','%s','%s')",
            $_POST['txtTitle'],$_POST['txtDes'],$_POST['txtContent'],$img,$date->format('Y-m-d'));
    $result = mysql_query($sql);
    if($result)
    {
        $path = '../'.$path;
        if($_FILES['imgPic']['name'] != NULL)
            move_uploaded_file($_FILES['imgPic']['tmp_name'],$path.$_FILES['imgPic']['name']);
        require('../closedb.php'); 
        echo "success"; exit;
    }
    else {
        require('../closedb.php'); 
        echo "err"; exit;
    }
}
if(isset($_REQUEST['news_del']))
{
    require('../opendb.php'); 
    $sql = sprintf("delete from news where ID = '%s'",$_REQUEST['news_del']);
    $result = mysql_query($sql);
    if($result)
    {
        require('../closedb.php');
        header('Location:news.php');
    }
 else {
       require('../closedb.php');
       header('Location:news.php?error');
    }
}
//</editor-fold>
//<editor-fold desc="User Process"> 
if(isset($_POST['UserAdd']))
{
    require('../opendb.php');
    $pass = crypt($_POST['txtPass'],'$1$acc$');
    $sql = sprintf("insert into user (ID,Password,Name) value ('%s','%s','%s')",
            $_POST['txtID'],$pass,$_POST['txtName']);
    $result = mysql_query($sql);
    if($result)
    {
        require('../closedb.php'); 
        echo "success"; exit;
    }
    else
    {
        require('../closedb.php'); 
        echo "err"; exit;
    }
}
if(isset($_POST['UserEdit']))
{
    require('../opendb.php'); 
    $pass = crypt($_POST['txtPass'],'$1$acc$');
    $check = sprintf("select * from user where ID = '%s' and Password = '%s'",$_POST['txtOldID'],$pass);
    $recordset = mysql_query($check);
    if(mysql_num_rows($recordset) != 1) {
        require('../closedb.php');
        echo "error_pass"; exit;
    } else {
        if($_POST['txtNewPass'] != '') {
            $pass = crypt($_POST['txtNewPass'],'$1$acc$'); 
            $sql = sprintf("update user set ID = '%s', Password = '%s', Name = '%s' where ID = '%s'",
                $_POST['txtID'],$pass,$_POST['txtName'],$_POST['txtOldID']);
        }
        else {
            $sql = sprintf("update user set ID = '%s', Name = '%s' where ID = '%s'",
                $_POST['txtID'],$_POST['txtName'],$_POST['txtOldID']);
        }
        $result = mysql_query($sql);
        if($result)
        {
            require('../closedb.php');
            echo "success"; exit;
        }
        else {
            require('../closedb.php');
            echo "err"; exit;
        }
    }
}
if(isset($_REQUEST['user_del']))
{
    require('../opendb.php'); 
    $check = sprintf("select * from user");
    $recordset = mysql_query($check);
    if(mysql_num_rows($recordset) == 1) {
         header('Location:user.php?error');
    } else {
        $sql = sprintf("delete from user where ID = '%s'",$_REQUEST['user_del']);
        $result = mysql_query($sql);
        if($result)
        {
            require('../closedb.php');
            header('Location:user.php');
        }
        else {
           require('../closedb.php');
           header('Location:user.php?error');
        }
    }
}
//</editor-fold>
?>

