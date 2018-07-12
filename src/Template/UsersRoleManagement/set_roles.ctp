<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
           <div class="portlet-body ">
        <!-- BEGIN FORM-->
        <div class="form">



            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light">
                       
                        <div class="portlet-body">
                            <div data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" style="hieght:200px;" id="parent_menu">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Parent menu
                                                </th>
                                                
<!--                                                <th>
                                                    Allow
                                                </th>-->
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  foreach($parent_menu as $row): ?>  
                                            <tr>
                                                <td  id="id<?php echo $row->id_main_menu; ?>">
                                                    
                                                    <a href="#" onclick="getChildMenu('<?php echo $row->id_main_menu; ?>');">
                                                     <?php echo  $row->manu_name; ?>
                                                    </a>
                                                    
                                                </td>
                                                
<!--                                                <td>
                                                    <input type="checkbox" value="" name="test" />
                                                </td>   -->
                                                
                                                
                                           </tr>
                                         <?php endforeach; ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
                
                   <div class="col-md-6 col-sm-6">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light">
                       
                        <div class="portlet-body">
                            <div data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="child_menu">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Child Menu
                                                </th>
                                                
                                                <th>
                                                    show  Menu
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button style="display:none;" onclick="update_roles();" id="save_btn" class="btn btn-icon waves-effect waves-light btn-success m-b-5 pull-right" ><i class="fa fa-save"></i> Save</button> 
                                            </td>
                                        </tr>
                                        
                                    </tfoot>        
                                        
                                    </table>
                                    
                                    
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>

            </div>
        </div>
    </div>

                
            </div>
            <!-- /.box-header -->
                 <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
    
    
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>

<?= $this->Html->script('datatable.js') ?>

<script>
     
    
    
    function getChildMenu(id){
       
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->Url->build(['controller' => 'UsersRoleManagement', 'action' => 'getChildmenu']); ?>',
            data: {
                id: id,
                role_id: <?php echo $role_id; ?>
            },
            dataType: "json",
            cache: false,
            async: true,
            success: function(data) {
                var data = data.data;
                //console.log(data);
                var mhtml = "";
                $('#save_btn').hide();
                 $.each(data, function(ind,val){
                    mhtml += '<tr>';
                    mhtml += '<td class="hidden">'+val[1]+'</td>';
                    mhtml += '<td>' + ind + '</td>';
                    
                    var yes = val[2] === 'Yes' ? 'selected' : ''; 
                    var no =  val[2] === 'No' ? 'selected' : '';
                    
                    mhtml += '<td><select class="form-control" id="permission"><option '+yes+' value="Yes">Yes</option><option '+no+' value="No">No</option></select></td>';
                    mhtml += '<td class="hidden">'+id+'</td>';
                    
                    mhtml += '</tr>';
                    $('#save_btn').show();
                    
                 });
                 
                 $('#child_menu tbody').html('');
                 $('#child_menu tbody').append(mhtml);
                
                 $('#parent_menu tbody tr td').removeClass('alert alert-danger');
                 $('#id'+id).addClass('alert alert-danger');
                 
              
            }
        });
        
        
    }
    
    
     function update_roles(){
        var TableData;
        TableData = storeOTblValues();
        if (TableData.length > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'UsersRoleManagement', 'action' => 'edit']); ?>",
                dataType:'json',
                data: {menu_details: TableData,role_id:<?php echo $role_id ?>},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        //location.reload();
                    } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        } else {
            toastr["warning"]("Nothing Added");
        }
    }
    
    
    function storeOTblValues(){
    
        var TableData = new Array();
        $('#child_menu tbody tr').each(function(row, tr) {
            TableData[row] = {
                "sub_menu_id": $(tr).find('td:eq(0)').text()
                , "sub_menu_name": $(tr).find('td:eq(1)').text()
                , "permissions": $(tr).find('td:eq(2)>select option:selected').val()
                , "main_menu_id": $(tr).find('td:eq(3)').text()
              
            }
        });
      //  TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
</script>