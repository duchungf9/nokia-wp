		</div><!-- #content-wrap -->
		
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" <?php hybrid_attr( 'footer' ); ?>>
		<div class="container">

			<?php
				saha_footer_widgets();

				saha_footer_bottom();
			?>

		</div>
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php 
// Scroll top
if ( saha_mod( PREFIX . 'scroll-top', '1' ) == '1' ) {
	echo '<a id="scroll-top"><span class="'. saha_mod( PREFIX . 'scroll-top-icon' ) .'"></span></a>';
}

wp_footer(); ?>
<div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <style>#cfacebook{position:fixed;bottom:0px;left:10px;z-index:999999999999999;width:250px;height:auto;box-shadow:6px 6px 6px 10px rgba(0,0,0,0.2);border-top-left-radius:5px;border-top-right-radius:5px;overflow:hidden;}#cfacebook .fchat{float:left;width:100%;height:270px;overflow:hidden;display:none;background-color:#fff;}#cfacebook .fchat .fb-page{margin-top:-130px;float:left;}#cfacebook a.chat_fb{float:left;padding:0 25px;width:250px;color:#fff;text-decoration:none;height:40px;line-height:40px;text-shadow:0 1px 0 rgba(0,0,0,0.1);background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAqCAMAAABFoMFOAAAAWlBMV…8/UxBxQDQuFwlpqgBZBq6+P+unVY1GnDgwqbD2zGz5e1lBdwvGGPE6OgAAAABJRU5ErkJggg==);background-repeat:repeat-x;background-size:auto;background-position:0 0;background-color:#336699;border:0;border-bottom:1px solid #336699;z-index:9999999;margin-right:12px;font-size:18px;}#cfacebook a.chat_fb:hover{color:Orange;text-decoration:none;}</style>
  <script>
  jQuery(document).ready(function () {
  jQuery(".chat_fb").click(function() {
jQuery('.fchat').toggle('slow');
  });
  });
  </script>
  <div id="cfacebook">
  <a href="javascript:;" class="chat_fb" onclick="return:false;"><i class="fa fa-facebook-square"> </i>Chat Với Chúng Tôi</a>
  <div class="fchat">
  <div class="fb-page" data-tabs="messages" data-href="https://www.facebook.com/dienthoai.nokiavip/" data-width="250" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
  </div>
  </div>
<style>
#floating-phone { display: none; position: fixed; right: 10px; bottom: 10px; height: 60px; width: 50px; background: url(http://nokiavip.vn/wp-content/uploads/2017/03/button-02.png) center / 50px no-repeat; z-index: 99; color: #FFF; font-size: 35px; line-height: 55px; text- align: center; border-radius: 50%; -webkit-box-shadow: 0 2px 5px rgba(0,0,0,.5); -moz-box-shadow: 0 2px 5px rgba(0,0,0,.5); box-shadow: 0 2px 5px rgba(0,0,0,.5); }
@media (max-width: 650px) { #floating-phone { display: block; } }
</style>

<a href="tel:0944433333" title="Gọi 0944433333" onclick="_gaq.push(['_trackEvent', 'Contact', 'Call Now Button', 'Phone']);" id="floating-phone"><i class="uk-icon-phone"></i>
</a>
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 864265501;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/864265501/?guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>
