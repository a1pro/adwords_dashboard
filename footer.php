
	<!-- Jquery Start Here -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Tab Jquery Starts -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.main-tab').click(function(){ 
				$('.main-tab').children("ul.inner-tab").hide();
				$(this).children("ul.inner-tab").show();
			});

			$(".showstate").click(function(){
				var id  = $(this).attr('id');
				$("."+id).toggle();					
       		});
       		$(function() {
				$( "#datepicker" ).datepicker();
			});
			$(function() {
				$( "#datepicker1" ).datepicker();
			});
		});
	</script>
</body>
</html>