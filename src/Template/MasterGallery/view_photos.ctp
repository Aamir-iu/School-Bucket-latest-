<?php
     function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
?>
<style>
    
 .hovereffect {
    width: 100%;
    height: 100%;
    float: left;
    overflow: hidden;
    position: relative;
    text-align: center;
    cursor: default;
}
.hovereffect .overlay {
    width: 100%;
    position: absolute;
    overflow: hidden;
    left: 0;
	top: auto;
	bottom: 0;
	padding: 1em;
	height: 4.75em;
	background: #79FAC4;
	color: #3c4a50;
	-webkit-transition: -webkit-transform 0.35s;
	transition: transform 0.35s;
	-webkit-transform: translate3d(0,100%,0);
	transform: translate3d(0,100%,0);
	visibility: hidden;

}

.hovereffect img {
    display: block;
    position: relative;
	-webkit-transition: -webkit-transform 0.35s;
	transition: transform 0.35s;
}

.hovereffect:hover img {
-webkit-transform: translate3d(0,-10%,0);
	transform: translate3d(0,-10%,0);
}

.hovereffect h2 {
    text-transform: uppercase;
    color: #fff;
    text-align: center;
    position: relative;
    font-size: 17px;
    padding: 10px;
    background: rgba(0, 0, 0, 0.6);
	float: left;
	margin: 0px;
	display: inline-block;
}

.hovereffect a.info {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    text-transform: uppercase;
	color: #fff;
	border: 1px solid #fff;
	margin: 50px 0 0 0;
	background-color: transparent;
}
.hovereffect a.info:hover {
    box-shadow: 0 0 5px #fff;
}


.hovereffect p.icon-links a {
	float: right;
	color: #3c4a50;
	font-size: 1.4em;
}

.hovereffect:hover p.icon-links a:hover,
.hovereffect:hover p.icon-links a:focus {
	color: #252d31;
}

.hovereffect h2,
.hovereffect p.icon-links a {
	-webkit-transition: -webkit-transform 0.35s;
	transition: transform 0.35s;
	-webkit-transform: translate3d(0,200%,0);
	transform: translate3d(0,200%,0);
	visibility: visible;
}

.hovereffect p.icon-links a span:before {
	display: inline-block;
	padding: 8px 10px;
	speak: none;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}


.hovereffect:hover .overlay,
.hovereffect:hover h2,
.hovereffect:hover p.icon-links a {
	-webkit-transform: translate3d(0,0,0);
	transform: translate3d(0,0,0);
}

.hovereffect:hover h2 {
	-webkit-transition-delay: 0.05s;
	transition-delay: 0.05s;
}

.hovereffect:hover p.icon-links a:nth-child(3) {
	-webkit-transition-delay: 0.1s;
	transition-delay: 0.1s;
}

.hovereffect:hover p.icon-links a:nth-child(2) {
	-webkit-transition-delay: 0.15s;
	transition-delay: 0.15s;
}

.hovereffect:hover p.icon-links a:first-child {
	-webkit-transition-delay: 0.2s;
	transition-delay: 0.2s;
}
Close
   
    
</style>
<!-- Main content -->
<section class="content">

    <div class="row">


        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Photo Gallery</h3>
                   <div class="btn-group pull-right">
                        <div class="actions" style="margin-bottom: 28px;">
                            <a  href="#add-account" onclick="loadmodal();" title="Upload Images" class="btn btn-sm btn-warning">
                                <i class="fa fa-upload"></i> Upload  </a>
                            
                        </div>
                    </div>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-body form-horizontal form-bordered form-row-stripped">

                        <div class="portlet-body ">


                            <!-- timeline item -->
                          
                              

                                <div class="timeline-item">
                                     <div class="timeline-body">
                                <?php  foreach($masterGallery as $row): ?>  
                                        <?php  $image = url()."img/photo_gallery/".$row->pic; ?>
                                         <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12" style="margin-top:10px; ">
                                            <div class="hovereffect">

                                               <img src="<?php echo $image; ?>" alt="..." class="img-responsive" style="width:150px;height: 120px;">
                                               <div class="overlay">
                                                   <h2 onclick="deleteme('<?php echo $row->id_gallery_details; ?>','<?php echo $row->pic; ?>');" style="cursor: pointer;"> Delete </h2>

                                               </div>
                                           </div>
                                       </div>
                                      
                                <?php  endforeach; ?>      
                                 </div> 
                                    
                                </div>
                           


                        </div>

                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>


    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-fee"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="box-header">
                    <strong>Upload Syllabus </strong>
               </div>
            </div>
            <div class="modal-body">
            
            <?= $this->Form->create('ds', array('type' => 'file', 'url' => array('controller' => 'MasterGallery', 'action' => 'upload',$id, 'id' => 'forget-form'))); ?>      
                <div class="row">
                    
                    <div class="alert alert-warning success">
                       You can upload multiple photos.
                    
                    </div>
               
               
                
                <div class="form-group">
                    
                 <div class="col-sm-12">   
                    <input type="file" name='images[]' multiple>
                    <input type="hidden" name='submit' value='mu'>
                   
                  </div>
                 
                 </div>
                
                 <br /><br />
                <div class="form-group pull-right">
                    
                 <div class="col-sm-12">   
                   
                    <?= $this->Form->button(__('<i class="fa fa-upload"></i> Upload'), [ 'class' => 'btn btn-success', 'escape' => false]) ?>
                    &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                    
                     
                  </div>
                 
                 </div>
                
            <?= $this->Form->end() ?>    
              </div>
                    
                    
               </div>
                
            </div>
         
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

<!-- /.modal -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>

<script>
   
    function deleteme(id,pic){
         swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (result) {
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'MasterGallery', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id,pic:pic},
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
    
    function loadmodal() {

        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

</script>   