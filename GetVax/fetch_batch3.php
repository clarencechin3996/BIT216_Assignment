<?php
//fetch.php
require('db.php');

$output = '';
$query = "SELECT * FROM batch where batchNo = '".$_POST['query']."'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <div class="data">
   <table class="table table-striped table table-bordered">
              <tr>
                <th>Expiry Date</th>
                <th>Quantity of doses available</th>
              </tr>';

 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["expiryDate"].'</td>
    <td>'.$row["quantityAvailable"].'</td>
    </tr>';
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