<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Mailer\Email;



class DashboardController extends AppController
{
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','balance','birthdaysms','editNotification','sendNotification','cashregister']) && $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6 ) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
   
    public function index(){
        
      
        $settingtbl = TableRegistry::get('sms_setting');
        $setting = $settingtbl->find();
        $setting->where(['status'=>1]);
        $result = $setting->first();
        $this->request->session()->write('Info.user',$result->user_name); 
        $this->request->session()->write('Info.password',$result->password);
        
        //absent message
        $this->request->session()->write('Info.absent',$result->absent);
        $this->request->session()->write('Info.absent_msg',$result->absent_msg);
        //present message
        $this->request->session()->write('Info.examcreation',$result->examcreation);
        $this->request->session()->write('Info.examcreation_msg',$result->examcreation_msg);
        //General message
        $this->request->session()->write('Info.events',$result->events);
        $this->request->session()->write('Info.events_msg',$result->events_msg);
        $this->request->session()->write('Info.msg_type',$result->type);
        
        
        $settingtbl = TableRegistry::get('general_setting');
        $setting = $settingtbl->find();
        $result = $setting->first();
        $this->request->session()->write('Info.school',$result->Institution_Name); 
        $this->request->session()->write('Info.address',$result->Institution_Address); 
        $this->request->session()->write('Info.phone',$result->Institution_Phone);
        $this->request->session()->write('Info.full_logo',$result->logo_size_full);
        $this->request->session()->write('Info.fine_setting',$result->fine_setting);
        $this->request->session()->write('Info.fee_slip',$result->fee_slip);
        
        
        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d"); 
        
        $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date)) ));
        $m = 0;
        $f = 0;
        $registrationtbl = TableRegistry::get('registration');
        $concession = $registrationtbl->find();
        $concession->select(['sex']);
        $concession->where(['active'=>'Y']);
        $data = $concession->toArray();
        foreach($data as $sex){
            if($sex['sex']=='Male'){
                 $m++;
             }else{
                 $f++;
             }
         }
         
         $students_master_detailstbl = TableRegistry::get('students_master_details');
         $query = $students_master_detailstbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'classes_sections',
                                'alias' => 'cs',
                                'type' => 'RIGHT',
                                'conditions' => 'cs.id_class = students_master_details.class_id'
                            ],
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'RIGHT',
                                'conditions' => 'registration.id_registration = students_master_details.registration_id'
                            ]
                        ]);
         
        $query->select(['total' => $query->func()->count('registration_id'),'class'=>'cs.class_name']);
        $query->select(['shift_id','class_id']);
        $query->where(['active'=>'Y','registration_id >'=>0]);
        $query->orderAsc('students_master_details.class_id');
        $query->group(['cs.class_name']);
        $class_wise = $query->ToArray();

        // defualter name list
        $duestbl = TableRegistry::get('dues');
        $query = $duestbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'classes_sections',
                                'alias' => 'cs',
                                'type' => 'RIGHT',
                                'conditions' => 'cs.id_class = dues.class_id'
                            ],
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = dues.registration_id'
                            ]
                        ]);
         
         $query->select(['students' => $query->func()->count('registration_id'),'class'=>'cs.class_name']);
         $query->select(['dues' => $query->func()->sum('amount'),'class_id'=>'cs.id_class']);
         $query->orderAsc('dues.class_id');
         $query->where(['active'=>'Y']);
         $query->andwhere(['MONTH(fee_date) =' => $month]);
         $query->andwhere(['YEAR(fee_date) =' => $year]);
         if($this->request->session()->read('Auth.User.role_id')!==1){
            $query->andwhere(['campus_id' => $this->request->session()->read('Auth.User.campus_id')]);    
         }
         
         
         $query->group(['cs.class_name']);
         $dues = $query->ToArray();
         
        
          // recieved amount
        $duestbl = TableRegistry::get('fees');
        $query = $duestbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'classes_sections',
                                'alias' => 'cs',
                                'type' => 'RIGHT',
                                'conditions' => 'cs.id_class = fees.class_id'
                            ],
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = fees.registration_id'
                            ]
                        ]);
         
         $query->select(['students' => $query->func()->count('registration_id'),'class'=>'cs.class_name','fee_date']);
         $query->select(['fees' => $query->func()->sum('amount'),'class_id'=>'cs.id_class']);
         $query->orderAsc('fees.class_id');
         $query->where(['active'=>'Y']);
         $query->where(['fees.status'=>1]);
         $query->andwhere(['MONTH(fee_date)' => $month]);
         $query->andwhere(['YEAR(fee_date) ' => $year]);
         if($this->request->session()->read('Auth.User.role_id')!==1){
            $query->andwhere(['campus_id' => $this->request->session()->read('Auth.User.campus_id')]);    
         }
         $query->group(['cs.class_name']);
         $fees = $query->ToArray();
         
       
         
         
         $student_attendancetbl = TableRegistry::get('student_attendance');
         $query = $student_attendancetbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'classes_sections',
                                'alias' => 'cs',
                                'type' => 'INNER',
                                'conditions' => 'cs.id_class = student_attendance.class_id'
                            ]
                        ]);
         
         $query->select(['total' => $query->func()->count('status'),'class'=>'cs.class_name','class_id']);
         $query->andwhere(['attendace_date'=> date("Y-m-d H:i:s", strtotime($yesterday))]);
         $query->orderAsc('student_attendance.class_id');
         $query->group(['cs.class_name']);
         $rs = $query->ToArray();
         $class_att = array();
         foreach ($rs as $row){
                $query = $student_attendancetbl->find()->hydrate(false);
                $query->select(['Absents' => $query->func()->count('status')]);
                $query->where(['status'=>'P']);
                $query->andwhere(['attendace_date'=> date("Y-m-d H:i:s", strtotime($yesterday))]);
               // $query->andwhere(['attendace_date'=> date('Y-m-d',(strtotime ( '-2 day' , strtotime ($date)) ))]);
                $query->where(['class_id'=>$row['class_id']]);
                $res = $query->ToArray();
                foreach ($res as $dat) {
                    $abs = array('present' => $dat['Absents']);
                    array_push($class_att, array_merge($row,$abs));
                 }
                    
             
         }

           /*
            *Previuos month Attendance those student whose attendance is short
            */
         $previuos_month = date('m',(strtotime ( '-1 MONTH' ) ));
                    //print_r($date);
            
            
       
     
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
            $reg_result->where(['registration.active'=>'Y']);
            $reg_result->orderAsc('students_master_details.class_id');
            $sql = $reg_result->toArray();

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
            $query->where(['MONTH(attendace_date)'=>$previuos_month]);
            $query->andwhere(['registration_id'=>$row['registration_id']]);
            $rs = $query->toArray();
         
         
                $query = $table->find();
                $query->select(['present' => $query->func()->count('status')]);
                $query->where(['registration_id'=>$row['registration_id']]);
                $query->andwhere(['MONTH(attendace_date) =' => $previuos_month]);
                $query->andwhere(['status' => 'P']);
                $present = $query->first();
                if(count($present->present) > 0){
                    $att_data = $present->present;
                }else{
                    $att_data = 0;
                }
            $count = 0;
            foreach($rs as $rows){
                $day =  'd'.ltrim(date('d', strtotime($rows['date'])),'0');
                $mdata[$row['registration_id']][$day] = $rows['status'];
                    if( isset($rows['status']) > 0)
                    {
                        $count++;
                    }

                }    
                $mdata[$row['registration_id']]['days'] = $count;  
                $mdata[$row['registration_id']]['present'] = $att_data;                

                $mdata[$row['registration_id']]['percentage'] = 0;
                if ($count > 0 ) {
                 # code...
                    $att = round($att_data/$count* 100,0);
                    $mdata[$row['registration_id']]['percentage'] = $att;
                    $data[] = $att;
                }

                if ($att < 70 ) {
                    # code...
                    //$day    = date("31");
                    //$year   = date("Y");
                    //$month  = date("m");
                    //$date1 = date("m");
                    //$mdata[$row['registration_id']]['short'] = $row['class'];
                    
                //print_r($row['registration_id'] . $row['sname'] ." (". $row['class'] ." )" );
                //echo " ";
                //$this->sendmail();
                
                //die('lol');
                    //exit();
                    

                }else{
                   //echo "no"."/";
                }

                  
            }
            // finish here
                   



                  
         $query = $registrationtbl->find();
         $query->select(['total' => $query->func()->count('id_registration')]);
         $query->where(['doa'=> date("Y-m-d H:i:s", strtotime($yesterday))]);
         $ad_yesterdays = $query->first();
         $ayd = $ad_yesterdays->total;
        
         /// yeaster days income 
         $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date)) ));
         $feestbl = TableRegistry::get('fees');
         $query   = $feestbl->find();
         $query->select(['income' => $query->func()->sum('amount'),'fee_type_id','status']);
         $query->group('fee_type_id');
         $query->where(['fee_date'=>date("Y-m-d H:i:s", strtotime($yesterday))]);
         $query->andwhere(['status'=>1]);
         $result = $query->first();
         if($result){
         $income = $result->income;
         }else{
          $income = 0;    
         }
         
        /// this month income 
         $feestbl = TableRegistry::get('fees');
         $query   = $feestbl->find();
         $query->select(['income' => $query->func()->sum('amount'),'fee_type_id','status']);
        // $query->group('fee_type_id');
         $query->where(['fee_month'=> $month]);
         $query->andwhere(['YEAR'=> $year]); 
         $query->andwhere(['status' => 1]);
         $result = $query->first();
         if($result){
         $montlyincome = $result->income;
         }else{
          $montlyincome = 0;    
         }
         
         
         
         /// yeaster days expanses 
         $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date)) ));
         $expansesbl = TableRegistry::get('expenses');
         $query   = $expansesbl->find();
         $query->select(['expanse' => $query->func()->sum('amount'),'status']);
         $query->where(['expanse_date'=>date("Y-m-d H:i:s", strtotime($yesterday))]);
         $query->andwhere(['status'=>1]);
         $exp = $query->first();
         if($exp){
         $expanse = $exp->expanse;
         }else{
          $expanse = 0;    
         }
         
         
          /// this month expanses 
         $expansesbl = TableRegistry::get('expenses');
         $query   = $expansesbl->find();
         $query->select(['expanse' => $query->func()->sum('amount'),'status']);
         $query->where(['MONTH(expanse_date)' => $month]);
         $query->andwhere(['YEAR(expanse_date) ' => $year]);
         $exp = $query->first();
         if($exp){
            $monthlyexpanse = $exp->expanse;
         }else{
           $monthlyexpanse = 0;    
         }
         
        $inquirybl = TableRegistry::get('inquiry');
        $query   = $inquirybl->find('all');
        $query->select(['f_name','in_date'=>'date_format(inquiry.inquery_date,"%d-%m-%Y %H:%i")']);
        $query->where(['status'=>'Pending']); 
        $enquiry = $query->toArray(); 
        $this->request->session()->write('Info.inquery',$enquiry); 

      //  $condition['MONTH(date) >'] = '10';
        $registrationbl = TableRegistry::get('students_master_details');
        $query   = $registrationbl->find()->hydrate(false)
            ->join([
                [   'table' => 'classes_sections',
                    'alias' => 'cs',
                    'type' => 'INNER',
                    'conditions' => 'cs.id_class = students_master_details.class_id'
                ],
                [   'table' => 'registration',
                    'type' => 'INNER',
                    'conditions' => 'registration.id_registration = students_master_details.registration_id'
                ],
                [   'table' => 'shift',
                    'type' => 'INNER',
                    'conditions' => 'shift.id_shift = students_master_details.shift_id'
                ]
            ]);
         
        $query->select(['student_name'=>'registration.student_name','father_name'=>'registration.father_name','image'=>'registration.image']);
        $query->select(['class'=>'cs.class_name','shift'=>'shift.shift_name']);
        $query->where(['MONTH(dob)' => $month]);
        $query->andwhere(['DAY(dob) ' => $day]);
        $query->limit(12);
        $birthdays = $query->toArray(); 
        
        
        $month_fee_collection =  array();
        for($i = 1; $i <= 12;  $i++){
        $tbl = TableRegistry::get('fees');
        $query = $tbl->find();
        $query->select(['revenue' => $query->func()->sum('amount')]);
        $query->where(['status'=>1]);
        $query->andwhere(['fee_month' => $i]);
        $query->andwhere(['year' => $year]);
        $revenue = $query->first();
            if(count($revenue->revenue) > 0){
               $month_fee_collection[$i] = $revenue->revenue;
            }else{
                $month_fee_collection[$i] = 0;
            }
        
        }
        
        $month_exp_collection =  array();
        for($i = 1; $i <= 12;  $i++){
        $tbl = TableRegistry::get('expenses');
        $query = $tbl->find();
        $query->select(['expanses' => $query->func()->sum('amount')]);
        $query->where(['status'=>1]);
        $query->andwhere(['MONTH(expanse_date)' => $i]);
        $query->andwhere(['YEAR(expanse_date)' => $year]);
        $expanses = $query->first();
            if(count($expanses->expanses) > 0){
               $month_exp_collection[$i] = $expanses->expanses;
            }else{
                $month_exp_collection[$i] = 0;
            }
        
        }
        
        
        
        $admin_notifications = TableRegistry::get('admin_notifications');
        $admin_note = $admin_notifications->find();
        $admins = $admin_note->first();
      
        $this->request->session()->write('Note.on_user_login',$admins->on_user_login); 
        $this->request->session()->write('Note.on_concession',$admins->on_concession);
        $this->request->session()->write('Note.on_day_closing',$admins->on_day_closing);
        $this->request->session()->write('Note.on_delete_invoice',$admins->on_delete_invoice);
        $this->request->session()->write('Note.on_changes_dues',$admins->on_changes_dues);
        
        

        $this->set(compact('m','f','class_wise','ayd','income','expanse','class_att','dues','birthdays','fees','montlyincome','monthlyexpanse','month_fee_collection','month_exp_collection','mdata'));
         
    }
    
    public function balance(){
        
        $username 	= $this->request->session()->read('Info.user');
        $password 	= $this->request->session()->read('Info.password');
//        $username = '923443005000';///Your Username
//        $password = 'gms';///Your Password
//        $url = "http://sms.eschools.cloud/api/balance.php?username=".$username."&password=".$password."";
//        $ch = curl_init();
//        $timeout = 30;
//        curl_setopt($ch,CURLOPT_URL,$url);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//        $responce = curl_exec($ch);
//        curl_close($ch);
        $url = "http://send.eschools.cloud/web_distributor/api/balance_check.php?username=".$username."&password=".$password.""; 
        $ch  =  curl_init();
        $timeout  =  30;
        curl_setopt ($ch,CURLOPT_URL, $url) ;
        curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
        $response = curl_exec($ch) ;
        curl_close($ch) ; 
        $rs = json_decode($response);
        //print_r($rs->results[0]->balance);
       // exit;
        $msg = $rs->results[0]->balance;
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']); 
    }
   
    
    public function birthdaysms(){
        
        
        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d");
        $file =  WWW_ROOT."download/csv_sample.txt";
         
        //  $condition['MONTH(date) >'] = '10';
        $registrationbl = TableRegistry::get('registration');
        $query   = $registrationbl->find('all');
        $query->select(['student_name','father_name','image','contact1']);
        $query->where(['MONTH(dob)' => $month]);
        $query->andwhere(['DAY(dob) ' => $day]);
        $query->hydrate(false);
        //$query->limit(12);
        $birthdays = $query->toArray(); 
    
        if($birthdays){
        
        $handle = fopen ($file, "w+");
        fclose($handle);
        foreach($birthdays as $row){
            if($row['contact1'] > 0){ 
                $contents = '92'.ltrim($row['contact1'],'0').','.$row['student_name'].PHP_EOL;
                if (($fd = fopen($file, "a")) !== false) { 
                     fwrite($fd, $contents);   
                     fclose($fd); 
                 }
            }  
        }
        
        
        $hostname = $this->url()."download/csv_sample.txt";
        $username = $this->request->session()->read('Info.user');
        $password = $this->request->session()->read('Info.password');
        $sender = "8023";
        $url = $hostname;
        $message = "Happy Birthday Dear #B# May your life be the best We wish you a successful future and Full marks in your exam Happy Birthday.";
//        $url = "http://sms.eschools.cloud/api/personalised.php?username=".$username."&password=".$password."&sender=".urlencode($sender)."&url=".$url."&message=".urlencode($message)."&format=json"; 
//        $ch = curl_init();
//        $timeout = 50;
//        curl_setopt($ch,CURLOPT_URL,$url);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//        $responce = curl_exec($ch);
//        curl_close($ch);
        $post = "sender=".urlencode($sender)."&url=".$url."&message=".urlencode($message)."";
        $url = "http://send.eschools.cloud/web_distributor/api/personalized.php?username=".$username."&password=".$password."";
        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch); 
        
        
        $msg = "Success|The messages has been send.";        
        }else{       
        $msg = "Warning|Sorry no record found.";
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
     public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    public function editNotification(){
        
        $name = $this->request->data['name'];  
        $status = $this->request->data['status']; 
        
        if($status == 'true' ){
            $val = 1;
            $msg = "Success|Notification Turn On";
        }else{
            $val = 0;
            $msg = "Success|Notification Turn off";
        }
        

        $table = TableRegistry::get('admin_notifications');    
        $query = $table->query();
        $query->update()
            ->set([$name => $val])
            ->where(['id_notifications' => 1])
            ->execute();
        
        
        $assign = "Note.".$name;
        $this->request->session()->write($assign,$name); 
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    public function cashregister(){
        
        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d"); 
        
        $currentday = date('Y-m-d',(strtotime ( '-0 day' , strtotime ($date)) ));
        /// current days income 
        $fee_typestbl = TableRegistry::get('fee_types');
        $sql_fee_type = $fee_typestbl->find()->hydrate(false);
        $sql_fee_type->where(['status_active'=>'Y']);
        $query = $sql_fee_type->toArray();
        $feestbl = TableRegistry::get('fees');
        $expansestbl = TableRegistry::get('expenses');
        
        $data = array();
        foreach($query as $row){
            
            $query = $feestbl->find()->hydrate(false);
            $query->select(['income' => $query->func()->sum('amount'),'fee_type_id','status']);
            $query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($currentday))]);
            $query->andwhere(['status'=>1]);
            $query->andwhere(['fee_type_id'=>$row['id_fee_type']]);
           // $query->andwhere(['created_by '=>$this->request->session()->read('Auth.User.role_id')]);
            $query->group('fee_type_id');
            $res = $query->first();
            if($res){
                $data[$row['fee_type_name']] = $res['income'];
            }else{
                $data[$row['fee_type_name']] = 0;
            }
            
            
            $query = $expansestbl->find()
            ->join([
                    [   'table' => 'transaction_account',
                        'alias' => 'ta',
                        'type' => 'INNER',
                        'conditions' => 'expenses.transaction_account_id = ta.id_transaction_account '
                     ],
                    [   'table' => 'sub_control_account',
                        'alias' => 'subaccount',
                        'type' => 'INNER',
                        'conditions' => 'ta.sub_control_account_id = subaccount.id_sub_control_account'
                     ],
                     [   'table' => 'control_account',
                         'alias' => 'controlaccount',
                         'type' => 'INNER',
                         'conditions' => 'subaccount.control_account_id = controlaccount.id_control_account'
                     ],
                     [   'table' => 'main_account',
                         'alias' => 'mainaccount',
                         'type' => 'INNER',
                         'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                     ]
                ]);

                $query->select(['ta'=>'ta.id_transaction_account','ta_no'=>'ta.transaction_account_number','ta_name'=>'ta.transaction_account_name']); 
                $query->select(['sca'=>'subaccount.sub_control_account_number']);
                $query->select(['ca'=>'controlaccount.control_account_number']);
                $query->select(['ma'=>'mainaccount.main_account_number']);
                $query->select(['amount' => $query->func()->sum('amount'),'expanse_desc']);
                $query->group('ta');
                $query->where(['expanse_date '=>date("Y-m-d H:i:s", strtotime($currentday))]);
              //  $query->andwhere(['created_by '=>$this->request->session()->read('Auth.User.role_id')]);
                
                $query->hydrate(false);
                $expanse = $query->ToArray();
            
        }
        $amount = 0;
        $message = 'Admin Alert:';
        $message .= "\nToday's Closing Report:";
        foreach($data as $index=>$value){
            
            $message .= "\n". ucfirst($index) .' = '.$value."";
            $amount += $value;
        }
        
      
        $message .= "\nTotal Received = $amount";
            
      
        $exapnse =0;
        foreach ($expanse as $index=>$value){
            $message .= '\n'.$value['ta_name'] .' = '.$value['amount'];
            $exapnse += $value['amount'];
        }
        
        $message .= "\nTotal Expanse = $exapnse";
         if($this->request->session()->read('Note.on_day_closing') == 1){
            $this->sendNotification($message);
         }
         echo $message;
         exit; 
       // $this->set(compact('data','expanse','cash_register'));
       // $this->set('_serialize', ['data','expanse','cash_register']);
        
    }
    
    public function sendNotification($messsage){
         
        $username 	= $this->request->session()->read('Info.user');
        $password 	= $this->request->session()->read('Info.password');
        $mobile 	= $this->request->session()->read('Info.phone'); 
        $sender 	= "SenderID";
        $message 	= $messsage;
        $message 	.= "\rThis is system generated automatic notification";
        $message 	.= "\r\n".$this->request->session()->read('Auth.school');
        $url = "http://sms.eschools.cloud/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $responce = curl_exec($ch);
        curl_close($ch);
        
    }
    public function sendmail()
    {
        # code...
        $email = new Email();
        $email
            ->profile('default')
            ->template('default')
            ->to('mirza7339@gmail.com')
            ->from('app@domain.com')
            ->subject('Attndance Short Notification')
            ->send('Test');
            die('lol');
    }
    
    
}
