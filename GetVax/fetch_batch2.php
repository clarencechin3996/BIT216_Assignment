<?php
//fetch.php
require('db.php');

$output = '';
$query = "SELECT * FROM batch where vaccineID ='".$_POST['query2']."' and centreName = '".$_POST['query']."'";

$result = mysqli_query($conn, $query);
  $output .= '<option value="none">-</option>';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
  $output .= '<option value="'.$row["batchNo"].'">'.$row["batchNo"].'</option>';
 }
}
echo $output;

?>