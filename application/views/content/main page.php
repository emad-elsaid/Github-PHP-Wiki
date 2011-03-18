<?php if( $mode=='config' ):
//the plugin requirements as a YAML object is here ?>



<?php elseif( $mode=='layout' ): 
//replace 0 with number of cells your plugin has ?>
2


<?php elseif( $mode=='view' ):
//the real content of your plugin goes here ?>

  <div id="container">
    <div id="header">
      <h1><a href="<?=base_url()?>"><?=theme_title('text')?></a></h1>
      <div id="user-navigation">
        <ul class="wat-cf">
        <?php if(perm_chck('logged')): ?>
            <li><a class="logout" href="<?=site_url('logout')?>">Logout <?=$ci->system->user->username?></a></li>
        <?php else: ?>
        	<li><a class="logout" href="<?=site_url('login')?>">Login</a></li>
        <?php endif; ?>
        </ul>
      </div>
      <div id="main-navigation">
        <ul class="wat-cf">
          <li><a href="<?=site_url('4')?>">Pages</a></li>
        </ul>
      </div>
    </div>
    <div id="wrapper" class="wat-cf">
      <div id="main">
		
		<?=$cell[0]?>

        <div id="footer">
          <div class="block">
            <p>Copyright &copy; <?=date('Y')?> <?=theme_sitename()?>, Built on <a href="http://blazeeboy.github.com/Codeigniter-Egypt/">Egypt CMS</a>.</p>
          </div>
        </div>
      </div>
      <div id="sidebar">
        <?=$cell[1]?>
      </div>
    </div>
  </div>

<?php endif; ?>
