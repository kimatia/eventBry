<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
  header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();
$bookID=$_GET['id'];

?>
<style type="text/css">
  .table tbody tr td:not(:first-child) {
  border: 1px solid blue;
}

.table tbody tr td:first-child {
  font-weight:bold;
}

.table tr td:nth-child(5) {
  border:none!important;
}

.table {
  border-spacing: 3em;
}
</style>
<table class="table">
<thead>
  <tr>
    <td></td>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td></td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
  </tr>
</thead>
<tbody>

<?php
$rowA="A";
$rowB="B";
$rowC="C";
$rowD="D";
$rowE="E";
$rowF="F";
$one=0;
$two=1;
$three=2;
?>
  <tr>
    <td>A</td>
    <?php
$stmt_select = $DB_con->prepare('SELECT * FROM tbl_seats WHERE row =:uid');
    $stmt_select->execute(array(':uid'=>$rowA));
    if($stmt_select->rowCount() > 0)
    {
        while($row=$stmt_select->fetch(PDO::FETCH_ASSOC))
        {
    
if($row['status']==$one){
 ?>
<td><a href="bookComment.php?book_id=<?php echo $bookID ?>&seat_id=<?php echo $row['id'] ?>" title="book"><img src="svg/chair (3).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$two){
  ?>
<td><a href="#" title="Reserved"><img src="svg/chair (2).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$three){
  ?>
 <td><a href="#" title="Booked"><img src="svg/chair.svg" height="50" width="50"></a></td>
 <?php
}
    
     }
  }
 ?>
  </tr>
  <tr>
    <td>B</td>
    <?php
$stmt_select_B = $DB_con->prepare('SELECT * FROM tbl_seats WHERE row =:uid');
    $stmt_select_B->execute(array(':uid'=>$rowB));
    if($stmt_select_B->rowCount() > 0)
    {
        while($row=$stmt_select_B->fetch(PDO::FETCH_ASSOC))
        {
            if($row['status']==$one){
 ?>
<td><a href="bookComment.php?book_id=<?php echo $bookID ?>&seat_id=<?php echo $row['id'] ?>" title="book"><img src="svg/chair (3).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$two){
  ?>
<td><a href="#" title="Reserved"><img src="svg/chair (2).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$three){
  ?>
 <td><a href="#" title="Booked"><img src="svg/chair.svg" height="50" width="50"></a></td>
 <?php
}
     }
  }
 ?>
  </tr>
  <tr>
    <td>C</td>
    <?php
$stmt_select_C = $DB_con->prepare('SELECT * FROM tbl_seats WHERE row =:uid');
    $stmt_select_C->execute(array(':uid'=>$rowC));
    if($stmt_select_C->rowCount() > 0)
    {
        while($row=$stmt_select_C->fetch(PDO::FETCH_ASSOC))
        {
            if($row['status']==$one){
 ?>
<td><a href="bookComment.php?book_id=<?php echo $bookID ?>&seat_id=<?php echo $row['id'] ?>" title="book"><img src="svg/chair (3).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$two){
  ?>
<td><a href="#" title="Reserved"><img src="svg/chair (2).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$three){
  ?>
 <td><a href="#" title="Booked"><img src="svg/chair.svg" height="50" width="50"></a></td>
 <?php
}
     }
  }
 ?>
  </tr>
  <tr>
    <td>D</td>
    <?php
$stmt_select_D = $DB_con->prepare('SELECT * FROM tbl_seats WHERE row =:uid');
    $stmt_select_D->execute(array(':uid'=>$rowD));
    if($stmt_select_D->rowCount() > 0)
    {
        while($row=$stmt_select_D->fetch(PDO::FETCH_ASSOC))
        {
            if($row['status']==$one){
 ?>
<td><a href="bookComment.php?book_id=<?php echo $bookID ?>&seat_id=<?php echo $row['id'] ?>" title="book"><img src="svg/chair (3).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$two){
  ?>
<td><a href="#" title="Reserved"><img src="svg/chair (2).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$three){
  ?>
 <td><a href="#" title="Booked"><img src="svg/chair.svg" height="50" width="50"></a></td>
 <?php
}
     }
  }
 ?>
  </tr>
  <tr>
    <td>E</td>
    <?php
$stmt_select_E = $DB_con->prepare('SELECT * FROM tbl_seats WHERE row =:uid');
    $stmt_select_E->execute(array(':uid'=>$rowE));
    if($stmt_select_E->rowCount() > 0)
    {
        while($row=$stmt_select_E->fetch(PDO::FETCH_ASSOC))
        {
           if($row['status']==$one){
 ?>
 <td><a href="bookComment.php?book_id=<?php echo $bookID ?>&seat_id=<?php echo $row['id'] ?>" title="book"><img src="svg/chair (3).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$two){
  ?>
<td><a href="#" title="Reserved"><img src="svg/chair (2).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$three){
  ?>
 <td><a href="#" title="Booked"><img src="svg/chair.svg" height="50" width="50"></a></td>
 <?php
}
     }
  }
 ?>
  </tr>
  <tr>
    <td>F</td>
    <?php
$stmt_select_F = $DB_con->prepare('SELECT * FROM tbl_seats WHERE row =:uid');
    $stmt_select_F->execute(array(':uid'=>$rowF));
    if($stmt_select_F->rowCount() > 0)
    {
        while($row=$stmt_select_F->fetch(PDO::FETCH_ASSOC))
        {
          if($row['status']==$one){
 ?>
 <td><a href="bookComment.php?book_id=<?php echo $bookID ?>&seat_id=<?php echo $row['id'] ?>" title="book"><img src="svg/chair (3).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$two){
  ?>
<td><a href="#" title="Reserved"><img src="svg/chair (2).svg" height="50" width="50"></a></td>
 <?php
}elseif($row['status']==$three){
  ?>
 <td><a href="#" title="Booked"><img src="svg/chair.svg" height="50" width="50"></a></td>
 <?php
}
     }
  }
 ?>
  </tr>
 
</tbody>
</table>