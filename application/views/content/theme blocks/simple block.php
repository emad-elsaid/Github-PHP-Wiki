<?php if( $mode=='config' ):
//the plugin requirements as a YAML object is here ?>
title:
	type: textbox
contentText:
	type: textarea
	


<?php elseif( $mode=='layout' ): 
//replace 0 with number of cells your plugin has ?>
0


<?php elseif( $mode=='view' ):
//the real content of your plugin goes here ?>

<div class="block">
	<h3><?=$title?></h3>
		<div class="content">
		<p><?=$contentText?></p>
	</div>
</div>

<?php endif; ?>
