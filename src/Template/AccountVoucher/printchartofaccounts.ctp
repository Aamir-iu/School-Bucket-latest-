<style>
    .customBorder{ border: 1px solid #eee; margin-bottom: 15px; padding: 15px; }
</style>
<div class="row">
    <div class="col-md-10">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title">
                <span style="display:block; position:relative; text-align:left; ">
                  <?php echo $this->Html->image('new_logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top']); ?>
<!--                    <span style="line-height:42px; font-size:41px; font-weight: bold; color:#EF4836 !important; vertical-align: top">Dr. Essa</span>
                    <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                    <span style=" position: relative;  display: inline-block;  font: 700 17px/17px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Laboratory<br/>& Diagnostic</span></span>-->
                </span>

                <div class="caption">
                    <i class="icon-chart font-teal-500"></i>

                    <span class="caption-subject font-teal-500 bold uppercase">

                        <span id="ponumber" >Chart of Accounts Report</span>
                    </span>

                </div>

                <div class="tools">
                    <strong>Show Transactional Accounts?</strong>
                    <input type="checkbox" id="yesno" onchange="valueChanged();">
                    <a href="javascript:window.print()" class="fa fa-print" data-original-title="" title="Print"></a>
                    <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden-xs hidden-sm" data-original-title="" title="Back">
                    </a>
                </div>
            </div>

            <div class="portlet-body">

                <!-- Accounts Details -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="portlet light">

                            <div class="portlet-body">
                                
                                <div class="row">
                                    <div class="col-xs-3 customBorder"><strong>Master Level</strong></div>
                                    <div class="col-xs-3 customBorder"><strong>Sub Control 1</strong></div>
                                    <div class="col-xs-3 customBorder"><strong>Sub Control 2</strong></div>
                                    <div class="col-xs-3 customBorder"><strong>Transaction Level</strong></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                                        <?php foreach($data as $mindex => $mvalue): ?>
                                        <div class="customBorder">
                                            <strong><?php echo $mindex; ?></strong>
                                            <div class="row">
                                                <div class="col-xs-3"></div>
                                                <div class="col-xs-9" style="padding-left: 0px;">
                                                    <?php foreach($mvalue as $s1index => $s1value): ?>
                                                    <div class="customBorder">
                                                        <strong><?php echo $s1index; ?></strong>
                                                        <div class="row">
                                                            <div class="col-xs-4"></div>
                                                            <div class="col-xs-8" style="padding-left: 6px;">
                                                                <?php foreach($s1value as $s2index => $s2value): ?>
                                                                <div class="customBorder">
                                                                    <strong><?php echo $s2index; ?></strong>
                                                                    <div class="row ta" style="display: none;">
                                                                        <div class="col-xs-6"></div>
                                                                        <div class="col-xs-6">
                                                                            <ul>
                                                                                <?php 
                                                                                foreach($s2value as $transactionindex=>$transactionvalue):
                                                                                    $array = explode('|', $transactionvalue);
                                                                                ?>
                                                                                <li>
                                                                                    <strong><?php echo $array[0]; ?></strong>
                                                                                    <ul class="list-unstyled">
                                                                                        <li><small><?php echo $array[1]; ?></small></li>
                                                                                        <li><small><?php echo $array[2]; ?></small></li>
                                                                                        <li>&nbsp;</li>
                                                                                    </ul>
                                                                                </li>
                                                                                <?php endforeach; ?> 
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!--Portlet Body End-->
        </div>
    </div>
</div>

<script>
  function goBack() {
    window.history.back();
  }  
  
  
  function valueChanged()
    {
        if($('#yesno').is(":checked"))   
            $(".ta").show();
        else
            $(".ta").hide();
    }
  
    
</script>