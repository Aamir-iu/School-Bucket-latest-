<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use App\Controller\AppController;

/**
 * ExamTypes Controller
 *
 * @property \App\Model\Table\ExamTypesTable $ExamTypes
 */
class ExamTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $examTypes = $this->paginate($this->ExamTypes);

        $this->set(compact('examTypes'));
        $this->set('_serialize', ['examTypes']);
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','view'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    public function view($flag = null ,$class_id = null ,$shift_id = null, $exam_type_id = null, $session_id = null, $shift_name=null ,$id_exam=null){
         
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
            
            $Subjects = $Exam_table->find()->having()
                     ->join([
                            [   'table' => 'subjects',
                                'type' => 'INNER',
                                'conditions' => 'subjects.id_subjects = exam_marks_details.subject_id'
                            ]

                        ]);
            
            $Subjects->select(['subject'=>'subjects.short_name','max_marks']);
            $Subjects->select(['sub_desc'=>'subjects.subject_desc']);
            $Subjects->where(['exam_marks_details.class_id'=>$class_id]);
            $Subjects->andwhere(['exam_type_id'=>$exam_type_id]);
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
            $query->andwhere(['exam_type_id'=>$exam_type_id]);
            $query->andwhere(['exam_results.session_id'=>$session_id]);
            $query->hydrate(false);
            $topstudents = $query->toArray();
            
           
            $this->set(compact('topstudents','shift_name'));
            $this ->render('top_students');  
            
        }
        elseif($flag == 3){
           
            $table = TableRegistry::get('exam_results');
            $sql = $table->find();
            $sql->select(['per'=> $sql->func()->max('per')]);
            $sql->where(['exam_results.class_id'=>$class_id]);
            $sql->andwhere(['exam_results.shift_id'=>$shift_id]);
            $sql->andwhere(['exam_type_id'=>$exam_type_id]);
            $sql->andwhere(['exam_results.session_id'=>$session_id]);
            $HP = $sql->first();
           
            
            $this->generateRank($class_id,$shift_id,$exam_type_id,$session_id);
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
            $query->orderDesc('students_master_details.roll_no');
            
           
            $query->where(['exam_results.class_id'=>$class_id]);
            $query->andwhere(['exam_results.shift_id'=>$shift_id]);
            $query->andwhere(['exam_type_id'=>$exam_type_id]);
            $query->andwhere(['exam_results.session_id'=>$session_id]);
            $out_of = count($query->toArray());
            
            if(!empty($id_exam)){
               $query->andwhere(['exam_results.registration_id'=>$id_exam]);
            }

           
            $query->hydrate(false);
            $res = $query->toArray();
           
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
                $query->select(['fmm','fpm','fom','tmm','tpm']);
                $query->where(['exam_result_id'=>$row['id_exam']]);
                $query->orderDesc('order_id');
                $ressult = $query->toArray();

                if($ressult){
                    $arr = array('exam_details'=>$ressult);
                }else{
                    $arr = array('exam_details'=>'');
                }
                
                $query = $GO_table->find()->hydrate(false);
                $query->where(['session_id'=>$row['session_id']]);
                $query->andwhere(['exam_type_id'=>$row['exam_type_id']]);
                $query->andwhere(['registration_id'=>$row['registration_id']]);
                $general_observation = $query->toArray();

                if($general_observation){
                    $arrgo = array('generalObservation'=>$general_observation);
                }else{
                    $arrgo = array('generalObservation'=>'');
                }
                array_push($data, array_merge($row, $arr,$arrgo));
                
                   
            }
          
            $shift_name  = str_replace("00","-",$shift_name);
            $this->set(compact('data','out_of','shift_name','HP'));
            
            $query = $tempalteTble->find()->hydrate(false);
            $query->where(['status'=>'Active']);
            $temp = $query->first();
      
            if($temp){
                    switch ($temp['id_result_card_template']) {
                    case "0":
                        $this->render('templete_1'); 
                        break;     
                    case "1":
                        $this->render('templete_1'); 
                        break;    
                    case "2":
                        $this->render('standard'); 
                        break;
                    case "3":
                        $this->render('result_card_mid_term'); 
                        break;
                    case "4":
                        $this->render('mid__term__examination'); 
                        break;
                    case "5":
                        $this->render('project_report'); 
                        break;
                    case "6":
                        $this->render('mid_term_test'); 
                        break;
                    case "7":
                        $this->render('result_card_mid_term_1'); 
                        break;
                    default:
                       $this->render('standard'); 
                    }
            }
           
        }
        
    }
    
      public function generateRank($class_id = null, $shift_id = null , $exam_type_id=null, $session_id=null){
        

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
            }elseif($i == 31){
                $rank = $i."st";
            }elseif($i == 41){
                $rank = $i."st";
            }elseif($i == 51){
                $rank = $i."st";
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
//        $msg  = "Success|Students rank has been generated";
//        $this->set(compact('msg'));
//        $this->set('_serialize', ['msg']);
    }
    
    public function add()
    {
        $examType = $this->ExamTypes->newEntity();
        if ($this->request->is('post')) {
            $examType = $this->ExamTypes->patchEntity($examType, $this->request->data);
            if ($this->ExamTypes->save($examType)) {
                $this->Flash->success(__('The exam type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam type could not be saved. Please, try again.'));
        }
        $this->set(compact('examType'));
        $this->set('_serialize', ['examType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exam Type id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $examType = $this->ExamTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $examType = $this->ExamTypes->patchEntity($examType, $this->request->data);
            if ($this->ExamTypes->save($examType)) {
                $this->Flash->success(__('The exam type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam type could not be saved. Please, try again.'));
        }
        $this->set(compact('examType'));
        $this->set('_serialize', ['examType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exam Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $examType = $this->ExamTypes->get($id);
        if ($this->ExamTypes->delete($examType)) {
            $this->Flash->success(__('The exam type has been deleted.'));
        } else {
            $this->Flash->error(__('The exam type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
