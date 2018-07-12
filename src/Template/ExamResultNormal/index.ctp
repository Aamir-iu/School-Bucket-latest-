           
<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.min.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables_themeroller.css') ?>


<!-- Main content -->
<section class="content">
    
<?php //$grade = $grades[0]; ?>
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <div class="btn-group pull-right">
                        <div class="row">
                            <div class="col-xs-8">
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                                <table class="table table-responsive">
                                            
                                            <tr>
                                                
                                                <td>
                                                 <input type="text" class="form-control input-sm" name="search" id="search" placeholder="Registration ID" style="width: 130px;">
                                                </td> 
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="submit"><i class="fa fa-search"></i> Search </button>
                                                </td>
                                                
                                               <!--  <td>
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal();" type="button"><i class="fa fa-plus"></i> Add New Result </button>
                                                
                                                
                                                </td> -->
                                                <td>
                                                    <button class="btn btn-sm btn-info" name="btnSearch" id="btnSearch" onclick="loadmodalReport();" type="button"><i class="fa fa-th"></i> Actions </button>
                                  
                                                </td>
                                                <!-- <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="loadmodalSettings();" type="button"><i class="fa fa-gears"></i> Templates </button>
                                  
                                                </td> -->
                                                
                                               <!--  <td>
                                                    <button class="btn btn-sm btn-warning" name="btnSearch" id="btnSearch" onclick="loadmodalSMS();" type="button"><i class="fa fa-envelope"></i> SMS </button>
                                  
                                                </td> -->
                                                
                                                
                                            </tr>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                            </div>     
                        </div> 
                      
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-container">
                        <table class="table table-striped  table-hover" id="userstable">    
                            <thead>
                                <tr>
                                    
                                    <th>CC#</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Session</th>
                                    <th>Exam Type</th>
                                    <th style="width:30%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade " id="add-exam"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:95%!important;">
        <div class="modal-content">


        <div class="modal-body">
             <div class="row" style="margin-bottom:0%!important;">
                    <div class="col-xs-12">
                        <form>
                            <div class="row col-xs-12" id="loadind">
                              <div class="col-md-4 col-sm-12">

                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <div class="caption">
                                              <i class="fa fa-dashboard"></i>
                                              <span class="caption-subject font-teal-500 bold uppercase">Exam Details </span>

                                              
                                          </div>

                                      </div>
                                      <div class="panel-body">
                                        <div class="row">  
                                            <div  class="col-md-6">     
                                                <div class="form-group">

                                                    <select class="form-control" id="session_id" data-placeholder="Select Session" style="width: 100%;">
                                                        <?php foreach ($session as $sessions): ?>    
                                                            <option value="<?php echo $sessions->id_session; ?>"><?php echo $sessions->session; ?></option>
                                                        <?php endforeach; ?>    
                                                    </select>
                                                </div>
                                            </div>

                                            <div  class="col-md-6">     
                                                <div class="form-group">
                                                    <select class="form-control" id="exam_type" data-placeholder="Select Exam Type" style="width: 100%;">
                                                        <?php foreach ($ExamTypes as $ExamTypess): ?>    
                                                            <option value="<?php echo $ExamTypess->id_exam_types; ?>"><?php echo $ExamTypess->exam_type; ?></option>
                                                        <?php endforeach; ?>    
                                                    </select>
                                                </div>
                                            </div>
                                  
                                        </div>    
                                          
                                         <div class="row">  
                                            <div  class="col-md-6">     
                                                <input type="text" placeholder="Registration ID" class="form-control" id="cc_id" value="" />
                                            </div>

                                            <div  class="col-md-6">     
                                                <div class="form-group pull-right">
                                                   <button onclick="getStudents();" id="search_btn" type="button" class="btn btn-icon btn-md waves-effect waves-light btn-success m-b-5">Search</button>
                                                    
                                                </div>
                                            </div>
                                  
                                        </div>   
                                          

                                      </div>
                                  </div>
                              </div>
                              <!--End Exam Details-->       

                              <!--Personal Details-->
                              <div class="col-md-4 col-sm-12">

                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <div class="caption">
                                              <i class="fa fa-user-secret"></i>
                                              <span class="caption-subject font-teal-500 bold uppercase">Personal Details </span>

                                              
                                          </div>

                                      </div>
                                      <div class="panel-body">
                                          <div class="row static-info">
                                              <div class="col-md-5 name">
                                                  Registration ID #:
                                              </div>
                                              <div class="col-md-7 value">
                                                  <span id="cc"></span>
                                                  <input type="text" class="hidden" id="hidden_class_id" value="" />
                                                  <input type="text" class="hidden" id="hidden_shift_id" value="" >
                                                  <input type="text" class="hidden" id="hidden_exam_id" value="" >
                                              </div>
                                          </div>
                                          <div class="row static-info">
                                              <div class="col-md-5 name">
                                                  Name of Student
                                              </div>
                                              <div class="col-md-7 value">
                                                    <span id="name_of_student"></span>
                                              </div>
                                          </div>
                                           <div class="row static-info">
                                              <div class="col-md-5 name">
                                                  Father Name
                                              </div>
                                              <div class="col-md-7 value">
                                                    <span id="father_name"></span>
                                              </div>
                                          </div>
                                          
                                          <div class="row static-info">
                                              <div class="col-md-5 name">
                                                  Class 
                                              </div>
                                              <div class="col-md-7 value">
                                                 <span id="name_of_class"></span>
                                              </div>
                                          </div>
                                          <div class="row static-info">
                                              <div class="col-md-5 name">
                                                 Shift
                                              </div>
                                              <div class="col-md-7 value">
                                                    <span id="name_of_shift"></span>
                                              </div>
                                          </div>
                                         

                                      </div>
                                  </div>
                              </div>
                              <!--End personal Details-->
                              
                               <!--Personal Details-->
                              <div class="col-md-4 col-sm-12">

                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <div class="caption">
                                              <i class="fa fa-bar-chart-o"></i>
                                              <span class="caption-subject font-teal-500 bold uppercase">Result Details </span>

                                                <div class="actions pull-right">
                                                    <a  href="#" onclick="prmote();" data-toggle="modal" data-original-title="Promote" title="Promote" class="btn btn-icon btn-xs waves-effect waves-light btn-info m-b-5">
                                                    <i class="fa fa-ship"></i> Promote </a>
                                                </div>
                                              
                                          </div>

                                      </div>
                                      <div class="panel-body">
                                          
                                          <div class="row static-info">
                                              
                                            <div class="col-md-5 name">
                                                Total Marks
                                            </div>
                                            <div class="col-md-2 value">
                                                <span id="t_marks">0</span>
                                            </div>
                                         
                                          </div>
                                          <div class="row static-info">
                                              <div class="col-md-5 name">
                                                  Obtain Marks
                                              </div>
                                              <div class="col-md-2 value">
                                                    <span id="o_marks">0</span>
                                              </div>
                                        
                                          </div>
                                           <div class="row static-info">
                                              <div class="col-md-5 name">
                                                  Percentage
                                              </div>
                                              <div class="col-md-2 value">
                                                    <span id="percentage">0</span>
                                              </div>
                                               
                                               <div class="col-md-2 name">
                                                  Rank:
                                              </div>
                                              
                                              <div class="col-md-3 value">
                                                  <span class="label label-success" id="rank">True</span>
                                              </div>
                                               
                                          </div>
                                          
                                          <div class="row static-info">
                                              <div class="col-md-5 name">
                                                  Grade 
                                              </div>
                                              
                                              <div class="col-md-2 value">
                                                 <span id="grade">-</span>
                                              </div>
                                              
                                              <div class="col-md-2 name">
                                                  Result:
                                              </div>
                                              
                                              <div class="col-md-3 value">
                                                  <span  id="result">-</span>
                                              </div>
                                              
                                          </div>
                                          <div class="row static-info">
                                              <div class="col-md-2 name">
                                                 Remarks
                                              </div>
                                              <div class="col-md-10 value">
                                                    <input type="text"  id="remarks" value="" style="border:none;text-align:left;width:100%;">
                                              </div>
                                          </div>
                                         

                                      </div>
                                  </div>
                              </div>
                              <!--End personal Details-->
                              
               
                            </div>     

                        </form>
                    </div>
           </div>
            
            <div class="row">
                <div class="col-xs-12">
                    
                    <div  class="col-md-2">     
                    <div class="form-group">
                        <label>Home Work</label>
                            <select name="home_work" id="home_work" class="form-control input-sm">
                                
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                                
                            </select>
                  
                     </div>
                    </div>
                    
                    <div  class="col-md-2">     
                    <div class="form-group">
                        <label>Reading</label>
                        
                            <select name="reading" id="reading" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                       
                     </div>
                    </div>
                    
                    <div  class="col-md-2">     
                    <div class="form-group">
                        <label>Writing</label>
                        
                            <select name="writing" id="writing" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                       
                     </div>
                    </div>
                    
                    <div  class="col-md-2">     
                    <div class="form-group">
                        <label>Cleanliness</label>
                        
                            <select name="cleanliness" id="cleanliness" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                       
                     </div>
                    </div>
                    
                    <div  class="col-md-2">     
                    <div class="form-group">
                        <label>S.Vacation's Assign.</label>
                        
                            <select name="sv" id="sv" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                       
                     </div>
                    </div>
                    
                    <div  class="col-md-1">     
                        <div class="form-group">
                            <label>Att.</label>
                            <input type="text"  id="att" value="" style="border:block;text-align:center;width:100%;">
                         </div>
                    </div>
                    
                    <div  class="col-md-1">     
                        <div class="form-group">
                            <label>Out-Of.</label>
                            <input type="text"  id="att_out_of" value="" style="border:block;text-align:center;width:100%;">
                         </div>
                    </div>
                    
                </div>    
            </div>
             <div class="row">
                 <div class="col-xs-12">
                     
                    <div  class="col-md-2"> 
                        <div class="form-group">
                            <label>Test Obtained Marks</label>
                            <input type="text"  id="test_om" value="" style="border:block;text-align:center;width:100%;">
                         </div>
                    </div>
                    
                    <div  class="col-md-2">     
                        <div class="form-group">
                            <label>Test Total Marks</label>
                            <input type="text"  id="test_mm" value="" style="border:block;text-align:center;width:100%;">
                         </div>
                    </div>
                     
                 </div>
            </div>     
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="resulttable"  class="table table-hover">
                                <thead>
                                    <tr>
                                        
                                        <th width="10%">Subject ID</th>
                                        <th width="15%">Subject Name</th>
                                        <th width="10%">Total Marks</th>
                                        <th width="10%">Passing Marks</th>
                                        <th width="10%">Test Marks</th>
                                        <th width="10%">Obtain Marks</th>
                                        <th width="15%">Total Obtain Marks</th>
<!--                                        <th width="10%">Result</th>-->
                                        

                                    </tr>
                                </thead>
                                
                                <tbody>
                                </tbody>   
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
            
        <div class="modal-footer">
            <div class="form-group">  
                <div class="pull-right" style="margin-right:0px!important;"> 
                    <button onclick="add_marks();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                    <button  type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
               </div>  
            </div>   
        </div>     

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN ADD PO MODAL FORM-->


<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade" id="add-report"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">View Reports</h4>
            </div>
            <div class="modal-body" id="rank_loader">
                <form class="form-horizontal">

                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Class: </label>
                      <div class="col-sm-9">
                        <select class="form-control"  id="class_id_for_report" name="class_id_for_report" data-placeholonchangeder="Select Fee Head" style="width: 100%;">
                          <?php foreach($class_name as $classes): ?>
                            <option value="<?php echo $classes->id_class ?>"><?php echo $classes->class_name; ?></option>
                            
                          <?php endforeach; ?>  
                        </select>
                       </div>   
                     </div>
                    
                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Shift: </label>
                      <div class="col-sm-9">
                            <select name="shift_id_for_report" id="shift_id_for_report" class="form-control input-sm">
                                <option value="1">Morning</option>
                                <option value="2">Afternoon</option>
                                <option value="3">Evening</option>
                            </select>
                       </div>   
                    </div>
                    
                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Session: </label>
                      <div class="col-sm-9">
                        <select class="form-control"  id="session_id_for_report" name="session_id_for_report" data-placeholonchangeder="Select Fee Head" style="width: 100%;">
                          <?php foreach($session as $session): ?>
                            <option value="<?php echo $session->id_session ?>"><?php echo $session->session; ?></option>
                            
                          <?php endforeach; ?>  
                        </select>
                       </div>   
                     </div>
                    
                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Exam Type: </label>
                      <div class="col-sm-9">
                        <select class="form-control"  id="examtype_id_for_report" name="examtype_id_for_report" data-placeholonchangeder="Select Fee Head" style="width: 100%;">
                          <?php foreach($ExamTypes as $examtype): ?>
                            <option value="<?php echo $examtype->id_exam_types ?>"><?php echo $examtype->exam_type; ?></option>
                            
                          <?php endforeach; ?>  
                        </select>
                       </div>   
                    </div> 
                    

                </form>
            </div>
            
            <div class="modal-footer">
                <button onclick="printGeneralObservation();" type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><li class="fa fa-eye"></li> General Observation</button>
<!--                <button onclick="generate_Rank();" type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><li class="fa fa-bar-chart"></li> Generate Rank</button>-->
                <button onclick="printResultCard();" type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><li class="fa fa-archive"></li> Print Result Cards</button> 
                <button onclick="Print_report();" type="button"  class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-print"></li> Print Tabulation</button>
                
            </div>
            
            <div class="modal-footer">
                
                <button onclick="generate();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><li class="fa fa-graduation-cap"></li> Generate Result</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-primary m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
                
            </div>
            
            
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?> 
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/input-mask/jquery.inputmask.js') ?>

<?php // $this->Html->script('datatable.js') ?> 


<script>
    
    $(document).ready(function () {
  
    $("#class_id1").select2();
    $("#class_id").select2();
    $("#shift_id").select2();
    $("#subject_id").select2();
    
    tabltint();
    
    $('#search-form').on('submit', function(){
        getStudents();
        return false;
    });   
    
        
    });
    function search_record(){
       tabltint();
     
    }
    var tabltint = function () {
        if($.fn.DataTable.isDataTable("#userstable")){ 
            $("#userstable").dataTable().fnDestroy();
         }
 
        var theTable = $('#userstable').DataTable({
           
                //"dom": '<"top"i>rt<"bottom"flp><"clear">',
                'bFilter': false,
                'responsive': true,
                'processing': true,
                'serverSide': true,
                "error": false,
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "stateSave": true,
                "ajax": {
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'ExamResultNormal', 'action' => 'getbysearch']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.id = $('#search').val();

                    }
                },
                "oLanguage": {
                 "sProcessing": '<img src="https://eschools.cloud/images/loading-spinner-grey.gif">'
               },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': false,
                    'targets': [0]
                    
                }],
                "order": [
                    [1, "asc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"data": "registration_id"},
                        {"data": "sname"},
                        {"data": "fname"},
                        {"data": "session_name"},
                        {"data": "exam"},
                        {"data": "actions"},
                    ]
        });
        
   }  
  
  function print_result(class_id,shift_id,exam_type_id,session_id,id_exam,session_name) {
       var f = 0;
       window.open("<?php echo $this->Url->build(['controller' => 'ExamResultNormal', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + exam_type_id + "/" + session_id + "/" + session_name+ "/"+id_exam );
  }


  function loadmodalReport() {
     
        $('#add-report').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }


    function printResultCard() {
       
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var session =  $('#session_id_for_report option:selected').text();
       
        var f = 0;
        window.open("<?php echo $this->Url->build(['controller' => 'ExamResultNormal', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + exam_type_id + "/" + session_id + "/" +session + "/"+ 0);

    }

     function printGeneralObservation() {
       
      var class_id =  $('#class_id_for_report option:selected').val();
      var shift_id =  $('#shift_id_for_report option:selected').val();
      var session_id =  $('#session_id_for_report option:selected').val();
      var exam_type_id =  $('#examtype_id_for_report option:selected').val();

      window.open("<?php echo $this->Url->build(['controller' => 'ExamResultNormal', 'action' => 'addMarks']); ?>/"+ class_id + "/" + shift_id + "/" + session_id);

 
    }


     function delete_record(id,exam_type_id,id_exam) {
       swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (result) {
              
            var table = $('#userstable').DataTable();  
            table.row('.selected').remove().draw( false );
         
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'ExamResultNormal', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {cc: id,exam_type_id:exam_type_id,id_exam:id_exam},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }
            }
           swal(
            'Deleted!',
            'Record has been deleted.',
            'success'
           
          )
        
        });
    }
    
    function Print_report() {
    
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var f = 1;
        window.open("<?php echo $this->Url->build(['controller' => 'ExamResultNormal', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id );

    }
    
    function generate(){
        
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'ExamResultNormal', 'action' => 'generateResultsClick']); ?>/"+ class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id ,
                dataType: 'json',
                cache: false,
                async: false,
                data: {},
                beforeSend: function(){
                   //imageOverlay('#smsloading','show');
                },
                success: function (data) {
                   // imageOverlay('#smsloading', 'hide');
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
