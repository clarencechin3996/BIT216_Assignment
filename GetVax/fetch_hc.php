<?php
//fetch.php
require('db.php');

$output = '';
$query = "SELECT * FROM batch where vaccineID = '".$_POST['query']."'";

$result = mysqli_query($conn, $query);
  $output .= '<option value="none">-</option>';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
  $output .= '<option value="'.$row["centreName"].'">'.$row["centreName"].'</option>';
 }
}
echo $output;

?>