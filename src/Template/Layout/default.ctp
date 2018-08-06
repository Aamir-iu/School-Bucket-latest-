<?php
$cakeDescription = 'Online School Management System';
?>
<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
    @media print { body { -webkit-print-color-adjust: exact; } }
    </style>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <?= $this->Html->css('../plugins/fullcalendar/fullcalendar.min.css') ?> 
    <?= $this->Html->css('../plugins/fullcalendar/fullcalendar.print.min.css  media="print"') ?> 
    <?= $this->Html->css('../plugins/fullcalendar/scheduler.min.css') ?>
    
    
    <?= $this->Html->css('../plugins/select2/select2.min.css') ?> 
    <?= $this->Html->css('../bootstrap/css/bootstrap.min.css') ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <?= $this->Html->css('../plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>
    <?= $this->Html->css('../dist/css/AdminLTE.min.css') ?>
    <?= $this->Html->css('../dist/css/skins/_all-skins.min.css') ?>
    <?= $this->Html->css('../plugins/pace/pace.min.css') ?>
    <?= $this->Html->css('../plugins/bootstrap-toastr/toastr.min.css') ?> 
    <?= $this->Html->css('../plugins/swl2/sweetalert2.css') ?> 
    <?= $this->Html->script('../plugins/swl2/sweetalert2.min.js') ?>
    
    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
 
    
</head>
 <?php if ($this->request->param('action') !== 'login' && $this->request->param('action') !== 'view' && $this->request->param('action') !== 'addMarks') { ?>
<body class="hold-transition skin-blue sidebar-mini">
 
 <div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>J</b>Q</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>JQSYS</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
       <?php  if($this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3):   ?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                           <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <?php $enquiry =  $this->request->session()->read('Info.inquery');  ?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php if(!empty($enquiry)){ echo count($enquiry); } ?></span>
            </a>
            <ul class="dropdown-menu">
             <li class="header"> <?php if(!empty($enquiry)){ if(count($enquiry)==1){ echo "You have ". count($enquiry). "  inquiry in pending";} elseif(count($enquiry)>1){ echo "You have ". count($enquiry). "  inquiries in pending"; } } ?></li>
              <li> 
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php if(!empty($enquiry)): foreach($enquiry as $row):  ?>  
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> <?php echo $row['f_name']; ?>
                       <small><i class="fa fa-clock-o"></i> <?php echo $row['in_date']; ?></small>
                    </a>
                  </li>
                <?php endforeach; endif; ?>  
                  
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
      <?php endif; ?>    
 
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'user-image']); ?>
                <span class="hidden-xs"><?php echo $this->request->session()->read('Auth.User.full_name'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'img-circle']); ?>

                <p>
                  System User
                  <small><?php echo $this->request->session()->read('Auth.User.created'); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                 
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
               <?php  if($this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3):   ?>   
                <div class="pull-left">
                  <?= $this->Html->link(__('<span class="btn btn-default btn-flat">Profile</span> '), ['controller' => 'Users', 'action' => 'Userprofile'], ['escape' => false]) ?>
                </div>
               <?php endif; ?>   
                <div class="pull-right">
                   <?= $this->Html->link(__('<span class="btn btn-default btn-flat">Logout</span> '), ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]) ?>
                   
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'img-circle']); ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $this->request->session()->read('Auth.User.full_name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        
       <li><a href="/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
        </a>
        </li>
      
        
    <?php  if(!empty($this->request->session()->read('menu.Organization'))):   ?> 
        <?php  $Organization =  $this->request->session()->read('menu.Organization'); ?>
        <li <?php if($this->request->param('controller')==='Expanses' &&  $this->request->param('action')==='index' ||  $this->request->param('controller')==='Complains' || $this->request->param('controller')==='Inquiry' && $this->request->param('action')==='index' )  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-th"></i> <span>Organization</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
      
            
          <ul class="treeview-menu">
              
            <?php  if(isset($Organization['Inquiry']) && $Organization['Inquiry'] === 'Yes'): ?>     
            <li <?php if($this->request->param('controller')==='Inquiry' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Inquiry'), ['controller' => 'Inquiry', 'action' => 'index']) ?>
            </li>
             <?php endif; ?> 
            
             <!-- <?php  if(isset($Organization['Inquiry Report']) && $Organization['Inquiry Report'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Inquiry' && $this->request->param('action')==='inquiryreport'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Inquiry Report'), ['controller' => 'Inquiry', 'action' => 'inquiryreport']) ?>
            </li>
            <?php endif; ?>  -->
            
            <!-- <?php  if(isset($Organization['Classes and Sections']) && $Organization['Classes and Sections'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ClassesSections' && $this->request->param('action')==='index'  || $this->request->param('controller')==='ClassesSections' && $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Classes and Sections'), ['controller' => 'ClassesSections', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> -->
            
            <?php  if(isset($Organization['Expanse Voucher']) && $Organization['Expanse Voucher'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Expanses' && $this->request->param('action')==='index' || $this->request->param('action')==='add' || $this->request->param('action')==='view'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Expense Voucher'), ['controller' => 'Expanses', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?>
            
            <!-- <?php  if(isset($Organization['Departments']) && $Organization['Departments'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Departments' && $this->request->param('action')==='index' || $this->request->param('controller')==='Departments' && $this->request->param('action')==='edit' ||  $this->request->param('controller')==='Employees' && $this->request->param('action')==='index' || $this->request->param('controller')==='Employees' && $this->request->param('action')==='edit'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?>
            </li >
            <?php endif; ?>
            
            
            <?php  if(isset($Organization['Class Schedule']) && $Organization['Class Schedule'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ClassSchedule' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Class Scheduler'), ['controller' => 'ClassSchedule', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
           <!--  <?php  if(isset($Organization['Teacher Scheduler']) && $Organization['Teacher Scheduler'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Scheduler' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Teacher Scheduler'), ['controller' => 'Scheduler', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
            
            
           <!--  <?php  if(isset($Organization['Staff Attendance']) && $Organization['Staff Attendance'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='EmployeeAttendance' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Staff Attendance'), ['controller' => 'EmployeeAttendance', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> 
            
            
            <?php  if(isset($Organization['Staff Salary']) && $Organization['Staff Salary'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='EmployeeSalary' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Staff Salary'), ['controller' => 'EmployeeSalary', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
            <?php  if(isset($Organization['Complains']) && $Organization['Complains'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Complains' && $this->request->param('action')==='index' || $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Notifications and Complains'), ['controller' => 'Complains', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?>
            
            <!-- <?php  if(trim(isset($Organization['Photo Gallery'])) && trim($Organization['Photo Gallery']) === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='MasterGallery' && $this->request->param('action')==='index' || $this->request->param('action')==='edit'  || $this->request->param('action')==='add'){echo 'class="active"';} ?>> 
             <?= $this->Html->link(__('Photo Gallery'), ['controller' => 'MasterGallery', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?>  -->
            
            
             
          </ul>
        </li>
    <?php endif; ?>  

    <?php  if(!empty($this->request->session()->read('menu.Organization'))):   ?> 
        <?php  $Organization =  $this->request->session()->read('menu.Organization'); ?>
        <li <?php if($this->request->param('controller')==='Departments' || $this->request->param('controller')==='Employees'   ||  $this->request->param('controller')==='Scheduler' ||  $this->request->param('controller')==='EmployeeSalary' ||  $this->request->param('controller')==='EmployeeAttendance' || $this->request->param('controller')==='ClassSchedule' )  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-user"></i> <span>Staff Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
      
            
          <ul class="treeview-menu">
              
            <!-- <?php  if(isset($Organization['Inquiry']) && $Organization['Inquiry'] === 'Yes'): ?>     
            <li <?php if($this->request->param('controller')==='Inquiry' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Inquiry'), ['controller' => 'Inquiry', 'action' => 'index']) ?>
            </li>
             <?php endif; ?>  -->
            
             <!-- <?php  if(isset($Organization['Inquiry Report']) && $Organization['Inquiry Report'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Inquiry' && $this->request->param('action')==='inquiryreport'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Inquiry Report'), ['controller' => 'Inquiry', 'action' => 'inquiryreport']) ?>
            </li>
            <?php endif; ?> --> 
            
           <!--  <?php  if(isset($Organization['Classes and Sections']) && $Organization['Classes and Sections'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ClassesSections' && $this->request->param('action')==='index'  || $this->request->param('controller')==='ClassesSections' && $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Classes and Sections'), ['controller' => 'ClassesSections', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> -->
            
            <!-- <?php  if(isset($Organization['Expanse Voucher']) && $Organization['Expanse Voucher'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Expanses' && $this->request->param('action')==='index' || $this->request->param('action')==='add' || $this->request->param('action')==='view'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Expense Voucher'), ['controller' => 'Expanses', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            <?php  if(isset($Organization['Departments']) && $Organization['Departments'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Departments' && $this->request->param('action')==='index' || $this->request->param('controller')==='Departments' && $this->request->param('action')==='edit' ||  $this->request->param('controller')==='Employees' && $this->request->param('action')==='index' || $this->request->param('controller')==='Employees' && $this->request->param('action')==='edit'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?>
            </li >
            <?php endif; ?>
            
            
            <?php  if(isset($Organization['Class Schedule']) && $Organization['Class Schedule'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ClassSchedule' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Class Scheduler'), ['controller' => 'ClassSchedule', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?>
            
            
           <!--  <?php  if(isset($Organization['Teacher Scheduler']) && $Organization['Teacher Scheduler'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Scheduler' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Teacher Scheduler'), ['controller' => 'Scheduler', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
            
            
            <?php  if(isset($Organization['Staff Attendance']) && $Organization['Staff Attendance'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='EmployeeAttendance' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Staff Attendance'), ['controller' => 'EmployeeAttendance', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> 
            
            
            <?php  if(isset($Organization['Staff Salary']) && $Organization['Staff Salary'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='EmployeeSalary' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Staff Salary'), ['controller' => 'EmployeeSalary', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?>
            
            
            <!-- <?php  if(isset($Organization['Complains']) && $Organization['Complains'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Complains' && $this->request->param('action')==='index' || $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Notifications and Complains'), ['controller' => 'Complains', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            <!-- <?php  if(trim(isset($Organization['Photo Gallery'])) && trim($Organization['Photo Gallery']) === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='MasterGallery' && $this->request->param('action')==='index' || $this->request->param('action')==='edit'  || $this->request->param('action')==='add'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Photo Gallery'), ['controller' => 'MasterGallery', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
             
          </ul>
        </li>
    <?php endif; ?>

    <?php  if(!empty($this->request->session()->read('menu.Organization'))):   ?> 
        <?php  $Organization =  $this->request->session()->read('menu.Organization'); ?>
        <li <?php if($this->request->param('controller')==='ClassesSections')  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-building"></i> <span>Class</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
      
            
          <ul class="treeview-menu">
              
            <!-- <?php  if(isset($Organization['Inquiry']) && $Organization['Inquiry'] === 'Yes'): ?>     
            <li <?php if($this->request->param('controller')==='Inquiry' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Inquiry'), ['controller' => 'Inquiry', 'action' => 'index']) ?>
            </li>
             <?php endif; ?>  -->
            
             <!-- <?php  if(isset($Organization['Inquiry Report']) && $Organization['Inquiry Report'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Inquiry' && $this->request->param('action')==='inquiryreport'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Inquiry Report'), ['controller' => 'Inquiry', 'action' => 'inquiryreport']) ?>
            </li>
            <?php endif; ?> --> 
            
           <?php  if(isset($Organization['Classes and Sections']) && $Organization['Classes and Sections'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ClassesSections' && $this->request->param('action')==='index'  || $this->request->param('controller')==='ClassesSections' && $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Classes and Sections'), ['controller' => 'ClassesSections', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> 
            
            <!-- <?php  if(isset($Organization['Expanse Voucher']) && $Organization['Expanse Voucher'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Expanses' && $this->request->param('action')==='index' || $this->request->param('action')==='add' || $this->request->param('action')==='view'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Expense Voucher'), ['controller' => 'Expanses', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            <!-- <?php  if(isset($Organization['Departments']) && $Organization['Departments'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Departments' && $this->request->param('action')==='index' || $this->request->param('controller')==='Departments' && $this->request->param('action')==='edit' ||  $this->request->param('controller')==='Employees' && $this->request->param('action')==='index' || $this->request->param('controller')==='Employees' && $this->request->param('action')==='edit'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Departments'), ['controller' => 'Departments', 'action' => 'index']) ?>
            </li >
            <?php endif; ?> -->
            
            
            <!-- <?php  if(isset($Organization['Class Schedule']) && $Organization['Class Schedule'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ClassSchedule' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Class Scheduler'), ['controller' => 'ClassSchedule', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
           <!--  <?php  if(isset($Organization['Teacher Scheduler']) && $Organization['Teacher Scheduler'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Scheduler' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Teacher Scheduler'), ['controller' => 'Scheduler', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
            
            
            <!-- <?php  if(isset($Organization['Staff Attendance']) && $Organization['Staff Attendance'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='EmployeeAttendance' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Staff Attendance'), ['controller' => 'EmployeeAttendance', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> 
            
            
            <?php  if(isset($Organization['Staff Salary']) && $Organization['Staff Salary'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='EmployeeSalary' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Staff Salary'), ['controller' => 'EmployeeSalary', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
            <!-- <?php  if(isset($Organization['Complains']) && $Organization['Complains'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Complains' && $this->request->param('action')==='index' || $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Notifications and Complains'), ['controller' => 'Complains', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            <!-- <?php  if(trim(isset($Organization['Photo Gallery'])) && trim($Organization['Photo Gallery']) === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='MasterGallery' && $this->request->param('action')==='index' || $this->request->param('action')==='edit'  || $this->request->param('action')==='add'){echo 'class="active"';} ?>>
             <?= $this->Html->link(__('Photo Gallery'), ['controller' => 'MasterGallery', 'action' => 'index']) ?>
            </li> 
            <?php endif; ?> -->
            
            
             
          </ul>
        </li>
    <?php endif; ?>    

        
    <?php  if(!empty($this->request->session()->read('menu.Student Management'))):   ?> 
        <?php  $student =  $this->request->session()->read('menu.Student Management'); ?>
        
        <li <?php if($this->request->param('controller')==='Registration' || $this->request->param('controller')==='DailyDiary' || $this->request->param('controller')==='RemarksForStudents'   || $this->request->param('controller')==='DownloadSyllabus')  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-group"></i> <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php  if(isset($student['Active Students List']) && $student['Active Students List'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Registration' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Active Students List'), ['controller' => 'Registration', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            <?php  //if(isset($student['Inactive Students List']) && $student['Inactive Students List'] === 'Yes'): ?>  
<!--            <li <?php //if($this->request->param('controller')==='Registration' && $this->request->param('action')==='inactive' ){echo 'class="active"';} ?>>
                 <?php // $this->Html->link(__('Inactive Students List'), ['controller' => 'Registration', 'action' => 'inactive']) ?>
            </li>-->
            <?php //endif; ?>
            
            <?php  if(isset($student['Transfer Students']) && $student['Transfer Students'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Registration' && $this->request->param('action')==='transferstudent' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Transfer Students'), ['controller' => 'Registration', 'action' => 'transferstudent']) ?>
            </li>
            <?php endif; ?>
            <?php  if(isset($student['View Students']) && $student['View Students'] === 'Yes'): ?>
             <li <?php if($this->request->param('controller')==='Registration' && $this->request->param('action')==='students' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('View Students'), ['controller' => 'Registration', 'action' => 'students']) ?>
            </li>
             <?php endif; ?>
            
            <!-- <?php  if(isset($student['Assign Homework']) && $student['Assign Homework'] === 'Yes'): ?>
            
            <li <?php if($this->request->param('controller')==='DailyDiary' && $this->request->param('action')==='index' ||  $this->request->param('action')==='edit' ||  $this->request->param('action')==='add' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Assign Homework'), ['controller' => 'dailyDiary', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> -->
            
            
           <!--  <?php  if(isset($student['Remarks For Students']) && $student['Remarks For Students'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='RemarksForStudents' && $this->request->param('action')==='index' ||  $this->request->param('action')==='edit' ||  $this->request->param('action')==='add' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Remarks For Students'), ['controller' => 'RemarksForStudents', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> -->
            
            <!-- <?php  if(isset($student['GR No Setting']) && $student['GR No Setting'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='RemarksForStudents' && $this->request->param('action')==='setRollNumbers'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('GR No Setting'), ['controller' => 'RemarksForStudents', 'action' => 'setRollNumbers']) ?>
            </li>
            <?php endif; ?> -->
            
            
            <?php  if(isset($student['Upload Syllabus']) && $student['Upload Syllabus'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='DownloadSyllabus' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Upload Syllabus'), ['controller' => 'DownloadSyllabus', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            <?php  if(!empty($this->request->session()->read('menu.Students Attendance'))):   ?>
        <?php  $att =  $this->request->session()->read('menu.Students Attendance'); ?>
        
        <li <?php if($this->request->param('controller')==='StudentAttendance')  {echo 'class="active treeview"';} ?>>
          <!-- <a href="#">
            <i class="fa fa-users"></i> <span>Students Attendance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> -->
          
           <?php  if(isset($att['Attendance']) && $att['Attendance'] === 'Yes'): ?>   
            <li <?php if($this->request->param('controller')==='StudentAttendance' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Attendance'), ['controller' => 'StudentAttendance', 'action' => 'index']) ?>
            </li>
             <?php endif; ?>
            <!-- <?php  if(isset($att['Attendance Report']) && $att['Attendance Report'] === 'Yes'): ?> 
            
            <li <?php if($this->request->param('controller')==='StudentAttendance' && $this->request->param('action')==='attendancereport' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Attendance Report'), ['controller' => 'StudentAttendance', 'action' => 'attendancereport']) ?>
            </li>
             <?php endif; ?> -->
 
          
        </li>
         <?php endif; ?>
            
 
          </ul>
        </li>
     <?php endif; ?>

     <?php  if(!empty($this->request->session()->read('menu.Examination Management'))):   ?>  
        <?php  $exam =  $this->request->session()->read('menu.Examination Management'); ?>
         <li <?php if($this->request->param('controller')==='Subjects' || $this->request->param('controller')==='GradeSetting' ||  $this->request->param('controller')==='ExamTypes' || $this->request->param('controller')==='ExamMarksDetails' || $this->request->param('controller')==='ExamResults' || $this->request->param('controller')==='ExamResultsPartTwo' || $this->request->param('controller')==='AdminCardDatesheet' || $this->request->param('controller')==='RoomMaster' || $this->request->param('controller')==='ExamResultNormal')  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-graduation-cap"></i> <span>Examination Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            <?php  if(isset($exam['Exam Types']) && $exam['Exam Types'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ExamTypes' && $this->request->param('action')==='index'  ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Exam Types'), ['controller' => 'ExamTypes', 'action' => 'index']) ?>
            </li>
            
            <?php endif; ?>   
              
            <?php  if(isset($exam['List of Subjects']) && $exam['List of Subjects'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Subjects' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('List of Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> 
            
            
            
            <?php  if(isset($exam['Grade Setting']) && $exam['Grade Setting'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='GradeSetting' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Grade Setting'), ['controller' => 'GradeSetting', 'action' => 'index']) ?>
            </li>
            
            <?php endif; ?>
            
            <!-- <?php  if(isset($exam['Exams Room/Hall Setup']) && $exam['Exams Room/Hall Setup'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='RoomMaster' && $this->request->param('action')==='index'  || $this->request->param('action')==='addStudents'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Exams Room/Hall Setup'), ['controller' => 'RoomMaster', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> -->
            
            
            <?php  if(isset($exam['Admit Card']) && $exam['Admit Card'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='AdminCardDatesheet' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Admi Card & Date Sheet'), ['controller' => 'AdminCardDatesheet', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            <?php  if(isset($exam['Examination Setup']) && $exam['Examination Setup'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ExamMarksDetails' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Examination Setup'), ['controller' => 'ExamMarksDetails', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
           
            <?php  if(isset($exam['Exam Results']) && $exam['Exam Results'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ExamResults' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Exam Results'), ['controller' => 'ExamResults', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>

            <?php  if(isset($exam['Exam Results Part II']) && $exam['Exam Results Part II'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ExamResultsPartTwo' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Exam Results Part II'), ['controller' => 'ExamResultsPartTwo', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>

            <?php  if(isset($exam['Generate Result']) && $exam['Generate Result'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='ExamResultNormal' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Generate Result'), ['controller' => 'ExamResultNormal', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>


 
          </ul>
        </li>
   <?php endif; ?>
      
    <?php  if(!empty($this->request->session()->read('menu.Fees Management'))):   ?> 
        <?php  $fee =  $this->request->session()->read('menu.Fees Management'); ?>
        
        <li <?php if($this->request->param('controller')==='Fees' || $this->request->param('controller')==='Concession' || $this->request->param('controller')==='FeeHeads' || $this->request->param('controller')==='FeeTypes'  )  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-cart-plus"></i> <span>Fees Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php  if(isset($fee['Fees Collection']) && $fee['Fees Collection'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Fees' && $this->request->param('action')==='index' || $this->request->param('action')==='addMultipleFees' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Fees Collection'), ['controller' => 'Fees', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            <?php  if(isset($fee['Fee Types']) && $fee['Fee Types'] === 'Yes'): ?>  
            
            <li <?php if($this->request->param('controller')==='FeeTypes' && $this->request->param('action')==='index' ||  $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Fee Types'), ['controller' => 'FeeTypes', 'action' => 'index']) ?>
            </li>
             <?php endif; ?>
             <?php  if(isset($fee['Fee Heads']) && $fee['Fee Heads'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='FeeHeads' && $this->request->param('action')==='index' ||  $this->request->param('action')==='edit' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Fee Heads'), ['controller' => 'FeeHeads', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            <?php  if(isset($fee['Fee Concession']) && $fee['Fee Concession'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Concession' && $this->request->param('action')==='index' || $this->request->param('controller')==='Concession' && $this->request->param('action')==='edit' || $this->request->param('action')==='add' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Fee Concession'), ['controller' => 'Concession', 'action' => 'index']) ?>
            </li>
             <?php endif; ?>
            
             <?php  if(isset($fee['Cancel Invoices']) && $fee['Cancel Invoices'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Fees' && $this->request->param('action')==='cancelInvoices'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Cancel Invoices'), ['controller' => 'Fees', 'action' => 'cancelInvoices']) ?>
            </li>
             <?php endif; ?>
 
          </ul>
        </li>
        
    <?php endif; ?>    

    <?php  if(!empty($this->request->session()->read('menu.Finance Management'))):   ?>  
        
        <?php  $accounts =  $this->request->session()->read('menu.Finance Management'); ?>
        
       <li <?php if($this->request->param('controller')==='ControlAccount' || $this->request->param('controller')==='SubControlAccount' || $this->request->param('controller')==='TransactionAccount' || $this->request->param('controller')==='MainAccount' || $this->request->param('controller')==='AccountVoucher' || $this->request->param('controller')==='Fees'  &&  $this->request->param('action')==='feecollection' ){echo 'class="active open"';} ?>>
          <a href="#">
            <i class="fa  fa-line-chart"></i> <span>Finance Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <!-- <?php  if(isset($accounts['Chart of Accounts']) && $accounts['Chart of Accounts'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='ControlAccount' && $this->request->param('action')==='index' || $this->request->param('action')==='edit' || $this->request->param('controller')==='SubControlAccount' && $this->request->param('action')==='index' || $this->request->param('controller')==='MainAccount' && $this->request->param('action')==='index' || $this->request->param('controller')==='TransactionAccount' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Chart of Accounts'), ['controller' => 'MainAccount', 'action' => 'index']) ?>
                </li>
               <?php endif; ?> --> 
                
                <!-- <?php  if(isset($accounts['Vouchers']) && $accounts['Vouchers'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='AccountVoucher' && $this->request->param('action')==='index' || $this->request->param('action')==='add' || $this->request->param('action')==='openvoucher' || $this->request->param('action')==='view'){echo 'class="active"';} ?>>
                    <?= $this->Html->link(__('Vouchers'), ['controller' => 'AccountVoucher', 'action' => 'index']) ?>
                </li>
                 <?php endif; ?>  -->
                <!-- <?php  if(isset($accounts['General Ledger']) && $accounts['General Ledger'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='AccountVoucher' &&  $this->request->param('action')==='generalledger'){echo 'class="active"';} ?>>
                    <?= $this->Html->link(__('General Ledger'), ['controller' => 'AccountVoucher', 'action' => 'generalledger']) ?>
                </li>
                 <?php endif; ?>  -->
                <?php  if(isset($accounts['Financial Statements']) && $accounts['Financial Statements'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='AccountVoucher' &&  $this->request->param('action')==='financialstatements'){echo 'class="active"';} ?>>
                    <?= $this->Html->link(__('Financial Statements'), ['controller' => 'AccountVoucher', 'action' => 'financialstatements']) ?>
                </li>
                 <?php endif; ?> 
                <?php  if(isset($accounts['Fee Collection']) && $accounts['Fee Collection'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='Fees' &&  $this->request->param('action')==='feecollection'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Fee Collection'), ['controller' => 'Fees', 'action' => 'feecollection']) ?>
                </li> 
                  <?php endif; ?>  
                <!-- <?php  if(isset($accounts['FCR Report']) && $accounts['FCR Report'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='Fees' &&  $this->request->param('action')==='fcr'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('FCR Report'), ['controller' => 'Fees', 'action' => 'fcr']) ?>
                </li>
                  <?php endif; ?>  
                <?php  if(isset($accounts['Expanse Report']) && $accounts['Expanse Report'] === 'Yes'): ?>
                
                <li <?php if($this->request->param('controller')==='Expanses' && $this->request->param('action')==='expansereport'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Expanse Report'), ['controller' => 'Expanses', 'action' => 'expansereport']) ?>
                </li>
                  <?php endif; ?>  -->
             
               
               
          </ul>
        </li>
       <?php endif; ?>   
        
   <?php  if(!empty($this->request->session()->read('menu.Dues Management'))):   ?> 
        
        <?php  $dues =  $this->request->session()->read('menu.Dues Management'); ?>
        
        <li <?php if($this->request->param('controller')==='Dues')  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-table"></i> <span>Dues Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
          <ul class="treeview-menu">
            <?php  if(isset($dues['Fee Challan']) && $dues['Fee Challan'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Dues' && $this->request->param('action')==='index'  ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Fee Challan'), ['controller' => 'Dues', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            <?php  if(isset($dues['Dues Slip']) && $dues['Dues Slip'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Dues' && $this->request->param('action')==='duesslip' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Dues Slip'), ['controller' => 'Dues', 'action' => 'duesslip']) ?>
            </li>
            <?php endif; ?>
            <!-- <?php  if(isset($dues['Defaulters Report']) && $dues['Defaulters Report'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Dues' && $this->request->param('action')==='defaultersreport' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Defaulters Report'), ['controller' => 'Dues', 'action' => 'defaultersreport']) ?>
            </li>
             <?php endif; ?> -->
 
          </ul>
        </li>
    <?php endif; ?>    
         
        
        
   
        
        <?php  if(!empty($this->request->session()->read('menu.Inventory Management'))):   ?> 
        <?php  $inv =  $this->request->session()->read('menu.Inventory Management'); ?>
        
         <li <?php if($this->request->param('controller')==='Purchaseorders' || $this->request->param('controller')==='PoDetails'  || $this->request->param('controller')==='Suppliers' || $this->request->param('controller')==='SupplierProducts' || $this->request->param('controller')==='Foc' || $this->request->param('controller')==='Producttypes' || $this->request->param('controller')==='Products' || $this->request->param('controller')==='Sale')  {echo 'class="active treeview"';} ?>>
          <!-- <a href="#">
            <i class="fa  fa-shopping-cart"></i>
            <span>Inventory Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> -->
             
          <ul class="treeview-menu">
            <?php  if(isset($inv['Product Type']) && $inv['Product Type'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Producttypes' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Product Type'), ['controller' => 'Producttypes', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            <?php  if(isset($inv['Suppliers List']) && $inv['Suppliers List'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Suppliers' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Suppliers List'), ['controller' => 'Suppliers', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            <?php  if(isset($inv['Purchase Orders']) && $inv['Purchase Orders'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Purchaseorders' && $this->request->param('action')==='index' || $this->request->param('controller')==='PoDetails'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Purchase Orders'), ['controller' => 'Purchaseorders', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            <?php  if(isset($inv['POS']) && $inv['POS'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Sale' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('POS'), ['controller' => 'Sale', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            
            <?php  if(isset($inv['Sale Report']) && $inv['Sale Report'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Sale' && $this->request->param('action')==='saleReport'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Sale Report'), ['controller' => 'Sale', 'action' => 'saleReport']) ?>
            </li>
            <?php endif; ?>
            
            <?php  if(isset($inv['Stock Report']) && $inv['Stock Report'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Sale' && $this->request->param('action')==='stockReport'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('Stock Report'), ['controller' => 'Sale', 'action' => 'stockReport']) ?>
            </li>
            <?php endif; ?>
            
            
            
            
          </ul>
             
        </li>
    <?php endif; ?>
        
       
        
  
      <?php  if(!empty($this->request->session()->read('menu.Reporting Area'))):   ?> 
      <?php  $reports =  $this->request->session()->read('menu.Reporting Area'); ?>
        
      <li <?php if($this->request->param('controller')==='Reports'  ){echo 'class="active open"';} ?>>
          <a href="#">
            <i class="fa   fa-pie-chart"></i> <span>Reporting Area</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php  if(isset($reports['View Statement']) && $reports['View Statement'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='Reports' && $this->request->param('action')==='view' || $this->request->param('action')==='index'  ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('View Statement'), ['controller' => 'Reports', 'action' => 'index' ]) ?>
                </li>
             <?php endif; ?> 
                
            <?php  if(isset($reports['Collection Summery']) && $reports['Collection Summery'] === 'Yes'): ?>     
                <li <?php if($this->request->param('controller')==='Reports' && $this->request->param('action')==='view' || $this->request->param('action')==='collectionsummery'  ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Collection Summary'), ['controller' => 'Reports', 'action' => 'collectionsummery' ]) ?>
                </li>
            <?php endif; ?>   
            
            <?php  if(isset($reports['Session Wise Summery']) && $reports['Session Wise Summery'] === 'Yes'): ?>     
                <li <?php if($this->request->param('controller')==='Reports' && $this->request->param('action')==='view' || $this->request->param('action')==='sessionWiseSummery'  ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Session Wise Summary'), ['controller' => 'Reports', 'action' => 'sessionWiseSummery' ]) ?>
                </li>
            <?php endif; ?> 

            <!-- <?php  if(!empty($this->request->session()->read('menu.Students Attendance'))):   ?>
        <?php  $att =  $this->request->session()->read('menu.Students Attendance'); ?> -->
        
        <li <?php if($this->request->param('controller')==='StudentAttendance')  {echo 'class="active open"';} ?>>
          <!-- <a href="#">
            <i class="fa fa-users"></i> <span>Students Attendance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> -->
          
           <!-- <?php  if(isset($att['Attendance']) && $att['Attendance'] === 'Yes'): ?>   
            <li <?php if($this->request->param('controller')==='StudentAttendance' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Attendance'), ['controller' => 'StudentAttendance', 'action' => 'index']) ?>
            </li>
             <?php endif; ?> -->
            <?php  if(isset($att['Attendance Report']) && $att['Attendance Report'] === 'Yes'): ?> 
            
            <li <?php if($this->request->param('controller')==='StudentAttendance' && $this->request->param('action')==='attendancereport' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Attendance Report'), ['controller' => 'StudentAttendance', 'action' => 'attendancereport']) ?>
            </li>
             <?php endif; ?>

             <?php  if(!empty($this->request->session()->read('menu.Dues Management'))):   ?> 
        
        <?php  $dues =  $this->request->session()->read('menu.Dues Management'); ?>
        
        <li <?php if($this->request->param('controller')==='Dues')  {echo 'class="active treeview"';} ?>>
          
            
            <?php  if(isset($dues['Defaulters Report']) && $dues['Defaulters Report'] === 'Yes'): ?>
            <li <?php if($this->request->param('controller')==='Dues' && $this->request->param('action')==='defaultersreport' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Defaulters Report'), ['controller' => 'Dues', 'action' => 'defaultersreport']) ?>
            </li>
             <?php endif; ?>
 
          
        </li>
    <?php endif; ?>
          
        </li>
         <?php endif; ?>    

         <?php  if(!empty($this->request->session()->read('menu.Organization'))):   ?> 
        <?php  $Organization =  $this->request->session()->read('menu.Organization'); ?>
        <li <?php if($this->request->param('controller')==='Inquiry')  {echo 'class="active treeview"';} ?>> 
            
             <?php  if(isset($Organization['Inquiry Report']) && $Organization['Inquiry Report'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Inquiry' && $this->request->param('action')==='inquiryreport'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Inquiry Report'), ['controller' => 'Inquiry', 'action' => 'inquiryreport']) ?>
            </li>
            <?php endif; ?> 
           
             
          
        </li>
    <?php endif; ?>

    <?php  if(!empty($this->request->session()->read('menu.Finance Management'))):   ?>  
        
        <?php  $accounts =  $this->request->session()->read('menu.Finance Management'); ?>
        
       <li <?php if($this->request->param('action')==='fcr' || $this->request->param('action')==='expansereport' ){echo 'class="active open"';} ?>>
          
              
                <?php  if(isset($accounts['FCR Report']) && $accounts['FCR Report'] === 'Yes'): ?>
                <li <?php if($this->request->param('controller')==='Fees' &&  $this->request->param('action')==='fcr'){echo 'class="active"';} ?>>
                <?= $this->Html->link(__('FCR Report'), ['controller' => 'Fees', 'action' => 'fcr']) ?>
                </li>
                  <?php endif; ?>  
                <?php  if(isset($accounts['Expanse Report']) && $accounts['Expanse Report'] === 'Yes'): ?>
                
                <li <?php if($this->request->param('controller')==='Expanses' && $this->request->param('action')==='expansereport'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Expense Report'), ['controller' => 'Expanses', 'action' => 'expansereport']) ?>
                </li>
                  <?php endif; ?>
             
            
        </li>
       <?php endif; ?>
                
               
          </ul>
        </li>
      <?php endif; ?>

       <?php  if(!empty(
    $this->request->session()->read('menu.General Setting'))):   ?>   
        <?php  $General =  $this->request->session()->read('menu.General Setting'); ?>
        
        <li <?php if($this->request->param('controller')==='GeneralSetting')  {echo 'class="active"';} ?>>
          <a href="#">
            <i class="fa   fa-gears"></i> <span>General Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            <?php  if(isset($General['Institution Details']) && $General['Institution Details'] === 'Yes'): ?>   
            <li <?php if($this->request->param('controller')==='GeneralSetting' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Institution Details'), ['controller' => 'GeneralSetting', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            <?php  if(isset($General['Messages/SMS Setting']) && $General['Messages/SMS Setting'] === 'Yes'): ?>   
            <li <?php if($this->request->param('controller')==='GeneralSetting' && $this->request->param('action')==='smssetting' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Messages/SMS Setting'), ['controller' => 'GeneralSetting', 'action' => 'smssetting']) ?>
            </li>
             <?php endif; ?>

              <?php  if(!empty($this->request->session()->read('menu.User Management'))):   ?>  
        <?php  $userm =  $this->request->session()->read('menu.User Management'); ?>
        
     <li <?php if($this->request->param('controller')==='Users')  {echo 'class="active treeview"';} ?>>
          <!-- <a href="#">
            <i class="fa  fa-user"></i> <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> -->
          <!-- <ul class="treeview-menu"> -->
            <?php  if(isset($userm['View All']) && $userm['View All'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Users' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('View All'), ['controller' => 'Users', 'action' => 'index']) ?>
            </li>
           <?php endif; ?> 
            <?php  if(isset($userm['Create New User']) && $userm['Create New User'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='Users' && $this->request->param('action')==='add' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Create New User'), ['controller' => 'Users', 'action' => 'add']) ?>
            </li>
            <?php endif; ?> 
            <?php  if(isset($userm['Role Permission']) && $userm['Role Permission'] === 'Yes'): ?> 
            <li <?php if($this->request->param('controller')==='UsersRoleManagement' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Role Permission'), ['controller' => 'UsersRoleManagement', 'action' => 'index']) ?>
            </li>
            <?php endif; ?> 
            
          <!-- </ul> -->
              
        </li>
      <?php endif; ?> 
            
          </ul>
              
        </li>
        
    <?php endif; ?>

      <!-- <?php  if(!empty($this->request->session()->read('menu.Tools'))):   ?>
        <?php  $tools =  $this->request->session()->read('menu.Tools'); ?>
        <li <?php if($this->request->param('controller')==='Tools' && $this->request->param('action')!=='updateapp')  {echo 'class="active"';} ?>>
          <a href="#">
            <i class="fa   fa-toggle-on"></i> <span>Tools</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php  if(isset($tools['Import From CSV File']) && $tools['Import From CSV File'] === 'Yes'): ?>   
            <li <?php if($this->request->param('controller')==='Tools' && $this->request->param('action')==='index' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Import From CSV File'), ['controller' => 'Tools', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>  
            <?php  if(isset($tools['Import From CSV File']) && $tools['Import From CSV File'] === 'Yes'): ?>   
             <li <?php if($this->request->param('controller')==='Tools' && $this->request->param('action')==='backup' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Database Backup'), ['controller' => 'Tools', 'action' => 'backup']) ?>
            </li>
            <?php endif; ?> 
            
          </ul>
              
        </li>
    <?php endif; ?> -->       

       
    <?php  if(!empty($this->request->session()->read('menu.SMS'))):   ?> 
        <?php  $sms =  $this->request->session()->read('menu.SMS'); ?>
    
        <li <?php if($this->request->param('controller')==='SmsLog')  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-envelope"></i> <span>SMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            <?php  if(isset($sms['SMS']) && $sms['SMS'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='SmsLog' && $this->request->param('action')==='index'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('SMS'), ['controller' => 'SmsLog', 'action' => 'index']) ?>
            </li>
            <?php endif; ?>
            
            <?php  if(isset($sms['SMS Statistics']) && $sms['SMS Statistics'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='SmsLog' && $this->request->param('action')==='statistics'){echo 'class="active"';} ?>>
                 <?php // $this->Html->link(__('SMS Statistics'),['https://send.eschools.cloud']) ?>
                <a href="http://send.eschools.cloud"  target="_blank">SMS Portal</a>
            </li>
            <?php endif; ?>
            
            
           </ul>
        </li>
     <?php endif; ?>     
         
        
     
    
        
  
        
     <!-- <?php  if(!empty($this->request->session()->read('menu.Help'))):   ?>   
        <?php  $help =  $this->request->session()->read('menu.Help'); ?>
        <li <?php if($this->request->param('controller')==='Tools' && $this->request->param('action')==='updateapp')  {echo 'class="active"';} ?>>
          <a href="#">
            <i class="fa   fa-bell"></i> <span>Help</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php  if(isset($help['Update']) && $help['Update'] === 'Yes'): ?>  
            <li <?php if($this->request->param('controller')==='Tools' && $this->request->param('action')==='updateapp' ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Update'), ['controller' => 'Tools', 'action' => 'updateapp']) ?>
            </li>
              <?php endif; ?> 
          </ul>
              
        </li>
      <?php endif; ?> -->     
        
      
      <?php  if($this->request->session()->read('Auth.User.role_id')==4 && $this->request->param('controller')==='StudentPortal' ):   ?>     
         
        <li <?php if($this->request->param('controller')==='StudentPortal' )  {echo 'class="active treeview"';} ?>>
          <a href="#">
            <i class="fa fa-graduation-cap"></i> <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            <li <?php if($this->request->param('controller')==='StudentPortal' && $this->request->param('action')==='index'  ){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Sstatistics'), ['controller' => 'StudentPortal', 'action' => 'index']) ?>
            </li>
 
            <li <?php if($this->request->param('controller')==='StudentPortal' && $this->request->param('action')==='dailydairy'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Daily Diary'), ['controller' => 'StudentPortal', 'action' => 'dailydairy']) ?>
            </li>
            
            <li <?php if($this->request->param('controller')==='StudentPortal' && $this->request->param('action')==='viewsyllabus'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('View Syllabus'), ['controller' => 'StudentPortal', 'action' => 'viewsyllabus']) ?>
            </li>
            
            <li <?php if($this->request->param('controller')==='StudentPortal' && $this->request->param('action')==='videogallery'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Video Gallery'), ['controller' => 'StudentPortal', 'action' => 'videogallery']) ?>
            </li>
            
            <li <?php if($this->request->param('controller')==='StudentPortal' && $this->request->param('action')==='imagegallery'){echo 'class="active"';} ?>>
                 <?= $this->Html->link(__('Photo Gallery'), ['controller' => 'StudentPortal', 'action' => 'imagegallery']) ?>
            </li>
            
            
            
          </ul>
        </li>
        
       <?php endif; ?> 
        
        
        
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
          
      
       <h1>
        <?= $this->request->param('controller');?>
       </h1>
      <ol class="breadcrumb">
          <li class="fa fa-envelope" onclick="getPendingInquerries();"> <a href="#"> Balance:  <span class="theBalance"></span> SMS  <span id="spn" class="fa fa-refresh fa-spin" onclick="getPendingInquerries();"></span></a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= $this->Html->link(__('Home'), ['controller' => 'Dashboard', 'action' => 'index']) ?></a></li>
        <?php if($this->request->param('controller') === 'PoDetails' || $this->request->param('controller') === 'Products' || $this->request->param('controller') === 'SupplierProducts' || $this->request->param('controller') === 'Employees' || $this->request->param('controller') === 'Foc'){ ?>
        <li class="active"><?= $this->request->param('controller');?></li>
        <?php  }else{ ?>
         <li class="active"><?= $this->Html->link(__($this->request->param('controller')), ['controller' => $this->request->param('controller'), 'action' => 'index']) ?></li>
         
        <?php  } ?>
        
        <li class="active"><?= $this->request->param('action');?></li>
      </ol>
        
    </section>


      
       <div onclick="this.classList.add('hidden')" class="alert alert-success alert-dismissible <?php  $msg = $this->Flash->render();
                        if (trim($msg) === '') {
                            echo 'hidden';
                        }
                        ?> " style="width:98%;margin-left:10px;background-color : transparent;">
                        <?=  $msg ?>
                        </div>
<!--                        <div onclick="this.classList.add('hidden')" class="note note-danger note-shadow <?php  $msg = $this->Flash->render('auth');
//                        if (trim($msg) === '') {
//                            echo 'hidden';
//                        }
                        ?>">
                                 <?= $msg ?>
     </div>-->
          


                <?=  $this->fetch('content') ?>

              
<!-- Control Sidebar -->
 <?php  if($this->request->session()->read('Auth.User.role_id')==1): ?>    
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        
        
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">Notification Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        When User Login
                        <input type="checkbox" onchange="change_status($(this));" class="pull-right" id="on_user_login" value="<?php echo  $this->request->session()->read('Note.on_user_login'); ?>" <?php echo  $this->request->session()->read('Note.on_user_login') == 1 ? 'checked' : 'unchecked'; ?>>
                       
                    </label>
                        <p>
                          As a user logs in the system, it notifies you.
                        </p>

                    <p>
<!--                        System will send SMS when is login-->
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        When User Add Concession
                        <input type="checkbox" onchange="change_status($(this));" class="pull-right" id="on_concession" value="<?php echo  $this->request->session()->read('Note.on_concession'); ?>" <?php echo  $this->request->session()->read('Note.on_concession') == 1 ? 'checked' : 'unchecked'; ?>>
                    </label>

                        <p>
                          When user adds a concession , You are updated.
                        </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        When User Delete Invoice
                        <input type="checkbox" onchange="change_status($(this));" class="pull-right"  id="on_delete_invoice" value="<?php echo  $this->request->session()->read('Note.on_delete_invoice'); ?>" <?php echo  $this->request->session()->read('Note.on_delete_invoice') == 1 ? 'checked' : 'unchecked'; ?>>
                    </label>

                    <p>
                        You are informed as user deleted any paid invoice.
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Financial Alert</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Day closing Alert
                        <input type="checkbox" onchange="change_status($(this));" onchange="change_status($(this));" class="pull-right" id="on_day_closing" value="<?php echo  $this->request->session()->read('Note.on_day_closing'); ?>" <?php echo  $this->request->session()->read('Note.on_day_closing') == 1 ? 'checked' : 'unchecked'; ?>>
                    </label>
                    <p>
                        Get complete closing report via SMS.
                    </p>
                    
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        When User Delete Dues
                        <input type="checkbox" onchange="change_status($(this));" class="pull-right" id="on_changes_dues" value="<?php echo  $this->request->session()->read('Note.on_changes_dues'); ?>" <?php echo  $this->request->session()->read('Note.on_changes_dues') == 1 ? 'checked' : 'unchecked'; ?>>
                    </label>
                    <p>
                        When user deleted dues, you are notified.
                    </p>
                </div>
                <!-- /.form-group -->

<!--                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>-->
                
                
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
        
        
    </div>
</aside>
<?php endif; ?>

<!-- BEGIN SMS MODAL FORM-->
<div class="modal fade" id="systemlock"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
<!--                <h2 class="modal-title text-center">System locked due to non payment.</h2>-->
                <h2 class="modal-title text-center">Payment Reminder</h2>
            </div>
           
            <div class="modal-body" id="smsloadingall">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                          
                   
<!--                        <strong>Respected Client, Please clear your all outstanding amount. you can deposit your amount in given  accounts.</strong>-->
                        <strong>To avoid service interruption, please pay your outstanding invoices as soon as possible.</strong>
                        
                        <br /><br />
                        <div class="row">
      
      

      
      <div class="alert alert-warning success"> 
        
                            <h4 class="">Bank Name : MCB BANK </h4>
                                <h5>Title:  Abdul Qayyum Shah</h5>
        <h5>Account # 0674945551002573 </h5>
        <h5>Branch : 1497-KARACHI SAEEDABAD</h5>
      </div>
                            
                        <div class="alert alert-danger success">  
        
        <h4>Easypaisa Account</h4>
<!--        <h5>CNIC# 42401-6409763-1 </h5>-->
        <h5>Account # 0345-2188682</h5>

      </div>  
                            
      <div class="alert alert-success success"> 
        
        <h4>Bank Name : First Century Bank </h4>
        <h5>Account # 4013283296054 </h5>
        <h5>Beneficiary Name Abdul Qayyum Shah</h5>
      </div>    

      <div class="alert alert-info success">  
        
        <h4>Bank Name :  Barclays </h4>
        <h5>Account # 00904330 </h5>
        <h5>Beneficiary Name Abdul Qayyum Shah</h5>
      </div>
                            
                        

      <div class="alert alert-warning success"> 
        
        <h4>Bank Name :  Wirecard </h4>
        <h5>BIC        WIREDEMM </h5>
        <h5>IBAN DE87512308006500940121</h5>
        <h5>Bank Country Germany</h5>
        <h5>Beneficiary Name Abdul Qayyum Shah</h5>
      </div>    

          
    </div>
                        
                        
                      
                    
          
                    </div>
                </form>
                 
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN SMS MODAL FORM-->
<div class="modal fade hidden-xs" id="pop_modal"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="width:750px!important;">
        <div class="modal-content">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
         <?php echo $this->Html->image('http://eschools.cloud/img/popup.png', ['alt' => 'user Picture', 'class' => '', 'style'=>'width:750px;']); ?>   
         
         <div class="alert alert-warning success">  
        
            <span style="font-size:15px;">Download user guide for parents,guardians and students. &nbsp; </span>
            
            <a href='http://eschools.cloud/img/User Guid.JPG'>JPG Format</a>   &nbsp; or &nbsp;   <a href='http://eschools.cloud/img/User Guide.PDF'">PDF Format</a>
              
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
            <footer>
               
                <?= $this->Html->script('../plugins/fullcalendar/moment.min.js') ?>  
                <?php // $this->Html->script('../plugins/fullcalendar/jquery.min.js') ?>
                <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
                <?= $this->Html->script('../plugins/fullcalendar/fullcalendar.min.js') ?>
                <?= $this->Html->script('../plugins/fullcalendar/scheduler.min.js') ?>
                
                <?php // $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
                <?= $this->Html->script('../bootstrap/js/bootstrap.min.js') ?>
                <?= $this->Html->script('../plugins/fastclick/fastclick.js') ?>
                <?= $this->Html->script('../dist/js/app.min.js') ?>
                <?= $this->Html->script('../plugins/sparkline/jquery.sparkline.min.js') ?>
                <?= $this->Html->script('../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>
                <?= $this->Html->script('../plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>
                <?= $this->Html->script('../plugins/slimScroll/jquery.slimscroll.min.js') ?>
                <?= $this->Html->script('../plugins/chartjs/Chart.min.js') ?> 
                <?php // $this->Html->script('../dist/js/pages/dashboard2.js') ?>
                <?= $this->Html->script('../dist/js/demo.js') ?>
                <?php //  $this->Html->script('../plugins/pace/pace.min.js') ?>
                <?= $this->Html->script('../plugins/bootstrap-toastr/toastr.min.js') ?>
                <?= $this->Html->script('../plugins/jquery-overlay/loadingoverlay.min.js') ?>
 
            </footer>
         
           </body>
           <script> 
             
            //  Pace.restart();
                jQuery(document).ready(function () {
//                    var myflag = "<?php echo $this->request->session()->read('Info.pop_flag'); ?>"; 
//                    if(myflag == '1'){
//                        $('#systemlock').modal({
//                        backdrop: 'static',
//                        keyboard: false,
//                        show: true
//                    });
//                    <?= $this->request->session()->write('Info.pop_flag',0); ?>
//                    }       
                  
//                        getNotifications();
//                        setInterval(function(){
//                            getNotifications();
//                        }, 5000);
//                    
                    <?php if($this->request->session()->read('Auth.User.role_id') === 1 || $this->request->session()->read('Auth.User.role_id') === 2 || $this->request->session()->read('Auth.User.role_id') === 3): ?> 
                     //    $(document).ajaxStart(function() { Pace.restart(); }); 
                    <?php endif; ?>
                        
                         
                    $('.alphaonly').bind('keyup blur',function(){ 
                        var node = $(this);
                        node.val(node.val().replace(/[^a-z ]/g,'') ); }
                    );
                    
     
                    $(".numeric").keypress(function(e) {
                        //if the letter is not digit then display error and don't type anything
                        if (e.which != 13 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                            return false;
                        }
                    });
                    
                    $(".float-number").keypress(function(event) {
                        if(event.which < 46 || event.which > 59) {
                            event.preventDefault();
                        } // prevent if not number/dot
                        if(event.which == 46 && $(this).val().indexOf('.') != -1) {
                            event.preventDefault();
                        } // prevent if already dot
                    });
                    
                });
                
                function getNotifications(){
                    getPendingInquerries();
                }
                
                function getPendingInquerries(){
//                     $('#systemlock').modal({
//                        backdrop: 'static',
//                        keyboard: false,
//                        show: true
//                    });
//                    
                    
                    
                  $('#spn').addClass('fa-spin');  
                  $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Dashboard', 'action' => 'balance']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    //data: {reg_id: id},
                    success: function (data) {
                      //  $('#spn').removeClass('fa-spin');
                           $('.theBalance').html(''+data.msg+'');
                            }
                    });
                    
                }  
           
           
           function imageOverlay(selector, type){
                    if(selector === ""){
                        if(type === 'hide'){
                            setTimeout(function(){
                                $('body').LoadingOverlay(type, { zIndex : 10000 });
                            }, 1000);
                        } else{
                            $('body').LoadingOverlay(type, { zIndex : 10000 });
                        }
                    } else{
                        if(type === 'hide'){
                            setTimeout(function(){
                                $(selector).LoadingOverlay(type, { zIndex : 10000 });
                            }, 1000);
                        } else{
                            $(selector).LoadingOverlay(type, { zIndex : 10000 });
                        }
                    }
                }
           
            </script> 
            
            <!--Start of Tawk.to Script-->
            <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/58c2498597fbd80a94f7a3f9/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
            
            
            
            function change_status(val) {
                
                var status = val.prop('checked');
                var name = val.attr('id');

                $.ajax({
                    type: 'POST',
                    url: "<?php echo $this->Url->build(['controller' => 'Dashboard', 'action' => 'editNotification']); ?>",
                    dataType: 'json',
                    data: {
                        status: status,
                        name: name
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
            
            
            </script>
            <!--End of Tawk.to Script-->
            
            
    <?php } else { ?>
        
            
            <body  class="hold-transition login-page hold-transition skin-blue sidebar-mini" <?php if ($this->request->param('action') === 'login'):  ?> style="background-image: url('https://eschools.cloud/images/backgrnd.png'); background-position: center; background-size: 100% 100%;background-repeat: no-repeat;" <?php endif; ?>>
            <?= $this->fetch('content') ?>
            
        </body>
    <?php } ?>
        
 
</html>
