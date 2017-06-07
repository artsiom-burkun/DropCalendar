<?php
 
/* VALUES */
$id=$_POST['id'];
/*$id='13'; */

// try to connect
include 'bd.php';
 
$sql = "DELETE FROM events WHERE id=$id";
$q = $bdd->prepare($sql);
$q->execute();
 
echo json_encode(array('status'=>'success','eventid'=>$id));
?>