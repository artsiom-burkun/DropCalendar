<?php
 
$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
$mesto=$_POST['mesto'];
$prim=$_POST['prim'];
$className=$_POST['className'];

// try to connect
include 'bd.php';
 
$sql = "INSERT INTO events (title, start, end, mesto, prim, className) VALUES (:title, :start, :end, :mesto, :prim, :className)";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end, ':mesto'=>$mesto, ':prim'=>$prim, ':className'=>$className));

$id = $bdd->lastInsertId() + 1 - 1;
echo json_encode(array('status'=>'success','eventid'=>$id));
?>