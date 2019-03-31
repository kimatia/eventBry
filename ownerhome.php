<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

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
          <a class="navbar-brand" href="#">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- navs -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo "Hello Event ".$userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


<div class="row" style="padding-top: 100px;">
  <div class="panel-body">
     <div class="col-md-12 ">
    <div class="panel panel-primary">
      <div class="panel heading">
       <h4 style="color: blue;"><center>All venues</center></h4>
      </div>
      <div class="panel-body" style="overflow-y: scroll;max-height: 720px;">
       <table  width="100%"  border='2' align="center">
                <thead>
                <tr>
                     <th width="5%" style="color: #0099D3;">Status</th> 
                    
                    <th width="5%" style="color: #0099D3;">R.ID</th> 
                   <th width="5%" style="color: #0099D3;">R.Type</th> 
                   <th width="5%" style="color: #0099D3;">R.Name</th>
                    <th width="5%" style="color: #0099D3;">R.Price</th>
                     <th width="5%" style="color: #0099D3;">R.Size</th>
                      <th width="10%" style="color: #0099D3;">Start Date</th>
                       <th width="10%" style="color: #0099D3;">End date</th>
                        <th width="5%" style="color: #0099D3;">Duration</th>
                         <th width="10%" style="color: #0099D3;">Action</th>
                          
                </tr>
                </thead>
                <tbody>
<?php
 $stmt = $DB_con->prepare('SELECT * FROM tbl_venue ORDER BY id DESC');
    $stmt->execute();

    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>

           <?php
                        
                 echo '<tr>';
                  echo '<td width="5%">';
                    //individual data of invoice file
                    if($row['status']==1){
        $id = $row['id'];
        $stmt_select_venue = $DB_con->prepare('SELECT * FROM tbl_bookReserve WHERE venueId =:uid');
        $stmt_select_venue->execute(array(':uid'=>$id));
        $select_row = $stmt_select_venue->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <button class="btn btn-md btn-danger btn-block" type="submit" >Booked by <?php echo $select_row['bookReservePerson']; ?></button>
                      <?php
                    }elseif($row['status']==2){
                       $id = $row['id'];
        $stmt_select_venue = $DB_con->prepare('SELECT * FROM tbl_bookReserve WHERE venueId =:uid');
        $stmt_select_venue->execute(array(':uid'=>$id));
        $select_row = $stmt_select_venue->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <button class="btn btn-md btn-danger btn-block" type="submit" >Reserved by <?php echo $select_row['bookReservePerson']; ?></button>
                      <?php
                    }elseif($row['status']==0){
                      ?>
                      <button class="btn btn-md btn-success btn-block" type="submit" >Venue is available</button>
                      <?php 
                    }
                 echo '</td>';
                 echo '<td width="5%">';
                    //individual data of invoice file
                     echo $row['id'];
                 echo '</td>';
                  //charges
                  echo '<td width="5%">';
                    //individual data of invoice file
                     echo $row['roomType'];
                 echo '</td>';
                  //invoice image file
                  echo '<td width="5%">';
                 echo $row['roomName'];
                
                 echo '</td>';
                 echo '<td width="5%">';
               echo $row['roomPrice'];
               echo '</td>';
                  echo '<td width="5%">';
               echo $row['roomSize'];
               echo '</td>';
                echo '<td width="10%">';
               echo $row['startDate'];
               echo '</td>';
                echo '<td width="10%">';
               echo $row['endDate'];
               echo '</td>';
                echo '<td width="5%">';
               echo $row['duration'].' days';
               echo '</td>';
                echo '<td width="10%">';
              ?>
<div class="row">
  <div class="col-md-4 col-md-offset-1">
     <a href="bookReserve.php?book_id=<?php echo $row['id']; ?>"><button class="btn  btn-success " type="submit" name="btn-login">Book</button></a>
  </div>
  <div class="col-md-4">
     <a href="bookReserve.php?reserve_id=<?php echo $row['id']; ?>"><button class="btn  btn-success " type="submit" name="btn-login">Reserve</button></a>
  </div>
  
</div>
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