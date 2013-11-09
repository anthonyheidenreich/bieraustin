  <h1><a href="<?php echo get_option('home'); ?>" class="logo"><?php bloginfo('name'); ?><br /><span><?php bloginfo('description'); ?></span></a></h1>

   <ul id="nav">
        <li<?php if (is_home()) { echo(' class="current_page_item"'); } ?>><a href="<?php echo get_option('home'); ?>">Home</a></li>
	<li><a href="<?php echo get_option('home'); ?>?page_id=2">About</a></li>
        <li><a href="<?php bloginfo('rss2_url'); ?>">RSS Updates</a></li>
        <li><a href="mailto:<?php echo antispambot(get_option('admin_email')); ?>">Contact</a></li>
      </ul>
