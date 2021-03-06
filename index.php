<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<div class="indextemplate">
		<div class="edgemargin">
			<?php while (have_posts()) : the_post(); ?>
				<div class="post">
				<div class="postcontent">
					<?php if ( is_single() ) : ?>
						<h2><?php the_title(); ?></h2>
					<?php else : ?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>

					<div class="postsubtitle">
						<?php 
						if ( in_category('books') ) :
							$book_subtitle = get_field('book_subtitle'); 
							if ( $book_subtitle && $book_subtitle != '' ) :
								echo $book_subtitle;
							endif; 
						else : ?>
							<p><?php the_time('F j, Y'); ?></p>
						<?php endif;?>
					</div>

					<?php 
					$image_gallery = get_field('image_gallery');
					
					if ( $image_gallery ) : 
						wp_enqueue_script( 'flickityjs',array('jquery'));
						wp_enqueue_script( 'postgalleryjs',array('jquery','flickityjs'));
						
						?>
						<div class="postgallery">
						<?php foreach ( $image_gallery as $image ) :?>
							<div class="postimage">
								<div class="ratio"></div>
								<div class="inner">
									<?php spellerberg_the_image($image['id'],'phoneplus'); ?>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					<?php else: ?>
						<?php if ( has_post_thumbnail() ) : ?>
							<p><?php spellerberg_the_thumbnail($post->ID,'phoneplus'); ?></p>
						<?php endif; ?>
					<?php endif; ?>

					<?php the_content(); ?>

				</div>

				<div class="socialmedia">
					<h4>Share</h4>
					<ul>
						<?php $url = get_permalink(); ?>
						<li><a href="http://twitter.com/?status=<?php echo $url; ?>">Twitter</a></li>
						<li><a href="http://www.facebook.com/share.php?u=<?php echo $url; ?>">Facebook</a></li>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>">LinkedIn</a></li>
						<li><a href="https://plus.google.com/share?url=<?php echo $url; ?>">Google+</a></li>
					</ul>
				</div>

				<?php if ( is_single() ) get_template_part('parts/backtobooks'); ?>


				</div>

			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
