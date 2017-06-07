<?php
 
/* VALUES */
$id=$_POST['id'];
$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
$mesto=$_POST['mesto'];
$prim=$_POST['prim'];
$className=$_POST['className'];

// try to connect
include 'bd.php';
 
$sql = "UPDATE events SET title=?, start=?, end=?, mesto=?, prim=?, className=? WHERE id=?";
$q = $bdd->prepare($sql);
$q->execute(array($title,$start,$end,$mesto,$prim,$className,$id));
 
?>


