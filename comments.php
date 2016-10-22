<?php
/*
The comments page for Bones
*/

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.","freshmind"); ?></div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<h3 id="comments"><?php comments_number('<span>' . __("No","freshmind") . '</span> ' . __("Responses","freshmind") . '', '<span>' . __("One","freshmind") . '</span> ' . __("Response","freshmind") . '', '<span>%</span> ' . __("Responses","freshmind") );?> <?php _e("to","freshmind"); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

	<?php freshmind_comment_nav(); ?>
	
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=freshmind_comments'); ?>
	</ol>
	
	<?php endif; ?>
	
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<h3 id="pings">Trackbacks/Pingbacks</h3>
		
		<ol class="pinglist">
			<?php wp_list_comments('type=pings&callback=list_pings'); ?>
		</ol>
	<?php endif; ?>
	
	<?php freshmind_comment_nav(); ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="alert alert-info"><?php _e("Comments are closed","freshmind"); ?>.</p>
	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

	<?php 
		comment_form( array(
			'comment_field' => '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <div class="form-control-wrap form-control-wrap-tarea form-control-wrap-comment"><textarea class="form-control" id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></div></div>',
			'class_submit'  => 'btn btn-submit'
		) ); 
	?>

<?php endif; // if you delete this the sky will fall on your head ?>
