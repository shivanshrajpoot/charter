<footer class="footer">
	<div class="container-fluid">
		<nav class="pull-left">
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="http://www.themekita.com">
						Charter
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">
						Help
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">
						Licenses 
					</a>
				</li>
			</ul>
		</nav>
		<div class="copyright ml-auto">
			2018, made with <i class="la la-heart heart text-danger"></i> by Developers</a>
		</div>				
	</div>
</footer>
<script type="text/javascript">
	var $notify = '<?php echo $notification['notify']; ?>'
	var $notify_obj = JSON.parse('<?php echo_json($notification['notify_obj']); ?>')
</script>
<script src="<?php _url('assets/js/core/jquery.3.2.1.min.js');?>"></script>

<script src="<?php _url('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js');?>"></script>
<script src="<?php _url('assets/js/core/popper.min.js');?>"></script>
<script src="<?php _url('assets/js/core/bootstrap.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/chartist/chartist.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/jquery-mapael/jquery.mapael.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/jquery-mapael/maps/world_countries.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/chart-circle/circles.min.js');?>"></script>
<script src="<?php _url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js');?>"></script>
<!-- Timepicker -->
<script src="<?php _url('assets/js/wickedpicker.min.js');?>"></script>
<!-- Datepicker -->
<script src="<?php _url('assets/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php _url('assets/js/ready.min.js');?>"></script>
<script src="<?php _url('assets/js/demo.js');?>"></script>
<script src="<?php _url('assets/js/app.js');?>"></script>
<!-- Datatable -->
<script src="<?php _url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php _url('assets/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php _url('assets/js/dataTables.buttons.min.js');?>"></script>
<script src="<?php _url('assets/js/buttons.bootstrap4.min.js');?>"></script>
<script src="<?php _url('assets/js/jszip.min.js');?>"></script>
<script src="<?php _url('assets/js/pdfmake.min.js');?>"></script>
<script src="<?php _url('assets/js/vfs_fonts.js');?>"></script>
<script src="<?php _url('assets/js/buttons.html5.min.js');?>"></script>
<script src="<?php _url('assets/js/buttons.print.min.js');?>"></script>
<script src="<?php _url('assets/js/buttons.colVis.min.js');?>"></script>
<script src="<?php _url('assets/js/dataTables.select.min.js');?>"></script>
<script src="<?php _url('assets/js/sweetalert.min.js');?>"></script>
<script>
	$( function() {
		$( "#slider" ).slider({
			range: "min",
			max: 100,
			value: 40,
		});
		$( "#slider-range" ).slider({
			range: true,
			min: 0,
			max: 500,
			values: [ 75, 300 ]
		});
	} );
	$('[data-target="#submitPrice"]').on('click',function(){
		$('#request_id').val($(this).data('id'))
	})
</script>
</html>