           
<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.min.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables_themeroller.css') ?>

<!--<style type="text/css"> 
<!-- Main content -->
<div id="first">
    <section class="content">
      <div class="error-page">
        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i>Welcome to <?php  echo $this->request->session()->read('Info.school'); ?></h3>
          <p>
           Please enter your Registration ID.
            If you are facing any problem contact the institution administration.
          </p>
          <form class="search-form" id="security_page_one">
            <div class="input-group">
                <input type="text" name="search" id='search' required class="form-control" placeholder="Registration ID" value='' />

              <div class="input-group-btn">
                <button type="submit" name="submit" id="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>  

<div id="second" style='display:none;'>
    <section class="content">
      <div class="error-page">
        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Enter Your 4 Digit PIN Code</h3>
          <p>
              If you have don't PIN Code than click here get it . <a href='#' onclick="get_pin_code();" id='get_pin_code'>Get PIN Code</a>
            
          </p>
          <form class="search-form" id="security_page_two">
            <div class="input-group">
                <input type="text" name="search" id='pincode' required class="form-control" placeholder="PIN Code">

              <div class="input-group-btn">
                <button type="submit" name="submit" id="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>  

    
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?> 
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/input-mask/jquery.inputmask.js') ?>


<?= $this->Html->script('datatable.js') ?>     
    
    
<script>
     $(document).ready(function(){
       
        $('#security_page_one').on('submit', function(e){
        var cc = $('#first #search').val(); 
        e.preventDefault();
        $('#security_page_one #submit').html('<i class="fa fa-spin fa-spinner"></i> Please wait...');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'StudentDashboard', 'action' => 'getstudentsrecord']); ?>",
                dataType:'json',
                data: {cc: cc},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        $('#first').hide();
                        $('#second').fadeIn();
                       } else {
                        toastr.error(result[0], result[1]);
                        $('#security_page_one #submit').html('<i class="fa fa-search"></i>');
                    }
                }
            });
 
        }); 
    
        $('#security_page_two').on('submit', function(e){
        var pin = $('#security_page_two #pincode').val();
        if(pin.length < 4 ){
            toastr.error('Invalid PIN Code, Please Try again.');    
            return false;
        }
  
        e.preventDefault();
        $('#security_page_two #submit').html('<i class="fa fa-spin fa-spinner"></i> Please wait...');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'StudentDashboard', 'action' => 'getpincode']); ?>",
                dataType:'json',
                data: {pin: pin},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        location.assign('<?php echo $this->Url->build(['controller' => 'StudentPortal', 'action' => 'index' ]); ?>');
                        } else {
                        toastr.error(result[0], result[1]);
                        $('#security_page_two #submit').html('<i class="fa fa-search"></i>');
                    }
                }
            });
 
        });
   
    });
    
    function get_pin_code(){
        var cc = $('#first #search').val();
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'StudentDashboard', 'action' => 'generatepin']); ?>",
                dataType:'json',
                data: {cc: cc},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        } else {
                        toastr.error(result[0], result[1]);
                       
                    }
                }
            });
 
        }
    
        
</script>  
