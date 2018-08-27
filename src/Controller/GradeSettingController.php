<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * GradeSetting Controller
 *
 * @property \App\Model\Table\GradeSettingTable $GradeSetting
 */
class GradeSettingController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $gradeSetting = $this->GradeSetting->find();
        $gradeSetting =  $gradeSetting->toArray();
        
        $this->set(compact('gradeSetting'));
        $this->set('_serialize', ['gradeSetting','generateRankCumulative']);
    }

   
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','edit','view','cumulativeResult','rolls'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }

        return parent::isAuthorized($user);
    }
    
    
    
    public function view($flag = null ,$class_id = null ,$shift_id = null, $exam_type_id = null,$session_id  = null, $shift_name=null ,$id_exam=null){
        //echo $exam_type_id;exit; 
        
        $table = TableRegistry::get('students_master_details');
        $Exam_table = TableRegistry::get('exam_marks_details');
        $tempalteTble = TableRegistry::get('exam_result_card_templates');
        if($flag == 0){
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
            $registration->andwhere(['registration.active'=>'Y']);

            $this->set(compact('registration','shift_name'));
            $this->set('_serialize', ['registration']);
        }
        elseif($flag == 1){
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
            $registration->andwhere(['registration.active'=>'Y']);
            
            $Subjects = $Exam_table->find()->hydrate(false)
                     ->join([
                            [   'table' => 'subjects',
                                'type' => 'INNER',
                                'conditions' => 'subjects.id_subjects = exam_marks_details.subject_id'
                            ]

                        ]);
            
            $Subjects->select(['subject'=>'subjects.short_name','max_marks']);
            $Subjects->select(['sub_desc'=>'subjects.subject_desc']);
            $Subjects->where(['exam_marks_details.class_id'=>$class_id]);
            $Subjects->andwhere(['exam_marks_details.exam_type_id'=>$exam_type_id]);
            $Subjects->orderAsc('exam_marks_details.order_id');
            $subjectDetails = $Subjects->toArray();
         
            $this->set(compact('registration','','subjectDetails','shift_name'));
            $this ->render('blank_tabulation');  
        }
        elseif($flag == 2){
            $this->generateRank($class_id,$shift_id,$session_id,$exam_type_id);
            $table = TableRegistry::get('exam_results');
            $query = $table->find()
                    ->join([
                                [   'table' => 'registration',
                                    'alias' => 'registration',
                                    'type' => 'INNER',
                                    'conditions' => 'registration.id_registration = exam_results.registration_id'
                                ],
                                [   'table' => 'classes_sections',
                                    'alias' => 'SS',
                                    'type' => 'INNER',
                                    'conditions' => 'SS.id_class = exam_results.class_id'
                                ],
                                [   'table' => 'shift',
                                    'type' => 'INNER',
                                    'conditions' => 'shift.id_shift = exam_results.shift_id'
                                ],
                                [   'table' => 'students_master_details',
                                    'type' => 'INNER',
                                    'conditions' => 'students_master_details.registration_id = exam_results.registration_id'
                                ]
                            ]);

            $query->select(['id_exam','registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
            $query->select(['class'=>'SS.class_name','shift'=>'shift.shift_name','exam_results.class_id','exam_results.shift_id','exam_type_id','exam_results.session_id']);
            $query->select(['total_marks','obtain_marks','per','grade','rank'=>'no_of_rank','result','remarks','roll'=>'students_master_details.roll_no','gr_no'=>'registration.gr']);
            $query->select(['att','out_of','no_of_rank']);
            $query->orderDesc('per');
            $query->limit(10);
           // $query->where(['registration_id'=>$reg_id]);
            $query->where(['exam_results.class_id'=>$class_id]);
            $query->andwhere(['exam_results.shift_id'=>$shift_id]);
            $query->andwhere(['exam_type_id'=>$session_id]);
            $query->andwhere(['exam_results.session_id'=>$exam_type_id]);
            //echo $session_id;exit();
            $query->hydrate(false);
            $topstudents = $query->toArray();
            
           
            $this->set(compact('topstudents','shift_name'));
            $this ->render('top_students');  
            
        }
        elseif($flag == 3){  // result card printing area
            
            $table = TableRegistry::get('exam_results');
            $sql = $table->find();
            $sql->select(['per'=> $sql->func()->max('per')]);
            $sql->where(['exam_results.class_id'=>$class_id]);
            $sql->andwhere(['exam_results.shift_id'=>$shift_id]);
            $sql->andwhere(['exam_type_id'=>$exam_type_id]); //$exam_type_id
            $sql->andwhere(['exam_results.session_id'=>$session_id]);
            $HP = $sql->first();
            
            
            $this->generateRank($class_id,$shift_id,$session_id,$exam_type_id);
            $table = TableRegistry::get('exam_results');
            $query = $table->find()
                    ->join([
                                [   'table' => 'registration',
                                    'alias' => 'registration',
                                    'type' => 'INNER',
                                    'conditions' => 'registration.id_registration = exam_results.registration_id'
                                ],
                                [   'table' => 'classes_sections',
                                    'alias' => 'SS',
                                    'type' => 'INNER',
                                    'conditions' => 'SS.id_class = exam_results.class_id'
                                ],
                                [   'table' => 'shift',
                                    'type' => 'INNER',
                                    'conditions' => 'shift.id_shift = exam_results.shift_id'
                                ],
                                [   'table' => 'students_master_details',
                                    'type' => 'INNER',
                                    'conditions' => 'students_master_details.registration_id = exam_results.registration_id'
                                ],
                                [   'table' => 'exam_types',
                                    'type' => 'INNER',
                                    'conditions' => 'exam_types.id_exam_types = exam_results.exam_type_id'
                                ]
                            ]);

            $query->select(['id_exam','registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
            $query->select(['class'=>'SS.class_name','shift'=>'shift.shift_name','exam_results.class_id','exam_results.shift_id','exam_type_id','exam_results.session_id']);
            $query->select(['total_marks','obtain_marks','per','grade','rank'=>'no_of_rank','result','remarks','roll'=>'students_master_details.roll_no','gr_no'=>'registration.gr']);
            $query->select(['att','out_of','no_of_rank','exam_type'=>'exam_types.exam_type','created_by','img'=>'registration.image','dob'=>'registration.dob']);
            $query->select(['test_om','test_mm','cum_no_of_rank']);
            $query->orderAsc('exam_results.registration_id');
            
            
            $query->where(['exam_results.class_id'=>$class_id]);
            $query->where(['exam_results.shift_id'=>$shift_id]);
            $query->andwhere(['exam_results.exam_type_id'=>$exam_type_id]);
            $query->andwhere(['exam_results.session_id'=>$session_id]);
            $out_of = count($query->toArray());
            
            if(!empty($id_exam)){
               $query->andwhere(['exam_results.id_exam'=>$id_exam]);
            }
           
            $query->hydrate(false);
            $res = $query->toArray();
            
            $query = $tempalteTble->find()->hydrate(false);
            $query->where(['status'=>'Active']);
            $temp = $query->first();
            
            $data= array();
            $table = TableRegistry::get('exam_result_detail');
            $GO_table = TableRegistry::get('exam_result_go');
            foreach($res as $row){
        
               
                $query = $table->find()->hydrate(false)->join([
                                [   'table' => 'subjects',
                                    'type' => 'INNER',
                                    'conditions' => 'subjects.id_subjects = exam_result_detail.subject_id'
                                ]
                            ]);
                $query->select(['subject_id','subject'=>'exam_result_detail.subject_name','max_marks'=>'mm','min_marks'=>'pm','order_id'=>'sub_order_id']);
                $query->select(['test_obtain_marks','obtain_marks','total_obtain_marks','sub_desc'=>'subjects.short_name','sub_type'=>'subjects.subject_desc']);
                $query->where(['exam_result_id'=>$row['id_exam']]);
                $query->orderAsc('order_id');
                $ressult = $query->toArray();

                if($ressult){
                    $arr = array('exam_details'=>$ressult);
                }else{
                    $arr = array('exam_details'=>'');
                }


                $query = $GO_table->find()->hydrate(false);
                $query->where(['session_id'=>$row['session_id']]);
                $query->andwhere(['exam_type_id'=>1]); /// mid term
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $general_observation = $query->toArray();

                
                $query = $GO_table->find()->hydrate(false);
                $query->where(['session_id'=>$row['session_id']]);
                $query->andwhere(['exam_type_id'=>$row['exam_type_id']]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $general_observationFinal = $query->toArray();

                if($general_observation){
                    $arrgo = array('generalObservation'=>$general_observation);
                }else{
                    $arrgo = array('generalObservation'=>'');
                }

                if($general_observationFinal){
                    $arrgo2 = array('generalObservationFinal'=>$general_observationFinal);
                }else{
                    $arrgo2 = array('generalObservationFinal'=>'');
                }


                $rs = '';

               if($temp['id_result_card_template'] == 8   && $exam_type_id == 3){
                
                    // 1st term
                   $tableR = TableRegistry::get('exam_results');
                   $sql = $tableR->find()->contain(['exam_result_detail'])->hydrate(false);
                   $sql->select($tableR);
                   $sql->select(['pre_om'=>'obtain_marks']);
                   $sql->where(['exam_results.registration_id'=>$row['registration_id']]);
                   $sql->andwhere(['exam_results.exam_type_id'=>1]);
                   //$sql->orderAsc('sub_order');
                   $pre_ressult = $sql->toArray();

                   if($pre_ressult){
                       $rs = array('preResult'=>$pre_ressult);
                   }else{
                       $rs = array('preResult'=>$pre_ressult);
                   }


                   // 2nd  term
                   $sql = $tableR->find()->contain(['exam_result_detail'])->hydrate(false);
                   $sql->select($tableR);
                   $sql->select(['pre_om'=>'obtain_marks']);
                   $sql->where(['exam_results.registration_id'=>$row['registration_id']]);
                   $sql->andwhere(['exam_results.exam_type_id'=>2]);
                   //$sql->orderAsc('sub_order');
                   $sec_ressult = $sql->toArray();

                   if($sec_ressult){
                       $sec = array('secResult'=>$sec_ressult);
                   }else{
                       $sec = array('secResult'=>$sec_ressult);
                   }

               }

                if($rs == ''){
                    $rs = array();
                }
                //$sec = array();
                /*if($sec == ''){
                    $sec = array();
                }*/

                array_push($data, array_merge($row, $arr,$arrgo,$rs,$arrgo2));
                   
            }
            

            if(empty($data)){
                die("Sorry no result found.");
            }
            
            $shift_name  = str_replace("00","-",$shift_name);
            $this->set(compact('data','out_of','shift_name','HP'));
            
            
            if($temp){
                    switch ($temp['id_result_card_template']) {
                    case "0":
                        $this->render('test_marksheet');   // Temp #1
                        break;     
                    case "1":
                        $this->render('basic');  // Temp #2
                        break;    
                    case "2":
                        $this->render('standard');  // Temp #3
                        break;
                    case "3":
                        $this->render('result_card_mid_term');  // Temp #4
                        break;
                    case "4":
                        $this->render('mid__term__examination');  // Temp #5
                        break;
                    case "5":
                        $this->render('project_report'); // Temp #6
                        break;
                    case "6":
                        $this->render('mid_term_test'); // Temp #7
                        break;
                    case "7":
                        $this->render('result_card_mid_term_1');  // Temp #8
                        break;
                    case "8":
                        $this->render('temp_8');  // Temp #9
                        break;
                    case "11":
                        $this->render('temp_10');  // Temp #10
                        break;
                    default:
                       $this->render('standard'); 
                    }
            }
           
        }
        
    }

  
    public function generateRank($class_id = null, $shift_id = null , $session_id=null, $exam_type_id=null){
        

        $table = TableRegistry::get('exam_results');
        $query = $table->find()->hydrate(false);
        $query->group('per');
        $query->orderDesc('per');
        
        $query->where(['class_id'=>$class_id]);
        $query->andwhere(['shift_id'=>$shift_id]);
        $query->andwhere(['exam_type_id'=>$exam_type_id]);
        $query->andwhere(['session_id'=>$session_id]);
        $query->andwhere(['rank'=>'True']);
      //  $query->andwhere(['grade NOT'=>'F']);
        
        $data =$query->toArray();
        $i = 1;
        $rank = '';
        foreach($data as $row){
            
            if($i ==1){
                $rank = $i."st";
            }elseif($i==2){
                $rank = $i."nd";
            }elseif($i==3){
                $rank = $i."rd";
            }elseif($i == 21){
                $rank = $i."st";
            }elseif($i == 22){
                $rank = $i."nd";
            }elseif($i == 23){
                $rank = $i."rd";
            }elseif($i == 31){
                $rank = $i."st";
            }elseif($i == 32){
                $rank = $i."nd";
            }elseif($i == 33){
                $rank = $i."rd";    
            }elseif($i == 41){
                $rank = $i."st";
            }elseif($i == 42){
                $rank = $i."nd";
            }elseif($i == 43){
                $rank = $i."rd";    
            }elseif($i == 51){
                $rank = $i."st";
            }elseif($i == 52){
                $rank = $i."nd";
            }elseif($i == 53){
                $rank = $i."rd";    
            }else{
                $rank = $i."th";
            }
            
     
            $query = $table->query();
            $query->update()
            ->set(['no_of_rank' => $rank])
            ->where(['class_id'=>$class_id])
            ->andwhere(['shift_id'=>$shift_id])
            ->andwhere(['exam_type_id'=>$exam_type_id])
            ->andwhere(['session_id'=>$session_id])
            ->andwhere(['rank'=>'True'])
            ->andwhere(['per'=>$row['per']])
            ->execute(); 
            
            $i++;
            
        }
        
        return true;
     
    }
    
    public function add()
    {
        $gradeSetting = $this->GradeSetting->newEntity();
        if ($this->request->is('post')) {
            $gradeSetting = $this->GradeSetting->patchEntity($gradeSetting, $this->request->data);
            if ($this->GradeSetting->save($gradeSetting)) {
                $this->Flash->success(__('The grade setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grade setting could not be saved. Please, try again.'));
        }
        $this->set(compact('gradeSetting'));
        $this->set('_serialize', ['gradeSetting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grade Setting id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gradeSetting = $this->GradeSetting->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gradeSetting = $this->GradeSetting->patchEntity($gradeSetting, $this->request->data);
            if ($this->GradeSetting->save($gradeSetting)) {
                $this->Flash->success(__('The grade setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grade setting could not be saved. Please, try again.'));
        }
        
        $this->set(compact('gradeSetting'));
        $this->set('_serialize', ['gradeSetting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grade Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gradeSetting = $this->GradeSetting->get($id);
        if ($this->GradeSetting->delete($gradeSetting)) {
            $this->Flash->success(__('The grade setting has been deleted.'));
        } else {
            $this->Flash->error(__('The grade setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function cumulativeResult($f,$class_id,$shift_id,$session_id,$exam_type_id){

        $table = TableRegistry::get('exam_results');
        $query  = $table->find()->hydrate(false);
        $query->where(['class_id'=>$class_id]);
        $query->andwhere(['shift_id'=>$shift_id]);
        $query->andwhere(['exam_type_id'=>1]);
        $query->andwhere(['session_id'=>$session_id]);
        $rs = $query->toArray();

        foreach($rs as $row){

            $query  = $table->find()->hydrate(false);
            $query->where(['class_id'=>$class_id]);
            $query->andwhere(['shift_id'=>$shift_id]);
            $query->andwhere(['exam_type_id'=>2]);
            $query->andwhere(['session_id'=>$session_id]);
            $query->andwhere(['registration_id'=>$row['registration_id']]);
            $res = $query->toArray();

            foreach($res as $dat){

                   $total_exam2 =  $dat['total_marks']; 
                   $total_exam1 =  $row['total_marks']; 

                   $obtain_exam2 =  $dat['obtain_marks']; 
                   $obtain_exam1 =  $row['obtain_marks']; 

                   $rank_exam2 =  $dat['rank']; 
                   $rank_exam1 =  $row['rank']; 

                   $total = $total_exam2 + $total_exam1;
                   $obtain = $obtain_exam2 + $obtain_exam1;

                   $per = round($obtain / $total * 100,2);

                   if($rank_exam2 === "True" &&  $rank_exam1 === "True"){
                        $cum_rank = 'True';
                   }else{
                        $cum_rank = 'False';
                   }
                   
                    $query = $table->query();
                    $query->update()
                    ->set(['cum_per' => $per,'cum_rank'=>$cum_rank])
                    ->where(['registration_id' => $row['registration_id']])
                    ->execute();
            } 

        }
        $this->generateRankCumulative($class_id,$shift_id,$session_id,$exam_type_id);
        $msg = "Success|Cumulative Generated";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }


    public function generateRankCumulative($class_id = null, $shift_id = null , $session_id=null, $exam_type_id=null){
        

        $table = TableRegistry::get('exam_results');
        $query = $table->find()->hydrate(false);
        $query->group('cum_per');
        $query->orderDesc('cum_per');
        
        $query->where(['class_id'=>$class_id]);
        $query->andwhere(['shift_id'=>$shift_id]);
        //$query->andwhere(['exam_type_id'=>$exam_type_id]);
        $query->andwhere(['session_id'=>$session_id]);
        $query->andwhere(['cum_rank'=>'True']);
      
        
        $data =$query->toArray();
        $i = 1;
        $rank = '';
        foreach($data as $row){
            
            if($i ==1){
                $rank = $i."st";
            }elseif($i==2){
                $rank = $i."nd";
            }elseif($i==3){
                $rank = $i."rd";
            }elseif($i == 21){
                $rank = $i."st";
            }elseif($i == 22){
                $rank = $i."nd";
            }elseif($i == 23){
                $rank = $i."rd";
            }elseif($i == 31){
                $rank = $i."st";
            }elseif($i == 32){
                $rank = $i."nd";
            }elseif($i == 33){
                $rank = $i."rd";    
            }elseif($i == 41){
                $rank = $i."st";
            }elseif($i == 42){
                $rank = $i."nd";
            }elseif($i == 43){
                $rank = $i."rd";    
            }elseif($i == 51){
                $rank = $i."st";
            }elseif($i == 52){
                $rank = $i."nd";
            }elseif($i == 53){
                $rank = $i."rd";    
            }else{
                $rank = $i."th";
            }
            
     
            $query = $table->query();
            $query->update()
            ->set(['cum_no_of_rank' => $rank])
            ->where(['class_id'=>$class_id])
            ->andwhere(['shift_id'=>$shift_id])
            //->andwhere(['exam_type_id'=>$exam_type_id])
            ->andwhere(['session_id'=>$session_id])
            ->andwhere(['cum_rank'=>'True'])
            ->andwhere(['cum_per'=>$row['cum_per']])
            ->execute(); 
            
            $i++;
            
        }
        
        return true;
     
    }


    public function rolls(){

        $class_id = $this->request->data['class_id'];
        $shift_id = $this->request->data['shift_id'];
        $session_id = $this->request->data['session_id'];
        $exam_type_id = $this->request->data['exam_type_id'];

        
        $table = TableRegistry::get('exam_results');
        $table_master = TableRegistry::get('students_master_details');

        $query = $table->find()->hydrate(false);
        $query->select(['per','registration_id','grade']);
        //$query->group('cum_per');
        $query->orderDesc('per');
        
        $query->where(['class_id'=>$class_id]);
        $query->andwhere(['shift_id'=>$shift_id]);
        $query->andwhere(['exam_type_id'=>$exam_type_id]);
        $query->andwhere(['session_id'=>$session_id]);
      
        $data =$query->toArray();
        $i = 1;
        $roll_no = '';
        foreach($data as $row){
            
            if($row['grade'] === 'F'){
                $roll_no = 0;
                $query = $table_master->query();
                $query->update()
                ->set(['roll_no' => $roll_no])
                ->where(['registration_id'=>$row['registration_id']])
                ->execute(); 
            }else{

                $roll_no = $i;
                 $query = $table_master->query();
                $query->update()
                ->set(['roll_no' => $roll_no])
                ->where(['registration_id'=>$row['registration_id']])
                ->execute(); 
                $i++;
            }
               
        }
      
        $msg = "Success|Updated";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }



}
