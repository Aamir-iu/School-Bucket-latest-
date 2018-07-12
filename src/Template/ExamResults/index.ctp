           
<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.min.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables_themeroller.css') ?>


<!-- Main content -->
<section class="content">
    
<?php $grade = $grades[0]; ?>
    
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
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal();" type="button"><i class="fa fa-plus"></i> Add New Result </button>
                                                
                                                
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" name="btnSearch" id="btnSearch" onclick="loadmodalReport();" type="button"><i class="fa fa-th"></i> Actions </button>
                                  
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="loadmodalSettings();" type="button"><i class="fa fa-gears"></i> Templates </button>
                                  
                                                </td>
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-warning" name="btnSearch" id="btnSearch" onclick="loadmodalSMS();" type="button"><i class="fa fa-envelope"></i> SMS </button>
                                  
                                                </td>
                                                
                                                
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
                <button onclick="Print_report();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-print"></li> Print Tabulation</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-primary m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
            </div>


            
             <div class="modal-footer">
              
                    <div class="col-sm-3">
                          <select name="admin_card_type" id="admin_card_type" class="form-control input-sm">
                              <option value="1">Front</option>
                              <option value="2">Back</option>
                              <option value="3">Both</option>
                          </select>
                     </div>   
              
                 
                <button onclick="adminCard();" type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><li class="fa fa-calendar"></li> Admit Card</button>
                <button onclick="topStudents();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><li class="fa fa-graduation-cap"></li> Top 10 Students</button>
                <button onclick="printBlankTabulation();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-print"></li> Blank Tabulation</button>
                

                
            </div>
            <div class="modal-footer">
              <button onclick="cumulativeResult();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><li class="fa fa-graduation-cap"></li> Generate Cumulative</button>
              <button onclick="setRollNumber();" type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><li class="fa fa-gears"></li> Set Roll Numbers</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN SMS MODAL FORM-->
<div class="modal fade" id="settings"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Result Card Templates</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<!--                    <div class="alert alert-warning success">
                        <span class="icon-warning icon-2x" style="color:orange"></span>
                        If you want to different result card templates,you can choose from here.
                        The templates are:
                        <br>
                        1-Basic
                        <br>
                        2-Standard
                        <br>
                        Professional
                    
                    </div>-->
            </div>
            
                        
            <div class="modal-body">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                
                                           
                    <div class="form-group class_sms">
                        <div class="col-sm-12">
                            <select name="settings_id" onchange="changeTemplate();" id="settings_id" class="form-control input-sm"  style="width:100%;">
                            <?php foreach($card_template as $temp):  ?>
                                    <option <?= $temp->status === 'Active' ? 'selected' : ''; ?> value="<?php echo $temp->id_result_card_template; ?>"><?php echo $temp->description; ?></option>
                                <?php endforeach; ?>
                            </select>
                         </div>    
                    </div>
                 
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
<!--                <button onclick="changeTemplate();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>-->
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade" id="add-sms"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="smsloading">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="alert alert-warning success">
                        <!--<span class="icon-warning icon-2x" style="color:orange"></span>-->
                        If you want to incorporate student information from the database in the message, then you have to include certain codes in the place of student information.                        <br>
                        The codes are:
                        <br>
                        Code for student's name #B#
                        <br>
                        Code for student's father name #C#
                        <br>
                        Code for  marks obtained #D#
                        <br>
                        Code for  marks total #E#
                        <br>
                        Code for  percentage #F#
                        <br>
                        Code for  grade #G#
                        <br>
                        Code for  result #H#
                        <br>
                        Code for  rank #I#
                    
                    </div>
            </div>
            <div class="modal-body" id="rank_loader">
                <form class="form-horizontal">

                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Class: </label>
                      <div class="col-sm-9">
                        <select class="form-control"  id="class_id_for_sms" name="class_id_for_sms" data-placeholonchangeder="Select Fee Head" style="width: 100%;">
                          <?php foreach($class_name as $classes): ?>
                            <option value="<?php echo $classes->id_class ?>"><?php echo $classes->class_name; ?></option>
                            
                          <?php endforeach; ?>  
                        </select>
                       </div>   
                     </div>
                    
                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Shift: </label>
                      <div class="col-sm-9">
                            <select name="shift_id_for_sms" id="shift_id_for_sms" class="form-control input-sm">
                                <option value="1">Morning</option>
                                <option value="2">Afternoon</option>
                                <option value="3">Evening</option>
                            </select>
                       </div>   
                    </div>
                    <?php //echo "<pre>"; print_r($sess); ?>
                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Session: </label>
                      <div class="col-sm-9">
                        <select class="form-control"  id="session_id_for_sms" name="session_id_for_sms" data-placeholonchangeder="Select Fee Head" style="width: 100%;">
                       
                            <?php foreach($sess as $sessions): ?>
                          
                            <option value="<?php echo $sessions['id_session'] ?>"><?php echo $sessions['session']; ?></option>
                            
                          <?php endforeach; ?>  
                        </select>
                       </div>   
                     </div>
                    
                    <div class="form-group">
                      <label for="father_name"   class="col-sm-3 control-label">Exam Type: </label>
                      <div class="col-sm-9">
                        <select class="form-control"  id="examtype_id_for_sms" name="examtype_id_for_sms" data-placeholonchangeder="Select Fee Head" style="width: 100%;">
                          <?php foreach($ExamTypes as $examtype): ?>
                            <option value="<?php echo $examtype->id_exam_types ?>"><?php echo $examtype->exam_type; ?></option>
                            
                          <?php endforeach; ?>  
                        </select>
                       </div>   
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" cols="4" rows="8" name='message' id="message" placeholder="Dear #B#!
You have Got #D# Marks
Your Result Is #H# 
Please Contact With Department For Details."></textarea>
                        </div>
                    </div>
                    

                </form>
            </div>
            
            <div class="modal-footer">
                
                <button onclick="send_SMS();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-envelope"></li> SMS</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-primary m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
            </div>
           
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN SMS MODAL FORM-->


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
                    url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'getbysearch']); ?>",
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
    function loadmodal() {
        $('#search_btn').show();
        $('#cc_id').show();
        $("#resulttable tbody").html('');
        $('#add-exam').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    function getStudents() {

      //  var class_id = $('#class_id option:selected').val();
      //  var shift_id = $('#shift_id option:selected').val();
        var exam_type_id = $('#exam_type option:selected').val();
        var cc = $('#cc_id').val();

        imageOverlay('#resulttable', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'getStudentIfo']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {cc: cc,exam_type_id:exam_type_id},
            success: function (data) {
                var result = data.msg.split("|");
                var mdata = data.data;
                var edata = data.exam_details;
                $('#t_marks').html(0);
                $('#o_marks').html(0);
                $('#percentage').html(0);
                $('#grade').html('-');
                if(mdata.length > 0){
                    $('#cc').html(mdata[0].registration_id);
                    $('#name_of_student').html(mdata[0].sname);
                    $('#father_name').html(mdata[0].fname);
                    $('#name_of_class').html(mdata[0].class);
                    $('#name_of_shift').html(mdata[0].shift);
                    $('#hidden_class_id').val(mdata[0].class_id);
                    $('#hidden_shift_id').val(mdata[0].shift_id);
                }
   
                imageOverlay('#resulttable', 'hide');
                var mhtml = "";
                $("#resulttable tbody").html('');
                if (result[0] === "Success") {
                    toastr.success(result[0], result[1]);
                    var TM = 0;
                    for (var x = 0; x < edata.length; x++) {
                        mhtml += '<tr>';
                        mhtml += "<td>" + edata[x]['subject_id'] + "</td>";
                        mhtml += "<td>" + edata[x]['subject'] + ' | ' + edata[x]['sub_desc'] + "</td>";
                        mhtml += "<td>" + edata[x]['max_marks'] + "</td>";
                        mhtml += "<td>" + edata[x]['min_marks'] + "</td>";
                        
                       // var type = $.isNumeric(edata[x]['max_marks']) ? 'number' : 'text';
                        
                        mhtml += "<td><input type='text' id='test_id"+x+"' onkeyup='calc_value();' class='form-control' style='height:25px;width:100px;' value='0' /></td>";
                        mhtml += "<td><input type='text' id='obtain_id"+x+"' onkeyup='calc_value();' class='form-control' style='height:25px;width:100px;' value='0' /></td>";
                        mhtml += "<td><input type='text' id='total_id"+x+"' disabled=true class='form-control' style='height:25px;width:100px;' value='0' /></td>";
                        mhtml += "<td class='hidden'>" + edata[x]['order_id'] + "</td>";
                         
                        mhtml += '</tr>';
                        if($.isNumeric(edata[x]['max_marks'])){
                            TM += parseFloat(edata[x]['max_marks']);
                        }
                    }
                    $("#resulttable tbody").append(mhtml);
                    $('#t_marks').text(TM);
                    
                } else {
                    toastr.error(result[0], result[1]);
                }

            }
        });
    }
    function add_marks() {
    
            var class_id = $('#hidden_class_id').val();
            var shift_id = $('#hidden_shift_id').val();
            var session_id = $('#session_id option:selected').val();
            var exam_type = $('#exam_type option:selected').val();
            var cc = $('#cc').text();
            var per = $('#percentage').text();
            var grade = $('#grade').text();
            var rank = $('#rank').text();
            var remarks = $('#remarks').val();
            var total = $('#t_marks').text();
            var obtain = $('#o_marks').text();
            var id_exam = $('#hidden_exam_id').val() == '' ? 0 : $('#hidden_exam_id').val();
            var att = $('#att').val() == '' || $('#att').val() == null ? 0 : $('#att').val();
            var att_out_of = $('#att_out_of').val() == '' || $('#att_out_of').val() == null ? 0 : $('#att_out_of').val();
            
            var hw = $('#home_work option:selected').val();
            var reading = $('#reading option:selected').val();
            var writing = $('#writing option:selected').val();
            var cleanliness = $('#cleanliness option:selected').val();
            var sv = $('#sv option:selected').val();
            var result = $('#result').text();
            
            var test_om = $('#test_om').val();
            var test_mm = $('#test_mm').val();
            
            var TableData;
            TableData = storeFeeTblValues()
            if (TableData.length > 0) {
               imageOverlay('#resulttable', 'show');
                toastr["info"]("Please wait..", "Processing");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'add']); ?>/"+id_exam,
                    dataType: 'json',
                    data: {marks_details: TableData
                           ,class_id:class_id
                           ,shift_id:shift_id
                           ,session_id:session_id
                           ,exam_type:exam_type
                           ,cc:cc,per:per,grade:grade,rank:rank,remarks:remarks,total:total,obtain:obtain,result:result
                           ,att_out_of:att_out_of,att:att,hw:hw,reading:reading,writing:writing,cleanliness:cleanliness,sv:sv
                           ,test_om:test_om,test_mm:test_mm },
                    success: function (data) {
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                            imageOverlay('#resulttable', 'hide');
                            toastr.success(result[0], result[1]);
                           
                        } else {
                            imageOverlay('#resulttable', 'hide');
                            toastr.warning(result[0], result[1]);
                        }
                    }
                });
            } else {
                toastr["warning"]("Nothing Added", "Record");
            }

    } 
    function storeFeeTblValues(){
        var TableData = new Array();

        $('#resulttable tr').each(function (row, tr) {
            TableData[row] = {
                "sub_id": $(tr).find('td:eq(0)').text()
                ,"sub_name": $(tr).find('td:eq(1)').text()
                ,"max": $(tr).find('td:eq(2)').text()
                ,"min": $(tr).find('td:eq(3)').text()
                ,"test_marks": $(tr).find('td:eq(4)>input').val()
                ,"obtain_marks": $(tr).find('td:eq(5)>input').val()
                ,"total_obtain_marks": $(tr).find('td:eq(6)>input').val()
                ,"order_id": $(tr).find('td:eq(7)').text()
                
            }
        });
        TableData.shift();  // first row will be empty - so remove

        return TableData;
    }
    function calc_value(){
        var i = 0;
        var OM = 0;
        $('#resulttable tbody tr').each(function (row, tr) {
       
        var passing_marks = $(tr).find('td:eq(3)').text() === "" ? 0 : $(tr).find('td:eq(3)').text();
        var total_marks = $(tr).find('td:eq(2)').text() === "" ? 0 : $(tr).find('td:eq(2)').text();
        
        var test_marks = $(tr).find('td:eq(4)>input').val() === "" ? 0 : $(tr).find('td:eq(4)>input').val();
        var obtain_marks = $(tr).find('td:eq(5)>input').val() === "" ? 0 : $(tr).find('td:eq(5)>input').val();
        
        var tval = 0;
        var oval = 0;
        if($.isNumeric(test_marks)){
            tval = test_marks;
        } 
        if($.isNumeric(obtain_marks)){
            oval = obtain_marks;
        } 
        
        if($.isNumeric(tval) && $.isNumeric(oval)){
            
            var total_obtain = parseFloat(tval) + parseFloat(oval);
            if (parseFloat(total_obtain) > parseFloat(total_marks)) {
                $('#total_id'+i).css({'background-color':'red','color':'white'});
                toastr["error"]("Sorry! Obtain marks can not be greater then total marks,Please check entered data.");
                $(tr).find('td:eq(6)>input').val('');
                
            }else{
                
                $('#total_id'+i).css({'background-color':'white','color':'black'});
                $(tr).find('td:eq(6)>input').val(total_obtain);
                
                if (parseFloat(total_obtain) >= parseFloat(passing_marks)) {
                    $('#total_id'+i).css({'background-color':'white','color':'black'});
                    OM += total_obtain;
                }else{
                    $('#total_id'+i).css({'background-color':'orange','color':'white'});
                    OM += total_obtain;
               
                }
                
            }
   
            i++;
        }else{
            $(tr).find('td:eq(7)').text('Cleared');
            $(tr).find('td:eq(6)>input').val('');
            $('#total_id'+i).css({'background-color':'white','color':'black'});
        }
            
        });
        $('#o_marks').text(OM);
        getPercentage();
        checkRank();
        checkResult();
        checkPassFailed();
        if($('#grade').text() == 'F'){
            $('#grade').removeClass('label label-success');
            $('#grade').addClass('label label-danger');
            $('#result').text('Failed');
        }else{
            $('#grade').addClass('label label-danger');
            $('#grade').addClass('label label-success');
            $('#result').text('Passed');
        }
        if($('#rank').text() == 'False'){
            $('#rank').removeClass('label label-success');
            $('#rank').addClass('label label-danger');
        }else{
            $('#rank').addClass('label label-danger');
            $('#rank').addClass('label label-success');
        }
    }
    function getPercentage(){
       
       var total_marks = parseFloat($('#t_marks').text());
       var o_marks = parseFloat($('#o_marks').text());
       var per = o_marks / total_marks * 100;
       $('#percentage').text(parseFloat(per).toFixed(2));
       
       $('#grade').removeClass('label label-danger');
       
      // var p  = parseFloat("<?php  //echo $grade['per']; ?>"); 
      
       if(per >= parseFloat("<?php  echo $grade['per_vii']; ?>")){
            $('#grade').text("<?php  echo $grade['grade_vii']; ?>");
            $('#remarks').val('<?php  echo $grade['remarks_vii']; ?>');
           
       }else if(per >= parseFloat("<?php  echo $grade['per_vi']; ?>")){
            $('#grade').text("<?php  echo $grade['grade_vi']; ?>");
             $('#remarks').val('<?php  echo $grade['remarks_vi']; ?>');
            
       }else if(per >= parseFloat("<?php  echo $grade['per_v']; ?>")){
            $('#grade').text("<?php  echo $grade['grade_v']; ?>");
            $('#remarks').val('<?php  echo $grade['remarks_v']; ?>');
            
       }else if(per >= parseFloat("<?php  echo $grade['per_iv']; ?>")){
            $('#grade').text("<?php  echo $grade['grade_iv']; ?>");
            $('#remarks').val('<?php  echo $grade['remarks_iv']; ?>');
            
       }else if(per >= parseFloat("<?php  echo $grade['per_iii']; ?>")){
            $('#grade').text("<?php  echo $grade['grade_iii']; ?>");
            $('#remarks').val('<?php  echo $grade['remarks_iii']; ?>');
            
       }else if(per >= parseFloat("<?php  echo $grade['per_ii']; ?>")){
            $('#grade').text("<?php  echo $grade['grade_ii']; ?>");
            $('#remarks').val('<?php  echo $grade['remarks_ii']; ?>');
            
       }else if(per >= parseFloat("<?php  echo $grade['per_i']; ?>")){
            $('#grade').text("<?php  echo $grade['grade_i']; ?>");
            $('#remarks').val('<?php  echo $grade['remarks_i']; ?>');
            
       }else{
           $('#grade').text("<?php  echo $grade['grade']; ?>");
           $('#remarks').val('Need To Work Very Hard');
       }
   }
    function checkRank(){
    
        $('#resulttable tbody tr').each(function (row, tr) {
       
         var rank = $(tr).find('td:eq(4)>input').val() === "" ? 0 : $(tr).find('td:eq(4)>input').val();
           if(rank === 'Abs.' || rank === 'Abs' || rank === 'Ab' || rank === 'Absent' || rank === 'abs.' || rank === 'abs' || rank === 'ab' || rank === 'absent'){
                $('#rank').text('False');
                return false;
            }else{
                $('#rank').text('True');
            }
                   
        });
    
    
    }
    function checkResult(){
    
        $('#resulttable tbody tr').each(function (row, tr) {
       
         var rank = $(tr).find('td:eq(5)>input').val() === "" ? 0 : $(tr).find('td:eq(5)>input').val();
           if(rank === 'Abs.' || rank === 'Abs' || rank === 'Ab' || rank === 'Absent' || rank === 'abs.' || rank === 'abs' || rank === 'ab' || rank === 'absent'){
              //  $('#percentage').text('0.00');
                $('#grade').text('F');
                $('#rank').text('False');
                $('#grade').addClass('label label-danger');
                
                return false;
            }else{
                getPercentage();
                
            }
                   
        });
    
    
    }
    function checkPassFailed(){
  
    $('#resulttable tbody tr').each(function (row, tr) {
       
        var passing_marks = $(tr).find('td:eq(3)').text() === "" ? 0 : $(tr).find('td:eq(3)').text();
        var total_marks = $(tr).find('td:eq(2)').text() === "" ? 0 : $(tr).find('td:eq(2)').text();
        
        var test_marks = $(tr).find('td:eq(4)>input').val() === "" ? 0 : $(tr).find('td:eq(4)>input').val();
        var obtain_marks = $(tr).find('td:eq(5)>input').val() === "" ? 0 : $(tr).find('td:eq(5)>input').val();
     
        
        if($.isNumeric(test_marks) && $.isNumeric(obtain_marks) && $.isNumeric(passing_marks)){
            var total_obtain = parseFloat(test_marks) + parseFloat(obtain_marks);
            if (parseFloat(total_obtain) < parseFloat(passing_marks)) {
               // $('#percentage').text('0.00');
                $('#grade').text('F');
                $('#rank').text('False');
                return false;
            }
        }else if(!$.isNumeric(test_marks) && $.isNumeric(obtain_marks)){
            var total_obtain = parseFloat(obtain_marks);
            if (parseFloat(total_obtain) < parseFloat(passing_marks)) {
               // $('#percentage').text('0.00');
                $('#grade').text('F');
                $('#rank').text('False');
                return false;
            }
        }else if(!$.isNumeric(obtain_marks) && $.isNumeric(test_marks)){
            var total_obtain = parseFloat(test_marks);
            if (parseFloat(total_obtain) < parseFloat(passing_marks)) {
               // $('#percentage').text('0.00');
                $('#grade').text('F');
                $('#rank').text('False');
                return false;
            }
        }else if(!$.isNumeric(test_marks) && !$.isNumeric(obtain_marks) && $.isNumeric(passing_marks)){
           
                $('#grade').text('F');
                $('#rank').text('False');
                $('#grade').addClass('label label-danger');
                return false;
           
        }
            
    });
       
    }
    function edit_record(class_id,shift_id,exam_type_id,session_id,reg_id) {
        
        $("#resulttable tbody").html('');
        $('#add-exam').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        $('#search_btn').hide();
        $('#cc_id').hide();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'editStudentIfo']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: class_id, shift: shift_id,exam_type_id:exam_type_id,session_id:session_id,reg_id:reg_id},
            success: function (data) {
                var result = data.msg.split("|");
                var mdata = data.data;
                var edata = data.exam_details;
                var Gdata = data.general_observation;
                
                $('#t_marks').html(0);
                $('#o_marks').html(0);
                $('#percentage').html(0);
                $('#grade').html('-');
                if(mdata.length > 0){
                    $('#cc').html(mdata[0].registration_id);
                    $('#name_of_student').html(mdata[0].sname);
                    $('#father_name').html(mdata[0].fname);
                    $('#name_of_class').html(mdata[0].class);
                    $('#name_of_shift').html(mdata[0].shift);
                    $('#hidden_class_id').val(mdata[0].class_id);
                    $('#hidden_shift_id').val(mdata[0].shift_id);
                    $('#hidden_exam_id').val(mdata[0].id_exam);
                    $('#session_id').val(mdata[0].session_id).change();
                    $('#exam_type').val(mdata[0].exam_type_id).change();
                    $('#att').val(mdata[0].att);
                    $('#att_out_of').val(mdata[0].out_of);
                    $('#remarks').val(mdata[0].remarks);
                    $('#result').text(mdata[0].result);
                    $('#o_marks').text(mdata[0].obtain_marks);
                    $('#percentage').text(mdata[0].per);
                    $('#grade').text(mdata[0].grade);
                    $('#test_om').val(mdata[0].test_om);
                    $('#test_mm').val(mdata[0].test_mm);
                }
                
                if(Gdata.length > 0){
                    
                    $('#home_work').val(Gdata[0].home_work).change();
                    $('#reading').val(Gdata[0].reading).change();
                    $('#writing').val(Gdata[0].writing).change();
                    $('#cleanliness').val(Gdata[0].cleanliiness).change();
                    $('#sv').val(Gdata[0].sv).change();
                    
                }
                
                
                
                imageOverlay('#resulttable', 'hide');
                var mhtml = "";
                $("#resulttable tbody").html('');
                if (result[0] === "Success") {
                    //toastr.success(result[0], result[1]);
                    var TM = 0;
                    for (var x = 0; x < edata.length; x++) {
                        mhtml += '<tr>';
                        mhtml += "<td>" + edata[x]['subject_id'] + "</td>";
                        mhtml += "<td>" + edata[x]['subject'] + "</td>";
                        mhtml += "<td>" + edata[x]['max_marks'] + "</td>";
                        mhtml += "<td>" + edata[x]['min_marks'] + "</td>";
                        
                       // var type = $.isNumeric(edata[x]['max_marks']) ? 'number' : 'text';
                        
                        mhtml += "<td><input type='text' id='test_id"+x+"' onkeyup='calc_value();' class='form-control' style='height:25px;width:100px;' value='"+edata[x]['test_obtain_marks']+"' /></td>";
                        mhtml += "<td><input type='text' id='obtain_id"+x+"' onkeyup='calc_value();' class='form-control' style='height:25px;width:100px;' value='"+edata[x]['obtain_marks']+"' /></td>";
                        mhtml += "<td><input type='text' id='total_id"+x+"' disabled=true class='form-control' style='height:25px;width:100px;' value='"+edata[x]['total_obtain_marks']+"' /></td>";
                        mhtml += "<td class='hidden'>" + edata[x]['order_id'] + "</td>";
                         
                        mhtml += '</tr>';
                        if($.isNumeric(edata[x]['max_marks'])){
                            TM += parseFloat(edata[x]['max_marks']);
                        }
                    }
                    $("#resulttable tbody").append(mhtml);
                    $('#t_marks').text(TM);
                    
                } else {
                    toastr.error(result[0], result[1]);
                }

            }
        });
         
       // calc_value();
        checkRank();
        checkResult();
        checkPassFailed();
        
    }
    function loadmodalReport() {
     
        $('#add-report').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    function Print_report() {
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var f = 0;
        window.open("<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id );

    }
    function generate_Rank(){
        
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        
        imageOverlay('#rank_loader', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'generateRank']); ?>/",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class_id: class_id,shift_id:shift_id,session_id:session_id,exam_type_id:exam_type_id},
            success: function (data) {
                var result = data.msg.split("|");
                if (result[0] === "Success") {
                    toastr.success(result[0], result[1]);
                    
                } else {
                    toastr.error(result[0], result[1]);
                   
                }
            }
        });
                
        imageOverlay('#rank_loader', 'hide');
        
    }
    function delete_record(id,exam_type_id,session_id,id_exam) {
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
                        url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {cc: id,exam_type_id:exam_type_id,session_id:session_id,id_exam:id_exam},
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
    function prmote(){
    
        if($('#grade').text() == 'F'){
           // $('#grade').removeClass('label label-success');
           // $('#grade').addClass('label label-danger');
            $('#result').text('Passed');
            $('#remarks').val('Promoted');
        }
    
    }
    function printGeneralObservation() {
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var shift_name = $('#shift_id_for_report option:selected').text() + " | " + $('#session_id_for_report option:selected').text() + " | " + $('#examtype_id_for_report option:selected').text();
        var f = 0;
        window.open("<?php echo $this->Url->build(['controller' => 'GradeSetting', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id +"/" +shift_name );

    }
    function printBlankTabulation() {
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var shift_name = $('#shift_id_for_report option:selected').text() + " | " + $('#session_id_for_report option:selected').text() + " | " + $('#examtype_id_for_report option:selected').text();
        var f = 1;
        window.open("<?php echo $this->Url->build(['controller' => 'GradeSetting', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id +"/" +shift_name );

    }

   
    function cumulativeResult(){
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var shift_name = $('#shift_id_for_report option:selected').text() + " | " + $('#session_id_for_report option:selected').text() + " | " + $('#examtype_id_for_report option:selected').text();
        var f = 1;
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'GradeSetting', 'action' => 'cumulativeResult']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id +"/" +shift_name ,
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

  function setRollNumber(){

        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
      
        var f = 1;
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'GradeSetting', 'action' => 'rolls']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {class_id:class_id,shift_id:shift_id,session_id:session_id,exam_type_id:exam_type_id},
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


    function topStudents() {
      

        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var shift_name = $('#shift_id_for_report option:selected').text() + " | " + $('#session_id_for_report option:selected').text() + " | " + $('#examtype_id_for_report option:selected').text();
        var f = 2;
        window.open("<?php echo $this->Url->build(['controller' => 'GradeSetting', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id +"/" +shift_name );

    }
    function printResultCard() {
       
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var session =  $('#session_id_for_report option:selected').text();
       
        var f = 3;
        window.open("<?php echo $this->Url->build(['controller' => 'GradeSetting', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + exam_type_id + "/" + session_id + "/" +session );

    }
    function print_result(class_id,shift_id,exam_type_id,session_id,id_exam,session_name) {
   
       var f = 3;
       window.open("<?php echo $this->Url->build(['controller' => 'GradeSetting', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + exam_type_id + "/" + session_id + "/" + session_name+ "/"+id_exam  );
    }
    
    function loadmodalSettings(id) {
        $('#settings').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
    function changeTemplate(){
        var id = $('#settings_id option:selected').val();
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'resultSettings']); ?>/",
                dataType: 'json',
                cache: false,
                async: false,
                data: {id: id},
                beforeSend: function(){
                   imageOverlay('#smsloading','show');
                },
                success: function (data) {
                    imageOverlay('#smsloading', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
                 
            });
          
    }
    
    function adminCard() {
     
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var session =  $('#session_id_for_report option:selected').text();
        var admin_card_type =  $('#admin_card_type option:selected').val();
      
        var f = 3;
        window.open("<?php echo $this->Url->build(['controller' => 'ExamMarksDetails', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + shift_id + "/" + session_id + "/" + exam_type_id + "/" +session +"/"+admin_card_type );

    }
    
    function loadmodalSMS(id) {
        $('#add-sms').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
    function exportSMS(){
        
        var class_id =  $('#class_id_for_report option:selected').val();
        var shift_id =  $('#shift_id_for_report option:selected').val();
        var session_id =  $('#session_id_for_report option:selected').val();
        var exam_type_id =  $('#examtype_id_for_report option:selected').val();
        var session =  $('#session_id_for_report option:selected').text();
        var admin_card_type =  $('#admin_card_type option:selected').val();
        imageOverlay('#smsExport', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'SmsLog', 'action' => 'exportnumbers']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class_id: class_id,shift_id:shift_id,option_id: option_id,message:message,ids:ids },
            success: function (data) {
                imageOverlay('#smsExport','hide');
                var result = data.msg.split("|");
                if (result[0] === "Success") {
                    window.open("<?php echo $link; ?>");
                } else {
                    toastr.error(result[0], result[1]);
                }
            }
        });

        
    }
    
    function send_SMS(){

        var  class_id = $('#class_id_for_sms option:selected').val();
        var  shift_id = $('#shift_id_for_sms option:selected').val();
        var  session_id = $('#session_id_for_sms option:selected').val();
        var  exam_id = $('#examtype_id_for_sms option:selected').val();
       
        var message  = $('#message').val()
        if(message == ''){
            toastr.error('Message can not be blank','Error');
            return false;
        }
       
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'ExamResults', 'action' => 'sendsms']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {class_id: class_id,shift_id:shift_id,session_id:session_id,exam_id:exam_id,message:message},
                beforeSend: function(){
                   imageOverlay('#smsloading','show');
                },
                success: function (data) {
                    imageOverlay('#smsloading', 'hide');
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
