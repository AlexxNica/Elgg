<?php

	/**
	 * Elgg user display
	 * 
	 * @package ElggProfile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Ben Werdmuller <ben@curverider.co.uk>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 * 
	 * @uses $vars['entity'] The user entity
	 */

	if ($vars['full'] == true) {
		$iconsize = "large";
	} else {
		$iconsize = "medium";
	}
	echo elgg_view(
						"profile/icon", array(
												'entity' => $vars['entity'],
												'align' => "right",
												'size' => $iconsize,
											  )
					);

?>
	<h2><a href="<?php echo $vars['entity']->getUrl(); ?>"><?php echo $vars['entity']->name; ?></a></h2>
	<?php 

		if ($vars['full'] == true) {
	
	?>
	<p><b><?php echo elgg_echo("profile:aboutme"); ?></b></p>
	<p><?php echo nl2br($vars['entity']->description); ?></p>
	<?php

		if (is_array($vars['config']->profile) && sizeof($vars['config']->profile) > 0)
			foreach($vars['config']->profile as $shortname => $valtype) {
				if ($shortname != "description") {
					$value = $vars['entity']->$shortname;
					if (!empty($value)) {
					
	?>

	<p>
		<b><?php

			echo elgg_echo("profile:{$shortname}");
		
		?>: </b>
		<?php

			echo elgg_view("output/{$valtype}",array('value' => $vars['entity']->$shortname));
		
		?>
		
	</p>

	<?php
					}
				}
			}
			
		}
	
		if ($vars['entity']->canEdit()) {
	
	?>
	<p>
		<a href="<?php echo $vars['url']; ?>mod/profile/edit.php"><?php echo elgg_echo("edit"); ?></a>
	</p>
	<?php

		}
	
	?>