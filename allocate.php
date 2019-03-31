<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
// $DBcon->close();


if(isset($_POST['btnsave'])){
    $allocate=$_GET['allocate_id'];
$numberofpeople=$_POST['numberofpeople'];
$eventname=$_POST['eventname'];
$eventDate=$_POST['eventDate'];
 $id = $userRow['user_id'];
  $roomType = $_POST['roomtype'];
   $roomName = $_POST['roomname'];
    $roomPrice = $_POST['roomprice'];
     $eventAllocator = $userRow['username'];
   $venueId=$_POST['venueId'];
    $stmt = $DB_con->prepare('INSERT INTO tbl_allocate(eventname,numberofpeople,eventDate,venueId,roomtype,roomname, roomPrice,postid,postUser,allocateId) VALUES(:ename,:npeople,:edate,:vId,:rtype,:rname,:rprice,:pid,:puser,:allocate)');
              $stmt->bindParam(':ename',$eventname);
              $stmt->bindParam(':npeople',$numberofpeople);
               $stmt->bindParam(':edate',$eventDate);
               $stmt->bindParam(':vId',$venueId);
                $stmt->bindParam(':rtype',$roomType);
                  $stmt->bindParam(':rname',$roomName);
                    $stmt->bindParam(':rprice',$roomPrice);
                      $stmt->bindParam(':pid',$id);
                       $stmt->bindParam(':puser',$eventAllocator);
                 $stmt->bindParam(':allocate',$allocate);
$idd=$_GET['allocate_id'];
  $reservetwo=1;
 $sqltwo = $con->prepare("UPDATE tbl_bookReserve SET allocate=? WHERE id=?");
 $sqltwo->bind_param("ii",$reservetwo,$idd);
 $sqltwo->execute();
            if($stmt->execute()){
               ?>
<script type="text/javascript">
  alert('Event created');
</script>

               <?php
        $iddd = $_GET['allocate_id'];
        $stmt_select_venue = $DB_con->prepare('SELECT * FROM tbl_allocate WHERE allocateId =:uid');
        $stmt_select_venue->execute(array(':uid'=>$iddd)); 
        $row_select=$stmt_select_venue->fetch(PDO::FETCH_ASSOC);
    $allocateId=$_GET['allocate_id'];
  $event=$row_select['eventname'];
 $sqlthree = $con->prepare("UPDATE tbl_bookReserve SET event=? WHERE id=?");
 $sqlthree->bind_param("si",$event,$allocateId);
 $sqlthree->execute();

               $return_id=$_GET['return_id'];
               header("Location:bookReserve.php?book_id=$return_id");
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
  <div class="col-md-5 col-md-offset-4">
    <div class="panel panel-primary"> 

   <div class="panel heading">
       <h4 style="color: blue;"><center>Allocate Event</center></h4>
      </div>   <?php
if(isset($_GET['allocate_id'])){
  $id = $_GET['allocate_id'];
        $stmt_select = $DB_con->prepare('SELECT * FROM tbl_bookReserve WHERE id =:uid');
        $stmt_select->execute(array(':uid'=>$id));
        $allocate_select = $stmt_select->fetch(PDO::FETCH_ASSOC);

 ?>
 <form method="post" role="form" type="multipart/form-data" >
    <input class="form-control" type="text" name="eventname" id="eventname"  placeholder="Enter event Name">
     <br/>
     <input class="form-control" type="text" name="numberofpeople" id="numberofpeople"  placeholder="Enter Number of people" >
    <br/>
    <input class="form-control" type="date" name="eventDate" id="eventDate" placeholder="Enter event Date"  >
     <br/> 
     <input type="hidden" name="venueId" value="<?php echo $allocate_select['venueId'];?>">
     <input type="hidden" name="roomtype" value="<?php echo $allocate_select['roomType'];?>">
     <input type="hidden" name="roomname" value="<?php echo $allocate_select['roomName'];?>">
     <input type="hidden" name="roomprice" value="<?php echo $allocate_select['roomPrice'];?>">
     <input type="hidden" name="postid" value="<?php echo $allocate_select['postId'];?>">
    <button class="btn btn-lg btn-success btn-block" type="submit" name="btnsave">Allocate Event</button>
    </form>
 <?php 
}
         ?>
       <div class="panel body">
      
 
  
      </div>
     
    </div>
  </div>


</div>

</body>
</html>