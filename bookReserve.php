<?php
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
// $DBcon->close();

if(isset($_POST['btnsave'])){
  $reserveId=$_POST['id'];
 $id = $userRow['user_id'];
  $roomType = $_POST['roomtype'];// user content
   $roomName = $_POST['roomname'];
    $roomPrice = $_POST['roomprice'];
      $roomSize = $_POST['roomsize'];
       $startDate = $_POST['startdate'];
        $endDate = $_POST['enddate'];
        $duration = $_POST['duration'];
        $bookReserve = $userRow['username'];
            $stmt = $DB_con->prepare('INSERT INTO tbl_bookReserve(postId,venueId,roomType,roomName,roomPrice,roomSize, startDate,endDate,duration,bookReservePerson) VALUES(:pId,:vId,:rtype,:rname,:rprice,:rsize,:sdate,:edate,:duration,:bRperson)');
            $stmt->bindParam(':pId',$id);
            $stmt->bindParam(':vId',$reserveId);
               $stmt->bindParam(':rtype',$roomType);
               $stmt->bindParam(':rname',$roomName);
                $stmt->bindParam(':rprice',$roomPrice);
                 $stmt->bindParam(':rsize',$roomSize);
                $stmt->bindParam(':sdate',$startDate);
                $stmt->bindParam(':edate',$endDate);
                 $stmt->bindParam(':duration',$duration);
                  $stmt->bindParam(':bRperson',$bookReserve);
                 
                 $book=1;
 $sql = $con->prepare("UPDATE tbl_venue SET status=? WHERE id=?");
 $sql->bind_param("ii",$book,$_GET['book_id']);
 $sql->execute();

  $booktwo=1;
 $sqltwo = $con->prepare("UPDATE tbl_bookReserve SET status=? WHERE postId=?");
 $sqltwo->bind_param("ii",$booktwo,$id);
 $sqltwo->execute();

            if($stmt->execute()){
               ?>
<script type="text/javascript">
  alert('Venue booked');
</script>
               <?php
            }
            else{
              echo "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>Error while inserting data
           </div>";
            }
}
if(isset($_POST['btnsavereserve'])){
 $reserveId=$_POST['id'];
 $id = $userRow['user_id'];
  $roomType = $_POST['roomtype'];
   $roomName = $_POST['roomname'];
    $roomPrice = $_POST['roomprice'];
      $roomSize = $_POST['roomsize'];
       $startDate = $_POST['startdate'];
        $endDate = $_POST['enddate'];
        $duration = $_POST['duration'];
        $status= 2;
        $bookReserve = $userRow['username'];
    $stmt = $DB_con->prepare('INSERT INTO tbl_bookReserve(postId,venueId,roomType,roomName,roomPrice,roomSize, startDate,endDate,duration,status,bookReservePerson) VALUES(:pId,:vId,:rtype,:rname,:rprice,:rsize,:sdate,:edate,:duration,:status,:bRperson)');
              $stmt->bindParam(':pId',$id);
              $stmt->bindParam(':vId',$reserveId);
               $stmt->bindParam(':rtype',$roomType);
               $stmt->bindParam(':rname',$roomName);
                $stmt->bindParam(':rprice',$roomPrice);
                 $stmt->bindParam(':rsize',$roomSize);
                $stmt->bindParam(':sdate',$startDate);
                $stmt->bindParam(':edate',$endDate);
                 $stmt->bindParam(':duration',$duration);
                 $stmt->bindParam(':status',$status);
                  $stmt->bindParam(':bRperson',$bookReserve);
                 
$reserve=2;
 $sql = $con->prepare("UPDATE tbl_venue SET status=? WHERE id=?");
 $sql->bind_param("ii",$reserve,$_GET['reserve_id']);
 $sql->execute();

  $reservetwo=2;
 $sqltwo = $con->prepare("UPDATE tbl_bookReserve SET status=? WHERE postId=?");
 $sqltwo->bind_param("ii",$booktwo,$id);
 $sqltwo->execute();
            if($stmt->execute()){
               ?>
<script type="text/javascript">
  alert('Venue reserved');
</script>
               <?php
            }
            else{
              echo "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>Error while inserting data
           </div>";
            }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="ownerhome.php">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- navs -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo "Hello Admin ".$userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="row" style="padding-top: 100px;">
  <div class="col-md-5 col-md-offset-1">
    <div class="panel panel-primary"> 
      <?php
if(isset($_GET['book_id'])){

        $idd = $_GET['book_id'];
        $stmt_select = $DB_con->prepare('SELECT * FROM tbl_venue WHERE id =:uid');
        $stmt_select->execute(array(':uid'=>$idd));
        $venue_select = $stmt_select->fetch(PDO::FETCH_ASSOC);
  $bookedRoom=$_GET['book_id'];
  ?>
   <div class="panel heading">
       <h4 style="color: blue;"><center>Book Venue</center></h4>
      </div>
       <div class="panel body">
      
 <form method="post" role="form" type="multipart/form-data" >
         <input class="form-control" type="text" name="roomname" id="roomname" value="<?php echo $venue_select['roomName'];?>" placeholder="Enter room name" >
     <br/>
     <input class="form-control" type="text" name="roomtype" id="roomtype" value="<?php echo $venue_select['roomType'];?>" placeholder="Enter room name" >
    <br/>
    <input class="form-control" type="text" name="roomprice" id="roomprice" value="<?php echo $venue_select['roomPrice'];?>" placeholder="Enter room price" >
     <br/>
     <input class="form-control" type="text" name="roomsize" id="roomsize" value="<?php echo $venue_select['roomSize'];?>" placeholder="Enter room size" >
     <br/>
    <input class="form-control " type="date" name="startdate" id="startdate" value="<?php echo $venue_select['startDate'];?>" placeholder="Enter start Date" >
     <br/>
    <input class="form-control " type="date" name="enddate" id="enddate" value="<?php echo $venue_select['endDate'];?>"  placeholder="Enter end Date" >
     <br/>
    <input class="form-control" type="text" name="duration" id="duration" value="<?php echo $venue_select['duration'];?>" placeholder="Enter expected duration" >
     <br/>
    
     <input type="hidden" name="id" value="<?php echo $venue_select['id'];?>">
      <?php
if($venue_select['status']==1){
 echo "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>The venue is booked
           </div>";
}elseif($venue_select['status']==2){
   echo "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>The venue is reserved
           </div>";
}elseif($venue_select['status']==0){
  ?>
<button class="btn btn-lg btn-success btn-block" type="submit" name="btnsave">Book Venue</button>
  <?php
}
     ?>
     
    </form>
  <?php
}elseif(isset($_GET['reserve_id'])){
    $idd = $_GET['reserve_id'];
        $stmt_select = $DB_con->prepare('SELECT * FROM tbl_venue WHERE id =:uid');
        $stmt_select->execute(array(':uid'=>$idd));
        $venue_select = $stmt_select->fetch(PDO::FETCH_ASSOC);
  $bookedRoom=$_GET['reserve_id'];
  ?>
   <div class="panel heading">
       <h4 style="color: blue;"><center>Reserve Venue</center></h4>
      </div>
       <div class="panel body">
 <form method="post" role="form" type="multipart/form-data" >
         <input class="form-control" type="text" name="roomname" id="roomname" value="<?php echo $venue_select['roomName'];?>" placeholder="Enter room name" >
     <br/>
     <input class="form-control" type="text" name="roomtype" id="roomtype" value="<?php echo $venue_select['roomType'];?>" placeholder="Enter room name" >
    <br/>
    <input class="form-control" type="text" name="roomprice" id="roomprice" value="<?php echo $venue_select['roomPrice'];?>" placeholder="Enter room price" >
     <br/>
     <input class="form-control" type="text" name="roomsize" id="roomsize" value="<?php echo $venue_select['roomSize'];?>" placeholder="Enter room size" >
     <br/>
    <input class="form-control " type="date" name="startdate" id="startdate" value="<?php echo $venue_select['startDate'];?>" placeholder="Enter start Date" >
     <br/>
    <input class="form-control " type="date" name="enddate" id="enddate" value="<?php echo $venue_select['endDate'];?>"  placeholder="Enter end Date" >
     <br/>
    <input class="form-control" type="text" name="duration" id="duration" value="<?php echo $venue_select['duration'];?>" placeholder="Enter expected duration" >
     <br/>
    <input type="hidden" name="id" value="<?php echo $venue_select['id'];?>">
       <?php
if($venue_select['status']==1){
 echo "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>The venue is booked
           </div>";
}elseif($venue_select['status']==2){
   echo "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>The venue is reserved
           </div>";
}elseif($venue_select['status']==0){
  ?>
<button class="btn btn-lg btn-success btn-block" type="submit" name="btnsave">Book Venue</button>
  <?php
}
     ?>
    </form>
  <?php
}
?>
      </div>
     
    </div>
  </div>
  <div class="col-md-6 ">
  <div class="row">
    <div class="panel panel-primary">
      <div class="panel heading">
       <h4 style="color: blue;"><center>Booking Status</center></h4>
      </div>
      <div class="panel-body" style="overflow-y: scroll;max-height: 720px;">
      <table  width="100%"  border='2' align="center">
                <thead>
                <tr>
                 <th width="5%" style="color: #0099D3;">R.ID</th>
                    
                   <th width="5%" style="color: #0099D3;">R.Name</th>
                  <th width="5%" style="color: #0099D3;">R.Price</th>
                  <th width="5%" style="color: #0099D3;">Status</th> 
                   <th width="15%" style="color: #0099D3;">Event</th>
                    <th width="5%" style="color: #0099D3;">Action</th>
                          
                </tr>
                </thead>
                <tbody>
<?php

      $iddd = $userRow['user_id'];
        $stmt_select_venue = $DB_con->prepare('SELECT * FROM tbl_bookReserve WHERE postId =:uid');
        $stmt_select_venue->execute(array(':uid'=>$iddd));               
  
    if($stmt_select_venue->rowCount() > 0)
    {
        while($row=$stmt_select_venue->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>

           <?php
                        
                 echo '<tr>';
                  echo '<td width="5%">';
                    //individual data of invoice file
                     echo $row['id'];
                 echo '</td>';
                 
                  //charges
                  echo '<td width="5%">';
                    //individual data of invoice file
                     echo $row['roomName'];
                 echo '</td>';
                  //invoice image file
                  echo '<td width="5%">';
                 echo $row['roomPrice'];
                  echo '</td>';
                  
                echo '<td width="5%">';
                    //individual data of invoice file
                    if($row['status']==1){
                      echo "You Booked";
                    }elseif($row['status']==2){
                      echo "You Reserved";
                    }elseif($row['status']==0){
                      echo "Available";
                    }
                 echo '</td>';
                  echo '<td width="15%">';
                 echo $row['event'];
                  echo '</td>';
                 echo '<td width="5%">';
                 if($row['allocate']==0){
?>
<div class="col-md-4 ">
     <a href="allocate.php?allocate_id=<?php echo $row['id']; ?>&return_id=<?php echo $_GET['book_id'] || $_GET['reserve_id'];?>"><button class="btn  btn-success " type="submit" name="btn-login">&nbsp;&nbsp;Allocate&nbsp;&nbsp;</button></a>
  </div>
<?php
                 }elseif($row['allocate']==1){
?>
<div class="col-md-4 ">
<button class="btn  btn-danger " type="submit" name="btn-login">Allocated&nbsp;&nbsp;</button>
</div>
<?php
                 }
              ?>

              <?php
               echo '</td>';
                 
            
                 echo '</tr>';
                         
                    ?>
    
                <?php
        }
    }

?>  
  
  
             
                </tbody>
            </table>
           
      </div>
     </div>
    </div>
    
  </div>

</div>

</body>
</html>