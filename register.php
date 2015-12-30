<?php include 'includes/navigation.php'; ?>
<?php require 'includes/connect.inc.php'; ?>


<div class="container col-md-8 col-md-offset-2 rmpading-15">
<form class="form-horizontal">

<!-- Form Name -->
<legend><a href="index.php">Pocetna</a> / Registracija</legend>

<div class="container" id="wrap">
	  <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="r" method="post" accept-charset="utf-8" class="form" role="form"> 
                
                    <div class="form-group formshort">
                      <label for="email">Email</label>
                      <input type="email" class="form-control input-lg" id="email" placeholder="Email">
                    </div>
                
                    <div class="form-group formshort">
                      <label for="email">Korisnicko ime</label>
                      <input type="username" class="form-control input-lg" id="username" placeholder="Korisnicko ime">
                    </div>
                    <div class="form-group formshort">
                      <label for="pwd">Lozinka</label>
                      <input type="password" class="form-control input-lg" id="password" placeholder="Lozinka">
                    </div>
                    <div class="form-group formshort">
                      <label for="pwd">Potvrdite Lozinku</label>
                      <input type="password" class="form-control input-lg" id="passconfirm" placeholder="Potvrdite Lozinku">
                    </div>
                    <div class="form-group formshort">
                    <label for="pwd">Izaberite pol</label>
                    <select name="sex" value="" class="form-control input-lg">
                        <option value="01">Muski</option>
                        <option value="02">Zenski</option>
                        <option value="03">Ne znam</option>
                    </select>
                    </div>
                
                    
                   
                    <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit">
                        Create account</button>
            </form>          
          </div>
</div>            
</div>
</div>
</form>
</div>