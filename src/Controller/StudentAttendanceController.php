<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * StudentAttendance Controller
 *
 * @property \App\Model\Table\StudentAttendanceTable $StudentAttendance
 */
class StudentAttendanceController extends AppController
{
 
    public function index()
    {
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus' => $this->request->session()->read('Auth.User.campus_id')]);    
        }
        
        $date = date("Y-m-d");
        $table = TableRegistry::get('student_attendance');
        $query = $table->find()
                ->join([
                            [   'table' => 'classes_sections',
                                'alias' => 'cs',
                                'type' => 'INNER',
                                'conditions' => 'cs.id_class = student_attendance.class_id'
                            ],
                            [   'table' => 'shift',
                                'alias' => 'shift',
                                'type' => 'INNER',
                                'conditions' => 'shift.id_shift = student_attendance.shift_id'
                            ]
                        ]);
        
        $query->select(['id_attendance','shift_id','class_id','status','class'=>'cs.class_name','shift'=>'shift.shift_name']);
        $query->select(['date'=>'date_format(student_attendance.attendace_date,"%d-%m-%Y %H:%i")']);
        $query->group(['class_id','shift_id']);
        $query->where(['student_attendance.attendace_date'=>date("Y-m-d", strtotime($date))]);
        $query->andwhere(['campus_id'=>$this->request->session()->read('Auth.User.campus_id')]);
        $data = $query->toArray();
       
        $table = TableRegistry::get('sms_setting');
        $query = $table->find();
        $messages = $query->toArray();
        
        
        
        $this->set(compact('class','campus','data','messages'));
        $this->set('_serialize', ['data','class','campus']);
        
        
    }
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'getstudents', 'view','delete','sendsms','attendancereport','setting'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    public function setting(){
        
          if ($this->request->is('post')) {
           
            $table = TableRegistry::get('sms_setting');
            $query = $table->find();
            $id = $query->first();
            $sql = $table->query();
            $sql->update()
            ->set(['student_present'=> $this->request->data['student_present'],
                    'student_absent'=> $this->request->data['student_absent'],
                    'student_leave'=> $this->request->data['student_leave'],
                    'student_late'=> $this->request->data['student_late'],
                    ])
            ->where(['id_setting' =>$id->id_setting])
            ->execute();
            $msg = 'Success|The SMS setting has been saved.';
            
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
    
    public function view($flag = null){
      
      
       if(isset($this->request->params['pass'][0])){
            $flag = $this->request->params['pass'][0];
       }
      
       if($flag ==0){
           
            $class = $this->request->data['class_id'];
            $shift = $this->request->data['shift_id'];
            $date = $this->request->data['date_range'];
            
            
       
     
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
            $reg_result->select(['class'=>'cs.class_name','shift'=>'shift.shift_name']);
            $reg_result->select(['roll_no','gr_no'=>'registration.gr']);
            $reg_result->where(['class_id'=>$class]);
            $reg_result->andwhere(['shift_id'=>$shift]);
            $reg_result->andwhere(['registration.active'=>'Y']);
            $reg_result->orderAsc('roll_no');
            $sql = $reg_result->toArray();
 
           // $temp_att_table = TableRegistry::get('temp_attendance'); 
         //   $temp_att_table->query()->delete()->execute();
            
            $mdata =  array();
            foreach($sql as $row){
            $mdata[$row['registration_id']]['registration_id'] = $row['registration_id'];
            $mdata[$row['registration_id']]['roll_no'] = $row['roll_no'];
            $mdata[$row['registration_id']]['grno'] = $row['gr_no'];
            $mdata[$row['registration_id']]['s_name'] = $row['sname'];
            $mdata[$row['registration_id']]['f_name'] = $row['fname'];
            $mdata[$row['registration_id']]['class_name'] = $row['class'];
            $mdata[$row['registration_id']]['shift_name'] = $row['shift'];
            $class = $row['class'];
            $shift = $row['shift'];
            
           
            $table = TableRegistry::get('student_attendance');
            $query = $table->find('all')->hydrate(false);
            $query->select(['registration_id','status','date'=>'attendace_date']);
            $query->where(['MONTH(attendace_date)'=>$date]);
         //   $query->andwhere(['class_id'=>$class]);
         //   $query->andwhere(['shift_id'=>$shift]);
            $query->andwhere(['registration_id'=>$row['registration_id']]);
            $rs = $query->toArray();
         
         
            
            foreach($rs as $rows){
                $day =  'd'.ltrim(date('d', strtotime($rows['date'])),'0');
                $mdata[$row['registration_id']][$day] = $rows['status'];
                }    

            }

            $this->set(compact('mdata','class','shift'));
            $this ->render('att_report'); 
            
       }
       elseif($flag ==1){
            $class = $this->request->params['pass'][1];
            $shift = $this->request->params['pass'][2];
            
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
            $reg_result->select(['class'=>'cs.class_name','shift'=>'shift.shift_name']);
            $reg_result->select(['roll_no','gr_no'=>'registration.gr']);
            $reg_result->where(['class_id'=>$class]);
            $reg_result->andwhere(['shift_id'=>$shift]);
            $reg_result->andwhere(['registration.active'=>'Y']);
            $reg_result->orderAsc('roll_no');
            $data = $reg_result->toArray();
          
            $this->set(compact('data','from','to','date'));
            $this ->render('att_blank'); 
       }    
        
 
    }

    
    public function add()
    {
        
        $table = TableRegistry::get('student_attendance');
        if ($this->request->is('post')) {
         
            $mData = [];
            $mData = $this->request->data['att'];
            $class = $this->request->data['class'];
            $shift = $this->request->data['shift'];
            $campus = $this->request->data['campus'];
            $date  = $this->request->data['ad'];
          
            foreach($mData as $row){
                $temp = explode('|',$row);    
                $studentAttendance = $table->newEntity();
                $exists = $table->exists(['registration_id' => $temp[0], 'attendace_date' => date("Y-m-d", strtotime($date))]);
                if(empty($exists)){
                    if($temp[0] > 0){
                $studentAttendance->registration_id = $temp[0];
                $studentAttendance->class_id = $class;
                $studentAttendance->shift_id = $shift;
                $studentAttendance->campus_id = $campus;
                $studentAttendance->status =  $temp[1];
                $studentAttendance->attendace_date = date("Y-m-d", strtotime($date));
                $studentAttendance->created_by =  $this->request->session()->read('Auth.User.id');       
                $table->save($studentAttendance);
                    }
              
                }                
            }
            
        }
        $msg = "Success|Attendace has been saved.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

   
    public function edit($id = null)
    {
        $studentAttendance = $this->StudentAttendance->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentAttendance = $this->StudentAttendance->patchEntity($studentAttendance, $this->request->data);
            if ($this->StudentAttendance->save($studentAttendance)) {
                $this->Flash->success(__('The student attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student attendance could not be saved. Please, try again.'));
            }
        }
        $registrations = $this->StudentAttendance->Registrations->find('list', ['limit' => 200]);
        $classes = $this->StudentAttendance->Classes->find('list', ['limit' => 200]);
        $shifts = $this->StudentAttendance->Shifts->find('list', ['limit' => 200]);
        $campuses = $this->StudentAttendance->Campuses->find('list', ['limit' => 200]);
        $this->set(compact('studentAttendance', 'registrations', 'classes', 'shifts', 'campuses'));
        $this->set('_serialize', ['studentAttendance']);
    }

    
    public function delete($id = null)
    {
        $date = date("Y-m-d");
        $class = $this->request->data['class'];
        $shift = $this->request->data['shift'];
        $table = TableRegistry::get('student_attendance');
        $query = $table->query();
                $query->delete()
                    ->where(['class_id' => $class,'shift_id'=>$shift,'attendace_date'=>date("Y-m-d", strtotime($date))])
                    ->execute();
                
        $msg  = "Success|Attendance record has been delete." ;
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);        
    }
    
    
    
    
    public function getstudents(){
        
        $class = $this->request->data['class'];
        $shift = $this->request->data['shift'];
        $campus = $this->request->data['campus'];
        $table = TableRegistry::get('students_master_details');
        $query = $table->find()
                ->join([
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = students_master_details.registration_id'
                            ]
                        ]);
        
        $query->select(['registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->where(['class_id'=>$class]);
        $query->andwhere(['registration.active'=>'Y']);
        $query->andwhere(['shift_id'=>$shift]);
        $query->andwhere(['campus_id'=>$campus]);
        
        $data = $query->toArray();
        $msg  = "Success|Found records. ". count($data) ;
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
        
    }
    
    public function sendsms($flag = null){
     
        $file =  WWW_ROOT."download/csv_sample.txt";
        $class  = $this->request->data['class'];
        $shift  = $this->request->data['shift'];
        $status = $this->request->data['status'];
        $date = date("Y-m-d");
        $table = TableRegistry::get('student_attendance');
        $query = $table->find()->hydrate(false)
                ->join([
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = student_attendance.registration_id'
                            ],
                            [   'table' => 'classes_sections',
                                'alias' => 'classes_sections',
                                'type' => 'INNER',
                                'conditions' => 'classes_sections.id_class = student_attendance.class_id'
                            ]
                        ]);
        
        $query->select(['registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name','cell'=>'registration.contact1']);
        $query->select(['cell1'=>'registration.contact2','cell2'=>'registration.contact3','gender'=>'registration.sex','class'=>'classes_sections.class_name']);
        
        $query->where(['student_attendance.attendace_date'=>date("Y-m-d", strtotime($date))]);
        $query->andwhere(['registration.active'=>'Y']);
        $query->andwhere(['status'=>$status]);
        
        if($flag ==0){
            $query->andwhere(['class_id'=>$class]);
            $query->andwhere(['shift_id'=>$shift]);
        }
        
        $data = $query->toArray();
       
        $message = $this->request->data['message'];
        $handle = fopen ($file, "w+");
        fclose($handle);
    
        // get id by session     
        $msg_status = $this->request->session()->read('Info.absent');
        $msg_type = $this->request->session()->read('Info.msg_type');
     
        if($msg_type == '1'){
            
            foreach($data as $row){
               if($row['cell'] > 0){ 
                   echo "test";
                   $sex = $row['gender'] == 'Male' ? 'S/O' : 'D/O';
                   $contents = '92'.ltrim($row['cell'],'0').','.$row['sname'].','.$sex.','.$row['fname'].','.$row['class'].PHP_EOL;
                   if (($fd = fopen($file, "a")) !== false) { 
                        fwrite($fd, $contents);   
                        fclose($fd); 
                       
                    }
               }
            }
            foreach($data as $row){
               if($row['cell'] > 0){ 
                   echo "test";
                   $sex = $row['gender'] == 'Male' ? 'S/O' : 'D/O';
                   $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].','.$sex.','.$row['fname'].','.$row['class'].PHP_EOL;
                   if (($fd = fopen($file, "a")) !== false) { 
                        fwrite($fd, $contents);   
                        fclose($fd); 
                       
                    }
               }
            }
            
            foreach($data as $row){
               if($row['cell2'] > 0){ 
                   echo "test";
                   $sex = $row['gender'] == 'Male' ? 'S/O' : 'D/O';
                   $contents = '92'.ltrim($row['cell2'],'0').','.$row['sname'].','.$sex.','.$row['fname'].','.$row['class'].PHP_EOL;
                   if (($fd = fopen($file, "a")) !== false) { 
                        fwrite($fd, $contents);   
                        fclose($fd); 
                       
                    }
               }
            }
            
            $hostname = $this->url()."download/csv_sample.txt";
            $username = $this->request->session()->read('Info.user');
            $password = $this->request->session()->read('Info.password');
            $sender = "SenderID";
            $url = $hostname;
            $message = $message;

            $post = "sender=".urlencode($sender)."&url=".$url."&message=".urlencode($message)."";
            $duplicate = 1;
            $url = "http://send.eschools.cloud/web_distributor/api/personalized.php?username=".$username."&password=".$password."&duplicate=".$duplicate."";
            $ch = curl_init();
            $timeout = 30; // set to zero for no timeout
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $result = curl_exec($ch);   

            $msg  = "Success|Messages has been send.";
            $this->set(compact('data','msg'));
            $this->set('_serialize', ['data','msg']);
            
        }
        else{
      
            if($msg_status ==1){ /// Guardian  
            
                    foreach($data as $row){
                       if($row['cell1'] > 0){ 
                           $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==2){ // students
            
                    foreach($data as $row){
                       if($row['cell2'] > 0){ 
                           $contents = '92'.ltrim($row['cell2'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==3){
            
                    foreach($data as $row){
                       if($row['cell'] > 0){ 
                           $contents = '92'.ltrim($row['cell'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==4){  // all
            
                    foreach($data as $row){
                       if($row['cell1'] > 0){ 
                           $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($data as $row){
                       if($row['cell2'] > 0){ 
                           $contents = '92'.ltrim($row['cell2'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($data as $row){
                       if($row['cell'] > 0){ 
                           $contents = '92'.ltrim($row['cell'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
        }
            
            $hostname = $this->url()."download/csv_sample.txt";
            $username = $this->request->session()->read('Info.user');
            $password = $this->request->session()->read('Info.password');
            $sender = "SenderID";
            $url = $hostname;
            $message = $message;
            

            $post = "sender=".urlencode($sender)."&url=".$url."&message=".urlencode($message)."";
            $duplicate = 1;
            $url = "http://send.eschools.cloud/web_distributor/api/personalized.php?username=".$username."&password=".$password."&duplicate=".$duplicate."";
            $ch = curl_init();
            $timeout = 30; // set to zero for no timeout
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $result = curl_exec($ch); 
            

            $msg  = "Success|Messages has been send.";
            $this->set(compact('data','msg'));
            $this->set('_serialize', ['data','msg']);
 
        
        }
       
        
        
    }
    
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    public function attendancereport(){
        
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');

        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');

        $campusesbl = TableRegistry::get('campuses');
        $campuses = $campusesbl->find('all');
        
        $monthsbl = TableRegistry::get('months');
        $months = $monthsbl->find('all');


         if($this->request->session()->read('Auth.User.role_id')!==1){
             $campuses->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
         }

       $this->set(compact('registration','classes','session','campuses','months'));
  
    }
   
}
