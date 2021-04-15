<?php
  $team_position = get_post_meta(get_the_id(), 'vizeon_team_position', true );
  $team_socials = get_post_meta(get_the_id(), 'team_socials', false );
  $team_color = get_post_meta(get_the_id(), 'vizeon_team_color', true );
  $team_text_color = get_post_meta(get_the_id(), 'vizeon_team_text_color', true );
  if(isset($team_socials[0])){
  	$team_socials = $team_socials[0]; 
  }

?>
<div class="team-block team-v2 <?php echo esc_attr($team_text_color); ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="team-image">
		 	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		 	<?php if($team_socials){ ?>
			   <div class="socials-team">
		     	<?php foreach ($team_socials as $key => $social) { ?>
		     		<?php if(isset($social['link']) && isset($social['icon'])){ ?>
				     	<a class="gva-social" href="<?php echo esc_url($social['link']) ?>"><?php echo esc_html($social['icon']) ?></a>
				   <?php } ?>   
		     	<?php } ?>
			   </div>
			<?php } ?>
		</div>
	<?php endif ?>
	<div class="team-content">  
	   <div class="team-content-inner">
         <div class="team-name"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></div>
   	   <?php if($team_position){ ?>   
   	   	<div class="team-job"><?php echo esc_html( $team_position ); ?></div>
   	   <?php } ?>
      </div>
	</div>
</div>  