<footer class="footer footer-black">
	            		<div class="container">
	            			<a class="footer-brand" href="#pablo"><?php echo get_logo_icon();?></a>

                            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu','menu_id'=>'main-menu','menu_class'=>'pull-center','container'=>'ul')); ?>
	            			<ul class="social-buttons pull-right">
	            				<li>
	            					<a href="https://weibo.com/u/5080890941" target="_blank" class="btn btn-just-icon btn-simple">
	            						<i class="fa fa-weibo"></i>
	            					</a>
	            				</li>
	            				<li>
	            					<a class="btn btn-just-icon btn-simple" data-toggle="modal" data-target="#smallAlertModal">
	            						<i class="fa fa-weixin"></i>
	            					</a>
	            				</li>
	            				<li>
	            					<a href="100041385" target="_blank" class="btn btn-just-icon btn-simple">
	            						<i class="fa fa-qq"></i>
	            					</a>
	            				</li>
	            			</ul>

	            		</div>
	            	</footer>
<div class="modal fade in" id="smallAlertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
      </div>
      <div class="modal-body text-center">
        <img src="<?php bloginfo('template_url');?>/public/img/qrcode.png" style="width: 100%;">
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-success btn-simple" data-dismiss="modal">扫描上方二维码添加好友</button>
      </div>
    </div>
  </div>
</div>
</body>
<?php wp_footer(); ?>
</html>
