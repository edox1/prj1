<?php include 'includes/navigation.php'; ?>
<?php require 'includes/connect.inc.php'; ?>

<!-- Form Name -->


<div class="container-fluid col-md-8 col-md-offset-2 rmpading-15">
    <legend><a href="index.php">Pocetna</a> / Registracija</legend>
	  <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form  class="form" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
                
                    <div class="form-group formshort">
                      <label for="email">Email</label>
                      <input type="email" class="form-control input-lg" name="email" placeholder="Email">
                    </div>
                
                    <div class="form-group formshort">
                      <label for="username">Korisnicko ime</label>
                      <input type="username" class="form-control input-lg" name="username" placeholder="Korisnicko ime">
                    </div>
                    <div class="form-group formshort">
                      <label for="pwd">Lozinka</label>
                      <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Lozinka">
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
    if ($_POST['password']==$_POST['passconfirm']){
    if (isset($_POST['submit']))
    {
	$sql= "INSERT INTO user (email, username, password, sex) VALUES ('$_POST[email]', '$_POST[username]', '$_POST[password]', '$_POST[sex]') ";
	
	mysql_query ($sql, $conn);
	
	mysql_close ($conn);
	
	}

    }
?>
<script type="text/javascript" src="functions/confpass.js"></script>
