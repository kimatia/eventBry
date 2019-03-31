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
       <table  width="100%"  border='2' align="center">
                <thead>
                <tr>
                     <th width="15%" style="color: blue;background-color: white; text-align: center;">Event Name</th> 
                    
                    <th width="5%" style="color: blue;background-color: white; text-align: center;">No. of People</th> 
                   <th width="5%" style="color: blue;background-color: white; text-align: center;">Event Date</th> 
                   <th width="5%" style="color: blue;background-color: white; text-align: center;">Room type</th>
                    <th width="5%" style="color: blue;background-color: white; text-align: center;">Room Name</th>
                     <th width="5%" style="color: blue;background-color: white; text-align: center;">Room Price</th>
                      <th width="5%" style="color: blue;background-color: white; text-align: center;">Event Owner</th>
                        <th width="5%" style="color: blue;background-color: white; text-align: center;">Comments</th>
                       <th width="5%" style="color: blue;background-color: white; text-align: center;">Action</th>
                       
                          
                </tr>
                </thead>
                <tbody>
<?php
 $stmt = $DB_con->prepare('SELECT * FROM tbl_allocate ORDER BY id DESC');
    $stmt->execute();

    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>

           <?php
                        
                 echo '<tr>';
                 
                 echo '<td width="5%" style="text-align: center;color: white;">';
                    //individual data of invoice file
                     echo $row['eventname'];
                 echo '</td>';
                  //charges
                  echo '<td width="5%" style="text-align: center;color: white;">';
                    //individual data of invoice file
                     echo $row['numberofpeople'];
                 echo '</td>';
                  //invoice image file
                  echo '<td width="5%" style="text-align: center;color: white;">';
                 echo $row['eventDate'];
                
                 echo '</td>';
                 echo '<td width="5%" style="text-align: center;color: white;">';
               echo $row['roomtype'];
               echo '</td>';
                  echo '<td width="5%" style="text-align: center;color: white;">';
               echo $row['roomname'];
               echo '</td>';
                echo '<td width="10%" style="text-align: center;color: white;">';
               echo $row['roomprice'];
               echo '</td>';
                echo '<td width="10%" style="text-align: center;color: white;">';
               echo $row['postUser'];
               echo '</td>';
               echo '<td width="10%" style="text-align: center;color: white;">';
              if($row['commentStatus']==0){
             echo "No Comment";
              }elseif($row['commentStatus']==1){
                echo $row['comment'];
              }
               echo '</td>';
                echo '<td width="10%" style="text-align: center;color: white;">';
                if($row['bookStatus']==0){
 ?>
<div class="row">
  <div class="col-md-5 ">
     <a href="bookComment.php?book_id=<?php echo $row['id']; ?>" style="text-align: center;">Book</a>
  </div>
 
</div>
              <?php
                }elseif($row['bookStatus']==1){
           ?>
<div class="row">
  <div class="col-md-5 ">
     <a href="#" style="text-align: center;">Booked</a>
  </div>
 
</div>
              <?php        
                }
             
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
