<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

  		<meta content="Western University, Western, london ontario canada research university college undergraduate graduate degrees " name="keywords"/>
  		<meta content="Department of Communications and Public Affairs, Western University" name="author"/>
		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title( '|', true, 'left' ); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<!-- <meta name="msapplication-TileColor" content="#f01d4f">
	 	<meta name="msapplication-TileImage" content="<?php //echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png"> -->

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>
	<div class="panelbck">
    	<div class="panel">
        	<div class="ribboninputcontainer">
            	<h4>Faculty / Staff Search</h4>
                <form action="http://www.uwo.ca/cgi-bin/dsgw/people.pl" method="post" name="Search_people" class="formcontrol">
                    <input name="mode" type="hidden" value="general_search" />
                    <label for="first_name" class="obscure">First Name</label>
                    <input id="first_name" class="entry-rbn" name="firstname" placeholder="First Name" />
                    <label for="last_name" class="obscure">Last Name</label>
                    <input id="last_name" class="entry-rbn" name="lastname" placeholder="Last Name" />
                    <input class="formbtn-rbn" name="info" type="submit" value="Starts with" />
                    or
                    <input class="formbtn-rbn" name="info" type="submit" value="Contains" />
                    <label for="clear" class="obscure">Clear Search</label>
                    <input id="clear" class="formbtn-rbn" type="reset" value="Clear" />
                </form>
                <br>
                <h4>Department / Unit Search</h4>
                <form class="formcontrol" method="post" name="SearchDept" action="http://www.uwo.ca/cgi-bin/dsgw/department.pl?mode=general" style=" float:left;">
                    <label for="hidden_input" class="obscure">hidden input</label>
                    <input id="hidden_input" type="hidden" name="mode" value="general">
                    <label for="department_search" class="obscure">Department Search</label>
                    <input id="department_search" class="entry-rbn-long" name="searchstring" placeholder="i.e. Chemistry or Bookstore" />
                    <label for="submit_search" class="obscure">Submit Search</label>
                    <input id="sumbit_search" class="formbtn-rbn" type="submit" value="Search">
                    <label for="clear_search" class="obscure">Clear Search</label>
                    <input id="clear_search" class="formbtn-rbn" type="reset" value="Clear">
                </form>
         	</div>
           	<div class="lists">
            	<ul style="border: 0;">
                	<li>
                    	<a href="http://www.lib.uwo.ca/" target="_blank">Libraries</a>
                    </li>
                    <li>
                    	<a href="http://www.uwo.ca/about/visit/maps.html">Maps</a>
                    </li>
                    <li>
                    	<a href="http://www.uwo.ca/parking/" target="_blank">Parking</a>
                    </li>
               	</ul>
               	<ul>
                    <li>
                    	<a href="http://www.uwo.ca/a-z.html">Websites A-Z</a>
                    </li>
                    <li>
                    	<a href="http://www.uwo.ca/directory.html">Directory</a>
                    </li>
                    <li>
                    	<a href="http://events.uwo.ca/cgi-bin/events.pl?Op=ShowIt&CalendarName=WesternEvents" target="_blank">Events</a>
                    </li>
               	</ul>
              	<ul>
                    <li>
                    	<a href="http://mail.uwo.ca" target="_blank">WebMail</a>
                    </li>
                    <li>
                    	<a href="https://owl.uwo.ca/portal" target="_blank">OWL</a>
                    </li>
                    <li>
                    	<a href="https://studentservices.uwo.ca/secure/index.cfm" target="_blank">Student Services</a>
                    </li>
                </ul>
           	</div>
            <div class="lists-2column">
            	<ul style="border: 0;">
                    <li>
                    	<a href="http://www.lib.uwo.ca/" target="_blank">Libraries</a>
                    </li>
                    <li>
                    	<a href="http://www.uwo.ca/about/visit/maps.html">Maps</a>
                    </li>
                    <li>
                    	<a href="http://www.uwo.ca/parking/" target="_blank">Parking</a>
                    </li>
                    <li>
                    	<a href="http://www.uwo.ca/directory.html">Directory</a>
                    </li>
                    <li>
                    	<a href="http://www.uwo.ca/a-z.html">Websites A - Z</a>
                    </li>
            	</ul>
            	<ul>
                    <li>
                    	<a href="http://mail.uwo.ca" target="_blank">WebMail</a>
                    </li>
                    <li>
                    	<a href="https://owl.uwo.ca/portal" target="_blank">OWL</a>
                    </li>
                    <li>
                    	<a href="https://studentservices.uwo.ca/secure/index.cfm">Student Services</a>
                    </li>
                    <li>
                    	<a href="http://events.uwo.ca/cgi-bin/events.pl?Op=ShowIt&CalendarName=WesternEvents" target="_blank">Events</a>
                    </li>
                </ul>
            </div>
       	</div>
  	</div>
    <div id="ribbon">
    	<div id="flipjar">
        <img src="<?php echo get_template_directory_uri(); ?>/library/images/pop-links-btn.gif" name="flip1" class="flip" onClick="swapImage();" onMouseOver="rOver();" onMouseOut="rOut();" alt="Popular Links tab">
        <a class="homelink" href="http://www.uwo.ca/">WesternU.ca</a>
        <?php // Settings for the Mast Header Navigation Block that will be repeated several times
			$mastHeadNavWalker = array(
				'theme_location'	=> 'mast-head-links',
				'container'			=> false,
				'items_wrap' 		=> '%3$s',
				'walker' 			=> new Custom_MastHead_Walker
			);
			$mastHeadNav = array(
				'theme_location'	=> 'mast-head-links',
				'container'			=> false,
				'items_wrap' 		=> '%3$s',
			);
        ?>
            </div>
            <div id="ribbon-inner">
            	<ul>
					<?php if ( has_nav_menu( 'mast-head-links' ) ) {
						wp_nav_menu( $mastHeadNavWalker );
					} ?>
                </ul>
          	</div>
     	</div>
   	</div>
    		<div id="ribbon-outer">
            	<ul>
					<?php if ( has_nav_menu( 'mast-head-links' ) ) {
						wp_nav_menu( $mastHeadNavWalker );
					} ?>
                    <li class="up">|</li>
                    <li>
                    	<a href="http://www.uwo.ca">WesternU.ca</a>
                    </li>
                </ul>

          	</div>
            <div class="secret-nav">
            	<nav class="nav right">
                    <ul>
                    <li class="current">
                    	<a href="#">Quick Links</a>
                    </li>
					<?php if ( has_nav_menu( 'mast-head-links' ) ) {
						wp_nav_menu( $mastHeadNav );
					} ?>
                    <li>
                    	<a href="http://www.uwo.ca">WesternU.ca</a>
                    </li>
                    </ul>
                </nav>
             </div>
        <div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Western University"></a></p>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>
					<?php if ( is_active_sidebar( 'searchbox' ) ) : ?>

						<?php dynamic_sidebar( 'searchbox' ); ?>

					<?php endif; ?>

					<nav role="navigation">
                    	<div class="nav-wrap">
						<?php bones_main_nav(); ?>
                        </div>
					</nav>

				</div>

			</header>
