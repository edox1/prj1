
<html>
<head>
 <meta charset="UTF-8"> 

<style>

body{
	background-color: #ECECEC;
}

.container {
  display: flex;
  flex-flow: row wrap;
  margin: auto;
  width: 67%;

}

img {
	width: 100%;
	margin: auto;
}

.container > * {
  padding: 0px;
  flex: 1 100%;
}

.news-bih {
	background-color: #FFF; 
	margin: 5px;
}

.news-edukacija {
	background-color: #40AFEE;
	margin: 5px;
}


.news-header {
	font-family: "Roboto Slab";
	font-size: 16px;
	margin: 0px;
	padding: 7px;
}

.news-header-bih {
	color: #555;
	padding: 7px;
}
.news-header-edukacija {
	color: #FFF;
	padding: 7px;
}



.news-item {
	font-family: "Roboto";
	font-size: 12px;
	color: #828282;
	line-height: 18px;
	padding: 7px;
}


@media all and (min-width: 800px) {
  .news-bih {
    flex: 1 0px;
  }
  .news-edukacija {
    flex: 1 0px;
  }
}

@media all and (min-width: 800px) {
  
  .news-big {
    flex: 2 0px;
  }

}


@media all and (max-width: 1200px) {
  .container {
	width: 80%;
	}

}

@media all and (max-width: 800px) {
  .container {
	width: 90%;
	}
}

.header-line {
	margin: 7px;
}

.header-line > a {
	color: #D33D3D;
	font-size: 12px;
	font-family: "Sans-serif";
	text-decoration: none;
	padding: 5px;
	font-weight: normal;
}
.news-edukacija .header-line > a {
	color: #fff;
}




.header-line > a:hover {
	text-decoration: underline;
}




</style>
</head>
<body>
<div class="container">
		<section class="container">  
			<article class="news-bih">
				<div class="header-line">
					<a href="#">BIH</a>
				</div>
				<img src="images/1.jpg" />
				<header class="news-header-bih">Podignuta optužnica u predmetu "Meso", država oštećena za 13,5 miliona KM</header>
				<section class="news-item">Optuženi se terete da su, u periodu od 2007. do 2012. godine, 
				djelujući kao povezana grupa fizičkih osoba i pravnih osoba (preduzeća), 
				počinili porezne utaje i neplaćanje poreza...
				 </section>
			</article>  
			<article class="news-big news-bih">
				<div class="header-line">
					<a href="#">BIH</a>
				</div>
				<img src="images/bakir.jpg" />
				<header class="news-header-bih">Izetbegović o spajanju kantona: Logično je da se ujedine Sarajevo, Zenica i Goražde</header>
				<section class="news-item">Što se tiče preustroja FBiH, Bakir Izetbegović je na današnjoj novogodišnjoj konferenciji SDA kazao kako
				 uskoro očekuje prijedloge HDZ-a BiH o preuređenju Mostara...
				 </section>
			</article>  
			<article class="news-bih">
				<div class="header-line">
					<a href="#">BIH</a>
				</div>
				<img src="images/3.jpg" />
				<header class="news-header-bih">Maskirani razbojnici u Lukavcu opljačkali banku i odnijeli veću količinu novca</header>
				<section class="news-item">"U Lukavcu, u ulici Armije RBiH jutros u 8:10 sati izvršeno je razbojništvo, 
				kada su dvije nepoznate osobe sa fantomkama na glavi i automatskim oružjem upale 
				u banku i otuđile veću količinu novca", izjavio je ...
				</section>
			</article> 

		</section>
		<section class="container">  
			
			<article class="news-bih">
				<div class="header-line">
					<a href="#">BIH</a>
				</div>
				<img src="images/4.jpg" />
				<header class="news-header-bih">Skupština KS usvojila Zakon o unutrašnjim poslovima: Finansijska samostalnost i depolitizacija Uprave policije</header>
			
			</article>  
			<article class="news-bih">
				<div class="header-line">
					<a href="#">BIH</a>
				</div>
				<img src="images/5.jpg" />
				<header class="news-header-bih">Zurovac: Istražni organi se ni danas ne bave sadržajem snimka Željke Cvijanović</header>
				
			</article>  
			<article class="news-bih">
				<div class="header-line">
					<a href="#">BIH</a>
				</div>
				<img src="images/6.jpg" />
				<header class="news-header-bih">Ana Babić iskritikovala kolege koje su napustile sjednicu Skupštine KS</header>
				
			</article> 
			<article class="news-edukacija">
				<div class="header-line">
					<a href="#">EDUKACIJA</a>
				</div>
				<img src="images/7.jpg" />
				<header class="news-header-edukacija">Dvanaest izreka koje vas mogu inspirisati u 2016. godini</header>
				
			</article> 

		</section>
</div>
<div class="container">
			<article class="news-edukacija">
				<div class="header-line">
					<a href="#">EDUKACIJA</a>
				</div>
				<img src="images/7.jpg" />
				<header class="news-header-edukacija">Dvanaest izreka koje vas mogu inspirisati u 2016. godini</header>
				
			</article> 

</div>




</body>
</html>