<?php
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
  header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

if(isset($_POST['btnsave'])){
 
  $roomType = $_POST['roomtype'];// user content
   $roomName = $_POST['roomname'];
    $roomPrice = $_POST['roomprice'];
      $roomSize = $_POST['roomsize'];
       $startDate = $_POST['startdate'];
        $endDate = $_POST['enddate'];
        $duration = $_POST['duration'];

            $stmt = $DB_con->prepare('INSERT INTO tbl_venue(roomType,roomName,roomPrice,roomSize, startDate,endDate,duration) VALUES(:rtype,:rname,:rprice,:rsize,:sdate,:edate,:duration)');
               $stmt->bindParam(':rtype',$roomType);
               $stmt->bindParam(':rname',$roomName);
                $stmt->bindParam(':rprice',$roomPrice);
                 $stmt->bindParam(':rsize',$roomSize);
                $stmt->bindParam(':sdate',$startDate);
                $stmt->bindParam(':edate',$endDate);
                 $stmt->bindParam(':duration',$duration);
                 

            if($stmt->execute()){
               ?>
<script type="text/javascript">
  alert('Record inserted');
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
if(isset($_GET['delete_id']))
{
 $SQL = $con->prepare("DELETE FROM tbl_venue WHERE id=".$_GET['delete_id']);
 $SQL->bind_param("i",$_GET['delete_id']);
 $SQL->execute();
 header("Location: adhome.php");
}
if(isset($_GET['suspend_id']))
{
$suspend_id=1;
 $sql = $con->prepare("UPDATE tbl_venue SET status=? WHERE id=?");
 $sql->bind_param("ii",$suspend_id,$_GET['suspend_id']);
 $sql->execute();

 header("Location: adhome.php");
}
if(isset($_GET['release_id']))
{
$release_id=0;
 $sql = $con->prepare("UPDATE tbl_venue SET status=? WHERE id=?");
 $sql->bind_param("ii",$release_id,$_GET['release_id']);
 $sql->execute();

 header("Location: adhome.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>Welcome - <?php echo $userRow['email']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/image-effects.css" rel="stylesheet">
    <link href="css/custom-styles.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    </head>

  <body>
    
      <div class="container">
     
        <div class="row">
          <div class="site-header spacing-t">
            <div class="col-md-3 ">
              <div class="site-name spacing-b">
                <h1> EVENTS HUB</h1>
                <h6>Book events and reserve rooms.</h6>
              </div>
            </div>
          <div class="col-md-9">
            <nav class="navbar pull-right " role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"><h3 class="hide">Menu</h3>
            <span class="fw-icon-th-list "></span>
            
          </button>
         
        </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li class="dropdown ">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown">About <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Events Hub</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Rooms</a></li>
                <li><a href="#">Us</a></li>
              </ul>
            </li>
                  <li><a href="#" >services</a></li>
                   <li><a href="#" >portfolio</a></li>
                  <li class="dropdown ">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown"><?php echo "Hello Admin ".$userRow['username']; ?><b class="caret"></b></a>
               <ul class="dropdown-menu">
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
            </ul>
            </li>
                  
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        
          </div>
          </div>
        </div>
     
    </div>
    <div class="container">
    <div class="subscribe">
      <div class="row">
      <div class="col-md-3">
      <div class="panel panel-primary">
      <div class="panel heading">
       <h4 style="color: blue;"><center>Create venues</center></h4>
      </div>
      <div class="panel body">
        <form method="post" role="form" type="multipart/form-data" >
         <input class="form-control" type="text" name="roomname" id="roomname" placeholder="Enter room name" >
     <br/>
      <select class="form-control" type="text" name="roomtype" id="roomtype" placeholder="Enter Room Type">
       <option value="Normal">Normal</option>
        <option value="Regular">Regular</option>
         <option value="VIP">VIP</option>
     </select>
    <br/>
    <input class="form-control" type="text" name="roomprice" id="roomprice" placeholder="Enter room price" >
     <br/>
     <input class="form-control" type="text" name="roomsize" id="roomsize" placeholder="Enter room size" >
     <br/>
    <input class="form-control " type="date" name="startdate" id="startdate"  placeholder="Enter start Date" >
     <br/>
    <input class="form-control " type="date" name="enddate" id="enddate"  placeholder="Enter end Date" >
     <br/>
    <input class="form-control" type="text" name="duration" id="duration" placeholder="Enter expected duration" >
     <br/>
    
     <button class="btn btn-primary btn-round" type="submit" name="btnsave">Submit</button>
    </form>
      </div>
     </div>
    </div>
  
  <div class="col-md-6 ">
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
                      ?>
                      <hh style="font-size: 15;color: blue;" >Booked</hh>
                      <?php
                    }elseif($row['status']==2){
                      ?>
                      <hh style="font-size: 15;color: blue;" >Reserved</hh>
                      <?php
                    }elseif($row['status']==0){
                      ?>
                      <hh style="font-size: 15;color: blue;" >Available</hh>
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
  <div class="col-md-3 ">
     <a href="?delete_id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-remove" style="color:Blue;"></span></a>
  </div>
  </div>
  <div class="row">
  <div class="col-md-3">
     <a href="?suspend_id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-lock" style="color:Blue;"></span></a>
  </div>
  </div>
  <div class="row">
  <div class="col-md-3">
     <a href="?release_id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-lock" style="color:Blue;"></span></a>
  </div>
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
  <div class="col-md-3">
    <div class="panel panel-primary">
      <div class="panel heading">
       <h4 style="color: blue;"><center>Users/Owners</center></h4>
      </div>
      <div class="panel-body" style="overflow-y: scroll;max-height: 720px;">
                       <?php
          $response = $con->query("SELECT * FROM tbl_users ORDER BY user_id DESC");
            while($systemLogs = $response->fetch_array()){
          if($systemLogs['logintype']==1){
            ?>
              <div class="list-group-item">
              <span class="fa fa user" ><span class=""><h5 style="color:Blue;"><?php echo "Event owner (".$systemLogs['username'].')';?></h5></span></span>
           
              <span class=""><a href="?viewPerson=<?php echo  $systemLogs['user_id']; ?>" class="fa fa-folder-o">View</a></span>
              
            </div>
             <?php
          }
          if($systemLogs['logintype']==0){
            ?>
              <div class="list-group-item">
             <span class="fa fa user" ><span class=""><h5 style="color:Blue;"><?php echo "User (".$systemLogs['username'].')';?></h5></span></span>
             
              <span class=""><a href="?viewPerson=<?php echo  $systemLogs['user_id']; ?>" class="fa fa-folder-o">View</a></span>
             
              
            </div>
             <?php
          }
              
             
            }
                       ?> 
                    </div>
      
    </div>
    </div>
    </div>
    </div>
    </div>
      <br>
    <div class="container" >
      <div class="subscribe">
       
       
           <h1>Events Hub</h1>
                 
           <form class="form-inline " role="form">
              <div class="row">
              <div class="form-group  col-md-4">
                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                <input type="email" class="form-control " id="exampleInputEmail2" placeholder="Enter email">
              </div>
              <div class="form-group col-md-4">
                <label class="sr-only" for="exampleInputPassword2">Password</label>
                <input type="password" class="form-control  " id="exampleInputPassword2" placeholder="Password">
              </div>
              
              <button type="submit" class="btn btn-default">subscribe</button>
           </div>
            </form>
      </div>
      <div class="ruler"></div>
    </div>

      
     <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
  <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  
       
  </body>
</html>
