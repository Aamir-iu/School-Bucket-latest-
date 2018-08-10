<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * Fees Controller
 *
 * @property \App\Model\Table\FeesTable $Fees
 */
class FeesController extends AppController
{

    public function index(){
        
        $data = date("Y-m-d H:i:s");
        $feestbl = TableRegistry::get('fees');
        $query = $feestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses','users']);
        $query->select(['f_date'=>'date_format(fees.fee_date,"%d-%m-%Y %H:%i")']);
        $query->select(['id_fees','year','amount','reg_id'=>'registration.id_registration']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
        $query->select(['status','inv_no','name'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['amount' => $query->func()->sum('amount'),'sub_total']);
        $query->select(['user'=>'full_name']);
        $query->group(['id_registration']);
        $query->group(['inv_no']);
        $query->orderDesc('fees.id_fees');
     //   $query->where(['fee_date >='=> date("Y-m-d", strtotime($data))]);
     //   $query->andwhere(['registration.active'=>'Y']);
        $query->hydrate(false);
        $res = $query->ToArray();
        $data = array();
        
        foreach ($res as $dat) {
            $actions = array('actions' => "<button onclick='javascript:print_invoice(1," . $dat['inv_no'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:Cancel_Invoice(" . $dat['inv_no'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Cancel</button>");
            array_push($data, array_merge($dat, $actions));
        }
        
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
         
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        
        $this->set(compact('data','feetype','months'));
        $this->set('_serialize', ['data']);
        
    }
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','edit','delete','fcr','generatedues',
            'getstudentfee','gtbysearch','piadfeehistory','paidfees','livesearchstudent',
            'feecollection','cashregister','updateCashRegister','addMultipleFees','paidMultiple','cancelInvoices'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    
    public function cancelInvoices($id = null){
        
        if ($this->request->is('post')) {
            $id = $this->request->data['user_id'];
        }
        
        $data = date("Y-m-d H:i:s");
        $feestbl = TableRegistry::get('fees');
        $query = $feestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses','users']);
        $query->select(['f_date'=>'date_format(fees.fee_date,"%d-%m-%Y %H:%i")']);
        $query->select(['id_fees','year','amount','reg_id'=>'registration.id_registration']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
        $query->select(['status','inv_no','name'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['amount' => $query->func()->sum('amount'),'sub_total']);
        $query->select(['user'=>'full_name','remarks']);
        $query->where(['status'=>0]);
        if($id > 0){
            $query->andwhere(['fees.created_by'=>$id]);
        }
        
        $query->group(['id_registration']);
        $query->group(['inv_no']);
        $query->orderDesc('fees.id_fees');
        $query->hydrate(false);
        $data = $query->ToArray();
        
        $tabluser = TableRegistry::get('users');
        $users = $tabluser->find();
        $users->where(['email !='=>'system@eschools.cloud']);
        $user = $users->toArray();
        $this->set(compact('data','user','id'));
        $this->set('_serialize', ['data','user','id']);
    }
    
    
    public function view() {
        $date = date("Y/m/d");   
        if($this->request->params['pass'][0]==1){ // print invoice 
            $inv_no = $this->request->params['pass'][1];
            $feestbl = TableRegistry::get('fees');
            $query = $feestbl->find()->contain(['months','fee_types','registration','classes_sections','shift','session','campuses','users']);
            $query->select(['id_fees','year','amount','reg_id'=>'registration.id_registration']);
            $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
            $query->select(['inv_no','name'=>'registration.student_name','fname'=>'registration.father_name']);
            $query->select(['amount','sub_total','retruned_amount']);
            $query->select(['campus'=>'campuses.campus_name','shift'=>'shift.shift_name','user_name'=>'users.full_name']);
            $query->select(['class'=>'classes_sections.class_name','session'=>'session.session','fee_date','payment_mode','remarks','status']);
            
            $query->where(['inv_no ='=> $inv_no]);
            
            $query->hydrate(false);
            $data = $query->ToArray();
            
            
            if($this->request->session()->read('Info.fee_slip') === 'thermal'){
                $this->set(compact('data'));
                $this ->render('view_thermal'); 
            }else{
            
                $this->set(compact('data'));
                $this->set('_serialize', ['data']);
            
            }
        }
        if($this->request->params['pass'][0]==0){ // print invoice 
            $inv_no = $this->request->params['pass'][1];
            $feestbl = TableRegistry::get('fees');
            $query = $feestbl->find()->contain(['months','fee_types','registration','classes_sections','shift','session','campuses','users']);
            $query->select(['id_fees','year','amount','reg_id'=>'registration.id_registration']);
            $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
            $query->select(['inv_no','name'=>'registration.student_name','fname'=>'registration.father_name']);
            $query->select(['amount','sub_total','retruned_amount']);
            $query->select(['campus'=>'campuses.campus_name','shift'=>'shift.shift_name','user_name'=>'users.full_name']);
            $query->select(['class'=>'classes_sections.class_name','session'=>'session.session','fee_date','payment_mode','remarks','status']);
            
            $query->where(['inv_no ='=> $inv_no]);
            
            $query->hydrate(false);
            $data = $query->ToArray();
            $this->set(compact('data'));
            $this ->render('view_multiple_slip');  
            
        }
        if($this->request->params['pass'][0]==2){ // Daily Fee collection 
            $from = $this->request->params['pass'][1];
            $to = $this->request->params['pass'][2];
            
            if(isset($this->request->params['pass'][3])){
                $class_id = $this->request->params['pass'][3];
            }
            if(isset($this->request->params['pass'][4])){
                $feehead = $this->request->params['pass'][4];
            }
            if(isset($this->request->params['pass'][5])){
                $shift_id = $this->request->params['pass'][5];
            }
            
            if(isset($this->request->params['pass'][6])){
                $tital = $this->request->params['pass'][6];
            }
          
                $table = TableRegistry::get('classes_sections');
                $class = $table->find();
                if(!empty($class_id)){
                    $class->where(['id_class'=>$class_id]);
                }
                
                
                $data = array();
                foreach ($class as $row){
                
                    $feestbl = TableRegistry::get('fees');
                    $query = $feestbl->find()->contain(['months','fee_types','registration','classes_sections','shift','session','campuses','users']);
                    $query->select(['id_fees','year','amount','reg_id'=>'registration.id_registration']);
                    $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
                    $query->select(['inv_no','name'=>'registration.student_name','fname'=>'registration.father_name']);
                    $query->select(['amount','sub_total','retruned_amount']);
                    $query->select(['campus'=>'campuses.campus_name','shift'=>'shift.shift_name','user_name'=>'users.full_name']);
                    $query->select(['class'=>'classes_sections.class_name','session'=>'session.session','f_date'=>'date_format(fees.fee_date,"%d-%m-%Y %H:%i")','payment_mode']);
                    //$query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($currentday))]);
                    $query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($from)), 'fee_date <='=> date("Y-m-d H:i:s", strtotime($to))]);
                    $query->andwhere(['status'=>1]);
                    $query->andwhere(['class_id'=>$row['id_class']]);
                    if($feehead > 0){
                        $query->andwhere(['fee_type_id'=>$feehead]);
                    }
                    if($shift_id > 0){
                        $query->andwhere(['shift_id'=>$shift_id]);
                    }
                    
                    $query->hydrate(false);
                    $rs = $query->ToArray();
                    if(count($rs) > 0){
                    
                    $data[$row['class_name']] = $rs;
                    array_merge($data, $rs);
                    }
                 
                }    
               
           
            $this->set(compact('data','from','to','tital'));
            $this ->render('daily_fee_collection');  
        }    
        if($this->request->params['pass'][0]==3){ // FCR Report
            
            $class_id = $this->request->params['pass'][1];
            $shift_id = $this->request->params['pass'][2];
            $fee_type_id = $this->request->params['pass'][3];
            
            
            $class = $this->request->params['pass'][4];
            $shift = $this->request->params['pass'][5];
            $fee_type = $this->request->params['pass'][6];
            $session_id = $this->request->params['pass'][7];
           
            
            $moonths = array();
            $moonth_names = array();
            
            $session_tbl = TableRegistry::get('session');
            $tbl = TableRegistry::get('students_master_details');
            $feestbl = TableRegistry::get('fees');
            $session_query = $session_tbl->find()->hydrate(false);
            $session_query->where(['id_session'=>$session_id]);
            $session_query->andwhere(['session_status'=>'Y']);
            $sessions = $session_query->first();
          
            for($i = 0; $i<=11; $i++){
                
                $moonths[] = ltrim(date('m', strtotime("+$i months", strtotime($sessions['session_start_date']))),'0');
                $moonth_names[] = ltrim(date('M', strtotime("+$i months", strtotime($sessions['session_start_date']))),'0').'-'.ltrim(date('Y', strtotime("+$i months", strtotime($sessions['session_start_date']))),'0');
               
            }
            
              $query_student = $tbl->find()->hydrate(false)
                         ->join([
                                [   'table' => 'registration',
                                     'type' => 'INNER',
                                     'conditions' => 'registration.id_registration = students_master_details.registration_id'
                                 ]
                             ]);
           
            $query_student->select(['roll_no','registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name','gr_no'=>'registration.gr']);
            $query_student->where(['class_id'=>$class_id]);
            $query_student->andwhere(['shift_id'=>$shift_id]);
            $query_student->andwhere(['registration.active'=>'Y']);
            $result = $query_student->toArray();
             
            $mdata = array();
            foreach($result as $row){
                $mdata[$row['registration_id']]['registration_id'] = $row['registration_id'];
                $mdata[$row['registration_id']]['roll_no'] = $row['roll_no'];
                $mdata[$row['registration_id']]['gr_no'] = $row['gr_no'];
                $mdata[$row['registration_id']]['s_name'] = $row['sname'];
                $mdata[$row['registration_id']]['f_name'] = $row['fname'];
                $count = 1;
                foreach($moonths as $m){
                        $query = $feestbl->find()->hydrate(false);
                        $query->select(['amount','inv_no']);
                        $query->where(['fee_type_id'=>$fee_type_id]);
                     //   $query->andwhere(['class_id'=>$class_id]);
                     //   $query->andwhere(['shift_id'=>$shift_id]);
                        $query->andwhere(['fee_month'=>$m]);
                        $query->andwhere(['session_id'=>$sessions['id_session']]);
                        $query->andwhere(['registration_id'=>$row['registration_id']]);
                        $query->andwhere(['status'=>1]);
                        $data = $query->first();
                        
                        if($data['amount'] > 0){
                          $mdata[$row['registration_id']]['m'.$count] = $data['amount'];
                        }else{
                           $mdata[$row['registration_id']]['m'.$count] = '-';
                        }
                      
                        $count ++;
                    }
              
            }    
            echo "<pre>";
            print_r($mdata);
            echo "</pre>";
            exit(); 
              
           
            $this->set(compact('mdata','moonth_names','fee_type','class','shift'));
            $this ->render('fcr_report');  
        }    
        if($this->request->params['pass'][0]==4){ // Cash Register
            
        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d"); 
        
        $currentday = date('Y-m-d',(strtotime ( '-0 day' , strtotime ($date)) ));
        
        $cash_registertbl = TableRegistry::get('cash_register');
        $sql = $cash_registertbl->find()->hydrate(false)
                ->join([
                            [   'table' => 'users',
                                'type' => 'INNER',
                                'conditions' => 'users.id = cash_register.user_id'
                            ]
                        ]);
        $sql->select($cash_registertbl);
        $sql->select(['user'=>'users.full_name']);
        $sql->where(['cash_register_date' => date("Y-m-d", strtotime($currentday))]);
        $cash_register = $sql->toArray();

        /// current days income 
        $fee_typestbl = TableRegistry::get('fee_types');
        $sql_fee_type = $fee_typestbl->find()->hydrate(false);
        $sql_fee_type->where(['status_active'=>'Y']);
        $query = $sql_fee_type->toArray();
        $feestbl = TableRegistry::get('fees');
        $expansestbl = TableRegistry::get('expanses');
        
        $data = array();
        foreach($query as $row){
            
            $query = $feestbl->find()->hydrate(false);
            $query->select(['income' => $query->func()->sum('amount'),'fee_type_id','status']);
            $query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($currentday))]);
            $query->andwhere(['status'=>1]);
            $query->andwhere(['fee_type_id'=>$row['id_fee_type']]);
            $query->andwhere(['fees.created_by '=>$this->request->session()->read('Auth.User.id')]);
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
                        'conditions' => 'expanses.transaction_account_id = ta.id_transaction_account '
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
                $query->select(['amount','expanse_desc']);
                //$query->group('ta');
                $query->where(['expanse_date '=>date("Y-m-d H:i:s", strtotime($currentday))]);
                $query->andwhere(['expanses.created_by '=>$this->request->session()->read('Auth.User.id')]);
                
                $query->hydrate(false);
                $expanse = $query->ToArray();
            
            }
           
            $this->set(compact('data','expanse','cash_register'));
            $this ->render('cash_register');  
        }
        if($this->request->params['pass'][0]==5){ // Cash Register
                
            $data = date("Y-m-d H:i:s");
            $feestbl = TableRegistry::get('fees');
            $query = $feestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses','users']);
            $query->select(['f_date'=>'date_format(fees.fee_date,"%d-%m-%Y %H:%i")']);
            $query->select(['id_fees','year','amount','reg_id'=>'registration.id_registration']);
            $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
            $query->select(['status','inv_no','name'=>'registration.student_name','fname'=>'registration.father_name']);
            $query->select(['amount' => $query->func()->sum('amount'),'sub_total']);
            $query->select(['user'=>'full_name','remarks']);
            $query->where(['status'=>0]);
            
            if($this->request->params['pass'][1] > 0){
                $query->andwhere(['fees.created_by'=>$this->request->params['pass'][1]]);
            }
            
            $query->group(['id_registration']);
            $query->group(['inv_no']);
            $query->orderDesc('fees.id_fees');
            $query->hydrate(false);
            $data = $query->ToArray();
          
            $this->set(compact('data'));
            $this ->render('cancel_invoice_log');  
        }
    }

   
    public function add(){
        $fee = $this->Fees->newEntity();
        if ($this->request->is('post')) {
            $fee = $this->Fees->patchEntity($fee, $this->request->data);
            if ($this->Fees->save($fee)) {
                $this->Flash->success(__('The fee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fee could not be saved. Please, try again.'));
            }
        }
        $registrations = $this->Fees->Registrations->find('list', ['limit' => 200]);
        $campuses = $this->Fees->Campuses->find('list', ['limit' => 200]);
        $sessions = $this->Fees->Sessions->find('list', ['limit' => 200]);
        $classes = $this->Fees->Classes->find('list', ['limit' => 200]);
        $shifts = $this->Fees->Shifts->find('list', ['limit' => 200]);
        $this->set(compact('fee', 'registrations', 'campuses', 'sessions', 'classes', 'shifts'));
        $this->set('_serialize', ['fee']);
    }

  
    public function edit() {

        $remarks = $this->request->data['desc']. ".Cancelled By : ".$this->request->session()->read('Auth.User.full_name');
        $inv_no  = $this->request->data['inv_no'];
        $feestbl = TableRegistry::get('fees');
        $query = $feestbl->query();
        $query->update()
            ->set(['remarks' => $remarks,'status'=>0])
            ->where(['inv_no' => $inv_no])
            ->execute();
        
        $fee = $feestbl->find();
        $fee->where(['inv_no'=>$inv_no]);
        $result = $fee->first();      
        $duestbl = TableRegistry::get('dues');
        $dues = $duestbl->newEntity();
        $dues->registration_id = $result->registration_id;
        $dues->campus_id =  $result->campus_id;
        $dues->session_id = $result->session_id;
        $dues->class_id = $result->class_id;
        $dues->shift_id = $result->shift_id;
        $dues->fee_month = $result->fee_month;
        $dues->year = $result->year;
        $dues->amount = $result->sub_total;
        $dues->fine = 0;
        $dues->fee_type_id = $result->fee_type_id;
        $dues->fee_date =   date("Y-m-d", strtotime($result->fee_date));
        $dues->due_date =   date("Y-m-d", strtotime($result->fee_date));
        $dues->created_by = $this->request->session()->read('Auth.User.id');
        $duestbl->save($dues);
        $amount = $result->sub_total;
        if($this->request->session()->read('Note.on_delete_invoice') == 1){
            $this->sendNotification($inv_no,$amount);
        }
        
        
        $msg = "Success|Invoice # $inv_no has been cancelled.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
    public function sendNotification($invoice_number,$amount){
         
        $username 	= $this->request->session()->read('Info.user');
        $password 	= $this->request->session()->read('Info.password');
        $mobile 	= $this->request->session()->read('Info.phone'); 
        $sender 	= "SenderID";
        $message 	= "Admin Alert:";
        $message 	.= "\rThe User:". $this->request->session()->read('Auth.User.full_name');
        $message 	.= "\rHas Cancelled The Invoice No :".$invoice_number;
        $message 	.= "\rAmount was :".$amount;
        $message 	.= "\rThis is system generated automatic notification";
        $message 	.= "\r\n".$this->request->session()->read('Auth.school');
        
        
//        $url = "http://sms.eschools.cloud/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
//        $ch = curl_init();
//        $timeout = 30;
//        curl_setopt($ch,CURLOPT_URL,$url);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//        $responce = curl_exec($ch);
//        curl_close($ch);
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
        
    }
    

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $fee = $this->Fees->get($id);
        if ($this->Fees->delete($fee)) {
            $this->Flash->success(__('The fee has been deleted.'));
        } else {
            $this->Flash->error(__('The fee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    
    public function getstudentfee(){
        $id =  $this->request->data['reg_id'];
        
        $duestbl = TableRegistry::get('dues');
        $query = $duestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses']);
        $query->select(['d_date'=>'date_format(dues.due_date,"%d-%M-%Y %H:%i")']);
        $query->select(['id_dues','year','amount','fine']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
        $query->select(['name'=>'registration.student_name','fname'=>'registration.father_name','num'=>'registration.contact1','email'=>'registration.email']);
        $query->select(['class_name'=>'classes_sections.class_name','shift'=>'shift.shift_name']);
        $query->select(['m_id'=>'months.id_month','t_id'=>'fee_types.id_fee_type']);
        $query->select(['c_id'=>'classes_sections.id_class','s_id'=>'shift.id_shift','se_id'=>'dues.session_id','campus'=>'campuses.id_campus']);
        $query->select(['pic'=>'registration.image']);  
        $query->where(['registration_id'=>$id]);
        $query->andwhere(['amount >'=>0]);
        $query->hydrate(false);
        $rs = $query->ToArray();
        $data = array();
        $current_date = date("d-M-Y H:i:s");
       // $today_time = strtotime($current_date);
        $is_dues = 'N';
        foreach ($rs as $dat) {
           $due_time = strtotime($dat['d_date']);

           if( $this->request->session()->read('Info.fine_setting') == 0){ 
           
                if(date("Y-m-d", strtotime($dat['d_date'])) >= date("Y-m-d", strtotime($current_date))){
                    $fine =  0; 
                    $is_dues = 'N';
                    $days =  0;
                }else{
                   $fine = $dat['fine'];
                   $is_dues = 'Y';
                   $days = 0;

                }
           }
           elseif($this->request->session()->read('Info.fine_setting') == 1){
               
                if(date("Y-m-d", strtotime($dat['d_date'])) >= date("Y-m-d", strtotime($current_date))){
                    $fine =  0; 
                    $is_dues = 'N';
                    $days = 0;
                }else{
                    
                    $date1 = date_create($dat['d_date']);
                    $date2 = date_create($current_date);
                    $diff = date_diff($date1,$date2);
                    $days =  $diff->format("%a");
                    $fine = $dat['fine'];
                    $is_dues = 'Y';
                   
                }
            }
          
            $fine_amount = array('fine_amount' => $fine,'is_due'=>$is_dues,'days'=>$days);
            array_push($data, array_merge($dat,$fine_amount));
      
            
        }
     
        $tbl = TableRegistry::get('students_master_details');
        $query = $tbl->find('all')->contain(['registration','classes_sections','shift','campuses']);
        $query->select(['name'=>'registration.student_name','fname'=>'registration.father_name','num'=>'registration.contact1','email'=>'registration.email']);
        $query->select(['class_name'=>'classes_sections.class_name','shift'=>'shift.shift_name']);
        $query->select(['pic'=>'registration.image']);    
        $query->where(['registration_id'=>$id]);
        $query->hydrate(false);
        $rs = $query->ToArray();
        
        $this->set(compact('data','rs'));
        $this->set('_serialize', ['data','rs']);
    }
    
    public function piadfeehistory(){
        $id =  $this->request->data['reg_id'];
        $Tbl = TableRegistry::get('fees');
        $query = $Tbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'months',
                                'type' => 'INNER',
                                'conditions' => 'months.id_month = fees.fee_month'
                            ],
                            [   'table' => 'fee_types',
                                'type' => 'INNER',
                                'conditions' => 'fee_types.id_fee_type = fees.fee_type_id'
                            ]
                        ]);
        $query->select(['inv_no','amount','year','month'=>'months.month_name','fee_type'=>'fee_types.fee_type_name']);
        $query->select(['f_date'=>'date_format(fees.fee_date,"%d-%m-%Y %H:%i")']);
        $query->where(['registration_id'=>$id]);
        $query->andwhere(['status'=>1]);
        $ph = $query->toArray();           
        $this->set(compact('ph'));
        $this->set('_serialize', ['ph']);
    }
    
    
    public function paidfees(){
        
      
        $mData = [];
        $mData = $this->request->data['fees'];
        
        $registration_id =  $this->request->data['rid'];
        $grand_total     =  $this->request->data['gt'];
        $received_amount =  $this->request->data['rca'];
        $returned_amount =  $this->request->data['rea'];
        
        $class_id        =  $this->request->data['classid'];
        $shift_id        =  $this->request->data['shiftid'];
        $session_id      =  $this->request->data['sessionid'];
        $campus_id       =  $this->request->data['campusid'];
        $phone           =  $this->request->data['cell'];
        $sms             =  $this->request->data['sms'];
        $name            =  $this->request->data['name'];
        $date            =  date("Y-m-d H:i:s");
        
          $feesble = TableRegistry::get('fees');
          $duesble = TableRegistry::get('dues');
        $invoicesble = TableRegistry::get('invoices');
        
            $query = $invoicesble->find()->hydrate(false);
            $query->select(['id_invoice']);
            $query->select(['Inv_date'=>'date_format(invoices.invoice_date,"%m%y")','invoice_number']);
            $query->orderDesc('id_invoice');
            $query->limit(1);
            $last_ID = $query->first();
           
           $current_year_month = date('y').date('m');
            $inv_number = '';
            if($last_ID['invoice_number'] > 0){
               
                $inv_number = $last_ID['invoice_number'];
                $db_year_month =  $last_ID['Inv_date'];
                
                if($db_year_month == $current_year_month){
                    //$inv_number++;
                    $inv_number = $last_ID['invoice_number'] + 1;
                    $invoice_number = date('y').date('m').$inv_number;
                    
                    
                }else{
                    
                    $inv_number++;
                    $invoice_number = date('y').date('m').$inv_number;
                }
                
                
            }else{
              
                $inv_number = 1;
                $invoice_number = date('y').date('m').$inv_number;
            }
 
         
          foreach($mData as $row){
              $shortage_amount = 0;
            if($row['piadamount'] > 0){  
                $fee = $feesble->newEntity();
                $fee->registration_id = $registration_id;
                $fee->inv_no = $invoice_number;
                $fee->campus_id = $campus_id;
                $fee->session_id = $row['se_id']; //$session_id;
                $fee->class_id = $class_id;
                $fee->shift_id = $shift_id;
                $fee->fee_month = $row['month'];
                $fee->year = $row['year'];
                $fee->amount = $row['piadamount'];
                $fee->sub_total = $row['subtotal'];
                $fee->retruned_amount = $returned_amount;
                $fee->fee_type_id = $row['fee_type'];
                $fee->status = 1;
                $fee->payment_mode = "Cash";
                $fee->fee_date =   date("Y-m-d", strtotime($date));
                $fee->created_by = $this->request->session()->read('Auth.User.id');
                $this->Fees->save($fee);
                $query = $duesble->query();
                $query->delete()->where(['id_dues' => $row['voucher']])->execute();
            if($row['piadamount'] < $row['subtotal']){
                $type = $row['fee_type'] == 9 ? $row['fee_type'] : 9;    
                $shortage_amount =   $row['subtotal'] - $row['piadamount'];
                $dues = $duesble->newEntity();
                $dues->registration_id = $registration_id;
                $dues->campus_id = $campus_id;
                $dues->session_id = $row['se_id']; //$session_id;
                $dues->class_id = $class_id;
                $dues->shift_id = $shift_id;
                $dues->fee_month = $row['month'];
                $dues->year = $row['year'];
                $dues->amount = $shortage_amount;
                $dues->fine = 0;
                $dues->fee_type_id = $type; //$row['fee_type'];
                $fdate = $row['year'].'-'.$row['month'].'-1';
                $dues->fee_date =   date("Y-m-d", strtotime($fdate));
                $dues->due_date =   date("Y-m-d", strtotime($row['due_date']));
                $dues->created_by = $this->request->session()->read('Auth.User.id');
                $duesble->save($dues);
                    
             }
     
            }
 
          }
            
           $invoice = $invoicesble->newEntity();
           $invoice->invoice_number = $inv_number;
           $invoice->invoice_date = date("Y-m-d", strtotime($date));;
           $invoicesble->save($invoice);
          
                if($sms=='Yes'){
                    $username 	= $this->request->session()->read('Info.user');
                    $password 	= $this->request->session()->read('Info.password');
                    $mobile 	= $phone; 
                    $sender 	= "SenderID";
                    $message 	= "Thank you $name for fees submission.";
                    $message 	.= "\r\nInvoice# :".$invoice_number;
                    $message 	.= "\r\nGrand Total :".$grand_total;
                    $message 	.= "\r\nRecieved Amount :".$received_amount.".00";
                    $message 	.= "\r\nReturned Amount :".$returned_amount;
                    $message 	.= "\r\n".$this->request->session()->read('Auth.school');
                    

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
                 
                }
        $msg = "Success|Fee record has been save.";  
        $this->set(compact('msg','invoice_number'));
        $this->set('_serialize', ['msg','invoice_number']);
    }
    
    public function paidMultiple(){
        
      
        $mData = [];
        $mData = $this->request->data['fees'];
       
        $grand_total     =  $this->request->data['gt'];
        $received_amount =  $this->request->data['rca'];
        $returned_amount =  $this->request->data['rea'];
        
      
        $campus_id       =  $this->request->data['campusid'];
        $phone           =  $this->request->data['cell'];
        $sms             =  $this->request->data['sms'];
        $name            =  $this->request->data['name'];
        $date            =  date("Y-m-d H:i:s");
        
          $feesble = TableRegistry::get('fees');
          $duesble = TableRegistry::get('dues');
          $invoicesble = TableRegistry::get('invoices');
        
            $query = $invoicesble->find()->hydrate(false);
            $query->select(['id_invoice']);
            $query->select(['Inv_date'=>'date_format(invoices.invoice_date,"%m%y")','invoice_number']);
            $query->orderDesc('id_invoice');
            $query->limit(1);
            $last_ID = $query->first();
           
          
            $current_year_month = date('y').date('m');
            $inv_number = '';
            if($last_ID['invoice_number'] > 0){
               
                $inv_number = $last_ID['invoice_number'];
                $db_year_month =  $last_ID['Inv_date'];
                
                if($db_year_month == $current_year_month){
                    //$inv_number++;
                    $inv_number = $last_ID['invoice_number'] + 1;
                    $invoice_number = date('y').date('m').$inv_number;
                    
                    
                }else{
                    
                    $inv_number++;
                    $invoice_number = date('y').date('m').$inv_number;
                }
                
                
            }else{
              
                $inv_number = 1;
                $invoice_number = date('y').date('m').$inv_number;
            }
           
          foreach($mData as $row){
              $shortage_amount = 0;
            if($row['piadamount'] > 0){  
                $fee = $feesble->newEntity();
                $fee->registration_id = $row['cc'];
                $fee->inv_no = $invoice_number;
                $fee->campus_id = $campus_id;
                $fee->session_id = $row['session_id']; 
                $fee->class_id = $row['class_id'];
                $fee->shift_id = $row['shift_id'];
                $fee->fee_month = $row['fee_month'];
                $fee->year = $row['year'];
                $fee->amount = $row['piadamount'];
                $fee->sub_total = $row['subtotal'];
                $fee->retruned_amount = $returned_amount;
                $fee->fee_type_id = $row['fee_type'];
                $fee->status = 1;
                $fee->payment_mode = "Cash";
                $fee->report_type = 0;
                $fee->fee_date =   date("Y-m-d", strtotime($date));
                $fee->created_by = $this->request->session()->read('Auth.User.id');
                $this->Fees->save($fee);
                $query = $duesble->query();
                $query->delete()->where(['id_dues' => $row['voucher']])->execute();
            if($row['piadamount'] < $row['subtotal']){
                $type = $row['fee_type'] == 9 ? $row['fee_type'] : 9;    
                $shortage_amount =   $row['subtotal'] - $row['piadamount'];
                $dues = $duesble->newEntity();
                $dues->registration_id = $row['cc'];
                $dues->campus_id = $campus_id;
                $dues->session_id = $row['session_id']; 
                $dues->class_id = $row['class_id'];
                $dues->shift_id = $row['shift_id'];
                $dues->fee_month = $row['fee_month'];
                $dues->year = $row['year'];
                $dues->amount = $shortage_amount;
                $dues->fine = 0;
                $dues->fee_type_id = $type; //$row['fee_type'];
                $fdate = $row['year'].'-'.$row['shift_id'].'-1';
                $dues->fee_date =   date("Y-m-d", strtotime($fdate));
                $dues->due_date =   date("Y-m-d", strtotime($row['due_date']));
                $dues->created_by = $this->request->session()->read('Auth.User.id');
                $duesble->save($dues);
                    
             }
     
            }
 
          }
           $invoice = $invoicesble->newEntity();
           $invoice->invoice_number = $inv_number;
           $invoice->invoice_date = date("Y-m-d", strtotime($date));;
           $invoicesble->save($invoice);
           
                if($sms=='Yes'){
                    $username 	= $this->request->session()->read('Info.user');
                    $password 	= $this->request->session()->read('Info.password');
                    $mobile 	= $phone; 
                    $sender 	= "SenderID";
                    $message 	= "Thank you for fee submission.";
                    $message 	.= "\r\nInvoice# :".$invoice_number;
                    $message 	.= "\r\nGrand Total :".$grand_total;
                    $message 	.= "\r\nRecieved Amount :".$received_amount.".00";
                    $message 	.= "\r\nReturned Amount :".$returned_amount;
                    $message 	.= "\r\n".$this->request->session()->read('Auth.school');
                    
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
                   
                }
        $msg = "Success|Fee record has been save.";  
        $this->set(compact('msg','invoice_number'));
        $this->set('_serialize', ['msg','invoice_number']);
    }
    
    public function livesearchstudent(){
        
        $name  = $this->request->data['search'];
              
        $registrationble = TableRegistry::get('registration');
        $query           = $registrationble->find();
        $query->select(['id_registration','student_name','father_name','image']);
        $query->where(['student_name LIKE' =>'%' . $name . '%']); 
        $query->andwhere(['active'=>'Y']);
        $result = $query->toArray();
      //  $hostname =  $this->Url->Html->image('students_images/avatar-1.jpg');
        $hostname = $this->url()."img/students_images";
       
        foreach($result as $row){
            
           $id = $row['id_registration'];
           $sname = $row['student_name'];
           $fname = $row['father_name'];
          
           
           $image  = $row['image'];
           $r =  "<div class='show' onclick='getID($id);' align='left'>";
           $r .=    "<img src='$hostname/$image' class = 'img-circle' style='width:38px; height:38px; float:left; margin-right:6px;' /><span class='name'><span id='s$id'> $id </span>&nbsp;- $sname</span>&nbsp;<br/>$fname<br/><br/>";
           $r .= "</div>";
           $data[] = $r; 
            
        }
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
       
    }
    
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    
    public function feecollection(){
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        $this->set(compact('class','campus','feetype','months'));
        $this->set('_serialize', ['class','campus','feetype','months']);
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
        
        if(empty($fee_result) && $this->request->data['ft'] != 22){
            $msg  = "Error|Please set fee head first.";
        }
        else{
            
            $concession = $concessiontbl->find()->hydrate(false);
            $concession->select(['amount','fine','from_date','to_date']);
            $concession->where(['registration_id' => $this->request->data['reg_id']]);
            $concession->andwhere(['fee_type_id' =>$this->request->data['ft']]);
            $con_rs     = $concession->first();
            if($this->request->data['ft'] != 22){
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
                        $amount = $con_rs['amount'];
                        $fine = $con_rs['fine'];
                    }else{
                        $amount = $fee_result->class_fees;
                        $fine = $fee_result->fine;
                    }

                 }else{
                    $amount = $fee_result->class_fees;
                    $fine = $fee_result->fine;
                 }
            } 
            if($this->request->data['ft'] == 22){
                $fine = 0;
                $amount = trim($this->request->data['feeamount']);
             }
            
                   
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
    
    public function gtbysearch(){
        
        
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
        if (isset($this->request->data['inv_no'])) {
            $inv_no =  $this->request->data['inv_no'];
        }
        if (isset($this->request->data['from_date'])) {
            $from =  $this->request->data['from_date'];
        }
        if (isset($this->request->data['to_date'])) {
            $to =  $this->request->data['to_date'];
        }
       
        $data = date("Y-m-d H:i:s");
        $feestbl = TableRegistry::get('fees');
        $query = $feestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses','users']);
        $query->select(['f_date'=>'date_format(fees.fee_date,"%d-%m-%Y %H:%i")']);
        $query->select(['id_fees','year','amount','reg_id'=>'registration.id_registration']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name','report_type']);
        $query->select(['status','inv_no','name'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['amount' => $query->func()->sum('amount'),'sub_total','created_on']);
       $query->select(['user'=>'users.full_name']);
        $query->group(['id_registration']);
        $query->group(['inv_no']);
        $query->orderDesc('fees.id_fees');
        $recordsTotal = $query->count();
        $query->where(['status'=>$status]);
        
        if (!empty($inv_no)) {
           $query->andwhere(['inv_no' =>$inv_no]);
        }
        
        if (!empty($from)) {
          $query->where(['fees.created_on >='=> date("Y-m-d H:i:s", strtotime($from)), 'fees.created_on <='=> date("Y-m-d H:i:s", strtotime($to))]);
        }
        
        if (!empty($ids)) {
           $query->andwhere(['registration.id_registration IN' =>$ids]);
        }
        if (!empty($fmc)) {
           $query->andwhere(['registration.fmc' =>$fmc]);
        }
        if (!empty($name)) {
           $query->andwhere(['registration.student_name LIKE' =>'%' .$name. '%']);
        }
        $recordsFiltered  = $query->count();
        $query->order([$orderby => $orderdir]);
        if($length>-1){
                $query->limit($length);
            }
            if($start>0){
                $query->offset($start);
        }
        
        $query->hydrate(false);
        $res = $query->ToArray();
        $data = array();
        
        foreach ($res as $dat) {
            
           $role_id = $this->request->session()->read('Auth.User.role_id');
           if($role_id == '1'){ 
                if($dat['status'] == 0){
                    $actions = array('actions' => "<button onclick='javascript:print_invoice(".$dat['report_type']. "," . $dat['inv_no'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:Cancel_Invoice(" . '#' . ")' disabled=true class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Cancel</button>");
                }else{
                    $actions = array('actions' => "<button onclick='javascript:print_invoice(".$dat['report_type']. "," . $dat['inv_no'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:Cancel_Invoice(" . $dat['inv_no'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Cancel</button>");
                }
           }
           else{
             
                $time = new Time($dat['created_on']); // if day is today then it will be work
                if($time->isToday()){
                    if($dat['status'] == 0){
                        $actions = array('actions' => "<button onclick='javascript:print_invoice(".$dat['report_type']. "," . $dat['inv_no'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:Cancel_Invoice(" . '#' . ")' disabled=true class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Cancel</button>");
                    }else{
                        $actions = array('actions' => "<button onclick='javascript:print_invoice(".$dat['report_type']. "," . $dat['inv_no'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:Cancel_Invoice(" . $dat['inv_no'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Cancel</button>");
                    }
                }else{
                    if($dat['status'] == 0){
                        $actions = array('actions' => "<button onclick='javascript:print_invoice(".$dat['report_type']. "," . $dat['inv_no'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button>");
                    }else{
                        $actions = array('actions' => "<button onclick='javascript:print_invoice(".$dat['report_type']. "," . $dat['inv_no'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button>");
                    }
                }
               
            }
            
            array_push($data, array_merge($dat, $actions));
        }
        
       $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
       $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
        
    }
    
     public function fcr(){
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
        
        $this->set(compact('class','campus','feetype','months','session'));
        $this->set('_serialize', ['class','campus','feetype','months','session']);
    }
    
    public function cashregister(){
        
        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d"); 
        
        $currentday = date('Y-m-d',(strtotime ( '-0 day' , strtotime ($date)) ));
        
        $cash_registertbl = TableRegistry::get('cash_register');
        $sql = $cash_registertbl->find()->hydrate(false);
        $sql->where(['cash_register_date' => date("Y-m-d", strtotime($currentday))]);
        $cash_register = $sql->toArray();

        /// current days income 
        $fee_typestbl = TableRegistry::get('fee_types');
        $sql_fee_type = $fee_typestbl->find()->hydrate(false);
        $sql_fee_type->where(['status_active'=>'Y']);
        $query = $sql_fee_type->toArray();
        $feestbl = TableRegistry::get('fees');
        $expansestbl = TableRegistry::get('expanses');
        
        $data = array();
        foreach($query as $row){
            
            $query = $feestbl->find()->hydrate(false);
            $query->select(['income' => $query->func()->sum('amount'),'fee_type_id','status']);
            $query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($currentday))]);
            $query->andwhere(['status'=>1]);
            $query->andwhere(['fee_type_id'=>$row['id_fee_type']]);
            $query->andwhere(['fees.created_by '=>$this->request->session()->read('Auth.User.id')]);
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
                        'conditions' => 'expanses.transaction_account_id = ta.id_transaction_account '
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
                $query->andwhere(['expanses.created_by '=>$this->request->session()->read('Auth.User.id')]);
                
                $query->hydrate(false);
                $expanse = $query->ToArray();
            
        }
         
        $this->set(compact('data','expanse','cash_register'));
        $this->set('_serialize', ['data','expanse','cash_register']);
        
    }
    
    public function updateCashRegister(){
        
        $mdata =   $this->request->data();
        $today = date('Y-m-d');
        $CashRegisterTable = TableRegistry::get('cash_register');
        $CashTable = $CashRegisterTable->exists(['cash_register_date' => date("Y-m-d", strtotime($today))]);
        if(empty($CashTable)){
            
            $CashRegiter = $CashRegisterTable->newEntity();
            $CashRegiter->till_amounts =  $mdata['till'] == '' || $mdata['till'] === 0 ? 0 : $mdata['till'];
            $CashRegiter->user_id = $this->request->session()->read('Auth.User.id');
            $CashRegiter->x5000 = $mdata['x5000'];
            $CashRegiter->x1000 = $mdata['x1000'];
            $CashRegiter->x500 = $mdata['x500'];
            $CashRegiter->x100 = $mdata['x100'];
            $CashRegiter->x50 = $mdata['x50'];
            $CashRegiter->x20 = $mdata['x20'];
            $CashRegiter->x10 = $mdata['x10'];
            $CashRegiter->difference = $mdata['totalDifference'];
          //  $CashRegiter->daily_expense = ;
            $CashRegiter->remarks = $mdata['remarks'];
            $CashRegiter->cash_register_date =$today;
            $CashRegisterTable->save($CashRegiter);
            $msg = "Success|Saved";
           // return $this->redirect(['action' => 'view',4]);
        }else{
            $CashRegisterTable->query()->delete()->where(['cash_register_date' => date("Y-m-d", strtotime($today))])->execute();;  
            $CashRegiter = $CashRegisterTable->newEntity();
            $CashRegiter->till_amounts =  $mdata['till'] == '' || $mdata['till'] === 0 ? 0 : $mdata['till'];
            $CashRegiter->user_id = $this->request->session()->read('Auth.User.id');
            $CashRegiter->x5000 = $mdata['x5000'];
            $CashRegiter->x1000 = $mdata['x1000'];
            $CashRegiter->x500 = $mdata['x500'];
            $CashRegiter->x100 = $mdata['x100'];
            $CashRegiter->x50 = $mdata['x50'];
            $CashRegiter->x20 = $mdata['x20'];
            $CashRegiter->x10 = $mdata['x10'];
            $CashRegiter->difference = $mdata['totalDifference'];
          //  $CashRegiter->daily_expense = ;
            $CashRegiter->remarks = $mdata['remarks'];
            $CashRegiter->cash_register_date =$today;
            $CashRegisterTable->save($CashRegiter);
            $msg = "Success|Saved";
            //return $this->redirect(['action' => 'view',4]);
        }
       
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
    public function addMultipleFees(){
        
        
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
         
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        
        $this->set(compact('data','feetype','months'));
        $this->set('_serialize', ['data']);
    }
    
    
}
