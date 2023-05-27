<?php
include('./connect.php');
$id = $_GET['id'];
if(isset($id)){
    $sql = "delete from categories where id = $id";
    $statement = $db->query($sql);
    header("location: index.php");
}