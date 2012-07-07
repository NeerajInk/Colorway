<?php
/**
 * Template Name: Gallery Template
 *
 * @package WordPress
 * 
 */
get_header(); ?>
<!--Start Content Grid-->
<div class="grid_24 content">
     <div class="content-wrapper">
          <div class="content-info">
               <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
          </div>
          <div  class="folio-content">
               <h2>
                    <?php the_title(); ?>
               </h2>
                <?php
		if (  $wp_query->have_posts()) : while (have_posts()) : the_post(); 
			 		
		?>
              <?php the_content(); ?>
                    <?php endwhile; endif; ?>
               <ul class="thumbnail">
                    <?php
        if ($wp_query->have_posts()) : while (have_posts()) : the_post();                
                $attachment_args = array(
                    'post_type' => 'attachment',
                    'numberposts' => -1,
                    'post_status' => null,
                    'post_parent' => $post->ID,
                    'orderby' => 'menu_order ID'
                );
                $attachments = get_posts($attachment_args);
                if ($attachments) {
                    foreach ($attachments as $gallery_image) {
					
                       $attachment_img =  wp_get_attachment_url( $gallery_image->ID);
					   $img_source=inkthemes_image_resize($attachment_img,266,158);
				echo '<li><a alt="'.$gallery_image->post_title.'" href="'.$attachment_img.'" class="zoombox zgallery1">';				
                                echo  '<img src="'.$img_source[url].'" alt=""/>';
				echo '</a></li>';
				}
				}
                ?>
                    <?php endwhile; endif; ?>
               </ul>
          </div>
          <div class="folio-page-info">
               <?php pagination(); ?>
          </div>
     </div>
</div>
<div class="clear"></div>
<!--End Content Grid-->
</div>
<!--End Container Div-->
<?php get_footer(); ?>
