<link href="css/style.css" rel="stylesheet" type="text/css"/>
<?php include 'includes/navigation.php'; ?>
<?php include 'includes/connect.inc.php'; ?>
<div class="container">
<form class="form-horizontal">

<!-- Form Name -->
<legend>Register</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fn">First name</label>  
  <div class="col-md-4">
  <input id="first_name" name="first_name" type="text" placeholder="first name" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ln">Last name</label>  
  <div class="col-md-4">
  <input id="last_name" name="last_name" type="text" placeholder="last name" class="form-control input-md" required="">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="ln">Username</label>  
  <div class="col-md-4">
  <input id="username" name="username" type="text" placeholder="username" class="form-control input-md" required="">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="ln">Email</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Password</label>  
  <div class="col-md-4">
      <input id="password" name="password" type="password" placeholder="password" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">SUBMIT</button>
  </div>
</div>
</form>
</div>
