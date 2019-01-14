			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">
					<div class="inside-footer">

                        <div class="fivecol first">
                            <p class="footernavtitles">&#169; 1878 - <?php echo date("Y"); ?> Western University</p><p class="footercontact">Western University<br/>1151 Richmond Street<br/>
                          London, Ontario, Canada, N6A 3K7<br/>
                          Tel: 519-661-2111<br/></p>
                            <p class="footercontact"><a href="http://www.uwo.ca/about/contact.html">Contact Us</a><br/> <a href="http://www.uwo.ca/privacy/index.html" target="_blank">Privacy</a> | <a href="http://communications.uwo.ca/comms/web_design/standards/index.html" target="_blank">Web Standards</a> | <a href="http://communications.uwo.ca/comms/terms_of_use.html" target="_blank">Terms of Use</a> | <a href="http://accessibility.uwo.ca/" target="_blank">Accessibility</a></p>
                        </div>

						<?php if ( is_active_sidebar( 'footerlinksone' ) ) : ?>

							<?php dynamic_sidebar( 'footerlinksone' ); ?>

						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footerlinkstwo' ) ) : ?>

							<?php dynamic_sidebar( 'footerlinkstwo' ); ?>

						<?php endif; ?>


                        <div class="threecol last">
                            <a href="http://www.uwo.ca"><img class="footer-crest" src="<?php echo get_template_directory_uri(); ?>/library/images/crest-stack-3.png" alt="Western logo"></a>
                        </div>

					</div>
				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>


    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-436113-39']);
        _gaq.push(['_setDomainName', 'uwo.ca']);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</html>
