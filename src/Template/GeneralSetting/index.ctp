
<!-- Main content -->
<section class="content">
 <?php  $details = $generalSetting[0];  ?>
    <div class="row">
     
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Institution Details</h6>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-flat">
                                    <input  class="form-control hidden" id="id_settings"  value="<?php echo $details['id_general_setting']; ?>" /></div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="reg_input_name" class="req">Institution Name </label>
                                                    <input size="60" maxlength="256" required="" class="form-control" name="Institution_Name" id="Institution_institution_name" type="text" value="<?php echo $details['Institution_Name']; ?>" /></div>
                                                <div class="col-md-6">
                                                    <label for="reg_input_name" class="req">Institution Address</label>
                                                    <textarea class="form-control" required="" name="Institution_Address" id="Institution_institution_address"><?php echo $details['Institution_Address']; ?></textarea></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="reg_input_currency" class="req">Institution Email</label>
                                                    <input size="60" maxlength="256" class="form-control" name="Institution_Email" id="Institution_institution_contactemail" type="text" value="<?php echo $details['Institution_Email']; ?>" /></div>
                                                <div class="col-md-6">
                                                    <label for="reg_input_currency" class="req">Institution Phone</label>
                                                    <input size="60" maxlength="256" class="form-control" name="Institution_Phone" id="Institution_institution_phone" type="text" value="<?php echo $details['Institution_Phone']; ?>" /></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="reg_input_currency"  class="req">Institution Mobile</label>
                                                    <input size="60" maxlength="256" required="" class="form-control" name="Institution_Mobile" id="Institution_Mobile" type="text" value="<?php echo $details['Institution_Mobile']; ?>" /></div>
                                                <div class="col-md-4">
                                                    <label for="reg_input_currency" class="req">Institution Fax</label>
                                                    <input size="60" maxlength="256" class="form-control" name="Institution_Fax" id="Institution_institution_fax" type="text" value="<?php echo $details['Institution_Fax']; ?>" /></div>
                                                <div class="col-md-4">
                                                    <label for="reg_input_currency" class="req">Admin Contact Person</label>
                                                    <input size="60" maxlength="256" class="form-control" name="Admin_Contact_Person" id="Institution_institution_contactperson" type="text" value="<?php echo $details['Admin_Contact_Person']; ?>" /></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="Country" class="req">Country</label>
                                                    <select  id="Country" name="Country" class="form-control" data-required="true">
                                                        
                                                        <?php foreach($country as $country):  ?>
                                                            <option <?php echo $details['Country'] == $country->country_code ? 'selected' : 'OK' ; ?> value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                                        <?php endforeach; ?>
                                                            
                                                        </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="reg_input_currency" class="req">Currency Type</label>
                                                    <select  id="Currency_Type" name="Currency_Type" class="form-control" data-required="true">
                                                       <?php foreach($currency as $currency):  ?>
                                                            <option <?php echo $details['Currency_Type'] == $currency->code ? 'selected' : 'OK' ; ?> value="<?php echo $currency->code; ?>"><?php echo $currency->name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select> 
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Language">Language</label>
                                                    <input size="60" maxlength="256" class="form-control" readonly value="English" name="Language" id="Language" type="text" value="English" /></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="Timezone" class="req">Timezone</label>
                                                    <select class="form-control" name="Timezone" id="Timezone">
                                                       <?php foreach($timezone as $timezone):  ?>
                                                            <option <?php echo $details['Timezone'] == $timezone->code ? 'selected' : 'OK' ; ?> value="<?php echo $timezone->code; ?>"><?php echo $timezone->name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label for="logo">Upload Logo</label><br />
                                                    <button class="btn btn-info" onclick="loadmodal();" type="button"> <i class="icon-arrow-right14 position-right"></i>Click here</button>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                        
                                           
                                        
                                        
                                        <div class="text-right">
                                            <button class="btn btn-primary" onclick="setting();" type="button"> <i class="icon-arrow-right14 position-right"></i>Save Setting</button>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
 <div class="modal fade" id="add_logo_modal" tabindex="-1" role="add_doctor_modal"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="close"  data-dismiss="modal" aria-hidden="true">x</span>
                </div>
           <form id="forget-form"> 
            <div class="modal-body">
                <form id="add_doctor_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                               <a href="#" onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive', 'id' => 'blah']); ?></a>
                                <input type="file" id="upload" onchange="readURL(this);" name="file" style="visibility: hidden; width: 1px; height: 1px" multiple />

                            </div>
                            
                        </div>
                       
                      
                        <div class="col-md-12">
                            <div class="form-group clearfix">
                                <button type="button" onclick="imageupload();" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                                
                            </div>
                        </div>
                    </div>
              </div>
           </form>
        </div>
            <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?> 
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 

   

<script>
    $(document).ready(function () {
       $("#Country").select2();
       $("#Currency_Type").select2();
       $("#Timezone").select2();
       
    });
     //Timepicke
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
                        .width(127);
                //.height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

  function setting() {
      var id                    = $('#id_settings').val();
      var Institution_Name      = $('#Institution_institution_name').val();
      var Institution_Address   = $('#Institution_institution_address').val();
      var Institution_Email     = $('#Institution_institution_contactemail').val();
      var Institution_Phone     = $('#Institution_institution_phone').val();
      var Institution_Mobile    = $('#Institution_Mobile').val();
      var Institution_Fax       = $('#Institution_institution_fax').val();
      var Admin_Contact_Person  = $('#Institution_institution_contactperson').val();
      var Country               = $('#Country option:selected').val();
      var Currency_Type         = $('#Currency_Type option:selected').val();
      var Language              = $('#Language').val();
      var Timezone              = $('#Timezone option:selected').val();

       swal({
            title: 'Are you sure?',
            text: "you want to save!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Sure!'
          }).then(function (result) {
         
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'GeneralSetting', 'action' => 'edit']); ?>/"+ id,
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {Institution_Name: Institution_Name
                                ,Institution_Address:Institution_Address
                                ,Institution_Email:Institution_Email
                                ,Institution_Phone:Institution_Phone
                                ,Institution_Mobile:Institution_Mobile
                                ,Institution_Fax:Institution_Fax
                                ,Admin_Contact_Person:Admin_Contact_Person
                                ,Country:Country
                                ,Currency_Type:Currency_Type
                                ,Language:Language
                                ,Timezone:Timezone},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                               
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }

            }
           swal(
            'Success!',
            'Setting has been saved.',
            'success'
           
          )
         //  location.reload();
        });

    }

    function loadmodal() {

            $('#add_logo_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }


        function imageupload(){
        var fd = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        for(var i = 0;i<file_data.length;i++){
            fd.append("file", file_data[i]);
        }
        var other_data = $('forget-form').serializeArray();
        $.each(other_data,function(key,input){
            fd.append(input.name,input.value);
        });
        
      
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'GeneralSetting', 'action' => 'updatelogo']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: fd,//only input,
                contentType: false,
                processData: false,
                success: function (data) {
                    var result = data.msg.split("|");
                    var filename = data.fileName;
                    $('#filename').val(filename);
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                    }else{
                       $('#upload').val('');
                       $('#imgpath').html('<?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?>'); 
                       toastr.warning(result[0], result[1]); 
                    }
                    
                }
            });
    }

</script>   