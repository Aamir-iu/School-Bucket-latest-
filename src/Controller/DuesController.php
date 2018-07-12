<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;


class DuesController extends AppController
{
   public function index(){
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
 
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
        
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        $classesbl = TableRegistry::get('classes_sections');
        $class_name = $classesbl->find('all');
        
        $this->set(compact('data','dues','class','campus','feetype','months','class_name'));
        $this->set('_serialize', ['data','dues','class','campus','feetype','months','class_name']);
        
    }
   public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','edit','delete','duesslip','getbysearch','editfee','sendsms','getduesdetails','generatedues','getdues','defaultersreport'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
   public function view(){
    $flag = $this->request->pass[0];
    
    if($flag == 1){

    $limit = $this->request->pass[1];
    $class = $this->request->pass[2];
    $shift = $this->request->pass[3];
    $class_name = $this->request->pass[4];
    $shift_name = $this->request->pass[5];


    $tbl = TableRegistry::get('students_master_details');
    $query = $tbl->find()->hydrate(false)
                 ->join([
                         [   'table' => 'registration',
                             'alias' => 'registration',
                             'type' => 'INNER',
                             'conditions' => 'registration.id_registration = students_master_details.registration_id'
                         ],
                         [   'table' => 'classes_sections',
                             'type' => 'INNER',
                             'conditions' => 'classes_sections.id_class = students_master_details.class_id'
                         ]
                     ]);
     $query->select(['registration_id','name'=>'registration.student_name','fname'=>'registration.father_name']);
     $query->select(['roll_no','gr_no'=>'registration.gr','class'=>'classes_sections.class_name','contact'=>'registration.contact1']);
     $query->select(['pic'=>'registration.image']);
     $query->where(['registration.active'=>'Y']); 
     if($class != 0){
         $query->andwhere(['class_id'=>$class]);
     }
     if($shift != 0){
         $query->andwhere(['shift_id'=>$shift]);
     }
     $result = $query->toArray();

     $duestbl = TableRegistry::get('dues');
     $mdata = array();
     foreach($result as $row){
         $mdata[$row['registration_id']]['registration_id'] = $row['registration_id'];
         $mdata[$row['registration_id']]['roll_no'] = $row['roll_no'];
         $mdata[$row['registration_id']]['gr_no'] = $row['gr_no'];
         $mdata[$row['registration_id']]['s_name'] = $row['name'];
         $mdata[$row['registration_id']]['f_name'] = $row['fname'];
         $mdata[$row['registration_id']]['class'] = $row['class'];
         $mdata[$row['registration_id']]['contact'] = $row['contact'];
         $mdata[$row['registration_id']]['pic'] = $row['pic'];

         $sql = $duestbl->find()->hydrate(false)
                 ->join([
                         [   'table' => 'fee_types',
                             'type' => 'INNER',
                             'conditions' => 'fee_types.id_fee_type = dues.fee_type_id'
                         ]
                     ]);
         $sql->select(['amount','fee_type_id','type'=>'fee_types.fee_type_name']);
         $sql->select(['fef_date'=>'date_format(dues.fee_date,"%M-%y")']);
         $sql->where(['registration_id'=>$row['registration_id']]);
         $sql->andwhere(['amount >'=>0]);
         $sql->orderAsc('fee_month');

         $rs = $sql->toArray();
          $months = '';
             $other = '';
             $total_amount = 0;
         if(count($rs) >= $limit){

             foreach($rs as $rows){

                 if($rows['fee_type_id'] ==1){
                     $months .=   $rows['fef_date'].' '.$rows['amount'].', ';
                 }else{
                      $other .=   substr($rows['type'],0,6).'-'.$rows['amount'].', ';
                 }
                 $total_amount += $rows['amount'];

             }
         }

             $mdata[$row['registration_id']]['dues'] = rtrim($months,', ');
             $mdata[$row['registration_id']]['other'] = rtrim($other,', ');
             $mdata[$row['registration_id']]['amount'] = $total_amount;
     }

     $this->set(compact('mdata','class_name','shift_name'));
     $this->set('_serialize', ['mdata']);

 }
    if($flag == 2 || $flag == 3){
        
            ini_set('max_execution_time', 0);
            $flag = $this->request->pass[0];
            $month    = explode(',', $this->request->pass[1]);
            $class = $this->request->pass[3];
            $shift = $this->request->pass[4];
            $dd = date('d-M-Y', strtotime(str_replace('-', '/', $this->request->pass[5])));
            $id = date('d-M-y', strtotime(str_replace('-', '/', $this->request->pass[6])));
          
           $tbl = TableRegistry::get('students_master_details');
           $query_student = $tbl->find()->hydrate(false)
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
           
            $query_student->select(['roll_no','registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name','class'=>'cs.class_name','shift'=>'shift.shift_name','pic'=>'registration.image']);
            $query_student->where(['class_id'=>$class]);
            $query_student->andwhere(['shift_id'=>$shift]);
            $query_student->andwhere(['registration.active'=>'Y']);
            $result = $query_student->toArray();
            
            $duestbl = TableRegistry::get('dues');
          
            $mdata = array();
            foreach($result as $row){
                // start monthlly fee from here..
                $mdata[$row['registration_id']]['registration_id'] = $row['registration_id'];
                $mdata[$row['registration_id']]['roll_no'] = $row['roll_no'];
                $mdata[$row['registration_id']]['s_name'] = $row['sname'];
                $mdata[$row['registration_id']]['f_name'] = $row['fname'];
                $mdata[$row['registration_id']]['class_name'] = $row['class'];
                $mdata[$row['registration_id']]['shift_name'] = $row['shift'];
                $mdata[$row['registration_id']]['pic'] = $row['pic'];
                
                $query = $duestbl->find()->hydrate(false)
                         ->join([
                                 [   'table' => 'fee_types',
                                     'alias' => 'ft',
                                     'type' => 'INNER',
                                     'conditions' => 'ft.id_fee_type = dues.fee_type_id'
                                 ],
                                 [   'table' => 'months',
                                     'type' => 'INNER',
                                     'conditions' => 'months.id_month = dues.fee_month'
                                 ]
                             ]);

                $query->select(['fee_type'=>'ft.fee_type_name']);
                $query->select(['amount','month'=>'months.month_name','year','fine','due_date']);
                $query->where(['fee_type_id'=>1]);
                $query->andwhere(['fee_month IN'=>$month]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $query->orderDesc('month');
                $data = $query->ToArray();
                $montly = '';
                $amount = 0;
                $fine = 0;
                $due_date = date("Y-m-d");
                foreach($data as $fee){
                    $montly .= substr($fee['month'],0,3).'-'.substr($fee['year'],2,2).',';
                    $amount += $fee['amount'];
                    $fine += $fee['fine'];
                    $due_date = $fee['due_date'];
                }

                 $mdata[$row['registration_id']]['Monthly'] = rtrim($montly,',');
                 $mdata[$row['registration_id']]['amount'] = $amount;
                 $mdata[$row['registration_id']]['fine'] = $fine;
                 $mdata[$row['registration_id']]['due_date'] = date("Y-m-d", strtotime($due_date));
                
                 $query = $duestbl->find()->hydrate(false)
                         ->join([
                                 [   'table' => 'fee_types',
                                     'alias' => 'ft',
                                     'type' => 'INNER',
                                     'conditions' => 'ft.id_fee_type = dues.fee_type_id'
                                 ],
                                 [   'table' => 'months',
                                     'type' => 'INNER',
                                     'conditions' => 'months.id_month = dues.fee_month'
                                 ]
                             ]);

                $query->select(['fee_type'=>'ft.fee_type_name']);
                $query->select(['amount','month'=>'months.month_name','year','fine','due_date']);
                $query->where(['fee_type_id'=>1]);
                $query->andwhere(['fee_month NOT IN'=>$month]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $query->orderDesc('month');
                $data = $query->ToArray();
                $montly = '';
                $amount = 0;
                $fine = 0;
                $due_date = '';
                foreach($data as $fee){
                    $montly .= substr($fee['month'],0,3).'-'.substr($fee['year'],2,2).',';
                    $amount += $fee['amount'] + $fee['fine'];
                  //  $fine += $fee['fine'];
                   
                }
  
                $mdata[$row['registration_id']]['pre_month'] = rtrim($montly,','); 
                $mdata[$row['registration_id']]['pre_amount'] = $amount;
     
                // other fees
                $fee_typesble = TableRegistry::get('fee_types');
                $feetype               = $fee_typesble->find('all')->hydrate(false);
                $feetype->where(['status_active'=>'Y']);
                $feetype->andwhere(['id_fee_type >'=>1]);
                $ft = $feetype->toArray();
                $val = '';
                $i = 1;
                $filed = '';
                foreach($ft as $fts){
                            $filed = "fee_".$i;
                            ////end monthlly area
                            $query = $duestbl->find()->hydrate(false)
                            ->join([
                                    [   'table' => 'fee_types',
                                        'alias' => 'ft',
                                        'type' => 'INNER',
                                        'conditions' => 'ft.id_fee_type = dues.fee_type_id'
                                    ],
                                    [   'table' => 'months',
                                        'type' => 'INNER',
                                        'conditions' => 'months.id_month = dues.fee_month'
                                    ]
                                ]);

                            $query->select(['fee_type'=>'ft.fee_type_name']);
                            $query->select(['amount' => $query->func()->sum('amount'),'month'=>'months.month_name','year']);
                            $query->where(['fee_type_id'=>$fts['id_fee_type']]);
                            $query->andwhere(['registration_id'=>$row['registration_id']]);
                            //$query->group('fee_type_id');
                            $data = $query->ToArray();
                            if($data[0]['amount']){
                            $val = $data[0]['fee_type'].'|'.$data[0]['amount'];
                            }else{
                                $val = $data[0]['fee_type'].'|0';
                            }
                            $mdata[$row['registration_id']][$filed] = $val;
                            
                            $i++;
                  }
                    
            }
            
            $table = TableRegistry::get('fee_types');
            $sql = $table->find();
            $sql->where(['id_fee_type'=>1]);
            $ft = $sql->toarray();        
            
            $data = $mdata; 
            
            $bank_details = TableRegistry::get('bank_details');
            $query               = $bank_details->find('all');
            $query->where(['active'=>'Y']);
            $bank = $query->first();
            
            
            $this->set(compact('data','dd','bank','id','ft'));
            if($flag == 2){
                $this ->render('dues_slip');
            }elseif($flag == 3){
               $this ->render('bank_slip');
            }
       }
    if($flag == 4 || $flag == 5){
        
            ini_set('max_execution_time', 0);
            $flag = $this->request->pass[0];
            $month    = explode(',', $this->request->pass[1]);
            $class = $this->request->pass[3];
            $shift = $this->request->pass[4];
            $dd = date('d-M-Y', strtotime(str_replace('-', '/', $this->request->pass[5])));
            $id = date('d-M-Y', strtotime(str_replace('-', '/', $this->request->pass[6])));
           
            $moonths = array();
            $tbl = TableRegistry::get('students_master_details');
            $session_tbl = TableRegistry::get('session');
            $session_query = $session_tbl->find()->hydrate(false);
            $session_query->where(['session_status'=>'Y']);
            //$session_query->andwhere(['id_session'=>2]);

            $sessions = $session_query->first();

            for($i = 0; $i<=11; $i++){
                
                $moonths[] = ltrim(date('m', strtotime("+$i months", strtotime($sessions['session_start_date']))),'0');
               
            }
           // echo "<pre>";
          //  print_r($moonths);
          //  exit(); 
            $query_student = $tbl->find()->hydrate(false)
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
           
            $query_student->select(['roll_no','registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name','class'=>'cs.class_name','shift'=>'shift.shift_name']);
            $query_student->where(['class_id'=>$class]);
            $query_student->andwhere(['shift_id'=>$shift]);
            $query_student->andwhere(['registration.active'=>'Y']);
            $result = $query_student->toArray();

            $duestbl = TableRegistry::get('dues');
            $feestbl = TableRegistry::get('fees');
            $mdata = array();
            foreach($result as $row){
                $mdata[$row['registration_id']]['registration_id'] = $row['registration_id'];
                $mdata[$row['registration_id']]['roll_no'] = $row['roll_no'];
                $mdata[$row['registration_id']]['s_name'] = $row['sname'];
                $mdata[$row['registration_id']]['f_name'] = $row['fname'];
                $mdata[$row['registration_id']]['class_name'] = $row['class'];
                $mdata[$row['registration_id']]['shift_name'] = $row['shift'];
    
                $total = 0;
                $fine = 0;
                $count = 1;
                
                $current_date = date("Y-m-d");
                foreach($moonths as $m){
                $query = $duestbl->find()->hydrate(false);
                $query->select(['amount','fine','due_date']);
                $query->where(['fee_type_id'=>1]);
                $query->andwhere(['fee_month'=>$m]);
                $query->andwhere(['session_id'=> $sessions['id_session']]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
               // $query->andwhere(['year'=>'2018']);

                $data = $query->first();
                    if($data['amount'] > 0){
                        
                       $total += $data['amount'];
                      
                       $mdata[$row['registration_id']]['m'.$count] = $data['amount'];
                        if(date("Y-m-d H:i:s", strtotime($data['due_date'])) > date("Y-m-d H:i:s", strtotime($current_date))){
                        }else{
                           $fine += $data['fine']; 
                        }
                       
                    }
                    else{
                        $query = $feestbl->find()->hydrate(false);
                        $query->select(['amount','inv_no']);
                        $query->where(['fee_type_id'=>1]);
                        $query->andwhere(['fee_month'=>$m]);
                        $query->andwhere(['session_id'=>$sessions['id_session']]);
                        $query->andwhere(['registration_id'=>$row['registration_id']]);
                        $data = $query->first();
                        if($data['amount'] > 0){
                           $mdata[$row['registration_id']]['m'.$count] = 'Paid';
                        }else{
                           $mdata[$row['registration_id']]['m'.$count] = '-';

                        }
                    }
                    $count++;
                }    
            

                // annaul fee records
                $query = $duestbl->find()->hydrate(false);
                $query->select(['amount' => $query->func()->sum('amount')]);
                $query->where(['fee_type_id'=>13]);
                $query->andwhere(['session_id'=> $sessions['id_session']]);
                $query->andwhere(['session_id'=> $sessions['id_session']]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $data = $query->first();
                if($data['amount'] > 0){
                    $total += $data['amount'];
                    $mdata[$row['registration_id']]['annual'] = $data['amount'];
                   // $temp_dues_table->query()->update()->set(['annual'=> $data['amount']])->where(['registration_id' => $row['registration_id']])->execute();
                }
                else{
                    $query = $feestbl->find()->hydrate(false);
                    $query->select(['amount' => $query->func()->sum('amount')]);
                    $query->where(['fee_type_id'=>13]);
                   // $query->andwhere(['fee_month'=>$m]);
                    $query->andwhere(['session_id'=>$sessions['id_session']]);
                    $query->andwhere(['registration_id'=>$row['registration_id']]);
                    $data = $query->first();
                    if($data['amount'] > 0){
                     // $temp_dues_table->query()->update()->set(['annual' => 'Paid'])->where(['registration_id' => $row['registration_id']])->execute
                      $mdata[$row['registration_id']]['annual'] = 'Paid';
                    }else{
                       $mdata[$row['registration_id']]['annual'] = '-'; 
                    }
                }
                
            
               // examination fee records     
                $query = $duestbl->find()->hydrate(false);
                $query->select(['amount' => $query->func()->sum('amount')]);
                $query->where(['fee_type_id'=>2]);
                //$query->orwhere(['fee_type_id'=>3]);
                $query->andwhere(['session_id'=> $sessions['id_session']]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $data = $query->first();
                if($data['amount'] > 0){
                     $total += $data['amount'];
                     $mdata[$row['registration_id']]['exam'] = $data['amount'];
                }
                else{
                        $query = $feestbl->find()->hydrate(false);
                        $query->select(['amount' => $query->func()->sum('amount')]);
                        $query->where(['fee_type_id'=>2]);
                       // $query->orwhere(['fee_type_id'=>3]);
                        $query->andwhere(['session_id'=>$sessions['id_session']]);
                        $query->andwhere(['registration_id'=>$row['registration_id']]);
                        $data = $query->first();
                        if($data['amount'] > 0){
                          $mdata[$row['registration_id']]['exam'] = 'Paid';
                        }else{ $mdata[$row['registration_id']]['exam'] = '-'; }
                }
                
                
                // arrears fee records     
                $query = $duestbl->find()->hydrate(false);
                $query->select(['amount' => $query->func()->sum('amount')]);
                //$query->where(['fee_type_id'=>9]);
                //$query->andwhere(['session_id'=> $sessions['id_session']]);
                $query->where(['session_id'=> 1]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $data = $query->first();
                if($data['amount'] > 0){
                    $total += $data['amount'];
                    $mdata[$row['registration_id']]['arrears'] = $data['amount'];
                }
                else{
                        $query = $feestbl->find()->hydrate(false);
                        $query->select(['amount' => $query->func()->sum('amount')]);
                        $query->where(['fee_type_id'=>9]);
                        $query->where(['session_id'=>1]);
                        $query->andwhere(['registration_id'=>$row['registration_id']]);
                        $data = $query->first();
                        if($data['amount'] > 0){
                          $mdata[$row['registration_id']]['arrears'] = '0';
                          //$temp_dues_table->query()->update()->set(['arrears' => 'Paid'])->where(['registration_id' => $row['registration_id']])->execute();
                        }else{ $mdata[$row['registration_id']]['arrears'] = '-';  }
                }
                
                 // arrears current session
                $query = $duestbl->find()->hydrate(false);
                $query->select(['amount' => $query->func()->sum('amount')]);
                $query->where(['fee_type_id'=>9]);
                //$query->andwhere(['session_id'=> $sessions['id_session']]);
                $query->andwhere(['session_id'=> $sessions['id_session']]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $data = $query->first();
                if($data['amount'] > 0){
                    $total += $data['amount'];
                    $mdata[$row['registration_id']]['arrears_current_session'] = $data['amount'];
                }
                else{
                        $query = $feestbl->find()->hydrate(false);
                        $query->select(['amount' => $query->func()->sum('amount')]);
                        $query->where(['fee_type_id'=>9]);
                        $query->andwhere(['registration_id'=>$row['registration_id']]);
                        $data = $query->first();
                        if($data['amount'] > 0){
                          $mdata[$row['registration_id']]['arrears_current_session'] = '0';
                        }else{ $mdata[$row['registration_id']]['arrears_current_session'] = '-';  }
                }
        
        
            
                // advance june  and july
                foreach($month as $r){ 
                       
                        $query = $duestbl->find()->hydrate(false);
                        $query->select(['amount']);
                        $query->where(['fee_type_id'=>1]);
                        $query->andwhere(['fee_month'=>$r]);
                        $query->andwhere(['session_id'=> $sessions['id_session']]);
                        $query->andwhere(['registration_id'=>$row['registration_id']]);
                        $data = $query->first();
                        if($data['amount'] > 0){
                            //$total += $data['amount'];
                            $mdata[$row['registration_id']]['current_month'] = $data['amount'];
                        }
                        else{
                            $query = $feestbl->find()->hydrate(false);
                            $query->select(['amount']);
                            $query->where(['fee_type_id'=>1]);
                            $query->andwhere(['fee_month'=>$r]);
                            $query->andwhere(['registration_id'=>$row['registration_id']]);
                            $data = $query->first();
                            if($data['amount'] > 0){
                                $mdata[$row['registration_id']]['current_month'] = 'Paid';
                            }else{ $mdata[$row['registration_id']]['current_month'] = '-'; }
                        }
                } 
                
                $mdata[$row['registration_id']]['total'] = $total + $fine;
                $mdata[$row['registration_id']]['fine'] = $fine;
                $total = 0;
            }   
          
           //    echo "<pre>";
           //    print_r($mdata);
           //    exit();
            
            $bank_details = TableRegistry::get('bank_details');
            $query               = $bank_details->find('all');
            $query->where(['active'=>'Y']);
            $bank = $query->first();
         
            $this->set(compact('mdata','dd','bank','id','moonths'));
            if($flag == 2){
                $this ->render('dues_slip');
            }elseif($flag == 3){
               $this ->render('bank_slip');
            }elseif($flag == 4){
               $this ->render('dues_double_copy');
            }elseif($flag == 5){
               $this ->render('dues_double_copy_1');
            }
       }
    if($flag == 6){
        
            ini_set('max_execution_time', 0);
            $flag = $this->request->pass[0];
            $month    = explode(',', $this->request->pass[1]);
            $feeType = $this->request->pass[2];
            $class = $this->request->pass[3];
            $shift = $this->request->pass[4];
            $dd = date('d-M-Y', strtotime(str_replace('-', '/', $this->request->pass[5])));
            $id = date('d-M-y', strtotime(str_replace('-', '/', $this->request->pass[6])));
          
           $tbl = TableRegistry::get('students_master_details');
           $query_student = $tbl->find()->hydrate(false)
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
           
            $query_student->select(['roll_no','registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name','class'=>'cs.class_name','shift'=>'shift.shift_name','pic'=>'registration.image']);
            $query_student->where(['class_id'=>$class]);
            $query_student->andwhere(['shift_id'=>$shift]);
            $query_student->andwhere(['registration.active'=>'Y']);
            $result = $query_student->toArray();
            
            $duestbl = TableRegistry::get('dues');
          
            $mdata = array();
            foreach($result as $row){
                // start monthlly fee from here..
                $mdata[$row['registration_id']]['registration_id'] = $row['registration_id'];
                $mdata[$row['registration_id']]['roll_no'] = $row['roll_no'];
                $mdata[$row['registration_id']]['s_name'] = $row['sname'];
                $mdata[$row['registration_id']]['f_name'] = $row['fname'];
                $mdata[$row['registration_id']]['class_name'] = $row['class'];
                $mdata[$row['registration_id']]['shift_name'] = $row['shift'];
                $mdata[$row['registration_id']]['pic'] = $row['pic'];
                
                $query = $duestbl->find()->hydrate(false)
                         ->join([
                                 [   'table' => 'fee_types',
                                     'alias' => 'ft',
                                     'type' => 'INNER',
                                     'conditions' => 'ft.id_fee_type = dues.fee_type_id'
                                 ],
                                 [   'table' => 'months',
                                     'type' => 'INNER',
                                     'conditions' => 'months.id_month = dues.fee_month'
                                 ]
                             ]);

                $query->select(['fee_type'=>'ft.fee_type_name']);
                $query->select(['amount','month'=>'months.month_name','year','fine','due_date']);
                $query->where(['fee_type_id'=>0]);
                $query->andwhere(['fee_month IN'=>$month]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $query->orderDesc('month');
                $data = $query->ToArray();
                $montly = '';
                $amount = 0;
                $fine = 0;
                $due_date = date("Y-m-d");
                foreach($data as $fee){
                    $montly .= substr($fee['month'],0,3).'-'.substr($fee['year'],2,2).',';
                    $amount += $fee['amount'];
                    $fine += $fee['fine'];
                    $due_date = $fee['due_date'];
                }

                 $mdata[$row['registration_id']]['Monthly'] = rtrim($montly,',');
                 $mdata[$row['registration_id']]['amount'] = $amount;
                 $mdata[$row['registration_id']]['fine'] = $fine;
                 $mdata[$row['registration_id']]['due_date'] = date("Y-m-d", strtotime($due_date));
                
                 $query = $duestbl->find()->hydrate(false)
                         ->join([
                                 [   'table' => 'fee_types',
                                     'alias' => 'ft',
                                     'type' => 'INNER',
                                     'conditions' => 'ft.id_fee_type = dues.fee_type_id'
                                 ],
                                 [   'table' => 'months',
                                     'type' => 'INNER',
                                     'conditions' => 'months.id_month = dues.fee_month'
                                 ]
                             ]);

                $query->select(['fee_type'=>'ft.fee_type_name']);
                $query->select(['amount','month'=>'months.month_name','year','fine','due_date']);
                $query->where(['fee_type_id'=>1]);
                $query->andwhere(['fee_month NOT IN'=>$month]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $query->orderDesc('month');
                $data = $query->ToArray();
                $montly = '';
                $amount = 0;
                $fine = 0;
                $due_date = '';
                foreach($data as $fee){
                    $montly .= substr($fee['month'],0,3).'-'.substr($fee['year'],2,2).',';
                    $amount += $fee['amount'] + $fee['fine'];
                  //  $fine += $fee['fine'];
                   
                }
  
                $mdata[$row['registration_id']]['pre_month'] = rtrim($montly,','); 
                $mdata[$row['registration_id']]['pre_amount'] = $amount;
     
                // other fees
                $fee_typesble = TableRegistry::get('fee_types');
                $feetype               = $fee_typesble->find('all')->hydrate(false);
                $feetype->where(['status_active'=>'Y']);
                $feetype->andwhere(['id_fee_type >'=>$feeType]);
                $ft = $feetype->toArray();
                $val = '';
                $i = 1;
                $filed = '';
                foreach($ft as $fts){
                            $filed = "fee_".$i;
                            ////end monthlly area
                            $query = $duestbl->find()->hydrate(false)
                            ->join([
                                    [   'table' => 'fee_types',
                                        'alias' => 'ft',
                                        'type' => 'INNER',
                                        'conditions' => 'ft.id_fee_type = dues.fee_type_id'
                                    ],
                                    [   'table' => 'months',
                                        'type' => 'INNER',
                                        'conditions' => 'months.id_month = dues.fee_month'
                                    ]
                                ]);

                            $query->select(['fee_type'=>'ft.fee_type_name']);
                            $query->select(['amount' => $query->func()->sum('amount'),'month'=>'months.month_name','year']);
                            $query->where(['fee_type_id'=>$feeType]);
                            $query->andwhere(['registration_id'=>$row['registration_id']]);
                            //$query->group('fee_type_id');
                            $data = $query->ToArray();
                            if($data[0]['amount']){
                            $val = $data[0]['fee_type'].'|'.$data[0]['amount'];
                            }else{
                                $val = $data[0]['fee_type'].'|0';
                            }
                            $mdata[$row['registration_id']][$filed] = $val;
                            
                            $i++;
                  }
                    
            }
            
            $table = TableRegistry::get('fee_types');
            $sql = $table->find();
            $sql->where(['id_fee_type'=>1]);
            $ft = $sql->toarray();        
            
            $data = $mdata; 
            
            $bank_details = TableRegistry::get('bank_details');
            $query               = $bank_details->find('all');
            $query->where(['active'=>'Y']);
            $bank = $query->first();
            
            
            $this->set(compact('data','dd','bank','id','ft'));
            if($flag == 6){
                $this ->render('single_fee');
            }
       }
       
    }
    
    
   public function add(){
        $due = $this->Dues->newEntity();
        if ($this->request->is('post')) {
            $due = $this->Dues->patchEntity($due, $this->request->data);
            if ($this->Dues->save($due)) {
                $this->Flash->success(__('The due has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The due could not be saved. Please, try again.'));
            }
        }
        $registrations = $this->Dues->Registrations->find('list', ['limit' => 200]);
        $classes = $this->Dues->Classes->find('list', ['limit' => 200]);
        $shifts = $this->Dues->Shifts->find('list', ['limit' => 200]);
        $sessions = $this->Dues->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('due', 'registrations', 'classes', 'shifts', 'sessions'));
        $this->set('_serialize', ['due']);
    }
   public function edit($id = null){
       $id = $this->request->data['id'];
       $amount = $this->request->data['amount'];
        $due = $this->Dues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $due = $this->Dues->patchEntity($due, $this->request->data);
            $due->amount = $amount;
            if ($this->Dues->save($due)) {
                $msg =  'Success|The due amount has been changed.';
            } else {
                $msg = 'Error|The due amount could not be cahnged. Please, try again.';
            }
        }
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
   public function delete($id = null){
        
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $due = $this->Dues->get($id);
        if ($this->Dues->delete($due)) {
            $msg =  'Success|The due has been deleted.';
        } else {
            $msg = 'Error|The due could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
   public function generatedues(){
        
        $flag = false;
        $class = $this->request->data['class'];
        $months = $this->request->data['months'];
        $feetype = $this->request->data['feehead'];
        $due_date = $this->request->data['dd'];
        
        if(!empty($this->request->data['st'])){
            $ids    = explode(',', $this->request->data['st']);
            $flag = true;
        }
       
      
        $fee_headstbl = TableRegistry::get('fee_heads');
        $studentsttbl = TableRegistry::get('students_master_details');
        $concessiontbl = TableRegistry::get('concession');
        $duestbl = TableRegistry::get('dues');
        $feestbl = TableRegistry::get('fees');
        
        $f_m = ltrim(date("m",strtotime($due_date)),'0');
        $f_y = ltrim(date("Y",strtotime($due_date)),'0');
        $f_d = ltrim(date("d",strtotime($due_date)),'0');
        
        
        
        $due_month = date("m",strtotime($due_date));
        $due_year = date("Y",strtotime($due_date));
        $due_day = date("d",strtotime($due_date));

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
        if($flag===true){
           $students->where(['registration_id IN' => $ids]);
        }else{
           $students->where(['class_id'=>$class]);
        }
        $students->andwhere(['registration.active'=>'Y']);
        $students->andwhere(['registration.doa <='=>date("Y-m-d", strtotime($due_date))]);
        $st_result = $students->ToArray();
       
       
        $i = 0;
        foreach($months as $month){
                foreach($feetype as $ft){
                $feeheads     = $fee_headstbl->find('all');
                if($flag===true){
                    $feeheads->where(['class_id'=>$st_result[$i]['class_id']]);
                }else{
                     $feeheads->where(['class_id'=>$class]);
                }
                $feeheads->andwhere(['fee_type_id'=>$ft]);
                $fee_result = $feeheads->first();
              
                if($fee_result){
                            foreach($st_result as $st_id){
                            $concession = $concessiontbl->find()->hydrate(false);
                            $concession->select(['amount','fine','from_date','to_date']);
                            $concession->where(['registration_id' => $st_id['registration_id']]);
                            $concession->andwhere(['fee_type_id' =>$ft]);
                          //  $concession->andwhere(['from_date >=' => date("Y-m-d H:i:s", strtotime($due_date)), 'to_date <=' => date("Y-m-d H:i:s", strtotime($due_date))]);
                          //  $concession->andwhere(['MONTH(from_date) >'=>date("m", strtotime($due_date))]);
                           // $concession->andwhere(['MONTH(to_date) <='=>$f_m]);
                           // $concession->andwhere(['YEAR(from_date) ='=>$f_y]);
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
                   
                            $fee_paid = $feestbl->exists(['registration_id' => $st_id['registration_id'], 'fee_month' => $month,'year'=>$f_y,'fee_type_id'=>$ft,'status'=>1]);
                            if(empty($fee_paid)){
                            $exists = $duestbl->exists(['registration_id' => $st_id['registration_id'], 'fee_month' => $month,'year'=>$f_y,'fee_type_id'=>$ft]);
                               if (empty($exists)) {
                                    $dues = $duestbl->newEntity();
                                    $dues->registration_id = $st_id['registration_id'];
                                    $dues->campus_id = $st_id['campus_id'];
                                    $dues->session_id = $st_id['session_id'];
                                    $dues->class_id = $st_id['class_id'];
                                    $dues->shift_id = $st_id['shift_id'];
                                    $dues->fee_month = $month;
                                    $dues->year = $due_year;
                                    $dues->amount =$amount;
                                    $dues->fine = $fine;
                                    $dues->fee_type_id = $ft;
                                    $fdate =   $due_year."-".$month."-1";
                                    $duedate = $due_year."-".$month."-".$due_day;
                                    $dues->fee_date =   date("Y-m-d", strtotime($fdate));
                                    $dues->due_date =   date("Y-m-d", strtotime($duedate));
                                    $dues->created_by = $this->request->session()->read('Auth.User.id');
                                    $duestbl->save($dues);
                               }
                                
                               $msg  = "Success|Fee challan has been geneated.";
                              }
                        }  
                }else{
                    $msg  = "Error|Fee Type Not Find.";
                }
             $i++;    
            }
        }
        
        
        $query   = $duestbl->find()->contain(['months','fee_types','registration','classes_sections','shift','session','campuses']);
        $query->select(['f_date'=>'date_format(dues.fee_date,"%d-%m-%Y %H:%i")']);
        $query->select(['id_dues','year','amount','reg_id'=>'registration.id_registration']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
        $query->select(['name'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['amount' => 'amount','fine']);
      
        if($flag === true){
           $query->where(['registration.id_registration IN' => $ids]);
        }else{
           $query->where(['class_id'=>$class]);
        }
        
        $query->andwhere(['fee_month'=>$month]);
        $query->andwhere(['registration.active'=>'Y']);
        $query->hydrate(false);
        $data = $query->ToArray();
       
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
        
    }
   public function getdues(){
        $class = $this->request->data['class'];
      
        $duestbl = TableRegistry::get('dues');
        $query = $duestbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'classes_sections',
                                'alias' => 'cs',
                                'type' => 'INNER',
                                'conditions' => 'cs.id_class = dues.class_id'
                            ],
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = dues.registration_id'
                            ],
                            [   'table' => 'shift',
                                'alias' => 'shift',
                                'type' => 'INNER',
                                'conditions' => 'shift.id_shift = dues.shift_id'
                            ]
                        ]);
         
         $query->select(['shift'=>'shift.shift_name']);
         $query->select(['amount' => $query->func()->sum('amount'),'class_id'=>'cs.id_class','class'=>'cs.class_name']);
         $query->group(['cs.class_name','shift.shift_name']);
         $query->where(['active'=>'Y']);
         $query->andwhere(['class_id' => $class ]);
         if($this->request->session()->read('Auth.User.role_id')!==1){
            $query->andwhere(['campus_id' => $this->request->session()->read('Auth.User.campus_id')]);    
         }
        
       
        $data = $query->ToArray();
       
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
        
    }
   public function defaultersreport(){
        
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
 
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
        
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        $this->set(compact('class','campus','feetype','months'));
        $this->set('_serialize', ['class','campus','feetype','months']);
    }
   public function duesslip(){
        
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
 
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
         
        $feeHeadstable = TableRegistry::get('fee_heads');
        
        $FeeeHead = $feeHeadstable->find('all');
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        $this->set(compact('class','campus','feetype','months'));
        $this->set('_serialize', ['class','campus','feetype','months']);
        
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
            $orderby = 'id_dues';
            $orderdir = 'asc';
        }
       // $status =  $this->request->data['status'];
        if(!empty($this->request->data['cc'])){
            $ids    = explode(',', $this->request->data['cc']);
           
        }
       
        if (isset($this->request->data['name'])) {
            $name =  $this->request->data['name'];
        }
        if (isset($this->request->data['shift_id'])) {
            $shift =  $this->request->data['shift_id'];
        }
        if (isset($this->request->data['class_id'])) {
            $class =  $this->request->data['class_id'];
        }
         
        $duestbl =   $feeHeadstable = TableRegistry::get('dues');
        $query   = $duestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses']);
        $query->select(['f_date'=>'date_format(dues.fee_date,"%d-%m-%Y %H:%i")']);
        $query->select(['id_dues','year','amount','reg_id'=>'registration.id_registration','img'=>'registration.image']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
        $query->select(['name'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['nom' => $query->func()->count('fee_month')]);
        $query->select(['amount' => $query->func()->sum('amount'),'fine']);
        $query->group('registration_id');
      
        $recordsTotal = $query->count();
        
        $query->where(['registration.active'=>'Y']);
        
        if (!empty($ids)) {
           $query->andwhere(['registration.id_registration IN' =>$ids]);
        }
       
        if (!empty($name)) {
           $query->andwhere(['registration.student_name LIKE' =>'%' .$name. '%']);
        }
        if (!empty($class)) {
           $query->andwhere(['class_id' =>$class]);
        }
        if (!empty($shift)) {
           $query->andwhere(['shift_id' =>$shift]);
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
            $hostname = $this->url()."img/students_images/".$dat['img']; 
            $actions = array('actions' => "<button id='".'id'.$dat['reg_id']."' onclick='javascript:loadmodal(" . $dat['reg_id'] . ")' class='btn btn-icon waves-effect waves-light btn-warning m-b-5'><i class='fa fa-eye'></i> View</button> <button onclick='javascript:loadmodalsms(" . $dat['reg_id'] . ")' class='btn btn-icon waves-effect waves-light btn-info m-b-5'><i class='fa fa-envelope'></i> Send SMS</button>",'host'=>$hostname);
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
    
    
    public function getduesdetails($id = null){
        
        $id = $this->request->data['id'];
        
        $duestbl =   $feeHeadstable = TableRegistry::get('dues');
        $query   = $duestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses']);
        $query->select(['f_date'=>'date_format(dues.fee_date,"%d-%m-%Y %H:%i")']);
        $query->select(['id_dues','year','amount','reg_id'=>'registration.id_registration']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
        $query->select(['name'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['amount','fine']);
        $query->where(['registration_id'=>$id]);
      //  $query->where(['amount >'=> 0]);
        $query->hydrate(false);
        $data = $query->ToArray();
        $msg = "Success|Records found";
        
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
    
        
    }
    
     public function sendsms($flag = null){
     
        $file =  WWW_ROOT."download/csv_sample.txt";
        $class  = $this->request->data['class_id'];
        $shift  = $this->request->data['shift_id'];
        $message = $this->request->data['message'];
        $id = $this->request->data['reg_id'];
       
        $date = date("Y-m-d");
        $duestbl =   $feeHeadstable = TableRegistry::get('dues');
        $query   = $duestbl->find('all')->contain(['months','fee_types','registration','classes_sections','shift','session','campuses']);
        $query->select(['f_date'=>'date_format(dues.fee_date,"%d-%m-%Y %H:%i")']);
        $query->select(['id_dues','year','amount','reg_id'=>'registration.id_registration']);
        $query->select(['month_id'=>'months.month_name','type_id'=>'fee_types.fee_type_name']);
        $query->select(['sname'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['cell'=>'registration.contact1','cell1'=>'registration.contact2','cell2'=>'registration.contact2']);
        
        $query->select(['nom' => $query->func()->count('fee_month')]);
        $query->select(['amount' => $query->func()->sum('amount'),'fine']);
        $query->group('registration_id');
        $query->where(['registration.active'=>'Y']);
        $query->andwhere(['amount >'=> 0]);
        
        if($flag ==0){
            if($class > 0){
                $query->andwhere(['class_id'=>$class]);
            }
            if($shift > 0){
                $query->andwhere(['shift_id'=>$shift]);
            }
        }elseif($flag ==1){
           $query->andwhere(['registration_id'=>$id]);
        
        }
        
        $data = $query->toArray();
        $handle = fopen ($file, "w+");
        fclose($handle);
    
       // get id by session     
       $msg_status = 3;
            
        if($msg_status ==1){ /// Guardian  
            
                    foreach($data as $row){
                       if($row['cell1'] > 0){ 
                           $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].','.$row['fname'].','.$row['amount'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==2){ // students
            
                    foreach($data as $row){
                       if($row['cell2'] > 0){ 
                           $contents = '92'.ltrim($row['cell2'],'0').','.$row['sname'].','.$row['fname'].','.$row['amount'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==3){
            
                    foreach($data as $row){
                       if($row['cell'] > 0){ 
                           $contents = '92'.ltrim($row['cell'],'0').','.$row['sname'].','.$row['fname'].','.$row['amount'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==4){  // all
            
                    foreach($data as $row){
                       if($row['cell1'] > 0){ 
                           $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].','.$row['fname'].','.$row['amount'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($data as $row){
                       if($row['cell2'] > 0){ 
                           $contents = '92'.ltrim($row['cell2'],'0').','.$row['sname'].','.$row['fname'].','.$row['amount'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($data as $row){
                       if($row['cell'] > 0){ 
                           $contents = '92'.ltrim($row['cell'],'0').','.$row['sname'].','.$row['fname'].','.$row['amount'].PHP_EOL;
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
        
        $msg  = "Success|Messages has been send.";
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
 
        
    }
    
    
    public function editfee($id = null){
        
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post']);
        $due = $this->Dues->get($id);
        if ($this->Dues->delete($due)) {
            $msg =  'Success|The due amount has been changed.';
        } else {
            $msg = 'Error|The due amount could not be cahnged. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
}
