<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

$DBcon->close();
  if(isset($_POST['btnsave'])){
$stmt_select = $DB_con->prepare('SELECT seat FROM tbl_seats WHERE id =:uid');
$stmt_select->execute(array(':uid'=>$_GET['seat_id']));
$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
$seatID=$imgRow['seat'];
$idd=$_GET['book_id'];
$commentStatus=1;
$comment=$_POST['comment'];
$bookPerson=$userRow['username'];
$bookStatus=1;
$bookSeat=$seatID;
$sql = $con->prepare("UPDATE tbl_allocate SET commentStatus=?, comment=?, bookPerson=?,bookSeat=?, bookStatus=? WHERE id=?");
  $sql->bind_param("isssii",$commentStatus,$comment,$bookPerson,$bookSeat,$bookStatus,$idd);
  

            if($sql->execute()){
  $status="1";
  $idseat=$_GET['seat_id'];
  $SQL = $con->prepare("UPDATE tbl_seats SET status=? WHERE id=?");
  $SQL->bind_param("ii",$status,$idseat);
  $SQL->execute();
               ?>
<script type="text/javascript">
  alert('success');
</script>
               <?php 
               header('location:home.php');
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
          <a class="navbar-brand" href="home.php">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- navs -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo "Hello user ".$userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="row" style="padding-top: 100px;">
 <div class="panel-body" style="overflow-y: scroll;max-height: 720px;">
<div class="col-md-10 col-md-offset-1">
  <div class="panel panel-primary">
    
      <?php
if(isset($_GET['book_id'])){
?>
  <?php
if(isset($_GET['book_id'])){
  $id = $_GET['book_id'];
        $stmt_select = $DB_con->prepare('SELECT * FROM tbl_allocate WHERE id =:uid');
        $stmt_select->execute(array(':uid'=>$id));
        $allocate_select = $stmt_select->fetch(PDO::FETCH_ASSOC);

 ?>
 <form method="post" role="form" type="multipart/form-data" >
    <input class="form-control" type="text" name="eventname" id="eventname"  value="<?php echo $allocate_select['eventname'];?>">
     <br/>
     <input class="form-control" type="text" name="numberofpeople" id="numberofpeople" value="<?php echo $allocate_select['numberofpeople'];?>" >
    <br/>
    <input class="form-control" type="date" name="eventDate" id="eventDate" value="<?php echo $allocate_select['eventDate'];?>"  >
     <br/> 
     <input class="form-control" type="text" name="venueId" value="<?php echo $allocate_select['venueId'];?>">
     <br/>
     <input class="form-control" type="text" name="roomtype" value="<?php echo $allocate_select['roomtype'];?>">
     <br/>
     <input class="form-control" type="text" name="roomname" value="<?php echo $allocate_select['roomname'];?>">
     <br/>
     <input class="form-control" type="text" name="roomprice" value="<?php echo $allocate_select['roomprice'];?>">
     <br/>
     <input class="form-control" type="text" name="postid" value="<?php echo $allocate_select['postid'];?>">
      <br/>
      <input class="form-control" type="text" name="comment" placeholder="Enter comment" >
     <br/>
    <button class="btn btn-lg btn-success btn-block" type="submit" name="btnsave">Book Event</button>
    </form>
<?php
}
    }  ?>
       </div>
</div>

</div>
</body>
</html>