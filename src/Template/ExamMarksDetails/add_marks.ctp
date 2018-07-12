           
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
          <?php if($results){ echo ' Subject :'. $results[0]['subject'].' '. $results[0]['subject_desc'];  }    ?>
          <?php if($results){ echo ' |  Total Number :'. $results[0]['max_marks'].' Passing Number : '. $results[0]['min_marks'];  }    ?>
          
          </span>
          
          
        </h2>
      </div>
      <!-- /.col -->
    </div>
    
    <input type="text" class="hidden" id="max_marks" value="<?= $results[0]['max_marks'] ?>" />
    <input type="text" class="hidden" id="min_marks" value="<?= $results[0]['min_marks'] ?>" />
    <input type="text" class="hidden" id="class_id" value="<?= $class_id ?>" />
    <input type="text" class="hidden" id="shift_id" value="<?= $exam_type_id ?>" />
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
              <th style="width:15%;">Student Name</th>
              <th style="width:15%;">Father Name</th>
              <th style="width:5%;">Obtained marks</th>
              <th style="width:10%;">Result</th>
             
              
              
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
                
                <td><input type="text" id="marksOB<?= $i ?>" style="font-weight: bold;text-align: center;width: 100%;" class="form-control obMarks" name="obmark[]" id="ob_marks" value="<?= $row['obtained'] ?>" /></td>
                <td></td>
           
              
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
       //$('#save_btn').html('<i class="fa fa-spin fa-spinner"></i> Please wait...');
        var class_id = $('#class_id').val();
        var shift_id = $('#shift_id').val();
        
        var exam_type_id = $('#exam_type_id').val();
        var subject_id = $('#subject_id').val();
        var max_marks = parseFloat($("#max_marks").val());
        var min_marks = parseFloat($("#min_marks").val());
        
        var TableData;
        TableData = storeOTblValues()
        if (TableData.length > 0) {

            toastr["info"]("Updating", "Exam Header");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'ExamMarksDetails', 'action' => 'addMarksDetails']); ?>",
                dataType:'json',
                cache: false,
                async: false,
                data: {details: TableData,class_id:class_id,shift_id:shift_id,
                       exam_type_id:exam_type_id,subject_id:subject_id,max_marks:max_marks,min_marks:min_marks},
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
                ,"obMarks": $(tr).find('td:eq(5)>input').val()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
   
    
</script>    