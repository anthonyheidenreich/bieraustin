<div id="footer" class="clearfix">

        <?php echo(base64_decode('PGRpdiBpZD0iY29weXJpZ2h0Ij5CZWVyIFRpbWUgVGhlbWUgZGVzaWduZWQgYnkgPGEgaHJlZj0iaHR0cDovL2NlbGxhcmFuZGtpdGNoZW4uYWRuYW1zLmNvLnVrIj5BZG5hbXMgQ2VsbGFyIGFuZCBLaXRjaGVuPC9hPjwvZGl2Pg==')); ?>

        <ul>
            <li class="first"><a href="<?php echo get_option('home'); ?>">Home |</a></li>
            <li><a href="<?php echo get_option('home'); ?>?page_id=2">About</a></li>
            <li><a href="<?php bloginfo('rss2_url'); ?>">RSS Updates |</a></li>
            <li><a href="mailto:<?php echo antispambot(get_option('admin_email')); ?>">Contact</a> </li>
        </ul>

</div>
      
<?php wp_footer(); ?>
