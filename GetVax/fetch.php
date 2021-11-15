<?php
//fetch.php
require('db.php');

$output = '';
$query = "SELECT * FROM batch where vaccineID = '".$_POST['query']."'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="data">
          <h5>This vaccine is available in the following healthcare centers:</h5>
          <table class="table table-striped table table-bordered">
            <tr>
              <th>Name</th>
              <th>Address</th>
            </tr>
         
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["centreName"].'</td>
    <td>';
    $query2 = "SELECT * FROM healthcare_centre where centreName = '".$row["centreName"]."'";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_array($result2);
    $output .= $row2['address'];
    $output .= '</td></tr>';
 }
 $output .= '</table>
  </div>';
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>