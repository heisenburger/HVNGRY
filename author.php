<?php
/**
 * Displays the author's personal page
 */
?>

<?php get_header(); ?>

<?php
	/** 
	 * cleanretina_before_main_container hook
	 */
	do_action( 'cleanretina_before_main_container' );
?>

<div id="content">

<?php

	if(isset($_GET['author_name'])) :
		$curauth = get_userdatabylogin($author_name);
	else :
		$curauth = get_userdata(intval($author));
	endif;
?>

<h2><?php echo $curauth->first_name; ?></h2>
<span class="excerpt"><?php echo $curauth->user_description; ?></span>
<br><br>
<!– The Loop –>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
<?php the_title(); ?></a>,
<?php the_time('d M Y'); ?> in <?php the_category('&');?>
</li>

<?php endwhile; else: ?>
<p><?php _e('No posts by this author yet!'); ?></p>

<?php endif; ?>

<!– End Loop –>

<br><br>
<?php get_sidebar(); ?>
</ul>
</div>

<?php
	/** 
	 * cleanretina_after_main_container hook
	 */
	do_action( 'cleanretina_after_main_container' );
?>

<?php get_footer(); ?>