<?php if( $mode=='config' ):
//the plugin requirements as a YAML object is here ?>
title:
	type: textbox
	default: Pages
limit:
	type: number
	default: 50


<?php elseif( $mode=='layout' ): 
//replace 0 with number of cells your plugin has ?>
0


<?php elseif( $mode=='view' ):
//the real content of your plugin goes here ?>
<?php
$ci->load->helper('directory');
$files = directory_map('wiki',1);
$files = array_slice( $files, 0, $limit );

$titles = array();
foreach( $files as $file )
	if( is_file('wiki/'.$file) and $file!='index.html' )
		$titles[] = substr( $file, 0, strrpos($file,'.') );
?>
<div class="block">
	<h3><?=$title?></h3>
	<ul class="navigation">
		<?php foreach( $titles as $title ): ?>
		<li><a href="<?=site_url('1/'.$title)?>"><?=str_replace('-',' ', $title)?></a></li><li>
		<?php endforeach; ?>
	</ul>
</div>

<?php endif; ?>
