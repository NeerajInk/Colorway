<?php
/*
Template Name: Contact
*/
?>
<?php
$nameError='';
$commentError='';
$emailError='';
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = '[PHP Snippets] From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
} ?>
<?php get_header(); ?>
<!--Start Content Grid-->
<div class="grid_24 content contact">
     <div  class="grid_16 alpha">
          <div class="content-wrap">
               <div class="content-info">
                    <?php if (function_exists('inkthemes_breadcrumbs')) inkthemes_breadcrumbs(); ?>
               </div>
               <!--Start Blog Post-->
               <div class="contact">
                    <h2>
                         <?php the_title(); ?>
                    </h2>
                    <ul>
                         <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                         <li>
                              <?php if(isset($emailSent) && $emailSent == true) { ?>
                              <div class="thanks">
                                   <p>Thanks, your email was sent successfully.</p>
                              </div>
                              <?php } else { ?>
                              <?php the_content(); ?>
                              <?php if(isset($hasError) || isset($captchaError)) { ?>
                              <p class="error">Sorry, an error occured.
                              <p>
                                   <?php } ?>
                              <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                                   <ul class="contactform">
                                        <li>
                                             <label for="contactName">Name:</label>
                                             <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
                                             <?php if($nameError != '') { ?>
                                             <span class="error">
                                             <?=$nameError;?>
                                             </span>
                                             <?php } ?>
                                        </li>
                                        <li>
                                             <label for="email">Email</label>
                                             <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
                                             <?php if($emailError != '') { ?>
                                             <span class="error">
                                             <?=$emailError;?>
                                             </span>
                                             <?php } ?>
                                        </li>
                                        <li>
                                             <label for="commentsText">Message:</label>
                                             <textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?>
</textarea>
                                             <?php if($commentError != '') { ?>
                                             <span class="error">
                                             <?=$commentError;?>
                                             </span>
                                             <?php } ?>
                                        </li>
                                        <li>
                                             <input type="submit" value="Send Email"/>
                                        </li>
                                   </ul>
                                   <input type="hidden" name="submitted" id="submitted" value="true" />
                              </form>
                              <?php } ?>
                         </li>
                         <!-- End the Loop. -->
                         <?php endwhile;?>
                    </ul>
               </div>
               <div class="hrline"></div>
               <!--End Blog Post-->
               <div class="clear"></div>
               <div class="social_link">
                    <p>If you enjoyed this article please consider sharing it!</p>
               </div>
               <div class="social_logo"> <a title="Tweet this!" href="http://twitter.com/home/?status=<?php the_title(); ?> : <?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter-share.png" alt="twitter" title="twitter"/></a> <a title="Share on StumbleUpon!" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/stumbleupon-share.png" alt="upon" title="upon"/></a> <a title="Share on Facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;amp;t=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook-share.png" alt="facebook" title="facebook"/></a> <a title="Digg This!" href="http://digg.com/submit?phase=2&amp;amp;url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/digg-share.png" alt="digg" title="digg"/></a> </div>
               <div class="clear"></div>               
          </div>
     </div>
     <?php get_sidebar(); ?>
</div>
<div class="clear"></div>
<!--End Content Grid-->
</div>
<!--End Container Div-->
<?php get_footer(); ?>
