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

<!-- SELECT 2 PLUGIN -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- DATE PICKER  -->
<script src="plugins/air-datepicker-master/dist/js/datepicker.js"></script>
<script src="plugins/air-datepicker-master/dist/js/i18n/datepicker.en.js"></script>

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


    <!-- NOTIFICATION SHOW -->
    <script>
      var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3500
      });

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
        else if(isset($_SESSION['message_arr'])){
          if(isset($_SESSION['type'])){
            foreach($_SESSION['message_arr'] as $msg){
            ?>
                  Toast.fire({
                    position: 'top-end',
                    icon: '<?=$_SESSION['type']?>',
                    title: '<?=$msg?>',
                    showConfirmButton: false,
                    timer: 2500
                  })
            <?php
            }
          }
          unset($_SESSION['message_arr'],$_SESSION['type']);
        }
      ?>
    </script>

  <!-- SELECT 2 PLUGIN installation -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('#select2').select2()

      //Initialize Select2 Elements
      $('#select2').select2({
        theme: 'bootstrap4',
        placeholder: 'Select an option',
        tags: true,
        allowClear: true,
        closeOnSelect: true
      })
    })

    $(function () {
      //Initialize Select2 Elements
      $('#select2std').select2()

      //Initialize Select2 Elements
      $('#select2std').select2({
        theme: 'bootstrap4',
        placeholder: 'Select an option',
        tags: true,
        allowClear: true,
        closeOnSelect: true
        
      })
    })
    $(function () {
      //Initialize Select2 Elements
      $('#select2status').select2()

      //Initialize Select2 Elements
      $('#select2status').select2({
        theme: 'bootstrap4',
        tags: false,
        allowClear: true,
        closeOnSelect: true
      })
    })
  </script>

  <!-- DATE PICKER -->
  <script>
      $('#book_from').datepicker({
        language: 'en',
        onSelect: function (fd, date) {
          $('#book_to').data('datepicker')
            .update('minDate', date)
        },
        dateFormat: 'yyyy-m-d',
        minDate: new Date()
      })
      
      $('#book_to').datepicker({
        language: 'en',
        minDate: new Date(),
        dateFormat: 'yyyy-m-d',
        onSelect: function (fd, date) {
          $('#book_from').data('datepicker')
            .update('maxDate', date)
        }
      })
      $('#actualDate').datepicker({
        language: 'en',
        minDate: new Date(),
        dateFormat: 'yyyy-m-d',
        onSelect: function (fd, date) {
          $('#book_from').data('datepicker')
            .update('maxDate', date)
        }
      })

      <?php
        if(isset($_SESSION['book_from'])){
          ?>
            $('#book_from').selectDate("<?=$_SESSION['book_from']?>");
          <?php
        }
        if(isset($_SESSION['book_from'])){
          ?>
            $('#book_to').selectDate("<?=$_SESSION['book_to']?>");
          <?php
        }
      ?>
    Datepicker.language['en'] = {
        days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        today: 'Today',
        clear: 'Clear',
        dateFormat: 'mm/dd/yy',
        firstDay: 0
    };
  </script>

<?php
  ob_end_flush();
?>