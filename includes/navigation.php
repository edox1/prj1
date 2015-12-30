<!doctype html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="http://localhost/prj1/css/style.css" >
<script src="../js/toggleactive.js" type="text/javascript"></script>
<div class="navbar navbar-default" role="navigation">
  <div class="container-fluid col-md-8 col-md-offset-2">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo_wrap icon_kapica_logo" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#" data-toggle="tab" id="vijesti"><div class="kocka bg_vijesti"></div>Vijesti <span class="sr-only">(current)</span></a></li>
        <li><a href="#" data-toggle="tab" id="biznis"><div class="kocka bg_biznis"></div>Biznis</a></li>
        <li><a href="#" data-toggle="tab" id="sport"><div class="kocka bg_sport"></div>Sport</a></li>
        <li><a href="#" data-toggle="tab" id="magazin"><div class="kocka bg_magazin"></div>Magazin</a></li>
        <li><a href="#" data-toggle="tab" id="lifestyle"><div class="kocka bg_lifestyle"></div>Lifestyle</a></li>
        <li><a href="#" data-toggle="tab" id="scitech"><div class="kocka bg_scitech"></div>Scitech</a></li>
        <li><a href="#" data-toggle="tab" id="auto"><div class="kocka bg_auto"></div>Auto</a></li>
        
        
          </ul>
        </li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Login</a></li>
        
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Prijava</h4>
        </div>
        <div class="modal-body">
         
               <form role="form">
                    <div class="form-group formshort">
                      <label for="email">Korisnicko ime ili e-mail</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group formshort">
                      <label for="pwd">Lozinka</label>
                      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                    </div>
                    <div class="checkbox formshort">
                      <label><input type="checkbox"> Remember me</label>
                    </div>

                    <!-- Button -->
                    <div class="form-group formshort">
                      <label class= "control-label" for="submit"></label>
                      <div class="prijavadesno">
                        <button id="submit" name="submit" class="btn btn-primary">Prijavi se</button>
                      </div>
                    </div>
                    <div class="form-group formshort">
                    <div class="ili-separator col-xs-12 no-padding">
                        <div class="lajna"></div>
                        <div class="krug-ili">ili</div>
                    </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-xs-12 buttonpad">
                        <a href="http://localhost/prj1/register.php" ><button type="button" class="btn btn-info btn-lg btn-block nodecor">Registruj se</button>
                        </a>
                    </div>
                    <p>&nbsp;</p>
                    </form>
           
       
        </div>
       
      </div>
      
    </div>
  </div>
  
</div>