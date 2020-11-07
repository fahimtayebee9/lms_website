<!-- CORE PLUGINS-->
<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="./assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
<script src="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
<script src="./assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="./assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="assets/js/app.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->
<script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>

<!-- sweetalert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    function getSubCategory(){
      var cat_id = document.getElementById(event.target.id).value;
      var xhttp = new XMLHttpRequest();
      xhttp.open('POST', 'controllers/category_controller.php', true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send('cat_id='+ cat_id);
      xhttp.onreadystatechange = function (){
          if(this.readyState == 4 && this.status == 200){
              if(this.responseText != ""){
                  if(this.responseText == "0"){
                    alert(this.responseText);
                    document.getElementById('sub_id').disabled = true;
                    document.getElementById('sub_id').innerHTML = "<option value='0'>Please select the category</option>";
                  }
                  else{
                    document.getElementById('sub_id').disabled = "";
                    document.getElementById('sub_id').innerHTML = this.responseText;
                  }
              }else{
                  document.getElementById('sub_id').innerHTML = "";
                  document.getElementById('sub_id').disabled = true;
              }
          }	
      }
    }
  </script>


    <!-- DELETE USER  -->
  <script>
    var Toast = Swal.mixin({
        toast: true,
        // position: 'top-end',
        showConfirmButton: false,
        timer: 3500
      });

    function deleteUser(user_id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        timer: 4000
      }).then((result) => {
        if (result.isConfirmed) {
          var xhttp = new XMLHttpRequest();
          xhttp.open('POST', 'controllers/user_controller.php', true);
          xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhttp.send('delete_id='+user_id);
          xhttp.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
              if(this.responseText != ""){
                Toast.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'User has been deleted.',
                  showConfirmButton: false,
                  timer: 2500
                })
              }else{
                Toast.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'User Not Deleted!',
                  showConfirmButton: false,
                  timer: 2500
                })
              }
              setTimeout(loadPageUser, 2400);
            }	
          }
        }
      })
    }

    function loadPageUser(){
      window.location = "users.php?action=Manage";
    }
  </script>

<?php
  ob_end_flush();
?>