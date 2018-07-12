<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
 <style>
  .ui-progressbar {
    position: relative;
  }
  .progress-label {
    position: absolute;
    left: 50%;
    top: 4px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
  }
  </style>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Update</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-primary" id="up">
                                <div class="panel-heading">Update</div>
                                <div class="panel-body">
                                    <div  class="col-md-8">
                                        <div id="progressbar" style="display:none;"><div class="progress-label">Loading...</div></div>
                                    </div>
                                    
                                    <div  class="col-md-4">
                                        
                                    <div class="box-footer  pull-right">
                                          
                                           <a  href="#" onclick="updates();"  class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-download"></i> Load Updates </a>
                                                                            
                                    </div>
 
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

</section>
<!-- /.content -->

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  function progress(){
  //$( function() {
   $('#progressbar').show();
    var progressbar = $( "#progressbar" ),
      progressLabel = $( ".progress-label" );
 
    progressbar.progressbar({
      value: false,
      change: function() {
        progressLabel.text( progressbar.progressbar( "value" ) + "%" );
      },
      complete: function() {
        progressLabel.text( "Completed!" );
        toastr.success('The updates has been installed');
      }
       
    });
 
    function progress() {
      var val = progressbar.progressbar( "value" ) || 0;
 
      progressbar.progressbar( "value", val + 2 );
 
      if ( val < 99 ) {
        setTimeout( progress, 80 );
      }
    }
 
    setTimeout( progress, 2000 );
  //} );
  }
    function updates() {
    
        swal({
            title: 'Are you sure?',
            text: "You want to install updates!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
              progress();
          //  imageOverlay('#up', 'show');
            if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Tools', 'action' => 'clearcache']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {},
                        success: function (data) {
                        //    imageOverlay('#up','hide');
                          
                           // var result = data.msg.split("|");
//                            if (result[0] === "Success") {
//                                toastr.success(result[0], result[1]);
//                            } else {
//                                toastr.error(result[0], result[1]);
//                            }
                        }
                    });
           }

        });

    }
</script>   