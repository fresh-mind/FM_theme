<?php
/**
 * Template for displaying search forms in Freshmind
 *
 * @package WordPress
 * @subpackage Bootstrap based
 * @since Bootstrap based 1.0
 */
?>

<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline">
    <fieldset>
		<div class="input-group">
			<input type="text" name="s" id="search" placeholder="<?php _e("Search","wpbootstrap"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
			<span class="input-group-btn">
				<button type="submit" class="btn btn-default"><?php _e("Search","wpbootstrap"); ?></button>
			</span>
		</div>
    </fieldset>
</form>
