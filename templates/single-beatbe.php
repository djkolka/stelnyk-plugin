<!-- /*
Template Name: Beatbe Home
Template Post Type: post, page, event
*/
 -->
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php dynamic_sidebar( 'resume_1' ); ?>

<div id="content" class="site-content resume">
 
 <div class="page-content">
		<?php
			echo '<div class="section" id="portfolio">
					  <div class="container">
					    <div class="row">
					      <div class="col-md-6 ml-auto mr-auto">
					      	<div class="h4 text-center mb-4 title">Portfolio</div>
				        	  <div class="nav-align-center">';
		
						// Start the loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							get_template_part( 'template-parts/content_resume', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

							// End of the loop.
						endwhile;
						
		  			echo  		'</div>
	   		  				</div>
	   		  			</div>
	   			    </div>
	   			  </div>
	   			</div>';
			?>

			<div class="section" id="experience">
			  <div class="container cc-experience">
			    <div class="h4 text-center mb-4 title">Work Experience</div>
			    <div class="card">
			      <div class="row">
			        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
			          <div class="card-body cc-experience-header">
			            <p>1.2017 - Present</p>
			            <div class="h5">Freelancer</div>
			          </div>
			        </div>
			        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
			          <div class="card-body">
			            <?php echo get_post_meta($post->ID, 'freelancer', true); ?>
			          </div>
			        </div>
			      </div>
			    </div>
			    <div class="card">
			      <div class="row">
			        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
			          <div class="card-body cc-experience-header">
			            <p>01.2015 – 01.2016 </p>
			            <div class="h5">AstwellSoft</div>
			          </div>
			        </div>
			        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
			          <div class="card-body">
			            <?php echo get_post_meta($post->ID, 'astwellsoft', true); ?>
			          </div>
			        </div>
			      </div>
			    </div>
			    <div class="card">
			      <div class="row">
			        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
			          <div class="card-body cc-experience-header">
			            <p>12.2013 – 02.2015</p>
			            <div class="h5">Webbook</div>
			          </div>
			        </div>
			        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
			          <div class="card-body">
			            <?php echo get_post_meta($post->ID, 'webbook', true); ?>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
</div>
    <footer class="footer">
      <div class="container text-center">
		<a class="btn btn-default btn-round btn-lg btn-icon" target="_blank" href="<?php echo get_post_meta($post->ID, 'linkedin', true); ?>" rel="tooltip" title="Follow me on LinkedIn"><i class="fa fa-linkedin"></i></a>
      	<a class="btn btn-default btn-round btn-lg btn-icon" target="_blank" href="<?php echo get_post_meta($post->ID, 'facebook', true); ?>" rel="tooltip" title="Follow me on Facebook"><i class="fa fa-facebook"></i></a>
	  </div>
      <div class="h4 title text-center"><?php echo get_post_meta($post->ID, 'name', true); ?></div>
      <div class="text-center text-muted">
        <p>&copy; Mykola Stelnyk. All rights reserved.<br><a class="credit" href="http://Stelnyk.com" target="_blank">Stelnyk.com</a></p>
      </div>
    </footer>
  
    
    
<?php get_footer(); ?>


