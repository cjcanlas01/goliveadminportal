<!DOCTYPE html>
<html lang="en">
   <?php
      session_start();    
      if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
         header("Location: index-dashboard.php");
         exit();
      }
   ?>

   <?php
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   ?>
   
   <head>
      <meta charset="UTF-8">
      <title>GoLive: Admin Portal</title>
      <meta http-equiv="X-UA-Compatible" content="IE-edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/png" href="resources/logoopt5.png">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
      <style>
         body {
         background: #2c3e50;  /* fallback for old browsers */
         background: -webkit-linear-gradient(to right, #3498db, #2c3e50);  /* Chrome 10-25, Safari 5.1-6 */
         background: linear-gradient(to right, #3498db, #2c3e50); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
         overflow: hidden;
         }
         #login {
         padding: 40px 40px 40px;
         }
         #center {
         margin-top: 50%;
         margin-left: 50%;
         transform: translate(-60%, -50%);
         }
         #logincard {
         background-color: #bdc3c7;
         border-radius: 6px;
         width: 400px;
         height: 370px;
         }
         .btn {
         background-color: #3498db;
         border-radius: 6px;
         border: 0;
         }
         .form-control {
         border: 0;
         border-radius: 6px;
         }
         @media (min-width: 320px) and (max-width: 767.98px) {
         #logincard {
         background-color: #2c3e50;
         border-radius: 6px;
         width: 300px; 
         }
         }
         #toptext {
         padding-top: 30px;
         color: #3498db;
         font-size: 30px;
         }
         #logo {
         margin-top: 50%;
         margin-left: 50%;
         transform: translate(-60%, -50%);
         height: auto;
         width: 380px;
         }
         .logotxt {
         position: absolute;
         left: 45%;
         top: 58%;	
         }
         .img-responsive {
         height: 6rem;
         width: auto;	
         }
         #signup {
         margin-top: 30px;
         }
      </style>
   </head>
   <body>
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <div><img class="img-responsive" src="https://i.imgur.com/dBaCmmo.png" alt="Logo" id="logo"></div>
               <div class="logotxt"><img class="img-responsive" src="https://i.imgur.com/XHLoCop.png" alt="Text"></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6" >
               <div id="center">
                  <div class="square" id="logincard">
                     <div id="toptext">
                        <center>Admin Portal</center>
                     </div>
                     <form id="login">
                        <div class="form-group">
                           <input type="email" name="UserName" id="UserName" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                           <input type="password" name="Passcode" id="Passcode" class="form-control" placeholder="Password">
                        </div>
                        <div><button type="submit" id="index-confirm" class="btn btn-primary" style="width: 100%; color: white;">Log In</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/index.js"></script>
      <script src="js/sweetalert2.all.min.js"></script>
   </body>
</html>