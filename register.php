<?php include 'includes/navigation.php'; ?>
<?php require 'includes/connect.inc.php'; ?>

<?php
// define variables and set to empty values
$emailErr = $usernameErr = $passwordErr = "";
$email = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
   
   if (empty($_POST["username"])) {
     $usernameErr = "Username is required";
   } else {
     $username = test_input($_POST["username"]);
     // check if name only contains letters, numbers and whitespace
     if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
       $usernameErr = "Only letters and numbers are allowed"; 
     }
   }

   if (empty($_POST["password"])) {
     $passwordErr = "Password is required";
   } else {
     $password = test_input($_POST["password"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>


<!-- Form -->
<div class="container-fluid col-md-8 col-md-offset-2 rmpading-15">
    <legend><a href="index.php">Pocetna</a> / Registracija</legend>
	  <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form  class="form" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> 
                
                    <div class="form-group formshort">
                      <label for="email">Email</label>
                      <input type="email" class="form-control input-lg" name="email" placeholder="Email" value="<?php echo $email;?>"><span class="error">* <?php echo $emailErr;?></span>
                    </div>
                
                    <div class="form-group formshort">
                      <label for="username">Korisnicko ime</label>
                      <input type="username" class="form-control input-lg" name="username" placeholder="Korisnicko ime" value="<?php echo $username;?>"><span class="error">* <?php echo $usernameErr;?></span>
                    </div>
                    <div class="form-group formshort">
                      <label for="pwd">Lozinka</label>
                      <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Lozinka"><span class="error">* <?php echo $passwordErr;?></span>
                    </div>
                    <div class="form-group formshort">
                      <label for="pwd">Potvrdite Lozinku</label>
                      <input type="password" class="form-control input-lg" name="passconfirm" id="passconfirm" placeholder="Potvrdite Lozinku"><span id='message'></span>
                    </div>
               
                    <div class="form-group formshort">
                    <label for="pwd">Izaberite pol</label>
                    <select name="sex" value="" class="form-control input-lg">
                        <option value="01">Muski</option>
                        <option value="02">Zenski</option>
                        <option value="03">Ne znam</option>
                    </select>
                    </div>
                
                    
                   
                    <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="submit">
                        Create account</button>
            </form>          
          </div>
</div>            
</div>


</div>
<?php
    if ($_POST['password']==$_POST['passconfirm'] && $emailErr == "" && $usernameErr == "" && $passwordErr == ""){
    if (isset($_POST['submit']))
    {
	$sql= "INSERT INTO user (email, username, password, sex) VALUES ('$_POST[email]', '$_POST[username]', '$_POST[password]', '$_POST[sex]') ";
	
	mysql_query ($sql, $conn);
	
	mysql_close ($conn);
	
	}

    }
?>
<script type="text/javascript" src="functions/confpass.js"></script>
