
	<!-- JS Files -->
	<script src="assets/js/vendor/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/plugins.js"></script>
	<script src="assets/js/active.js"></script>
	
	<!-- SELECT 2 PLUGIN -->
	<script src="admin/plugins/select2/js/select2.full.min.js"></script>


	<!-- sweetalert2 -->
	<script src="admin/plugins/sweetalert2/sweetalert2.min.js"></script>
	
	<!-- NOTIFICTAION SCRIPTS -->
	<script>
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3500
        });
		function infobox(){
			Swal.fire({
			title: 'ERROR 404',
			text: "You are not logged in...",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sign Up!!!',
			timer: 4000
        }).then((result) => {
				if (result.isConfirmed) {
					window.location = "checkout.php?action=SignUp";
				}
			})
		}

		<?php
			if(isset($_SESSION['message'])){
				if(isset($_SESSION['type'])){
				  ?>
						Toast.fire({
						  position: 'top-end',
						  icon: '<?=$_SESSION['type']?>',
						  title: '<?=$_SESSION['message']?>',
						  showConfirmButton: false,
						  timer: 2500
						})
				  <?php
				}
				unset($_SESSION['message'],$_SESSION['type']);
			}
		?>
	</script>

	<!-- SELECT 2 SCRIPTS -->
	<script>
		$(function () {
			//Initialize Select2 Elements
			$('#select2bk').select2()

			//Initialize Select2 Elements
			$('#select2bk').select2({
				theme: 'bootstrap4',
				placeholder: 'Select an option',
				tags: true,
				allowClear: true,
				closeOnSelect: true
			})
		})
	</script>
    
    <?php ob_end_flush();?>