<?php get_header(); ?>

<div class="content thin">
											        
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
		
			<?php $post_format = get_post_format(); ?>
			
			<?php if ( $post_format == 'video' ) : ?>
			
				<?php $video_url = get_post_meta($post->ID, 'video_url', true); if ( $video_url != '' ) : ?>
				
					<div class="featured-media">
					
						<?php if (strpos($video_url,'.mp4') !== false) : ?>
							
							<video controls>
								<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
							</video>
																					
						<?php else : ?>
							
							<?php 
							
								$embed_code = wp_oembed_get($video_url); 
								
								echo $embed_code;
								
							?>
								
						<?php endif; ?>
						
					</div>
				
				<?php endif; ?>
				
			<?php elseif ( $post_format == 'gallery' ) : ?>
			
				<div class="featured-media">	
	
					<?php fukasawa_flexslider('post-image'); ?>
					
					<div class="clear"></div>
					
				</div> <!-- /featured-media -->
				
			<?php elseif ( $post_format == 'quote' ) : ?>
			
				<?php $quote_content = get_post_meta($post->ID, 'quote_content', true); ?>
				<?php $quote_attribution = get_post_meta($post->ID, 'quote_attribution', true); ?>
					
				<div class="post-quote">
				
					<div class="post-inner">
						
						<blockquote><?php echo $quote_content; ?></blockquote>
					
						<?php if ( $quote_attribution != '' ) : ?>
						
							<cite><?php echo $quote_attribution; ?></cite>
						
						<?php endif; ?>
					
					</div> <!-- /post-inner -->
				
				</div> <!-- /post-quote -->
					
			<?php endif; ?>
			
			<div class="post-inner">
				
				<div class="post-header">
													
					<h2 class="post-title"><?php the_title(); ?></h2>
															
				</div> <!-- /post-header -->
				    
			    <div class="post-content">
			    
			    	<?php the_content(); ?>
			    
			    </div> <!-- /post-content -->
			    
			    <div class="clear"></div>
				
				<div class="post-meta-bottom">
				
					<?php 
				    	$args = array(
							'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:','fukasawa' ) . '</span>',
							'after'            => '</p>',
							'link_before'      => '<span>',
							'link_after'       => '</span>',
							'separator'        => '',
							'pagelink'         => '%',
							'echo'             => 1
						);
			    	
			    		wp_link_pages($args); 
					?>
				
					<ul>
						<?php if (has_category()) : ?>
							<li class="post-categories"><?php _e('In','fukasawa'); ?> <?php the_category(', '); ?></li>
						<?php endif; ?>
						<?php if (has_tag()) : ?>
							<li class="post-tags"><?php the_tags('', ' '); ?></li>
						<?php endif; ?>
						<?php edit_post_link('Edit post', '<li>', '</li>'); ?>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- /post-meta-bottom -->
			
			</div> <!-- /post-inner -->
		
		</div> <!-- /post -->
									                        
   	<?php endwhile; else: ?>

		<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "fukasawa"); ?></p>
	
	<?php endif; ?>    

</div> <!-- /content -->
		
<?php get_footer(); ?>