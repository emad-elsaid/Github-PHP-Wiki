<?php if( $mode=='config' ):
//the plugin requirements as a YAML object is here ?>



<?php elseif( $mode=='layout' ): 
//replace 0 with number of cells your plugin has ?>
0


<?php elseif( $mode=='view' ):
//the real content of your plugin goes here 
$page = $ci->uri->rsegment(4);
if( $page === FALSE )
	$page = 'Home';

$title = str_replace('-',' ',$page);
theme_pagetitle($title);
$page = strtolower($page);
	
$ci->load->helper('directory');
$files = directory_map('wiki',1);

$titles = array();
foreach( $files as $file )
	if( is_file('wiki/'.$file) and $file!='index.html' )
		$titles[strtolower(substr( $file, 0, strrpos($file,'.') ))] = $file ;

$page_file = $titles[$page];
$extension = substr( $page_file, strrpos($page_file,'.')+1 );

$text = file_get_contents('wiki/'.$page_file);
switch( $extension ){
	case 'textile':
		$ci->load->helper('textile');
		
		$text = str_replace( '```', '@' , $text );
		
		// then parse
		$parser = new Textile();
		$text = $parser->TextileThis($text);
		
		// then make pages links
		$text = str_replace( array('[[',']]'), array('<a rel="page" href="'.site_url('1').'/">','</a>') , $text );
		
		// that will fix images links
		$base_url = base_url();
		theme_add('jquery/jquery.js');
		theme_add(<<<EOT
<script type="text/javascript" >
$(function(){
	$('a[rel="page"]').each(function(){
		text = $(this).text();
		text = text.split(' ').join('-');
		$(this).attr('href', $(this).attr('href')+text);
	});
	$('.parse img').each(function(){
		el = $(this);
		el.attr('src', "{$base_url}wiki/"+el.attr('src'));
	});
	$('.parse code').each(function(){
		el = $(this);
		text = el.html();
		language = text.split('\\n')[0];
		
		if(  $.inArray( language, new Array(
					'cpp','c','c++','c#','c-sharp','csharp',
					'css','delphi','pascal','java','js','jscript',
					'javascript','php','py','python','rb','ruby',
					'rails','ror','sql','vb','vb.net','xml','html',
					'xhtml','xslt') )==-1 )
		{
			language = 'html';
		}
		
		text = text.split('\\n');
		text[0] = undefined;
		text = text.join('\\n');
		if( text.length>0 ){
			pre = $('<pre>').html(text).attr('name','code').addClass(language);
			el.replaceWith(pre);
		}
	});
	dp.SyntaxHighlighter.HighlightAll('code');
});
</script>
EOT
);
		break;
}
?>

        <div class="block" id="block-text">
          <div class="content">
            <h2 class="title"><?=$title?></h2>
            <div class="inner parse">
              <?=$text?>
            </div>
          </div>
        </div>

<?php endif; ?>
