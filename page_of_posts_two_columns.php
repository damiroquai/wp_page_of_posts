<?php
/*
Template Name: Page Of Posts Two Columns
*/
/* This example is for a child theme of Twenty Thirteen: 
*  You'll need to adapt it the HTML structure of your own theme.
*/

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	
		<header class="archive-header">   
			<h1 class="archive-title"><?php printf( __( '%s', 'twentythirteen' ), the_title( '', false ) ); ?></h1>
		</header><!-- .archive-header -->
            
		<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
			
	<?php endwhile; ?>


	<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$query_args = array(
			'post_type' => 'post',
			'category_name' => 'plugins',/*add your category here, or coma separated multiple categories*/
			'posts_per_page' => 4, /*number of posts to show per page*/
			'paged' => $paged 
			);
	// create a new instance of WP_Query
		$the_query = new WP_Query( $query_args );
	?>

	<?php $col = 1; ?>
	<article class="entry_content_medium">
		<div class="entry-content">
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
		<?php if ($col == 1) echo '<div class="entry-content-two-columns-row">'; ?>
		
			<div class="post col<?php echo $col;?>" id="post-<?php the_ID(); ?>">
			<h2 class="entry-title-medium"><a href="<?php echo  get_permalink(); ?>" rel="bookmark"><?php echo the_title(); ?></a></h2>
		
				<div class="entry-thumbnail-medium">
					<a href="<?php echo  get_permalink(); ?>" rel="bookmark" title="<?php echo the_title(); ?>">
					<?php the_post_thumbnail(); ?>
					</a>
				</div> 
			
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
				
				<div class="entry-meta"> 
				
					<?php // twentythirteen_entry_meta(); ?>
					<?php // edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
	
					<?php if ( comments_open() && ! is_single() ) : ?>
					
					<div class="comments-link">
					<?php // comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
					</div><!-- .comments-link -->
				
					<?php endif; // comments_open() ?>
        			</div><!-- .entry-meta -->       
        		</div><!-- .entry-content-two-columns-row -->     
		<?php if ($col == 1) echo '</div>'; (($col==1) ? $col=2 : $col=1); endwhile; ?>  
		</div> <!-- entry_content -->
	</article>

	<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>


	<?php
	if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>

	<nav class="navigation paging-navigation" role="navigation">
	
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		
		<div class="nav-links">
		
			<div class="nav-previous">
			<?php echo get_next_posts_link( '<span class="meta-nav">&larr;</span> Older posts', $the_query->max_num_pages ); // display older posts link ?>
			</div>
		
			<div class="nav-next">
			<?php echo get_previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); // display newer posts link ?>
			</div>
		</div>
	</nav>
	<?php } ?>

	<?php else: ?>
	
	<div class="entry-content">
		<article>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		</article>
	</div>

	<?php endif; ?>

		<?php // twentythirteen_child_paging_nav(); ?>     
         
		     
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
