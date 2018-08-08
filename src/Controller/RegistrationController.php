<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use App\Controller\AppController;


class RegistrationController extends AppController
{

    public function index(){
     
        $registrationtbl = TableRegistry::get('students_master_details');
        $registration = $registrationtbl->find('all')->contain(['registration','classes_sections','shift']);
        $registration->where(['active'=>'Y']);
      //  $registration->limit(100);
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        
        $classesbl = TableRegistry::get('classes_sections');
        $class_name = $classesbl->find('all');
        
        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
       
        $campusesbl = TableRegistry::get('campuses');
        $campuses = $campusesbl->find('all');
       
       
        if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]  == 1){
            $inquirysbl = TableRegistry::get('inquiry');
            $inquiry = $inquirysbl->find('all')->where(['id_inquery'=>$this->request->params['pass'][1]]);
            $inquiry = $inquiry->ToArray();
        }
       
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campuses->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
        
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);


        
       $this->set(compact('registration','classes','session','campuses','inquiry','feetype','class_name'));
     
    }

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function inactive(){
        
        $registrationtbl = TableRegistry::get('students_master_details');
        $registration = $registrationtbl->find('all')->contain(['registration','classes_sections','shift']);
        $registration->where(['active'=>'N']);
      //  $registration->limit(100);
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        
        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
       
        $campusesbl = TableRegistry::get('campuses');
        $campuses = $campusesbl->find('all');
       
       
        if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]  == 1){
            $inquirysbl = TableRegistry::get('inquiry');
            $inquiry = $inquirysbl->find('all')->where(['id_inquery'=>$this->request->params['pass'][1]]);
            $inquiry = $inquiry->ToArray();
        }
       
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campuses->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
        
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        
        
       $this->set(compact('registration','classes','session','campuses','inquiry','feetype'));
        
    }
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','getrollno',
                                'transferstudents','tranfer','getfmc',
                                'inactive','delete','transferstudent',
                                'view','imageupload','updateimage','uploadrecord','deleteme',
                                'indexAjax','students','getbysearch','generatedues','sendNotification'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    public function view($flag = null , $class_id = null , $shift_id= null ,$status =null, $cols=null) {
        
        if($flag == 3){
            $table = TableRegistry::get('students_master_details');
            $registration = $table->find()->contain(['registration','classes_sections']);
            $registration->select($table);
            $registration->select(['s_name'=>'registration.student_name','f_name'=>'registration.father_name']);
            $registration->select(['class_name'=>'classes_sections.class_name']);
            $registration->select(['gender'=>'registration.sex','contact'=>'registration.contact1']);
            $registration->select(['roll_no','grno'=>'registration.gr','add'=>'registration.address']);
            $registration->select(['cont2'=>'registration.contact2','cont3'=>'registration.contact3']);
            $registration->select(['reg_date'=>'date_format(registration.doa,"%d-%M-%Y %H:%i")']);
            

            $registration->where(['class_id'=>$class_id]);
            $registration->andwhere(['shift_id'=>$shift_id]);
            $registration->andwhere(['registration.active'=>$status]);
            $registration = $registration->toArray();
            
            $this->set(compact('registration','cols'));
            $this->render('general');
        }
        else if($flag == 4){
            $temp = explode(',',$cols);
            $table = TableRegistry::get('students_master_details');
            $registration = $table->find()->contain(['registration','classes_sections']);
            $registration->select($table);
            $registration->select(['s_name'=>'registration.student_name','f_name'=>'registration.father_name']);
            $registration->select(['class_name'=>'classes_sections.class_name']);
            $registration->select(['gender'=>'registration.sex','contact'=>'registration.contact1']);
            $registration->select(['roll_no','grno'=>'registration.gr','add'=>'registration.address']);
            $registration->select(['cont2'=>'registration.contact2','cont3'=>'registration.contact3']);
            $registration->select(['reg_date'=>'date_format(registration.doa,"%d-%M-%Y %H:%i")']);
            
           
            $registration->where(['registration.active'=>$status]);
            $registration->andwhere(['registration.created_on >='=> date("Y-m-d H:i:s", strtotime($temp[0])), 'registration.created_on <='=> date("Y-m-d H:i:s", strtotime($temp[1]))]);
            $registration = $registration->toArray();
            $f = $temp[0];
            $t = $temp[1];
            $this->set(compact('registration','cols','f','t'));
            $this->render('new_admissions');
        }
        else{
        
            $table = TableRegistry::get('students_master_details');
            $registration = $table->find()->contain(['registration','classes_sections']);
            $registration->select($table);
            $registration->select(['s_name'=>'registration.student_name','f_name'=>'registration.father_name']);
            $registration->select(['class_name'=>'classes_sections.class_name']);
            $registration->select(['gender'=>'registration.sex','contact'=>'registration.contact1']);
            $registration->select(['roll_no','grno'=>'registration.gr','add'=>'registration.address']);
            $registration->select(['cont2'=>'registration.contact2','cont3'=>'registration.contact3']);
            $registration->select(['reg_date'=>'date_format(registration.doa,"%d-%M-%Y")']);
            $registration->select(['DOB'=>'date_format(registration.dob,"%d-%M-%Y")']);
            
            $registration->where(['class_id'=>$class_id]);
            $registration->andwhere(['shift_id'=>$shift_id]);
            $registration->andwhere(['registration.active'=>$status]);

            $this->set(compact('registration'));
            $this->set('_serialize', ['registration']);
        
        }
        
    }
    public function add() {
        
        if ($this->request->is('post')) {
        $mData = [];
        $mData = $this->request->data;
        $registrationble = TableRegistry::get('registration');
        $exist = $registrationble->exists(['student_name' => $this->request->data['student_name'], 'father_name' => $this->request->data['father_name'],'contact1'=> $this->request->data['contact1'],'active'=>'Y']);
      
        if(!empty($exist)){
            $msg = 'Error|The registration already exist.';
        }else{
     
        $registration = $this->Registration->newEntity();
        
            $registration = $this->Registration->patchEntity($registration, $this->request->data);
         
             //  geting family code if no set..
             if(empty($this->request->data['fmc'])){
             
                 $fmctbl = TableRegistry::get('fmc');
                 $fmc = $fmctbl->find();
                 $fmc->select(['fmc'=> 'max(fmc)']);
                 $result = $fmc->first();
                 $cont =  $result->fmc;
                 $fcode =  $cont + 1;
                
                $query = $fmctbl->query();
                $query->update()
                    ->set(['fmc' => $cont + 1])
                    ->where(['id_fmc' => 1])
                    ->execute();

              }else{
                  $fcode = strtoupper($this->request->data['fmc']);
              }
               
            $registration->dob = date("Y-m-d H:i:s", strtotime($this->request->data['dob']));
            $registration->doa = date("Y-m-d H:i:s", strtotime($this->request->data['doa']));
            $registration->fmc = "FMC-$fcode";
            $registration->created_on = date("Y-m-d H:i:s");
            $registration->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Registration->save($registration)) {
                
                $query = $registrationble->find();
                $query->select(['lastID'=> 'max(registration.id_registration)']);
                $last_ID = $query->first();
                              
                $students_master_detailsble = TableRegistry::get('students_master_details');
                $students_master_details = $students_master_detailsble->newEntity();
                
                $students_master_details->registration_id = $last_ID->lastID;
                $students_master_details->roll_no = $this->request->data['roll_no'];
                $students_master_details->class_id = $this->request->data['class_id'];
                $students_master_details->shift_id = $this->request->data['shift_id'];
                $students_master_details->session_id = $this->request->data['session_id'];
                $students_master_details->campus_id = $this->request->data['campus_id'];
                $students_master_details->class_start_time = $this->request->data['srtattime'];
                $students_master_details->class_end_time = $this->request->data['endtime'];
                $last_id = $last_ID->lastID;
                $students_master_detailsble->save($students_master_details);
                 
                 //  geting family code if no set..
                 //  if inquiry admission is confirmed
                if(!empty($this->request->data['inquiry_id'])){
                   $inquirytbl = TableRegistry::get('inquiry');
                   $query = $inquirytbl->query();
                   $query->update()
                       ->set(['status' => 'Qualified'])
                       ->where(['id_inquery' => $this->request->data['inquiry_id']])
                       ->execute();

                 }
 
                 $msg = "Success|The registration has been saved, Regidtration ID is : ".$last_id;

                 $this->sendNotification($this->request->data['contact1'],$this->request->data['student_name']);

              
            } else {
                $msg = 'Error|The registration could not be saved. Please, try again.';
            }
        }
 
    }
      $classesbl = TableRegistry::get('classes_sections');
       $classes = $classesbl->find('all');
        
       $sessionbl = TableRegistry::get('session');
       $session = $sessionbl->find('all');
       
       $campusesbl = TableRegistry::get('campuses');
       $campuses = $campusesbl->find('all');
       
       
       if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]  == 1){
           $inquirysbl = TableRegistry::get('inquiry');
           $inquiry = $inquirysbl->find('all')->where(['id_inquery'=>$this->request->params['pass'][1]]);
           $inquiry = $inquiry->ToArray();
       }
       
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campuses->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
        $this->set(compact('registration','classes','session','campuses','inquiry'));
       
        $this->set(compact('msg','last_id','fcode'));
        $this->set('_serialize', ['msg','last_id','fcode']);
       
    }


    public function sendNotification($number,$name){
         
        $username   = $this->request->session()->read('Info.user');
        $password   = $this->request->session()->read('Info.password');
        $mobile     = $this->request->session()->read('Info.phone'); 

        $settingtbl = TableRegistry::get('sms_setting');
        $setting = $settingtbl->find();
        $setting->where(['status'=>1]);
        $result = $setting->first();
        $mobile = '92'.ltrim($number,'0');
        $msg =  str_replace("#B#", $name, $result->admission_msg);
         
        if(!empty($msg)){
            $sender     = "SenderID";
            $message    = $msg;
            $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
            $url = "http://send.eschools.cloud/web_distributor/api/sms.php?username=".$username."&password=".$password."";
            $ch = curl_init();
            $timeout = 30; // set to zero for no timeout
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $result = curl_exec($ch); 
            echo $result;
        }
        
        return false;
    }




    public function edit($id = null) {
        $registration = $this->Registration->get($id, [
            'contain' => ['students_master_details']
        ]);
        
       
        if ($this->request->is(['patch', 'post', 'put'])) {
           $registration = $this->Registration->patchEntity($registration, $this->request->data);
           if(!empty($this->request->data['file']['tmp_name'])){
                
                $fileName = $this->request->data['file']['name'];
                $image_info = getimagesize($this->request->data['file']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $file_type    = $image_info['mime'];

                if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                   && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" && $file_type != "image/JPEG") {
                   $this->Flash->error(__('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
                   return $this->redirect(['action' => 'index']);
                }

                if($image_width>127 || $image_height>127) 
                { 
                    $this->Flash->error(__('Exceeded image dimension limits.You can upload 127px X 127px maximam dimension. '));
                    return $this->redirect(['action' => 'index']);
                }    


                $newname = $this->request->data['student_name'].$this->request->data['father_name'].$this->request->data['contact1'];
                $tmp = explode(".", $fileName);
                $extension = end($tmp);
                
                $uploadPath = WWW_ROOT . 'img/students_images/';

                $uploadFile = $uploadPath.$newname.".jpg";
                $insertindb = $newname.".jpg";
                move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
                $registration->image = $insertindb;    
             }

             if(!empty($this->request->data['file2']['tmp_name'])){
                
                $fileName = $this->request->data['file2']['name'];
                $image_info = getimagesize($this->request->data['file2']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $file_type    = $image_info['mime'];

                if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                   && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" && $file_type != "image/JPEG") {
                   $this->Flash->error(__('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
                   return $this->redirect(['action' => 'index']);
                }


                $newname = $this->request->data['student_name'].$this->request->data['contact1'];
                $tmp = explode(".", $fileName);
                $extension = end($tmp);
                
                $uploadPath =WWW_ROOT . 'img/students_images/';
                $uploadFile = $uploadPath.$newname.".jpg";
                $insertindb = $newname.".jpg";
                move_uploaded_file($this->request->data['file2']['tmp_name'],$uploadFile);
                $registration->record = $insertindb;    
             }



            $registration->dob = date("Y-m-d H:i:s", strtotime($this->request->data['dob']));
            $registration->doa = date("Y-m-d H:i:s", strtotime($this->request->data['doa']));
           
            if ($this->Registration->save($registration)) {
              
                $students_master_detailsble = TableRegistry::get('students_master_details'); 
                $query = $students_master_detailsble->query();
                $query->update()
                ->set(['roll_no' => $this->request->data['roll_no'],
                        'class_id'=>$this->request->data['class_id'],
                        'shift_id'=>$this->request->data['shift_id'],
                        'session_id'=>$this->request->data['session_id'],
                        'campus_id'=>$this->request->data['campus_id'],
                        'class_start_time'=>$this->request->data['srtattime'],
                        'class_end_time'=> $this->request->data['endtime'],
                        ])
                ->where(['registration_id' => $this->request->data['cc']])
                ->execute();
         
                
                $this->Flash->success(__('The registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The registration could not be saved. Please, try again.'));
            }
        }
        
       $classesbl = TableRegistry::get('classes_sections');
       $classes = $classesbl->find('all');
        
       $sessionbl = TableRegistry::get('session');
       $session = $sessionbl->find('all');
       
       $campusesbl = TableRegistry::get('campuses');
       $campuses = $campusesbl->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campuses->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
       
       
       $this->set(compact('registration','classes','session','campuses'));
       
    }
    public function delete($id = null, $status=null) {
        $id = $this->request->data['id'];
        $status = $this->request->data['status'];
        $reason = $this->request->data['reason'];
        $tabl = TableRegistry::get('registration');
        $query = $tabl->query();
        $query->update()
            ->set(['active' => $status,'reason_of_inactive'=>$reason,'inactive_by'=>$this->request->session()->read('Auth.User.full_name'),'inactive_date'=>date("Y-m-d H:i:s")])
            ->where(['id_registration' => $id])
            ->execute();
        $msg = "Success|Student has been inactive.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
        
    }
    
    public function getrollno(){
        
         if ($this->request->is(['post'])) {    
            $class_id = $this->request->data['class'];
            $shift = $this->request->data['shift'];
            $campus = $this->request->data['campus_id'];
            $students_master_detailstbl = TableRegistry::get('students_master_details');
            $students_master_details = $students_master_detailstbl->find();
            $students_master_details->select(['Roll_No'=> 'max(students_master_details.roll_no)']);
            $students_master_details->where(['class_id'=>$class_id]);
            $students_master_details->andwhere(['shift_id'=>$shift]);
            $students_master_details->andwhere(['campus_id'=> $campus]);
            $result = $students_master_details->first();
            if($result->Roll_No > 0){
            $roll_no = $result->Roll_No + 1;
            }else{
                $roll_no = 1;
            }
            $this->set(compact('roll_no'));
            $this->set('_serialize', ['roll_no']);
        }
    }
    public function getfmc(){
        
         if ($this->request->is(['post'])) {    
            $nic = $this->request->data['nic'];

            $registrationtbl = TableRegistry::get('registration');
            $registration = $registrationtbl->find('all');
            $registration->where(['nic'=>$nic]);
            $data = $registration->first();
            $this->set(compact('data'));
            $this->set('_serialize', ['data']);
        }
    }
    public function imageupload(){
       
        if(!empty($this->request->data['file']['tmp_name'])){
                
                $fileName = $this->request->data['file']['name'];
                $image_info = getimagesize($this->request->data['file']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $file_type    = $image_info['mime'];

                if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                   && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" && $file_type != "image/JPEG") {
                   $msg =  'Warning|Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                   
                }elseif($image_width>127 || $image_height>127) 
                { 
                    $msg = 'Warning| Exceeded image dimension limits.You can upload 127px X 127px maximam dimension. ';
                }else{
                    
                    $fileName = $this->request->data['file']['name'];
                    $msg = "Success|Image load successfully";
                }    
             }
        
        $this->set(compact('msg','fileName'));
        $this->set('_serialize', ['msg','fileName']);
        
    }

   
    public function updateimage($id = null){
       
         if(!empty($this->request->data['file']['tmp_name'])){
                
                $fileName = $this->request->data['file']['name'];
                $image_info = getimagesize($this->request->data['file']['tmp_name']);
   
                $newname = rand(1000,5000).'-'.$id;
                $tmp = explode(".", $fileName);
                $extension = end($tmp);
                
                $uploadPath = WWW_ROOT . 'img/students_images/';
                $uploadFile = $uploadPath.$newname.".jpg";
                $insertindb = $newname.".jpg";
                move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
                //$registration->image = $insertindb;
                $registrationtable = TableRegistry::get('registration');    
                $query = $registrationtable->query();
                $query->update()
                    ->set(['image' => $insertindb])
                    ->where(['id_registration' => $id])
                    ->execute();
                
             }else{
                $insertindb = "avatar-1.jpg"; 
                $registrationtable = TableRegistry::get('registration');    
                $query = $registrationtable->query();
                $query->update()
                    ->set(['image' => $insertindb])
                    ->where(['id_registration' => $id])
                    ->execute();  
                 
             }
             
   
       $this->set(compact('msg'));
       $this->set('_serialize', ['msg']); 
        
    }
    public function uploadrecord($id = null)
    {
       
        /*print_r($_FILES);
        print_r($_REQUEST);
        exit;*/
        if(!empty($this->request->data['file2']['tmp_name'])){
                
                $fileName = $this->request->data['file2']['name'];
                $image_info = getimagesize($this->request->data['file2']['tmp_name']);
    
                $newname = rand(1000,5000).'-'.$id;
                $tmp = explode(".", $fileName);
                $extension = end($tmp);
                
                $uploadPath = WWW_ROOT . 'img/students_images/';
                $uploadFile = $uploadPath.$newname.".jpg";
                $insertindb = $newname.".jpg";
                move_uploaded_file($this->request->data['file2']['tmp_name'],$uploadFile);
                //$registration->image = $insertindb;
                $registrationtable = TableRegistry::get('registration');    
                $query = $registrationtable->query();
                $query->update()
                    ->set(['record' => $insertindb])
                    ->where(['id_registration' => $id])
                    ->execute();
                
             }
             /*print_r($_FILES);
             exit();*/

        $this->set(compact('fileName'));
        $this->set('_serialize', ['fileName']);
    }
    public function deleteme($id = null) {
        $id = $this->request->data['id'];
        //.$pic = $this->request->data['record'];
        print_r($_REQUEST);
        exit();
        $registrationtable = TableRegistry::get('registration');
        $query = $this->$registrationtable->query();
                        $query->update()
                        ->set(['record'=> ''])
                        ->where(['id_registration' => $id])
                        ->execute();
        if ($query) {
            unlink(WWW_ROOT . 'img/students_images/');
            $msg = 'Success|The photo has been deleted.';
        } else {
            $msg = 'Error|This could not be deleted. Please, try again.';
        }
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
     /*public function viewPhotos($id = null) {
        
        //$this->loadModel('GalleryDetails');
        $registrationtable = TableRegistry::get('registration');
        $masterGallery = $this->registrationtable->find();
        $masterGallery->select(['record'=>'registration.record']);
        $masterGallery->where(['id_registration' => $id]);

       
        $this->set(compact('masterGallery','id'));
        $this->set('_serialize', ['masterGallery','id']);
        
    }*/
    
    public function indexAjax(){
       
        $registrationtbl = TableRegistry::get('students_master_details');
        $registration = $registrationtbl->find('all')->contain(['registration','classes_sections','shift']);
        $registration->where(['active'=>'Y']);
        $registration = $registration->toArray();     
        $this->set(compact('registration'));
     
    }
    
    
    public function students(){
        
        
       $classes_sectionsble = TableRegistry::get('classes_sections');
       $class               = $classes_sectionsble->find('all'); 
        
       $this->set(compact('class'));
       $this->set('_serialize', ['class']); 
        
    }
    
    public function transferstudent(){
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes2 = $classesbl->find('all');
        
        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
        
        $sessionbl = TableRegistry::get('session');
        $session2 = $sessionbl->find('all');
        
        
       $this->set(compact('classes','session','classes2','session2'));
       $this->set('_serialize', ['classes','session','classes2','session2']); 
    } 
    
    public function tranfer(){
        
        $class = $this->request->data['class_id'];
        $shift = $this->request->data['shift_id'];
        $session = $this->request->data['session_id'];
            
        $mastertable = TableRegistry::get('students_master_details');
        $reg_result = $mastertable->find()->hydrate(false)
            ->join([
                    [   'table' => 'registration',
                        'type' => 'INNER',
                        'conditions' => 'registration.id_registration = students_master_details.registration_id'
                    ],
                    [   'table' => 'classes_sections',
                         'alias' => 'cs',
                        'type' => 'INNER',
                        'conditions' => 'cs.id_class = students_master_details.class_id'
                    ],
                    [   'table' => 'shift',
                        'type' => 'INNER',
                        'conditions' => 'shift.id_shift = students_master_details.shift_id'
                    ]
                ]);
        $reg_result->select(['registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
       // $reg_result->select(['pic'=>'registration.image']);
        
        $reg_result->where(['class_id'=>$class]);
        $reg_result->andwhere(['shift_id'=>$shift]);
        $reg_result->andwhere(['session_id'=>$session]);
         $reg_result->andwhere(['registration.active'=>'Y']);
        $data = $reg_result->toArray();
        if($data){
            $msg = "Success|Records Found."; 
        }else{
            $msg = "Error|Sorry! No records found."; 
        }
        $this->set(compact('msg','data'));
        $this->set('_serialize', ['msg','data']); 
    }
    
    public function transferstudents(){
        
        $class = $this->request->data['class_id'];
        $shift = $this->request->data['shift_id'];
        $session = $this->request->data['session_id'];
        
        $mData = [];
        $mData = $this->request->data['details'];
        $mastertable = TableRegistry::get('students_master_details');
        $registrationtable = TableRegistry::get('registration');
        
        foreach($mData as $row){
            
            if($row['status'] === 'T'){
                $query = $mastertable->query();
                $query->update()->set(['class_id' => $class,'shift_id'=>$shift,'session_id'=>$session])->where(['registration_id' => $row['reg_id']])->execute();
            }elseif($row['status'] === 'N'){
                $query = $registrationtable->query();
                $query->update()->set(['active' => 'N'])->where(['id_registration' => $row['reg_id']])->execute();
            }elseif($row['status'] === 'NO'){
                $query = $mastertable->query();
                $query->update()->set(['session_id'=>$session])->where(['registration_id' => $row['reg_id']])->execute();
            }
            
        }
        $msg = "Success|The operation has been complete.";
        $this->set(compact('msg','data'));
        $this->set('_serialize', ['msg','data']);
        
    }
    
    public function getbysearch(){
        
        
        $draw = $this->request->data['draw'];
        $start = $this->request->data['start'];
       
        $length = $this->request->data['length'];
        
         if (isset($this->request->data['order'])) {
            $order = $this->request->data['order'];
            $columns = $this->request->data['columns'];
            $orderby = $columns[$order[0]['column']]['data'];
            $orderdir = $order[0]['dir'];
        } else {
            $orderby = 'id_purchase_orders';
            $orderdir = 'asc';
        }
        $status =  $this->request->data['status'];
        if(!empty($this->request->data['cc'])){
            $ids    = explode(',', $this->request->data['cc']);
           
        }
        if (isset($this->request->data['fmc'])) {
            $fmc =  $this->request->data['fmc'];
        }
        if (isset($this->request->data['name'])) {
            $name =  $this->request->data['name'];
        }
//        if (isset($this->request->data['shift_id'])) {
//            $shift =  $this->request->data['shift_id'];
//        }
//        if (isset($this->request->data['class_id'])) {
//            $class =  $this->request->data['class_id'];
//        }
        if (isset($this->request->data['contact'])) {
            $contact =  $this->request->data['contact'];
        }
        
        $registrationtbl = TableRegistry::get('students_master_details');
        $registration = $registrationtbl->find()->contain(['registration','classes_sections','shift']);
        $registration->select(['id'=>'registration.id_registration','sname'=>'registration.student_name']);
        $registration->select(['fname'=>'registration.father_name','class'=>'classes_sections.class_name']);
        $registration->select(['shift'=>'shift.shift_name','img'=>'registration.image']);
        $registration->select(['contact'=>'registration.contact1','contact2'=>'registration.contact2']);
        $registration->select(['status'=>'registration.active']);
        $registration->select(['gr_no'=>'registration.gr']);
        
        $recordsTotal = $registration->count();
        
        $registration->where(['registration.active'=>$status]);
        if (!empty($ids)) {
           $registration->andwhere(['registration.id_registration IN' =>$ids]);
        }
        if (!empty($fmc)) {
           $registration->andwhere(['registration.fmc' =>$fmc]);
        }
        if (!empty($name)) {
           $registration->andwhere(['registration.student_name LIKE' =>'%' .$name. '%']);
        }
        if (!empty($class)) {
           $registration->andwhere(['class_id' =>$class]);
        }
        if (!empty($shift)) {
           $registration->andwhere(['shift_id' =>$shift]);
        }
        if (!empty($contact)) {
           $registration->andwhere(['registration.contact1' =>$contact]);
        }
        
        $recordsFiltered  = $registration->count();
        $registration->order([$orderby => $orderdir]);
        if($length>-1){
                $registration->limit($length);
            }
            if($start>0){
                $registration->offset($start);
        }
      
      
        $registration->hydrate(false);
        $res = $registration->ToArray();
        $data = array();
       
       foreach ($res as $dat) {
            $hostname = $this->url()."img/students_images/".$dat['img']; 
            
            if($dat['status'] === 'Y'){
                $actions = array('actions' => "<button onclick='javascript:edit_record(" . $dat['id']. ")' class='btn btn-icon waves-effect waves-light btn-warning m-b-5'><i class='fa fa-pencil'></i> Edit</button> <button onclick='javascript:inactive_student(" . $dat['id'] .',"N"'. ")' class='btn btn-icon waves-effect waves-light btn-danger m-b-5'><i class='fa fa-trash'></i> Inactive</button>",'host'=>$hostname);
            }else{
                $actions = array('actions' => "<button onclick='javascript:inactive_student(" . $dat['id'] .',"Y"'.")' class='btn btn-icon waves-effect waves-light btn-info m-b-5'><i class='fa fa-plus'></i> Click To Active</button>",'host'=>$hostname);
            }
            array_push($data, array_merge($dat, $actions));
        }
       
       
       $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
       $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
    }
    
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    
    public function generatedues(){
        
        $fee_headstbl = TableRegistry::get('fee_heads');
        $duestbl = TableRegistry::get('dues');
        $feestbl = TableRegistry::get('fees');
        $concessiontbl = TableRegistry::get('concession');
        $studentsttbl = TableRegistry::get('students_master_details');
        
        $f_m = ltrim(date("m",strtotime($this->request->data['feemonth'])),'0');
        $f_y = ltrim(date("Y",strtotime($this->request->data['feemonth'])),'0');
        $f_d = ltrim(date("d",strtotime($this->request->data['feemonth'])),'0');
        
        
//        $due_month = date("m",strtotime($due_date));
//        $due_year = date("Y",strtotime($due_date));
//        $due_day = date("d",strtotime($due_date));
        
       
        $students     = $studentsttbl->find('all')->hydrate(false)
        ->join([
                [   'table' => 'registration',
                    'alias' => 'registration',
                    'type' => 'INNER',
                    'conditions' => 'registration.id_registration = students_master_details.registration_id'
                ]
            ]);
        $students->select(['registration_id','active'=>'registration.active']);
        $students->select(['class_id','shift_id','session_id','campus_id']);
        $students->where(['registration_id' => $this->request->data['reg_id']]);
        $st_id = $students->first();
        
        $feeheads     = $fee_headstbl->find('all');
        $feeheads->where(['class_id'=>$st_id['class_id']]);
        $feeheads->andwhere(['fee_type_id'=>$this->request->data['ft']]);
        $fee_result = $feeheads->first();

        if(!$fee_result){
            $msg  = "Error|Please set fee head first.";
        }
        else{    
            $concession = $concessiontbl->find()->hydrate(false);
            $concession->select(['amount','fine','from_date','to_date']);
            $concession->where(['registration_id' => $this->request->data['reg_id']]);
            $concession->andwhere(['fee_type_id' =>$this->request->data['ft']]);
            $con_rs     = $concession->first();

            if(!empty($con_rs)){

                $c_m = ltrim(date("m",strtotime($con_rs['from_date'])),'0');
                $c_y = ltrim(date("Y",strtotime($con_rs['from_date'])),'0');
                $c_d = ltrim(date("d",strtotime($con_rs['from_date'])),'0');

                $cf_m = ltrim(date("m",strtotime($con_rs['to_date'])),'0');
                $cf_y = ltrim(date("Y",strtotime($con_rs['to_date'])),'0');
                $cf_d = ltrim(date("d",strtotime($con_rs['to_date'])),'0');

                $from =  intval($c_y.$c_m.$c_d);
                $to  =  intval($cf_y.$cf_m.$cf_d);
                $fm =  intval($f_y.$f_m.$f_d);
                
                
                if($fm >= $from  && $fm <=$to){
                  //  $amount = $con_rs['amount'];
                  //  $fine = $con_rs['fine'];
                }else{
                  //  $amount = $fee_result->class_fees;
                  //  $fine = $fee_result->fine;
                }

             }else{
              //  $amount = $fee_result->class_fees;
              //  $fine = $fee_result->fine;
             }
             $fine = 0;
             $amount = trim($this->request->data['feeamount']);
                   
            $fee_paid = $feestbl->exists(['registration_id' => $this->request->data['reg_id'], 'fee_month' => $f_m,'year'=>$f_y,'fee_type_id'=>$this->request->data['ft'],'status'=>1]);
            if(empty($fee_paid)){
            $exists = $duestbl->exists(['registration_id' => $this->request->data['reg_id'], 'fee_month' => $f_m,'year'=>$f_y,'fee_type_id'=>$this->request->data['ft']]);
               if (empty($exists)) {
                    $dues = $duestbl->newEntity();
                    $dues->registration_id = $this->request->data['reg_id'];
                    $dues->campus_id =  $st_id['campus_id'];
                    $dues->session_id = $st_id['session_id'];
                    $dues->class_id = $st_id['class_id'];
                    $dues->shift_id = $st_id['shift_id'];
                    $dues->fee_month = $f_m;
                    $dues->year = $f_y;
                    $dues->amount = $amount;
                    $dues->fine = $fine;
                    $dues->fee_type_id = $this->request->data['ft'];
                    $dues->fee_date =   date("Y-m-d", strtotime($this->request->data['feemonth']));
                    $dues->due_date =   date("Y-m-d", strtotime($this->request->data['feemonth']));
                    $dues->created_by = $this->request->session()->read('Auth.User.id');
                    $duestbl->save($dues);
                    $msg  = "Success|The fee has been geneated.";
               }else{ $msg  = "Error|The fee already geneated."; }
                
              }else{
                   $msg  = "Error|The fee already  paid.";
              }
             
        }      
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }

}
