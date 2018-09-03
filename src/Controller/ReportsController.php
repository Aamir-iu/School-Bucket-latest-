<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;


class ReportsController extends AppController
{

   
    public function index()
    {
      
         
    }
    
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','collectionsummery','sessionWiseSummery'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    
    public function view(){
        
        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d"); 
        
        $currentday = date('Y-m-d',(strtotime ( '-0 day' , strtotime ($date)) ));
        /// current days income 
        $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date)) ));
        
        if($this->request->params['pass'][0]==1){ //
            
        $shift =$this->request->params['pass'][1];
        $from =$this->request->params['pass'][2];
        $to = $this->request->params['pass'][3];
        $shift_name = $this->request->params['pass'][4];
        
        $feestbl = TableRegistry::get('fees');
        $query   = $feestbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'fee_types',
                                'alias' => 'ft',
                                'type' => 'INNER',
                                'conditions' => 'ft.id_fee_type = fees.fee_type_id'
                            ]
                        ]);
         
         $query->select(['income' => $query->func()->sum('amount'),'fee_type_id','status']);
         $query->select(['fee_type'=>'ft.fee_type_name']);
         $query->group('fee_type_id');
         $query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($from)), 'fee_date <='=> date("Y-m-d H:i:s", strtotime($to))]);
        
         
         $query->andwhere(['status'=>1]);
         if($shift > 0){
            $query->andwhere(['fees.shift_id'=>$shift]);
         }
         $income = $query->toArray();
         
         
         /// current days expanses 
         
        $expansestbl = TableRegistry::get('expenses');
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
                $query->select(['amount','expanse_desc']);
                $query->where(['expanse_date >='=> date("Y-m-d H:i:s", strtotime($from)), 'expanse_date <='=> date("Y-m-d H:i:s", strtotime($to))]);
                $query->andwhere(['status'=>1]);
                if($shift > 0){
                   $query->andwhere(['shift_id'=>$shift]);
                }


                $query->hydrate(false);
                $expanse = $query->ToArray();

                //current days salary
                $expansesalary = TableRegistry::get('employee_salary');
                $query = $expansesalary->find('all');
                $query->select(['empsalary'=> 'employee_salary.Net_salary']);
                
                $query->where(['employee_salary.salary_month >='=> date("m", strtotime($from)), 'employee_salary.salary_month <='=> date("m", strtotime($to))]);
                $salary = $query->toArray();



                $this->set(compact('income','expanse','salary','from','to','shift_name'));
                $this->set('_serialize', ['income','expanse','salary']);
                $this ->render('statement');
                
            }
        elseif($this->request->params['pass'][0]==2){ // Daily Fee collection 
                
                $shift =$this->request->params['pass'][1];
                $from =$this->request->params['pass'][2];
                $to = $this->request->params['pass'][3];
                $shift_name = $this->request->params['pass'][4];
                
                $table = TableRegistry::get('classes_sections');
                $class = $table->find();
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
                   // $query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($currentday))]);
                    $query->where(['fee_date >='=> date("Y-m-d H:i:s", strtotime($from)), 'fee_date <='=> date("Y-m-d H:i:s", strtotime($to))]);
                    $query->andwhere(['status'=>1]);
                    
                    $query->andwhere(['class_id'=>$row['id_class']]);
                    if($shift > 0){
                        $query->andwhere(['shift_id'=>$shift]);
                    }
                    $query->hydrate(false);
                    $rs = $query->ToArray();
                    if(count($rs) > 0){
                    
                    $data[$row['class_name']] = $rs;
                    array_merge($data, $rs);
                    }
                 
                }    
               
                $this->set(compact('data','shift_name','from','to'));
                $this ->render('daily_fee_collection');  
            
            }
        elseif($this->request->params['pass'][0]==3){ // Daily Fee collection 
                
                $class_id = $this->request->params['pass'][1];
                $fee_type = $this->request->params['pass'][2];
                $month_id = $this->request->params['pass'][3];
                $type_name = $this->request->params['pass'][4];
                $month = $this->request->params['pass'][5];
                
                $table = TableRegistry::get('classes_sections');
                $class = $table->find()->hydrate(false);
                if($class_id === 'select'){                   
                }else{
                    $class->where(['id_class'=>$class_id]); 
                }
                $sql_class = $class->toArray();
                
                $feestbl = TableRegistry::get('fees');
                $duestbl = TableRegistry::get('dues');
                $duestbl = TableRegistry::get('dues');
                $feeheadbl = TableRegistry::get('fee_heads');
                $students_master_detailstbl = TableRegistry::get('students_master_details');
                
                $year   = date("Y");
                $data = array();
                foreach ($sql_class as $row){
                    
                    $query   = $feestbl->find();
                    $query->select(['received' => $query->func()->sum('amount'),'fee_type_id','status']);
                   // $query->group('fee_type_id');
                    $query->where(['fee_month'=> $month_id]);
                    $query->andwhere(['YEAR(fee_date)'=> $year]); 
                    $query->andwhere(['status' => 1]);
                    $query->andwhere(['class_id' => $row['id_class']]);
                    $query->andwhere(['fee_type_id' => $fee_type]);
                    
                    $result = $query->first();
                    if($result){
                    $received = $result->received;
                    }else{
                     $received = 0;    
                    }
                    
                    $data[$row['class_name']]['received'] = $received;
                    
                    $query   = $duestbl->find()
                            ->join([
                                       [   'table' => 'registration',
                                           'type' => 'INNER',
                                           'conditions' => 'registration.id_registration = dues.registration_id'
                                       ]
                                   ]);
                    $query->select(['dues' => $query->func()->sum('amount'),'fee_type_id']);
                   // $query->group('fee_type_id');
                    $query->where(['fee_month'=> $month_id]);
                    $query->andwhere(['YEAR'=> $year]); 
                    $query->andwhere(['class_id' => $row['id_class']]);
                    $query->andwhere(['fee_type_id' => $fee_type]);
                    $query->andwhere(['registration.active' => 'Y']);
                    
                    $result = $query->first();
                    if($result){
                    $dues = $result->dues;
                    }else{
                     $dues = 0;    
                    }
                    
                    $data[$row['class_name']]['dues'] = $dues;
                    
                    $query = $students_master_detailstbl->find()->hydrate(false)
                               ->join([
                                       [   'table' => 'registration',
                                           'type' => 'INNER',
                                           'conditions' => 'registration.id_registration = students_master_details.registration_id'
                                       ]
                                   ]);

                   $query->select(['total' => $query->func()->count('registration_id')]);
                   $query->where(['active'=>'Y']);
                   $query->andwhere(['class_id'=>$row['id_class']]);
                   $query->group(['class_id']);
                   $result = $query->first();
               
                    if($result){
                    $number_of_students = $result['total'];
                    }else{
                     $number_of_students = 0;    
                    } 
                    
                    $data[$row['class_name']]['total_students'] = $number_of_students; 
                    
                    $query   = $feeheadbl->find();
                    $query->select(['class_fees','fee_type_id']);
                    $query->where(['class_id' => $row['id_class']]);
                    $query->andwhere(['fee_type_id' => $fee_type]);
                    $result = $query->first();
                    if($result){
                     $fee = $result->class_fees;
                    }else{
                     $fee = 0;    
                    }
                    
                    $data[$row['class_name']]['fee'] = $fee; 
                         
                   

                } 
              //  echo "<pre>";
              //  print_r($data);
              // exit;
                $this->set(compact('data','type_name','month'));
                $this ->render('collection_summery');  
            
            }    
        elseif($this->request->params['pass'][0]==4){ // Daily Fee collection 
                
            $session_id = $this->request->params['pass'][1];
            $session_name = $this->request->params['pass'][2];

            $moonths = array();
            $moonth_names = array();
            
            $session_tbl = TableRegistry::get('session');
            $tbl = TableRegistry::get('students_master_details');
            $feestbl = TableRegistry::get('fees');
            $duestbl = TableRegistry::get('dues');
            $session_query = $session_tbl->find()->hydrate(false);
            $session_query->where(['id_session'=>$session_id]);
            $session_query->andwhere(['session_status'=>'Y']);
            $sessions = $session_query->first();
          
            for($i = 0; $i<=11; $i++){
                
                $moonths[] = ltrim(date('m', strtotime("+$i months", strtotime($sessions['session_start_date']))),'0');
                $moonth_names[] = ltrim(date('M', strtotime("+$i months", strtotime($sessions['session_start_date']))),'0').'-'.ltrim(date('Y', strtotime("+$i months", strtotime($sessions['session_start_date']))),'0');
               
            }
         
            $mdata = array();
            $count = 1;
            foreach($moonths as $m){
                    $query = $feestbl->find()->hydrate(false);
                    $query->select(['amount' => $query->func()->sum('amount')]);
                    $query->where(['fee_type_id'=>1]);
                    $query->andwhere(['fee_month'=>$m]);
                    $query->andwhere(['session_id'=>$sessions['id_session']]);
                    $query->andwhere(['status'=>1]);
                    $data = $query->first();
                    if($data['amount'] > 0){
                       $mdata['Received']['m'.$count] = $data['amount'];
                    }else{
                       $mdata['Received']['m'.$count] = '0';
                    }
                $count ++;
             }
             
            $ddata = array();
            $count = 1;
            foreach($moonths as $m){
                    $query = $duestbl->find()->hydrate(false)
                              ->join([
                                [   'table' => 'registration',
                                    'type' => 'INNER',
                                    'conditions' => 'registration.id_registration = dues.registration_id'
                                ]
                            ]);
                    $query->select(['amount' => $query->func()->sum('amount')]);
                    $query->where(['fee_type_id'=>1]);
                    $query->andwhere(['fee_month'=>$m]);
                    $query->andwhere(['session_id'=>$sessions['id_session']]);
                    $query->andwhere(['active'=>'Y']);
                  //  $query->andwhere(['status'=>1]);
                    $data = $query->first();
                    if($data['amount'] > 0){
                       $ddata['Balance']['m'.$count] = $data['amount'];
                    }else{
                       $ddata['Balance']['m'.$count] = '0';
                    }
                $count ++;
             }
             
            $edata = array();
            $count = 1;
            foreach($moonths as $m){
                    $query = $duestbl->find()->hydrate(false)
                            ->join([
                                [   'table' => 'registration',
                                    'type' => 'INNER',
                                    'conditions' => 'registration.id_registration = dues.registration_id'
                                ]
                            ]);
                    $query->select(['amount' => $query->func()->sum('amount')]);
                    $query->where(['fee_type_id'=>9]);
                    $query->andwhere(['fee_month'=>$m]);
                    $query->andwhere(['session_id'=>$sessions['id_session']]);
                    $query->andwhere(['active'=>'Y']);
                  //  $query->andwhere(['status'=>1]);
                    $data = $query->first();
                    if($data['amount'] > 0){
                       $edata['Arrears']['m'.$count] = $data['amount'];
                    }else{
                       $edata['Arrears']['m'.$count] = '-';
                    }
                $count ++;
             }
             
            // annual Fee received
            $query = $feestbl->find()->hydrate(false);
            $query->select(['amount' => $query->func()->sum('amount')]);
            $query->where(['fee_type_id'=>13]);
            $query->andwhere(['session_id'=>$sessions['id_session']]);
            $query->andwhere(['status'=>1]);
            $data = $query->first();
            if($data['amount'] > 0){
               $annaul_r = $data['amount'];
            }else{
               $annaul_r = '-';
            }
             
            // annual Fee balance
            $query = $duestbl->find()->hydrate(false)
                      ->join([
                            [   'table' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = dues.registration_id'
                            ]
                        ]);
            $query->select(['amount' => $query->func()->sum('amount')]);
            $query->where(['fee_type_id'=>13]);
            $query->andwhere(['session_id'=>$sessions['id_session']]);
            $query->andwhere(['active'=>'Y']);
            $data = $query->first();
            if($data['amount'] > 0){
               $annaul_b = $data['amount'];
            }else{
               $annaul_b = '-';
            } 
             
           // examination Fee received
            $query = $feestbl->find()->hydrate(false);
            $query->select(['amount' => $query->func()->sum('amount')]);
            $query->where(['fee_type_id'=>2]);
            $query->andwhere(['session_id'=>$sessions['id_session']]);
            $query->andwhere(['status'=>1]);
            $data = $query->first();
            if($data['amount'] > 0){
               $exam_r = $data['amount'];
            }else{
               $exam_r = '-';
            }
             
            // examination Fee balance
            $query = $duestbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = dues.registration_id'
                            ]
                        ]);
            $query->select(['amount' => $query->func()->sum('amount')]);
            $query->where(['fee_type_id'=>2]);
            $query->andwhere(['session_id'=>$sessions['id_session']]);
            $query->andwhere(['active'=>'Y']);
            $data = $query->first();
            if($data['amount'] > 0){
               $exam_b = $data['amount'];
            }else{
               $exam_b = '-';
            } 
             
            // This session arrears
            $query = $duestbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = dues.registration_id'
                            ]
                        ]);
            $query->select(['amount' => $query->func()->sum('amount')]);
            $query->where(['fee_type_id'=>9]);
            $query->andwhere(['session_id'=>$sessions['id_session']]);
            $query->andwhere(['active'=>'Y']);
            $data = $query->first();
            if($data['amount'] > 0){
               $current_arrears = $data['amount'];
            }else{
               $current_arrears = '0';
            } 
            
             // This session arrears
            $query = $duestbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = dues.registration_id'
                            ]
                        ]);
            $query->select(['amount' => $query->func()->sum('amount')]);
            $query->where(['fee_type_id'=>9]);
            $query->andwhere(['session_id <'=>$sessions['id_session']]);
            $query->andwhere(['active'=>'Y']);
            $data = $query->first();
            if($data['amount'] > 0){
               $last_arrears = $data['amount'];
            }else{
               $last_arrears = '0';
            } 
             
            $this->set(compact('ddata','mdata','edata','session_name','current_arrears','last_arrears','moonth_names','annaul_r','annaul_b','exam_r','exam_b'));
            $this ->render('session_wise_summery_report');  
            
        }    
    }
  
    
    public function collectionsummery(){
        
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
        
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        $classesbl = TableRegistry::get('classes_sections');
        $class_name = $classesbl->find('all');
        
        $this->set(compact('feetype','months','class_name'));
        $this->set('_serialize', ['feetype','months','class_name']);
        
        
    }
    
    public function sessionWiseSummery(){
  
    $sessiontable = TableRegistry::get('session');
    $session = $sessiontable->find('all');
    $this->set(compact('session'));
    $this->set('_serialize', ['session']);
        
        
    }
}
