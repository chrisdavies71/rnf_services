<?php 

/**
 * Template Name: Tab Layout
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();

?>

<!-- Nav Tabs -->

<ul class="nav nav-tabs nav-justified" id="tabs" role="tablist" data-tabs="tabs">
	<?php
		/*  Query the post  */
		$parent = get_the_ID();
		$args = array( 'post_type' => 'services', 'posts_per_page' => -1, 'post_status' => 'publish', 'post_parent' => $parent, 'order' => 'ASC' );
		$loop = new WP_Query( $args );
		$count = 1;
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
								
				<?php $class = ($count==1) ? 'active' : ''; ?>
							
 					<li role="presentation" class="<?php echo $class; ?>">
 						<a href="#<?php echo the_title(); ?>"  aria-controls="<?php echo the_title(); ?>" role="tab" data-toggle="tab">
 							<?php echo the_title(); ?>
 						</a>
 					</li>
 			<?php $count++; endwhile; ?>
</ul>
					
<!-- Tab Contents -->

<div class="tab-content" id="tab-content">
	<?php
		/*  Query the post  */
		$args = array( 'post_type' => 'services', 'posts_per_page' => -1, 'post_status' => 'publish', 'post_parent' => $parent, 'order' => 'ASC' );
		$loop = new WP_Query( $args );
		$count = 1;
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
									
				<?php $class = ($count==1) ? 'in active' : 'in'; ?>
 				
 					<div role="tabpanel" id="<?php echo the_title();?>" class="tab-pane fade <?php echo $class; ?>">
 						<?php the_content(); ?>
 					</div>
 			<?php $count++; endwhile; ?>
 </div>