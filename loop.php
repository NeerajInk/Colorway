<ul class="blog_post">
     <!-- Start the Loop. -->
     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
     <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
           <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                         <?php inkthemes_get_thumbnail(224, 145); ?>
                    <?php } else { ?>
                        <?php inkthemes_get_image(250, 170); ?> 
                        <?php
                    }
                    ?>	
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          Posted on
          <?php the_time('F j, Y'); ?>
          by
          <?php the_author_posts_link() ?>
          in
          <?php the_category(', '); ?>
          <?php the_excerpt(); ?>
          <?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?>
          <a href="<?php the_permalink() ?>">Continue Reading...</a> </li>
     <!-- End the Loop. -->
     <?php endwhile; else: ?>
     <li>
          <p>
               <?php _e('Sorry, no posts matched your criteria.', 'colorway'); ?>
          </p>
     </li>
     <?php endif; ?>
</ul>
