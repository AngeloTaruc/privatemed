<?Php

		$conn = mysqli_connect("localhost","root","","privatemed");
		
		if (isset($_POST["submit"]))
		{
			$user_name = $_POST["user_name"];
			$password = $_POST["password"];
			
			
			$sql = mysqli_query($conn, "select count(*) as total from tbluser WHERE user_name= '".$user_name."' and password = '".$password."' ") or die(mysqli_error($conn));
			
			$rw = mysqli_fetch_array($sql);
			
			if ($rw['total'] > 0) {
					echo "<script> alert('username and password are correct') </script>";
					
					
					header("Location: index.php");
				
				
				
			}else {
				echo "<script> alert('username and password are not correct') </script>";
			}
		}
		

		
		
?>



<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="undraw_doctor_kw-5-l.svg">
		</div>
		<div class="login-content">
    <form method="post">
				<img src="doctor4.jpg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
                  <input type="user_name" name="user_name" placeholder="enter your username" onfocus="this.placeholder=''" onblur="this.placeholder='enter your username'" required>
                     <i class='bx bx-hide input__icon' id="input-icon"></i>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    
                     <input type="password" name="password" placeholder="enter your password" onfocus="this.placeholder=''" onblur="this.placeholder='enter your password'" required>
                     <i class='bx bx-hide input__icon' id="input-icon"></i>
                  
                     


            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login" name="submit">
              
              
            
        </div>
    
    </div>
  
    <script type="text/javascript" src="js/main.js"></script>
</body>
</form>
</html>
