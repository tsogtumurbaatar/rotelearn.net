  <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="js/script.js"></script>
	<script src="js/nouislider.min.js"></script>
	<!-- StikyMenu -->
	<script src="js/stickUp.min.js"></script>
	<script type="text/javascript">
	  jQuery(function($) {
		$(document).ready( function() {
		  $('.navbar-default').stickUp();
		  
		});
	  });
	
	</script>
	<!-- Smoothscroll -->
	<script type="text/javascript" src="js/jquery.corner.js"></script> 
	<script src="js/wow.min.js"></script>
	<script>
	 new WOW().init();
	</script>
	<script src="js/classie.js"></script>
	{{-- <script src="js/uiMorphingButton_inflow.js"></script> --}}
	<!-- Magnific Popup core JS file -->
	<script src="js/jquery.magnific-popup.js"></script> 
	<script type="text/javascript">
	var slider = document.getElementById('slider');

noUiSlider.create(slider, {
	start: [0, 25],
	connect: true,
	tooltips: true,
	step: 5,
	margin: 10,
	range: {
		'min': 0,
		'max': 200
	},
	pips: {
		mode: 'range',
		density: 10
	},
	format: {
	  to: function ( value ) {
		return value;
	  },
	  from: function ( value ) {
		return value.replace(',-', '');
	  }
	}   
});

slider.noUiSlider.on('change', function(){
	var jvar = slider.noUiSlider.get();
	 $("#jsval1").val(jvar[0]);
	 $("#jsval2").val(jvar[1]);
});

	</script>