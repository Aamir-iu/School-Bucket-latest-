

 


 




 
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
                <h4 class="modal-title">Please enter description of  cancelling invoice</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">


                    <div class="form-group">
                        <label class="control-label col-md-3">Description:</label> 
                        <div class="col-md-9">
                            <textarea class="form-control" rows="5" id="desc"></textarea>
                            <input id="inv"  type="hidden"/>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button onclick="deleteinvoice();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<script>


    $(function() { // document ready

		$('#calendar').fullCalendar({
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    defaultView: 'agendaDay',
                    defaultDate: '2017-05-07',
                    timeFormat: 'h:mm',
                    slotLabelFormat:"hh:mm",
                    displayEventTime : false,
                    slotDuration: '00:15', /* If we want to split day time each 15minutes */
                    slotLabelInterval: '00:15',
                    slotMinutes: 05,
                    minTime: '08:00:00',
                    maxTime: '18:00:00',
                    height: $(window).height() - 150,
                    lazyFetching: false,
                    dayOfMonthFormat: 'dddd DD/MM',
                    editable: true,
                    selectable: true,
                    eventLimit: true, // allow "more" link when too many events
                    header: {
                            left: 'prev,next today',
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
                        <?php if($response) foreach($response as $row): ?> 
                        { id:"<?php echo $row['id']; ?>",title : "<?php echo $row['title']; ?>", eventColor: '<?php echo $row['color_code']; ?>'  },
                        <?php  endforeach; ?>
                          
                    ],
                    
                    events: [
                            { id: '1', resourceId: '3', start: '2017-05-07T08:00:00', end: '2017-05-07T09:00:00', title: 'English' },
                            { id: '2', resourceId: '4', start: '2017-05-07T08:45:00', end: '2017-05-07T9:45:00', title: 'Urdu' }
                          
                    ],
                   
                  
                    select: function(start, end, jsEvent, view, resource) {
                            $('#eventadd').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true
                            });  
                            console.log(
                                    'select',
                                    start.format(),
                                    end.format(),
                                    resource ? resource.id : '(no resource)'
                            );
                                 
                    
                    },
                    dayClick: function(date, jsEvent, view, resource) {
                            console.log(
                                    'dayClick',
                                    date.format(),
                                    resource ? resource.id : '(no resource)'
                            );
                    }
            });
	
	});


</script>
<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 12px;
               
	}

	#calendar {
		max-width: 100%;
		margin: 0px auto;
	}

</style>