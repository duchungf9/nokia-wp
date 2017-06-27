<?php
/**
 * Template Name: Sai Thông Tin
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package cactus
 */
get_header('saithongtin'); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

 		
  					<?php while (have_posts()) : the_post();  ?>

				<?php the_content(); ?>

    					 <?php endwhile;?>
  				
  <style>
  .custom-btn{
  	border-radius: 0px !important;
  	margin:25px auto !important;
  	display: block;
  	max-width: 300px;
  }
  	.mark{
  		position: absolute;
  		top:0;
		bottom: 0;
		right: 0;
		left: 0;
		background: #000;
		z-index: -9;
  	}
	.full-bg{
		position: relative;
		background: #000;
		width: 100% !important;
		height: 100%;
		top:0;
		bottom: 0;
		right: 0;
		left: 0;
	}
	.popup-duan{
		width: 60%;
		height: 500px;
		background: #FFF;
		z-index: 9999999999999;
	}
  a{
    color:#FFF !important;
  }
  #itro_popup{
    display: none !important;
  }
  </style>
<?php get_footer('saithongtin'); ?>
