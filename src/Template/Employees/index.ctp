<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/switch/dist/css/bootstrap3/bootstrap-switch.css') ?> 
<?= $this->Html->css('../plugins/switch/dist/css/bootstrap3/bootstrap-switch.min.css') ?> 
<style type="text/css">
           
    #sortable li  {
        cursor: move;
    }
 </style>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-success">Action</button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li> <?= $this->Html->link(__('Add New Employee'), ['controller' => 'Employees', 'action' => 'add', 'department_id' => $department_id]) ?></li>
                            <li><a href="javascript:void(0);"  onclick="load_modal_ordering();"><?= __('Change Order') ?></a></li>
                        </ul>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="userstable" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th width="10%">Image</th>
                                <th width="20%">Name</th>
                                <th width="10%">Address</th>
                                <th width="10%">Contact</th>
                                <th width="10%">Status</th>
                                <th width="10%">Department</th>
                                <th width="10%">Scheduler</th>
                                <th width="20%">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee): ?>
                                <tr>

                                    <td><?php echo $this->Html->image("employees/" . $employee->employee_pic, ['alt' => 'user Picture', 'class' => 'img-circle', 'style' => 'width:30px']); ?></td>  
                                    <td><?= h($employee->employee_name) ?></td>
                                    <td><?= h($employee->employee_address) ?></td>
                                    <td><?= h($employee->employee_no) ?></td>
                                    <td><?= h($employee->status) ?></td>

                                    <td><?= h($employee->department['department_name']) ?></td>
                                    <?php $status = strtoupper($employee->scheduler_status) == 'TRUE' ? 'Yes' : 'No'; ?>
                                    
                                   <td><div style="font-size:16px;" class="<?= $status === 'Yes' ? 'alert alert-success' : 'alert alert-danger' ?>"><?= $status ?></div></td>
                                    
<!--                                    <td><input type="checkbox" id="sch_status<?= h($employee->employee_id) ?>"  name="my-checkbox"  <?= h($employee->scheduler_status) == 'true' ? 'checked' : 'unchecked' ?>   value="" /></td>-->

                                    <td class="actions">

                                        <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $employee->employee_id, 'department_id' => $employee->department_id], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                        <?php // $this->Form->postLink(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete', $employee->employee_id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->employee_id), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                        <a  href="#" onclick="delete_account(<?= $this->Number->format($employee->employee_id) ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                            </tfoot>
                    </table>
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

<!--ORDER PLUGIN MODAL START-->
<div id="orderplugin" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="orderplugin" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Display Order</h4>
            </div>
            <div class="modal-body">
                <div class="demo">
            <ul id="sortable" class="ui-sortable list-group">
                
<!--                <li class=" list-group-item text-left">
                    <span class="badge">1</span> Item
                </li>-->
               
            </ul>
        </div>

                
            </div>
            <div class="modal-footer">
                <input type="hidden" name="neworder" id="neworder" value="" />
                <button onclick="updateorder();" class="btn btn-icon waves-effect waves-light btn-info m-b-5 orderloader"><span>Save</span></button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--ORDER PLUGIN MODAL END-->



<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/switch/dist/js/bootstrap-switch.js') ?>
<?= $this->Html->script('../plugins/switch/dist/js/bootstrap-switch.min.js') ?>

<?= $this->Html->script('datatable.js') ?>  



<script>
    $(function () {
        $("#userstable").DataTable();
       // $("[name='my-checkbox']").bootstrapSwitch();



    });
    
     $(function() {
        $('#sortable').sortable({
            start : function(event, ui) {
                var start_pos = ui.item.index();
                ui.item.data('start_pos', start_pos);
            },
            change : function(event, ui) {
                var start_pos = ui.item.data('start_pos');
                var index = ui.placeholder.index();
                if (start_pos < index) {
                    $('#sortable li:nth-child(' + index + ')').addClass('list-group-item-success');
                } else {
                    $('#sortable li:eq(' + (index + 1) + ')').addClass('list-group-item-success');
                }
            },
            update : function(event, ui) {
                $('#sortable li').removeClass('list-group-item-success');
               // alert(ui.item.attr("id"));
                //console.log(order);
            }
        });

//        $('#dinamyc-element').on('click', function(e){
//                e.preventDefault();
//                var element_id = $('#sortable li').length+1;
//                var element = '<li class="list-group-item text-left"><span class="badge">'+element_id+'</span> Item</li>';
//                $('#sortable').append(element);
//        });
    });

    
    
    function change_status(id) {

        var status = $('#sch_status' + id).prop('checked');

        $.ajax({
            type: 'POST',
            url: "<?php echo $this->Url->build(['controller' => 'Employees', 'action' => 'editstatus']); ?>",
            dataType: 'json',
            data: {
                id: id,
                status: status
            },
            success: function (data) {
                var result = data.msg.split('|');
             
                if (result[0] === 'Success') {
                    toastr.success(result[0], result[1]);
               
                } else {
                    toastr.warning(result[0], result[1]);
                }
            }
        });

    }


    function load_modal_ordering() {
        
        $.ajax({
            type: 'POST',
            url: "<?php echo $this->Url->build(['controller' => 'Employees', 'action' => 'getemployees']); ?>",
            dataType: 'json',
            data: {
                depart_id: '<?php echo $department_id; ?>'
            },
            success: function (data) {
                var result = data.msg.split('|');
                var emp = data.data;
            //    console.log(emp);
                if (result[0] === 'Success') {
                   $('#sortable').html('');
                    $.each(emp, function(ind,val){
                    var img = val.host;
                   // $('#blah').attr("src",img);    
                   
                    var html = '';
                   // html += '<img src="'+img+'" class="" />';
                    html += '<li id="'+val.employee_id+'" class=" list-group-item text-center">';
                    html += '<span  class="badge">'+val.order_id+'</span><img src="'+img+'" class="profile-user-img img-responsive img-circle" style="width:50px;" /> &nbsp;&nbsp;&nbsp;&nbsp;'+val.employee_name;
                    html += '</li>';
                    $('#sortable').append(html);
                    });
                      
                } else {
                    toastr.warning(result[0], result[1]);
                }
            }
        });
        
          $('#orderplugin').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

    }
    
    
    function updateorder(){
    
        var order_data = [];
        $("#sortable li").each(function(index,row){
//           //console.log($(this).find('span').html());
//          // console.log($(this).find('select option:selected').text());
//         // option_values.push({'options':$(this).find('span').html(),'values': $(this).find('select option:selected').text()}); 
//        // console.log(row);
//        // console.log(index);
          order_data.push({'order_id':$(this).find('span').html()}); 
         
             
         });
         toastr.error('Sorry! This work is under construction');
         console.log(order_data);
     
    
    }
    
    function delete_account(id) {

        swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
            if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Employees', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
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

        });


    }
    
</script>