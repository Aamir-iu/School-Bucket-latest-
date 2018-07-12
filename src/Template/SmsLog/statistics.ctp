<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="box">
           
                    <div class='col-md-12 col-12-9 col-xs-12'>
                        <h1 class='dashadding'><i class='fa fa-file-pdf-o'></i>&nbsp;SMS Statistics <ui  id="bigBtnIcon"><a href='#' class='pull-right btn btn-default btn-radius btn-sm' data-sectionid='profile'><i class='fa fa-wrench'></i> &nbsp;Change DateTime</ui></a></h1>

                        <div id="profile" class="panel panel-theme panelz" style="display: none;">
                            <div class="panel-heading">
                                <a href="#" class="btn btn-xs btn-link pull-right closeSec"><i class="fa fa-times-circle"></i></a>
                                <p class="panel-title"><i class="fa fa-clock-o"></i> Change Date Range</p>
                            </div>
                            <div class="panel-body"> 



                                <form class='well well-sm' method='post'>

                                    <div class="row">




                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userName">Select Date Range:</label>
                                                <input type="text" name="daterange" class="form-control" value="11-24-2017 - 11-24-2017" />
                                            </div></div>




                                    </div>



                                    <div class="form-group">
                                        <input class="btn btn-default btn-radius pull-right" type="submit" name='filter' value="Submit">
                                    </div>
                                </form>			    


                            </div>
                        </div>    				

                        <div id='mainSec' class="panel panel-theme">
                            <div class="panel-heading">

                                <p class="panel-title"><i class="fa fa-file-archive-o"></i>&nbsp; SMS Statistics From 11-24-2017 - To - 11-24-2017</p>
                            </div>			


                            <div class="panel-body well">	

                                <div class="col-md-8">

                                    <div class='table-responsive'>
                                        <table id="userstable" class='table table-bordered table-hover table-striped'>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Operator</th>
                                                    <th>Country</th>
                                                    <th>No Of SMS</th>
                                                    <th>SMS Cost</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan='3' class='text-right'>Total:</th>
                                                    <th>5</th>
                                                    <th>5</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Telenor Pakistan</td>
                                                    <td>Pakistan</td>
                                                    <td>3</td>
                                                    <td>3</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Zong (Paktel)</td>
                                                    <td>Pakistan</td>
                                                    <td>2</td>
                                                    <td>2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-md-4">

                                    <div class="box-body">

                                        <div id="container2" style="min-width: 310px; height: 300px; max-width: 600px; margin: 0 auto"></div>


                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                    </div>    
                </div>
            </div>
         
</section>
<!-- /.content -->


<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/daterangepicker/daterangepicker.js') ?>
<?php // $this->Html->script('datatable.js') ?> 

<script>
    
    $(function () {
        $("#userstable").DataTable();

    });
   
    
    $(function () {
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    $('#start').val(start);
                    $('#end').val(end);
                    
                }
                        
        );
       

    });

  
 
    $('#datepicker').datepicker({
        autoclose: true
    });
    
   
  
</script>
