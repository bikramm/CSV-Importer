<?php include 'header.php' ?>
<?php

   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM users WHERE username = '$myusername' and passcode = '$mypassword' ";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
    	
      if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location: dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
         $totalerror = $result. " " . $row;
      }
   }
?>

   

<div class="container">    
   <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
      <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Sign In</div>
        </div>     

        <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div> 
               
               <form action = "" method = "POST">       
                  <div style="margin-bottom: 25px" class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input id="username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
                  </div>
              
                  <div style="margin-bottom: 25px" class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                     <input id="password" type="password" class="form-control" name="password" placeholder="password">
                  </div>
                  
                  <div class="input-group ">
                     <div class="checkbox">
                      <label>
                        <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                      </label>
                     </div>
                  </div>

                  <div style="margin-top:10px" class="form-group">
                     <!-- Button -->

                     <div class="col-sm-12 controls">
                      <input type = "submit" value = " Submit " class="btn btn-success"/><br />

                     </div>
                  </div>

                  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $totalerror; ?></div>

               </form>     
            </div>                     
        </div>  
      </div>
   </div>

      



               
					
<?php include 'footer.php' ?>
