<?php
//API for display 25 or 'limit' results on a page
header("Content-type:application/json");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Method:GET/POST");

$dbhandle = mysql_connect("localhost","root","magento");
//echo "<b>CONNECTED<b/>";
$selected = mysql_select_db("event",$dbhandle);

if($_GET['limit']=="")
    $limit=25;
else
    $limit=$_GET['limit'];

if($_GET['query']=="SEARCH")
    if($_GET['page']=="")
    {
        $page=1;
    }else
    {
        $page=$_GET['page'];
    }

$sn=($page-1)*$limit;

$sql="SELECT * FROM places2 limit ".$sn.",".$limit;
$result=mysql_query($sql);
$data=array();
$status=array();
if($result==true)
{
    while($rows=mysql_fetch_assoc($result))
    {
        $status[]=array('status'=>'success',);
        $data[]=array('title'=>$rows['title'],'address'=>$rows['address'],'country'=>$rows['country'],'image'=>$rows['image'],'description'=>$rows['description'],'serviceType'=>$rows['serviceType']);


    }
//print_r($data);
}
else
{
    $status[]=array('status'=>'failure');
}

print json_encode(array('Contacts'=>$data));


?>