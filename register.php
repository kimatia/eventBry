<?php
session_start();
if (isset($_SESSION['userSession'])!="") {
    header("Location: home.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])) {
    $first = strip_tags($_POST['firstname']);
    $last = strip_tags($_POST['lastname']);
    $uname = strip_tags($_POST['username']);
    $uphone = strip_tags($_POST['phonenumber']);
    $email = strip_tags($_POST['email']);
    $upass = strip_tags($_POST['password']);
    
    $first = $DBcon->real_escape_string($first);
    $last = $DBcon->real_escape_string($last);
    $uname = $DBcon->real_escape_string($uname);
    $uphone = $DBcon->real_escape_string($uphone);
    $email = $DBcon->real_escape_string($email);
    $upass = $DBcon->real_escape_string($upass);

    
    $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
    // check if fields are empty
    if(empty($first&&$last&&$uname&&$uphone&&$email&&$upass)){
            $errMSG = "Please Input All the fields.";
        }
          else  if(empty($first)){
            $errMSG = "Please Fill In First Name..";
        }
        else if(empty($last)){
            $errMSG = "Please Fill In LastName..";
        }
        else if(empty($uname)){
            $errMSG = "Please Fill In Username..";
        }
        else if(empty($uphone)){
            $errMSG = "Please Input Phone Number";
        } else if(empty($email)){
            $errMSG = "Please Input Email.";
        } else if(empty($upass)){
            $errMSG = "Please Input Password.";
        }
        
        else
        {
    $check_email = $DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
    $count=$check_email->num_rows;
    
    if ($count==0) {
         //$query = $DBcon->prepare("INSERT INTO tbl_users(firstname,lastname,username,phonenumber,email,password) VALUES(?,?,?,?,?,?)");
        //$query->bind_param('ssssss',$first,$last,$uname,$uphone,$email,$hashed_password);
            //$query->execute();
        $query = "INSERT INTO tbl_users(firstname,lastname,username,phonenumber,email,password) VALUES('$first' , '$last' ,'$uname', '$uphone' ,'$email','$hashed_password')";
        

        if ($DBcon->query($query)) {
             $successMSG1 = "Registered succesfully..";
            header("refresh:5;home.php");
        }else {
             $errMSG1 = "Error while registering.";
                    
        }
        
    } else {
        
        
         $errMSG1 = "Sorry email already taken.";
            
    }
    
    $DBcon->close();
}
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
      <div class="row" style="padding-top: 80px">
<div class="col-md-5 col-md-offset-3">
 <div class="panel panel-default">
        
            <div class="panel-heading">
                <center><strong>SIGNUP</strong></center>
                <?php
    if(isset($errMSG1)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG1; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG1)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG1; ?></strong>
        </div>
        <?php
    }
    ?>   
            </div>
            <div class="panel-body">
       
       <form class="form-signin" method="post" id="register-form">
        

              
            <div class="form-group input-group">
                 
                 <span class="input-group-addon">First Name</span>
                 <input class="form-control" type="text" name="firstname" placeholder="Firstname">
             </div>
             <div class="form-group input-group">
                 
                 <span class="input-group-addon">Last Name</span>
                 <input class="form-control" type="text" name="lastname" placeholder="Lastname">
             </div>
            
             <div class="form-group input-group">
                 
                 <span class="input-group-addon">Username</span>
                 <input class="form-control" type="text" name="username" placeholder="Username">
             </div>
              <div class="form-group input-group">
                 
                 <span class="input-group-addon">Phone No.</span>
                 <input class="form-control" type="text" name="phonenumber" placeholder="Phone No.">
             </div>
              <div class="form-group input-group">
                 
                 <span class="input-group-addon">Email Add</span>
                 <input class="form-control" type="email"   name="email" placeholder="Email">
             </div>
             <div class="form-group input-group">
                 
                 <span class="input-group-addon">Password.</span>
                 <input class="form-control" type="password" name="password" placeholder="Password">
             </div>
            
             &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" name="btn-signup" class="btn btn-primary btn-round" value="POST">Signup.</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
             <a class="btn btn-primary btn-round" href="index.php">Login</a>
             </form>
              </div>
            <div class="panel-footer">
                <?php
    if(isset($errMSG)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
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
