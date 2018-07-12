           
<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.min.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables_themeroller.css') ?>
<?= $this->Html->css('../plugins/bootstrap-toastr/toastr.min.css') ?> 


<style>
    @media screen and (orientation:landscape) {
       }   
   td{


       border: 2px solid black;
       text-align: center;
   }
   tr{
       border: 2px solid black;
   }
   th{
       border: 2px solid black;
       text-align: center;
   }
   .hids{
       width:5%;
   }
   .hnames{
       width:15%;
   }
   .hsub{
       width:10%;
   }
    
</style> 
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i>
          <span style="font-size:13px;">
          Details : | <?php if($data){ echo  $data[0]['class']; echo " | Shift : ";  echo  $data[0]['shift_id'] ==1? 'Morning'  : ''; echo  $data[0]['shift_id'] ==2? 'afternoon'  : ''; echo  $data[0]['shift_id'] ==3? 'Evening'  : ''; }    ?>
          </span>
          
          
        </h2>
      </div>
      <!-- /.col -->
    </div>
    
    
    <input type="text" class="hidden" id="class_id" value="<?= $class_id ?>" />
    
    <input type="text" class="hidden" id="exam_type_id" value="<?= $session_id ?>" />
    <input type="text" class="hidden" id="subject_id" value="<?= $shift_id ?>" />
    
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12">
        <table class="" style="width:100%;" id="tablMarks">
          <thead>
          <tr>
              
              <th style="width:5%;">Reg. ID</th>
              <th style="width:5%;">G.R ID</th>
              <th style="width:5%;">Roll No</th>
              <th style="width:10%;">Student Name</th>
              <th style="width:10%;">Father Name</th>
              <th style="width:8%;">HomeWork</th>
              <th style="width:8%;">Reading</th>
              <th style="width:8%;">Writing</th>
              <th style="width:8%;">Cleanliness</th>
              <th style="width:8%;">S.Vacation's Assign.</th>
              <th style="width:5%;">Att</th>
              <th style="width:5%;">Out of</th>
             
              
              
           </tr>
          </thead>
          <tbody>
         <?php $i=0; foreach($data as $row): ?>   
          <input type="hidden" id="cid" value="<?php // echo $row['class_name']; ?>">
          <tr>
                <td><?php echo $row['registration_id'];  ?> </td>
                <td><?php echo $row['grno'];  ?> </td>
                <td><?php echo $row['roll_no'];  ?> </td>
               
                <td><?php echo $row['sname'];  ?> </td>
                <td><?php echo $row['fname'];  ?> </td>
                
                <td>
                
                      <select name="home_work" id="home_work" class="form-control input-sm">
                          <option value="Excellent">1-Excellent</option>
                          <option value="V-Good">2-V-Good</option>
                          <option value="Good">3-Good</option>
                          <option value="Satisfactory">4-Satisfactory</option>
                          <option value="Unsatisfactory">5-Unsatisfactory</option>
                          <option value="New Admission">6-New Admission</option>
                          <option value="Not Submitted">7-Not Submitted</option>
                          
                      </select>
                
                </td>
                <td>
                   
                        
                        
                            <select name="reading" id="reading" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                       
                     
                </td>
                <td>
                   
                            <select name="writing" id="writing" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                     
                </td>
                <td>
                   
                            <select name="cleanliness" id="cleanliness" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                       
                     

                </td>
                <td>
                   
                        
                        
                            <select name="sv" id="sv" class="form-control input-sm">
                                <option value="Excellent">1-Excellent</option>
                                <option value="V-Good">2-V-Good</option>
                                <option value="Good">3-Good</option>
                                <option value="Satisfactory">4-Satisfactory</option>
                                <option value="Unsatisfactory">5-Unsatisfactory</option>
                                <option value="New Admission">6-New Admission</option>
                                <option value="Not Submitted">7-Not Submitted</option>
                            </select>
                       
                     
                </td>
                <td><input type="text" id="marksOB<?= $i ?>" style="font-weight: bold;text-align: center;width: 100%;" class="form-control" name="att[]"  value="" /></td>
                <td><input type="text" id="marksOB<?= $i ?>" style="font-weight: bold;text-align: center;width: 100%;" class="form-control" name="out_of[]"  value="" /></td>
              
          </tr>
         <?php $i++; endforeach; ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    
    </div>
    <!-- /.row -->
      
        <div class="modal-footer">
            <button id="save_btn" onclick="update_details();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>

        </div>
    
  
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/bootstrap-toastr/toastr.min.js') ?>
<?= $this->Html->script('../plugins/jquery-overlay/loadingoverlay.min.js') ?>
<script>
  
    $(document).ready(function(){
        var max_marks = parseFloat($("#max_marks").val());
        $( ".obMarks" ).keyup(function() {
            $('#tablMarks tbody tr').each(function (row, tr) {
                
                var ob_marks = parseFloat($(tr).find('td:eq(5)>input').val());
                if(ob_marks > max_marks){
                    toastr.error("Sorry! Obtained marks can not be greater then from maximam marks","Something went wrong");
                    $('#save_btn').hide();
                    return false;
                }else{
                    $('#save_btn').show();
                }
                
            });
        });  
        
        
    });
    
   
  function goBack() {
    window.history.back();
  }  
  
  
    function update_details(){
       
        var class_id = $('#class_id').val();
        var shift_id = $('#shift_id').val();
        
        
        
        
        var TableData;
        TableData = storeOTblValues()
        if (TableData.length > 0) {

            toastr["info"]("Updating", "Exam Header");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'ExamResultNormal', 'action' => 'addMarksDetails']); ?>",
                dataType:'json',
                cache: false,
                async: false,
                data: {details: TableData,class_id:class_id,shift_id:shift_id},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                       } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        } else {
            toastr["warning"]("Nothing Added", "Exam Header");
        }
      // $('#save_btn').html('<i class="fa fa-spin fa-save"></i> Save');
      $('#save_btn').hide();
    }
    
    function storeOTblValues(){
        var TableData = new Array();

        $('#tablMarks tr').each(function(row, tr) {
            TableData[row] = {
                "registration_id": $(tr).find('td:eq(0)').text()
                ,"val1": $(tr).find('td:eq(5)>select').val()
                ,"val2": $(tr).find('td:eq(6)>select').val()
                ,"val3": $(tr).find('td:eq(7)>select').val()
                ,"val4": $(tr).find('td:eq(8)>select').val()
                ,"val5": $(tr).find('td:eq(9)>select').val()
                ,"att": $(tr).find('td:eq(10)>input').val()
                ,"out_of": $(tr).find('td:eq(11)>input').val()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
   
    
</script>    