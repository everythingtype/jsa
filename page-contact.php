<?php 

/* Template Name: Contact */ 

get_header(); ?>
<?php if (have_posts()) : ?>
	<div class="contacttemplate">
		<?php while (have_posts()) : the_post(); ?>
			<div class="edgemargin">

				<h2 class="mobiletitle"><?php the_title(); ?></h2>

				<dl>
					<dt>Telephone</dt>
					<dd>+1 212 431 8751</dd>
					<dt>Email</dt>
					<dd><a href="mailto:info@joelsandersarchitect.com">info@joelsandersarchitect.com</a></dd>
				</dl>


			<div class="contactmaps">

				<div class="nylocation">

					<div id="nymap"></div>

					<p><a href="https://www.google.com/maps/place/89+5th+Avenue,+New+York,+NY+10003/" target="_blank">New York<br />
					89 5th Avenue, Suite 301<br />
					New York, NY 10003</a></p>

				</div>

<!--

				<h3>Other Offices</h3>

				<div class="shanghailocation">

					<div id="shanghaimap"></div>

					<p><a href="https://www.google.com/maps/place/106+E+19th+St,+New+York,+NY+10003/" target="_blank">Shanghai<br />
					106 East 19th Street, 2nd Floor<br />
					New York, NY 10003</a></p>

				</div>

				<div class="dubailocation">

					<div id="dubaimap"></div>

					<p><a href="https://www.google.com/maps/place/106+E+19th+St,+New+York,+NY+10003/" target="_blank">Dubai<br />
					106 East 19th Street, 2nd Floor<br />
					New York, NY 10003</a></p>

				</div>

-->

			</div>

			<div class="contactcontent">

				<?php the_content(); ?>

			</div>
		</div>

		<?php endwhile; ?>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
