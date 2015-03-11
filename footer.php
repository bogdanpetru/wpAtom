
	</div><!-- #content -->



	<footer id="footer" class="container">
	</footer>

<?php wp_footer(); ?>
<script src="<?php bloginfo( 'template_url' ); ?>/assets/js/lib/slick/slick.min.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/assets/js/lib/magnific/magnific.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/assets/js/main.js"></script>

<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create',<?= $simpleTheme['googleAnalyticsSiteId'] ?>,'auto');ga('send','pageview');
</script>

</body>
</html>
