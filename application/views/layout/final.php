<style>
.imgbox{width:400px;height:350px;}
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social Traffic Center</title>
    <!-- FontAwesome -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Exo+2:400,700italic,700,200,200italic' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- The Styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/style2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/colors.css">
	<link href="<?php echo base_url(); ?>css/validation/validationEngine.jquery.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body id="top">

    <a href="#top" id="up" data-spy="affix" data-offset="100"><span class="fa fa-caret-up"></span></a>

    <nav class="navbar" role="navigation">

      <div class="navbar-header">
        <strong>Menu</strong>
      </div>

    <ul class="nav">
        <li><a href="<?php echo base_url();?>forum">Home</a></li>
        <li><a href="<?php echo base_url();?>topics">Forum</a></li>
        <!--<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="portfolio-2-col.html">2 columns</a></li>
            <li><a href="portfolio.html">3 columns</a></li>
            <li><a href="portfolio-4-col.html">4 columns</a></li>
            <li><a href="portfolio-5-col.html">5 columns</a></li>
            <li><a href="portfolio-single.html">Single page</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="blog.html">Blog page</a></li>
            <li><a href="single.html">Single page</a></li>
          </ul>
        </li>-->
        <li><a href="<?php echo base_url();?>articles">Articles</a></li>
		<li><a href="<?php echo base_url();?>monetization_networks">Monetization</a></li>
	</ul>
	<!--
      <form class="menu-search" action="search-results.html"><input type="search" class="search-input" placeholder="Search">
        <button class="search"><span class="fa fa-search"></span></button>
      </form>
    --> 
    </nav>

    <div class="container-fluid nav-head" data-spy="affix" data-offset="1">
      <div class="row">
        <div class="col-md-4 col-xs-2">
          <div id="menu-trigger" class="fa fa-bars fa-2x"></div>
        </div>
        <div class="col-md-4 col-xs-8 text-center">
          <!--<a class="logo" href="http://droxr.com/j7br7W8"><img src="http://i.imgur.com/4wHFBFl.png">-->
		  <b> STC logo goes here!!!</b>
        </div>
      </div>
    </div>
	
    <div class="jumbotron full-bg animated-bg" data-bg="<?php echo base_url();?>img/stcm.jpg">
      <div class="col-md-6 col-md-offset-3 centered text-center">
		
        <b class="stc-heading">Welcome to Social Traffic Center</b> <br/><br/>
        <b class="home-text">A Social Network for social publishers</b> <br/><br/>
		<b class="home-text2">Meet More Peoples.Optimize Your Network.Make More Money.It's that simple.</b> <br/><br/>
        <b class="home-text3">Coming Soon!</b> <br/><br/>
        <b class="home-text4">Sign up to receive the updates about our launch via email.</b>
		<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
		<div id="successMessage" class="alert alert-success" style="display:none;"></div>
		<form class="form-horizontal" id="frm_addLinkCat" action="<?php echo base_url();?>user/users/addemail" method="POST">
		  <div class="input-group">
			<input type="text" class="form-control validate[required,custom[email]]" name="emailid" placeholder="E-mail address" style="border-color:blueviolet;">
			<span class="input-group-btn">
			  <button class="btn btn-default" id="btn_submit" type="submit" style="border-color:blueviolet;">Sign up!</button>
			</span>
		  </div>
        </form>
          <!--<a class="btn btn-primary btn-lg" href="#services" role="button"><span class="fa-caret-down fa"></span> Discover Slix</a>-->
       
      </div>
    </div>
	<!--
    <div id="services" class="container-fluid separator">
      <div class="row">
        <div class="col-md-4 service">
          <div class="fa fa-2x fa-certificate primary-color col-md-2 col-xs-2"></div>
          <div class="col-md-9 col-xs-10">
            <h4> Set Your Budget</h4>
            <p>
              Social advertising doesn't have to be expensive or confusing. Brands can easily manage, setup, and edit budgets. 
            </p>
          </div>
        </div>
        <div class="col-md-4 service">
          <div class="fa fa-2x fa-spinner primary-color col-md-2 col-xs-2"></div>
          <div class="col-md-9 col-xs-10">
            <h4>Make Money</h4>
            <p>
              Influencers earn money for doing what they love creating branded content that set trends by engaging with their audience.
            </p>
          </div>
        </div>
        <div class="col-md-4 service">
          <div class="fa fa-2x fa-location-arrow primary-color col-md-2 col-xs-2"></div>
          <div class="col-md-9 col-xs-10">
            <h4>Grow Your Customers</h4>
            <p>
              STC allows brands to target your key audience through our influence network to engage with your your product or service. 
            </p>
          </div>
        </div>

        <div class="col-md-4 service">
          <div class="fa fa-2x fa-rocket primary-color col-md-2 col-xs-2"></div>
          <div class="col-md-9 col-xs-10">
            <h4>No Contracts</h4>
            <p>
            There are no contracts, obligations, or rights that you give up
			to us.
            </p>
          </div>
        </div>
        <div class="col-md-4 service">
          <div class="fa fa-2x fa-mobile primary-color col-md-2 col-xs-2"></div>
          <div class="col-md-9 col-xs-10">
            <h4>It's Responsive</h4>
            <p>
              Our site is responsive in mobile,tablets and laptops.
            </p>
          </div>
        </div>
        <div class="col-md-4 service">
          <div class="fa fa-2x fa-eye primary-color col-md-2 col-xs-2"></div>
          <div class="col-md-9 col-xs-10">
            <h4>Professional Tools</h4>
            <p>
              STC maximizes earnings and insights through our constant flow of brand deals and intelligent dashboard. 
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid separator">
	  <div class="row">
		<?php //echo "<pre>"; print_R($articles); exit; ?> 	
        <h4>Our Articles</h4>	
		<?php for($i=0;$i<3;$i++) { ?> 
		<div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]["image"];?>">
            <div class="caption">
              <h4><?php echo $articles[$i]["topic"];?></h4>
              
			  <?php $art = url_title($articles[$i]['topic'],'underscore',TRUE);?>
              <a href="<?php echo base_url();?>article/<?php echo $art;?>/<?php echo $articles[$i]['id'];?>" class="btn btn-primary" role="button"><span class="fa-arrow-circle-right fa"></span> View Article</a>
            </div>
          </div>
        </div>
        <?php 	}  ?>
      </div>
    </div>
	
    <div id="team" class="container-fluid text-center separator">
      <div class="row">
        <div class="col-md-12">
          <h3>Meet our team</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div href="#" class="team-member">
            <img src="http://placehold.it/350x350" alt="">
            <div class="title">
              <h4>Soraya Doe</h4>
              <h5>Senior SEO expert</h5>
            </div>
            <div class="caption">
              <a href="#" class="icon fa fa-twitter"> </a>
              <a href="#" class="icon fa fa-facebook"> </a>
              <a href="#" class="icon fa fa-linkedin"> </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div href="#" class="team-member">
            <img src="http://placehold.it/350x350" alt="">
            <div class="title">
              <h4>John Doe</h4>
              <h5>Chief Executive Officer</h5>
            </div>
            <div class="caption">
              <a href="#" class="icon fa fa-twitter"> </a>
              <a href="#" class="icon fa fa-facebook"> </a>
              <a href="#" class="icon fa fa-instagram"> </a>
              <a href="#" class="icon fa fa-linkedin"> </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div href="#" class="team-member">
            <img src="http://placehold.it/350x350" alt="">
            <div class="title">
              <h4>Jane Doe</h4>
              <h5>Marketing Guru</h5>
            </div>
            <div class="caption">
              <a href="#" class="icon fa fa-twitter"> </a>
              <a href="#" class="icon fa fa-instagram"> </a>
              <a href="#" class="icon fa fa-facebook"> </a>
            </div>
          </div>
        </div>
      </div>
    </div>
	
    <div id="brand-title" class="container-fluid text-center">
      <div class="row">
        <h3>Our Clients</h3>
      </div>
    </div>
    <div id="brands" class="container-fluid">
      <ul class="row brand-list">
        <li class="col-md-3 col-sm-6 col-xs-6"><img src="http://i.imgur.com/hgC51wu.png"></li>
        <li class="col-md-3 col-sm-6 col-xs-6"><img src="http://i.imgur.com/kRtk8gb.png"></li>
        <li class="col-md-3 col-sm-6 col-xs-6"><img src="http://i.imgur.com/u2MNekp.png"></li>
        <li class="col-md-3 col-sm-6 col-xs-6"><img src="http://i.imgur.com/lmUM7V5.png"></li>
      </ul>
    </div>
    
    <div class="container-fluid first-foot">
      <div class="row">
        <div class="col-md-3">
          <h4>Why Us?</h4>
          <p>Because we can!</p>
          <h5>
            Sign up for our Newsletter
          </h5>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="E-mail address">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Sign up!</button>
            </span>
          </div>
        </div>
        <div class="col-md-6">
          <h4>Recent topics</h4>
          <div class="list-group">
            <?php for($i=0;$i<3;$i++) { ?>
			<?php $title = url_title($topics[$i]['name'],'dash',TRUE);?>
			<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>" class="list-group-item">
              <p class="list-group-item-text"><?php echo $topics[$i]['name'];?></p>
              <h5 class="list-group-item-heading"> 
			  <?php 
					$str = strip_tags($topics[$i]['description']);
					echo "&nbsp;&nbsp;".substr($str,0,100)."...";
			  ?>
			  </h5>
            </a>
            <?php } ?>
          </div>
        </div>
        <div id="shots" class="col-md-3">
          <h4>Recent Articles</h4>
          <?php  for($i=0;$i<9;$i++) { 
					$art = url_title($articles[$i]['topic'],'underscore',TRUE);
		  ?> 
		  <a class="shots" href="<?php echo base_url();?>article/<?php echo $art;?>/<?php echo $articles[$i]['id'];?>">
			<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>">
		  </a>
          <?php } ?>
        </div>
      </div>
    </div> 

    <div class="container-fluid social-icons">
      <div class="row">
        <div class="col-md-12">
          <div class="btn-group btn-group-justified">
            <div class="btn-group">
              <a href="http://www.twitter.com" type="button" class="btn btn-default fa fa-twitter"></a>
            </div>
            <div class="btn-group">
              <a href="http://www.facebook.com" type="button" class="btn btn-default fa fa-facebook"></a>
            </div>
            <div class="btn-group">
              <a href="http://www.linkedin.com" type="button" class="btn btn-default fa fa-linkedin"></a>
            </div>
            <div class="btn-group">
              <a href="http://www.dribble.com" type="button" class="btn btn-default fa fa-dribbble"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
	
    <footer>
      <div class="container-fluid center-text-mobile">
        <div class="row">
          <div class="col-md-3">
            <h4>About <span class="logo">STC</span></h4>
            <p> Social Traffic Center is the place to be in the vast world of social media monetization."Network, Optimize, Make More Money. It’s that simple."</p>
          </div>
          <div class="col-md-2 col-md-offset-1">
            <h4>About</h4>
            <ul class="link-list">
              <li><a href="#">Our history</a></li>
              <li><a href="#">Mission</a></li>
              <li><a href="#">Future</a></li>
              <li><a href="#">Our clients</a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <h4>Navigate</h4>
            <ul class="link-list">
              <li><a href="#">Home</a></li>
              <li><a href="#">Pages</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <h4>Privacy</h4>
            <ul class="link-list">
              <li><a href="#">Terms</a></li>
              <li><a href="#">Questions</a></li>
              <li><a href="#">Support</a></li>
              <li><a href="#">Stetement</a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <h4>Links</h4>
            <ul class="link-list">
              <li><a href="#">Google</a></li>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Some other link</a></li>
              <li><a href="#">The best link</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer> -->
    <div class="container-fluid copyright">
      <div class="row">
        <div class="col-md-4">
          <span class="info">&copy; 2014 STC. <a href="#">Social traffic center</a></span>
        </div>
		<div class="col-md-4">
        </div>
        <div class="col-md-4 caption">
			<a href="http://www.twitter.com"  class="icon  fa fa-twitter" style="background-color:#3b88c3;"></a>
			<a href="http://www.facebook.com" class="icon fa fa-facebook" style="background-color:#3b5998;"></a>
			<a href="http://www.linkedin.com" class="icon fa fa-linkedin" style="background-color:#2a6496;"></a>
			<a href="http://www.dribble.com"  class="icon fa fa-dribbble" style="background-color:#ea4c89;"></a>
		</div>
      </div>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Mixitup -->
    <script src="<?php echo base_url();?>js/jquery.mixitup.min.js"></script>
    <!-- Full size Background -->
    <script src="<?php echo base_url();?>js/jquery.backstretch.min.js"></script>
    <!-- Functions -->
    <script src="<?php echo base_url();?>js/functions.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	<script>
	$(document).ready(function(){
		$('#frm_addLinkCat').ajaxForm({
			beforeSubmit : function()
            {
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addLinkCat").validationEngine('validate'))
				{
					$("#btn_submit").button('loading');
					return true;
				}
				else
				{
					$("#btn_submit").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form)
            {
				$("#btn_submit").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Your Email subscribed successfully.");
					$("#successMessage").show();
					//alert("Your Email is subscribed successfully.");
                }
				else if(responseText==102)
				{
					$("#errorMessage").html("Databse server is not working.Please try again.");
					$("#errorMessage").show();
					//alert("Databse server is not working.Please try again.");
                }
                else if(responseText==200)
				{
					$("#errorMessage").html("Email ID already exists.");
					$("#errorMessage").show();
					//alert("Email ID already exists.");
				}
				else
				{
					$("#errorMessage").html(responseText);
					$("#errorMessage").show();
					//alert(responseText);
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});
	</script>
    
  </body>
</html>