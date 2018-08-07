<?= $this->Html->css('../plugins/iCheck/square/blue.css') ?>
 <div class="navbar navbar-inverse" style="background-color:#05a;">
            <div class="navbar-header">
                &nbsp;&nbsp;&nbsp; <a  href="#"><img src="https://eschools.cloud/images/top.png" alt="" width="70%"></a>
                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                </ul>
            </div>
            <div class="navbar-collapse collapse" id="navbar-mobile" style="padding-bottom:0px">
                <ul class="nav navbar-nav navbar-right">
                 
                    <li class="pull-left"><a href="#">School Management software</a></li>
                   
                    
                </ul>
            </div>
        </div>
<div class="login-box">
 
  <?= $this->Form->create('User', array('style' => 'display:block', 'id' => 'login-form','class'=>'form-signin')) ?>
  <!-- /.login-logo -->
  <div class="login-box-body">
      <div style="text-align:center;">
      <a  href="#"><img class='' src="/img/logo2.png" alt="" width="80%" height="100%"></a>
      </div>
    <p class="login-box-msg">Sign in to start your session</p>

   
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    
     <div class="note note-danger note-shadow <?php $msg = $this->Flash->render(); if (trim($msg) === '') {  echo 'hidden'; }?>">
         <?= $msg ?>
     </div>
    <a href="#">I forgot my password</a><br>
  

  </div>
  <!-- /.login-box-body -->
</div>
   <!-- Footer -->
<div class="footer text-muted" style='text-align: center;'>
    &copy; 2017. eschools.cloud Pvt Ltd. V2.5
</div>
<!-- /footer -->
<!-- /.login-box -->
 <?= $this->Form->end() ?>
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?php // $this->Html->script('..bootstrap/js/bootstrap.min.js') ?>
 <?= $this->Html->script('../plugins/iCheck/icheck.min.js') ?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
 </script>