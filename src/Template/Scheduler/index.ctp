<?php 

$color [] = "DarkGreen";
$color [] = "DarkMagenta";
$color [] = "DarkRed";
$color [] = "DarkSlateBlue";
$color [] = "GoldenRod";
$color [] = "SeaGreen";
$color [] = "Tomato";
$color [] = "MediumVioletRed";
$color [] = "MediumOrchid";
$color [] = "Maroon";
$color [] = "IndianRed";
$color [] = "HotPink";
$color [] = "DodgerBlue";
$color [] = "DarkSalmon";

?>


<!-- Main content -->
 <section class="content" style=" background-color: white;">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<!-- /.content -->
<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade" id="eventadd"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Please select subject</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">

                    <INPUT TYPE="text" class="hidden" id="res_id" name="res_id" value="" />
                    <INPUT TYPE="text" class="hidden" id="start_id" name="start_id" value="" />
                    <INPUT TYPE="text" class="hidden" id="end_id" name="end_id" value="" />
                    
                     <div class="form-group">
                      <div class="col-sm-12">
                        <select class="form-control" id="class_id" name="class_id" data-placeholder="Select Fee Head" style="width: 100%;">
                        <?php foreach($class as $classes):  ?>
                            <option  value="<?php echo $classes->id_class; ?>"><?php echo $classes->class_name; ?></option>
                        <?php endforeach; ?> 
                        </select>
                       </div>   
                     </div>
                    
                    
                    
                    <div class="form-group">
                      <div class="col-sm-12">
                        <select class="form-control" id="subject" name="subject" data-placeholder="Select Fee Head" style="width: 100%;">
                         <?php  foreach($subjects as $subjects): ?>    
                            <option value="<?php  echo $subjects->id_subjects; ?>"><?php  echo $subjects->subject_name; ?></option>
                         <?php endforeach; ?>    
                        </select>
                       </div>   
                     </div>
                    
                    <div class="form-group hidden">
                      <div class="col-sm-12">
                        <select class="form-control" id="color_id" name="color_id" data-placeholder="Select Subject" style="width: 100%;">
                         
<!--                            <option value="0">Select Color</option>-->
                            <option value="green">Green</option>
                            <option value="yellow">Yellow</option>
                            <option value="blue">Blue</option>
                            <option value="brown">Brown</option>
                            
                         
                        </select>
                       </div>   
                     </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button onclick="add_sch();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?= $this->Html->script('../plugins/fullcalendar/moment.min.js') ?>  
<?php // $this->Html->script('../plugins/fullcalendar/jquery.min.js') ?>
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/fullcalendar/fullcalendar.min.js') ?>
<?= $this->Html->script('../plugins/fullcalendar/scheduler.min.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 

<script>
   
    var oldResourceId = null;
    $(function() { // document ready

		$('#calendar').fullCalendar({
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    defaultView: 'agendaDay',
                    defaultDate: '<?php echo date('Y-m-d'); ?>',
                    timeFormat: 'h:mm',
                    slotLabelFormat:"hh:mm",
                    displayEventTime : false,
                    slotDuration: '00:05', /* If we want to split day time each 15minutes */
                    slotLabelInterval: '00:05',
                    slotMinutes: 05,
                    minTime: '07:00:00',
                    maxTime: '23:55:00',
                    height: $(window).height() - 0,
                    lazyFetching: false,
                    dayOfMonthFormat: 'dddd DD/MM',
                    editable: true,
                    allDaySlot: false,
                    selectable: true,
                    eventLimit: true, // allow "more" link when too many events
                    header: {
                            left: '',
                            center: 'title',
                            right: 'agendaDay,agendaWeek,month'
                    },
                     resourceRender: function(resourceObj, labelTds, bodyTds) {
                        $.ajax({
                            url: '<?php echo $this->Url->build(['controller' => 'Scheduler', 'action' => 'getemp']); ?>',
                            data: {
                                staff_id:resourceObj.id
                            },
                            type: 'POST',
                            dataType: 'json',
                            success: function(response){
                                var img = response.staff_image;
                                labelTds.css({
                                    'cursor':'pointer',
                                    'background-image':'url('+img+')',
                                    'background-color':'#fff',
                                    'background-size':'50px 50px',
                                    'background-repeat':'no-repeat',
                                    'height': '105px',
                                    'color':'#808080',
                                    'font-size': '12px',
                                    'text-align':'center',
                                    'background-position':'center',
                                    'overflow': 'hidden'
                                });
                            }

                        });
                    },
                    resources: [
                        <?php $i= 0; if($response) foreach($response as $row): ?> 
                        { id:"<?php echo $row['id']; ?>",title : "<?php echo $row['title']; ?>", eventColor: '<?php echo $color[$i]; ?>'  },
                        <?php $i++; endforeach; ?>
                          
                    ],
                    events: [
                        <?php if($data) foreach($data as $row): ?> 
                        <?php   
                        
                            $st = new DateTime($row['start_time']);
                            $sdate = date('Y-m-d').' '.$st->format('H:i:s');
                            
                            $et = new DateTime($row['end_time']);
                            $edate = date('Y-m-d').' '.$et->format('H:i:s');
                            
                            $endTime = strtotime("-5 minutes", strtotime($et->format('H:i:s')));
                            
                        
 
                            ?>
                        { id:"<?php echo $row['id_class_schedule']; ?>",resourceId : "<?php echo $row['teacher_id']; ?>", start: "<?php echo $sdate; ?>",end:"<?php echo $edate; ?>", title:" <?php echo  $row['class']; ?> | <?php echo $row['sub']; ?> | <?php echo $row['day']; ?>" },
                        
                        
                        <?php  endforeach; ?>
                    ],
                   
                    select: function(start, end, jsEvent, view, resource) {
//                            $('#staff_id').val('');
//                            $('#eventadd').modal({
//                                backdrop: 'static',
//                                keyboard: false,
//                                show: true
//                            });
//                            
//                            $('#res_id').val(resource.id);
//                            $('#start_id').val(start.format());
//                            $('#end_id').val(end.format());
           
                    
                    },
                    dayClick: function(date, jsEvent, view, resource) {
                            console.log(
                                    'dayClick',
                                    date.format(),
                                    resource ? resource.id : '(no resource)'
                            );
                    },
                    eventDragStart: function(event) {
                        oldResourceId = event.resourceId;
                       // console.log(oldResourceId);
                    },
                    eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
                      //  console.log(event.start.format());
                        //console.log(event.resourceId);
                    //    update_scheduler(event.id,event.resourceId,event.start.format(),event.end.format());
                      
                    },
                    eventMouseover: function(calEvent, jsEvent) {
                        var mTitle=calEvent.title.split('-');
                        var tooltip = '<div class="tooltipevent" style="width:220px;height:50px;background:#23527c;color:#fff; padding:5px; position:absolute;z-index:10090;">' + mTitle[0]+' - '+ mTitle[1]+' - '+mTitle[2] + '</div>';
                        var $tooltip = $(tooltip).appendTo('body');

                        $(this).mouseover(function(e) {
                            $(this).css('z-index', 10000);
                            $tooltip.fadeIn('500');
                            $tooltip.fadeTo('10', 1.9);
                        }).mousemove(function(e) {
                            $tooltip.css('top', e.pageY + 10);
                            $tooltip.css('left', e.pageX + 20);
                        });
                    },
                    eventMouseout: function(calEvent, jsEvent) {
                        $(this).css('z-index', 8);
                        $('.tooltipevent').remove();
                    },
                    eventResizeStart: function(event) {
                        oldResourceId = event.resourceId;
                    },
                    eventResize: function(event, delta, revertFunc, jsEvent, ui, view){
                     //   update_scheduler(event.id,event.resourceId,event.start.format(),event.end.format());
                    },
                    eventRender: function(event, element) {
                        element.bind('dblclick', function() {
                            
                         //   delete_event(event.id);
                            
                         });
                     }
            });
	
	});

      
//    $(window).on('load', function() {
//        $('#calendar').fullCalendar('render');
//        $('html, body').css({
//            'overflow': 'hidden',
//            'height': '100%'
//        });
//    });   
        
    function add_sch(){
        
        var color_code = $('#color_id option:selected').text();
        if(color_code === 'Select Color'){
            toastr["error"]("Please select color that you want to display!", "Error");
            return false;
        }
        
        var id = $('#res_id').val();
        var subject_id = $('#subject option:selected').val();
        var class_id = $('#class_id option:selected').val();
        var start_time = $('#start_id').val();
        var end_time = $('#end_id').val();
        
         $.ajax({
         url: '<?php echo $this->Url->build(['controller' => 'Scheduler', 'action' => 'add']); ?>',
            data: {
                staff_id:id
                ,subject_id:subject_id
                ,start_time:start_time
                ,end_time:end_time
                ,color_code:color_code
                ,class_id:class_id
            },
            type: 'POST',
            dataType: 'json',
            success: function(response){
                var result = response.msg.split('|');
                if(result[0] === 'Success'){
                    toastr.success(result[0], result[1]);
                    location.reload();
                } else{
                   toastr.warning(result[0], result[1]); 
                }

            }
        });
        
    }    
   
    $(document).ready(function () {
      $("#class_id").select2();
      $("#subject").select2();
    
    });
    
     function update_scheduler(e_id,r_id,s,e){
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Scheduler', 'action' => 'uodatescheduler']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {e_id: e_id,r_id:r_id,st:s,et:e},
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
    
  function delete_event(id) {

       swal({
            title: 'Are you sure?',
            text: "You want to delete schedule!",
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
                        url: "<?php echo $this->Url->build(['controller' => 'Scheduler', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
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
            'Deleted!',
            'The Schedule Has Been Deleted.',
            'success'
           
          )
           location.reload();
        });

    }    
    
   
</script>
<style>
	#calendar {
		max-width: 100%;
		margin: 0px auto;
	}

</style>