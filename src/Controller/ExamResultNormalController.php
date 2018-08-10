<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use App\Controller\AppController;

/**
 * ExamResultNormal Controller
 *
 * @property \App\Model\Table\ExamResultNormalTable $ExamResultNormal
 */
class ExamResultNormalController extends AppController
{

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','Resultsgenerate','generateResultsClick','addMarks','addMarksDetails','view','getbysearch'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
 


    public function index()
    {
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        
        $classesbl = TableRegistry::get('classes_sections');
        $class_name = $classesbl->find('all');
        
        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
        
        $sessionTable = TableRegistry::get('session');
        $sess = $sessionTable->find('all')->hydrate(false)->toArray();
       
        $campusesbl = TableRegistry::get('campuses');
        $campuses = $campusesbl->find('all');
        
        $exam_typesbl = TableRegistry::get('exam_types');
        $ExamTypes = $exam_typesbl->find('all');
      
        $grade_settingsbl = TableRegistry::get('grade_setting');
        $grades = $grade_settingsbl->find('all');
        $grades = $grades->toArray();
        
        $card_tempalte = TableRegistry::get('exam_result_card_templates');
        $card_temp = $card_tempalte->find('all');
        $card_template = $card_temp->toArray();

        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
        
        
        //$link = $this->url()."download/csv_sample.csv";
        
        
       $this->set(compact('ExamResults','classes','session','campuses','feetype'
                          ,'class_name','subjects','getMarks','ExamTypes','grades','card_template','sess','link'));

    }

    
     public function view($flag,$class_id,$shift_id,$exam_type_id,$session_id,$session_name=null,$registration_id=null)
    {

        if($flag == '0'){
           
        $table = TableRegistry::get('students_master_details');
        $Exam_table = TableRegistry::get('exam_marks_details');
        $ResultTable = TableRegistry::get('exam_result_normal');
        $Subjects = $Exam_table->find()->hydrate(false);
        $Subjects->select(['min_marks']);
        $Subjects->where(['class_id'=>$class_id]);
        $Subjects->andwhere(['exam_type_id'=>$exam_type_id]);
        //$Subjects->orderAsc('registration_id');

        $subjectDetails = $Subjects->first();
        $min_marks =  $subjectDetails['min_marks'];
        $query = $ResultTable->find()->hydrate(false);
        $query->select(['registration_id']);
        $query->distinct(['registration_id']);
        $query->where(['class_id'=>$class_id]);
        $query->andwhere(['exam_type_id'=>$exam_type_id]);
        $query->where(['obtained_marks < '=>$min_marks]);
        $students = $query->ToArray();
        
       // foreach($students as $row){
        
          //  $query = $ResultTable->query();
          //  $query->update()
          //  ->set(['rank' => 'False','grade'=>'F'])
          //  ->where(['registration_id'=>$row['registration_id']])
          //  ->execute();

       // }
        
        $this->generateRank($class_id,$shift_id,$session_id,$exam_type_id);
        if($flag == 0){
            $registration = $ResultTable->find()->contain(['Registration','classes_sections','Shift'])->hydrate(false);
            $registration->select($ResultTable);
            $registration->select(['s_name'=>'Registration.student_name','f_name'=>'Registration.father_name']);
            $registration->select(['class_name'=>'classes_sections.class_name']);
            $registration->select(['grno'=>'Registration.gr','shift'=>'shift_name','img'=>'Registration.image']);
            $query->distinct('exam_result_normal.registration_id');
            
            
            $registration->where(['class_id'=>$class_id]);
            $registration->andwhere(['shift_id'=>$shift_id]);
            $registration->andwhere(['Registration.active'=>'Y']); 
            $out_of = count($registration->toArray()); 
            if($registration_id > 0){
                $registration->where(['Registration.id_registration'=>$registration_id]);
            }
            $rs = $registration->ToArray();
            //echo "<pre>";
            //print_r($rs);
            //exit();
            $GO_table = TableRegistry::get('exam_result_go');
            $data = array();
            foreach($rs as $row){
                    $query =  $ResultTable->find()->hydrate(false)
                        ->join([
                                [   'table' => 'subjects',
                                    'type' => 'INNER',
                                    'conditions' => 'subjects.id_subjects = exam_result_normal.subject_id'
                                ],
                                [   'table' => 'exam_types',
                                    'type' => 'INNER',
                                    'conditions' => 'exam_types.id_exam_types = exam_result_normal.exam_type_id'
                                ]
                            ]);
                    $query->select($ResultTable);   
                   // $query->distinct('exam_result_normal.registration_id');
                    $query->select(['subject'=>'subjects.subject_name','sub_desc'=>'subjects.subject_desc']);  
                    $query->where(['class_id'=>$class_id]);

                    $query->andwhere(['shift_id'=>$shift_id]);
                    $query->andwhere(['exam_type_id'=>$exam_type_id]);
                    $query->andwhere(['registration_id'=>$row['registration_id']]); 
                    $query->orderAsc('exam_result_normal.registration_id');
                    $details = array('details'=>$query->ToArray());

                    $query = $GO_table->find()->hydrate(false);
                    $query->where(['session_id'=>$session_id]);
                    $query->andwhere(['exam_type_id'=>$exam_type_id]);
                    $query->andwhere(['registration_id'=>$row['registration_id']]);
                    $general_observation = $query->toArray();
                    if($general_observation){
                        $arrgo = array('generalObservationFinal'=>$general_observation);
                    }else{
                        $arrgo = array('generalObservationFinal'=>array());
                    }
                    array_push($data, array_merge($row,$details,$arrgo));
                }
        }   
       
        $this->set(compact('data','out_of'));
        $this->set('_serialize', ['data']);

        }
        elseif($flag == '1'){


        $Exam_table = TableRegistry::get('exam_marks_details');
        $Subjects = $Exam_table->find()->hydrate(false)
        ->join([
                    [   'table' => 'subjects',
                        'type' => 'INNER',
                        'conditions' => 'subjects.id_subjects = exam_marks_details.subject_id'
                    ]
                ]);
        $Subjects->select(['sub'=>'short_name','sub_desc'=>'subject_desc']);
        $Subjects->where(['class_id'=>$class_id]);
        $Subjects->andwhere(['exam_type_id'=>$session_id]); /// examl_type_id
        $Subjects->orderAsc('exam_marks_details.registration_id');
        $subjectDetails = $Subjects->toArray();    
        
        $table = TableRegistry::get('exam_result_normal');
        $query = $table->find()
                ->join([
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = exam_result_normal.registration_id'
                            ],
                            [   'table' => 'classes_sections',
                                'alias' => 'SS',
                                'type' => 'INNER',
                                'conditions' => 'SS.id_class = exam_result_normal.class_id'
                            ],
                            [   'table' => 'shift',
                                'type' => 'INNER',
                                'conditions' => 'shift.id_shift = exam_result_normal.shift_id'
                            ]
                        ]);
        
        $query->select(['registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['class'=>'SS.class_name','shift'=>'shift.shift_name','exam_result_normal.class_id','exam_result_normal.shift_id']);
        $query->select(['gr_no'=>'registration.gr']);
        $query->distinct('exam_result_normal.registration_id');
        $query->orderAsc('exam_result_normal.registration_id');
        $query->where(['exam_result_normal.class_id'=>$class_id]);
        $query->andwhere(['exam_result_normal.shift_id'=>$shift_id]);
        //$query->andwhere(['students_master_details.session_id'=>$session_id]);
        $query->hydrate(false);
        $res = $query->toArray();
        
        $data= array();
        $table = TableRegistry::get('exam_result_normal');
        foreach($res as $row){
            
            $query = $table->find()->hydrate(false);
            $query->where(['class_id'=>$class_id]);
            $query->andwhere(['shift_id'=>$shift_id]);
            $query->andwhere(['registration_id'=>$row['registration_id']]);
            $query->orderAsc('exam_result_normal.registration_id');
            $ressult = $query->toArray();
            
            if($ressult){
                $arr = array('exam_details'=>$ressult);
            }else{
                $arr = array('exam_details'=>'');
            }
            array_push($data, array_merge($row, $arr));
            
        
        }

        $this->set(compact('data','subjectDetails'));
        $this->render('tabulation');
       

        }

    }
    
    

    public function generateRank($class_id = null, $shift_id = null , $session_id=null, $exam_type_id= null){
        

        $table = TableRegistry::get('exam_result_normal');
        $query = $table->find()->hydrate(false);
        $query->distinct(['registration_id']);
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
        $examResultNormal = $this->ExamResultNormal->newEntity();
        if ($this->request->is('post')) {
            $examResultNormal = $this->ExamResultNormal->patchEntity($examResultNormal, $this->request->data);
            if ($this->ExamResultNormal->save($examResultNormal)) {
                $this->Flash->success(__('The exam result normal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam result normal could not be saved. Please, try again.'));
        }
        $registrations = $this->ExamResultNormal->Registrations->find('list', ['limit' => 200]);
        $classes = $this->ExamResultNormal->Classes->find('list', ['limit' => 200]);
        $shifts = $this->ExamResultNormal->Shifts->find('list', ['limit' => 200]);
        $sessions = $this->ExamResultNormal->Sessions->find('list', ['limit' => 200]);
        $examTypes = $this->ExamResultNormal->ExamTypes->find('list', ['limit' => 200]);
        $subjects = $this->ExamResultNormal->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('examResultNormal', 'registrations', 'classes', 'shifts', 'sessions', 'examTypes', 'subjects'));
        $this->set('_serialize', ['examResultNormal']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exam Result Normal id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $examResultNormal = $this->ExamResultNormal->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $examResultNormal = $this->ExamResultNormal->patchEntity($examResultNormal, $this->request->data);
            if ($this->ExamResultNormal->save($examResultNormal)) {
                $this->Flash->success(__('The exam result normal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam result normal could not be saved. Please, try again.'));
        }
        $registrations = $this->ExamResultNormal->Registrations->find('list', ['limit' => 200]);
        $classes = $this->ExamResultNormal->Classes->find('list', ['limit' => 200]);
        $shifts = $this->ExamResultNormal->Shifts->find('list', ['limit' => 200]);
        $sessions = $this->ExamResultNormal->Sessions->find('list', ['limit' => 200]);
        $examTypes = $this->ExamResultNormal->ExamTypes->find('list', ['limit' => 200]);
        $subjects = $this->ExamResultNormal->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('examResultNormal', 'registrations', 'classes', 'shifts', 'sessions', 'examTypes', 'subjects'));
        $this->set('_serialize', ['examResultNormal']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exam Result Normal id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
        
        $tabl_detail = TableRegistry::get('exam_result_normal');
        $exam_result_go = TableRegistry::get('exam_result_go');
        
        $tabl_detail->query()->delete()
        ->where(['registration_id' =>$this->request->data['cc']])
        ->where(['exam_type_id' =>$this->request->data['exam_type_id']])
        ->execute();

      

        $exam_result_go->query()->delete()
        ->where(['registration_id' =>$this->request->data['cc']])
        //->andwhere(['session_id' =>$this->request->data['session_id']])
        ->andwhere(['exam_type_id' =>$this->request->data['exam_type_id']])        
        ->execute();
        
        $msg  = "Success|The result has been deleted.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
            
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
            $orderby = 'registration_id';
            $orderdir = 'asc';
        }
        
        
        
        $ExamResults =  $this->ExamResultNormal->find()->contain(['Registration', 'classes_sections', 'Shift', 'Session', 'exam_types']);
        $ExamResults->select(['id_exam_marks','registration_id','sname'=>'student_name','fname'=>'father_name']);
        $ExamResults->select(['session_name'=>'session','exam'=>'exam_type']);
        $ExamResults->select(['class_id','shift_id','exam_type_id','session_id']);
        $ExamResults->group('registration_id','session_id','exam_type_id');
        $recordsTotal = $ExamResults->count();
        
        if (isset($this->request->data['id']) && !empty($this->request->data['id'])) {
            $ExamResults->where(['registration_id'=>$this->request->data['id']]);
        }
        
        
        $recordsFiltered  = $ExamResults->count();
        $ExamResults->order([$orderby => $orderdir]);
        if($length>-1){
                $ExamResults->limit($length);
            }
            if($start>0){
                $ExamResults->offset($start);
        }
        
      
        $ExamResults->hydrate(false);
        
        $res = $ExamResults->ToArray();
        $data = array();
       
       foreach ($res as $dat) {
            $session_name  = str_replace("-","00",$dat['session_name']);
            //$actions = array('actions' => "<button onclick='javascript:edit_record(" . $dat['class_id'].','.$dat['shift_id'].','.$dat['exam_type_id'].','.$dat['session_id'].','.$dat['registration_id'].")' class='btn btn-icon waves-effect waves-light btn-warning m-b-5'><i class='fa fa-eye'></i> Open</button> <button onclick='javascript:print_result(" . $dat['class_id'].','.$dat['shift_id'].','.$dat['exam_type_id'].','.$dat['session_id'].','.$dat['id_exam_marks'].','.$session_name.")' class='btn btn-icon waves-effect waves-light btn-success m-b-5'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:delete_record(" .$dat['registration_id'].','.$dat['exam_type_id'].','.$dat['session_id'] .','.$dat['id_exam_marks'].")' class='btn btn-icon waves-effect waves-light btn-danger m-b-5'><i class='fa fa-trash'></i> Delete</button>");
            $actions = array('actions' => "<button onclick='javascript:print_result(" . $dat['class_id'].','.$dat['shift_id'].','.$dat['exam_type_id'].','.$dat['session_id'].','.$dat['registration_id'].','.$session_name.")' class='btn btn-icon waves-effect waves-light btn-success m-b-5'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:delete_record(" .$dat['registration_id'].','.$dat['exam_type_id'].','.$dat['session_id'] .','.$dat['id_exam_marks'].")' class='btn btn-icon waves-effect waves-light btn-danger m-b-5'><i class='fa fa-trash'></i> Delete</button>");
            array_push($data, array_merge($dat, $actions));
        }
       
       
       $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
       $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
    }

    
    public function addMarks($class_id = null ,$shift_id = null, $session_id = null){
        
        $table = TableRegistry::get('students_master_details');
        $registration = $table->find()->contain(['registration','classes_sections']);
        $registration->select($table);
        $registration->select(['sname'=>'registration.student_name','fname'=>'registration.father_name']);
        $registration->select(['class'=>'classes_sections.class_name']);
        $registration->select(['gender'=>'registration.sex','contact'=>'registration.contact1']);
        $registration->select(['roll_no','grno'=>'registration.gr','add'=>'registration.address']);
        $registration->select(['cont2'=>'registration.contact2','cont3'=>'registration.contact3','img'=>'registration.image','roll'=>'students_master_details.roll_no','gr_no'=>'registration.gr']);
        $registration->select(['reg_date'=>'date_format(registration.doa,"%d-%M-%Y %H:%i")']);

        $registration->where(['class_id'=>$class_id]);
        $registration->andwhere(['shift_id'=>$shift_id]); 
        $registration->andwhere(['registration.active'=>'Y']);
        $registration->hydrate(false);
        $rs = $registration->toArray();
        $data = $rs;
        // $table = TableRegistry::get('exam_marks_details');
        // $subject = $table->find()->contain(['Subjects']);
        // $subject->select(['subject'=>'subject_name']);
        // $subject->select(['subject_desc'=>'subject_desc']);
        // $subject->select(['min_marks','max_marks']);

        // $subject->where(['class_id'=>$class_id]);
        // $subject->andwhere(['exam_type_id'=>$session_id]); // this is  exam_type_id actually
        // $subject->andwhere(['id_subjects'=>$shift_id]); // this is subject id actually

        // $results = $subject->toArray();

        // $resultTable = TableRegistry::get('exam_result_normal');
        // $data = array();
        // foreach($rs as $row){

        //     $sql = $resultTable->find()->hydrate(false);
        //     $sql->select(['obtained_marks']);
        //     $sql->where(['class_id'=>$class_id]);
        //     $sql->andwhere(['exam_type_id'=>$session_id]); // this is  exam_type_id actually
        //     $sql->andwhere(['subject_id'=>$shift_id]); // this is subject id actually
        //     $sql->andwhere(['shift_id'=>$exam_type_id]); // this is shift id actually
        //     $sql->andwhere(['registration_id'=>$row['registration_id']]); 
        //     $ob = $sql->toArray();
        //     if(count($ob) > 0){
        //         $obtained = array('obtained'=>$ob[0]['obtained_marks']);
        //     }else{
        //         $obtained = array('obtained'=>0);
        //     }
        //     array_push($data, array_merge($row,$obtained));    

        // }

        $this->set(compact('data','results','class_id','session_id','shift_id','exam_type_id'));
        $this->set('_serialize', ['data']);
        
    }
    public function addMarksDetails(){
        
        $mData = [];
        $mData = $this->request->data['details'];
       // $class_id = $this->request->data['class_id'];
       // $shift_id = $this->request->data['shift_id'];
        
        
        $table = TableRegistry::get('exam_result_go');
       
        foreach ($mData as $detail) {
            
            $query = $table->query();
            $query->delete()
            ->where(['registration_id'=>$detail['registration_id']])
            ->execute();
            
            $examType = $table->newEntity();
            $examType->registration_id = $detail['registration_id'];
            $examType->session_id = 1;
            $examType->exam_type_id = 1;
            $examType->home_work = $detail['val1'];
            $examType->reading = $detail['val2'];
            $examType->writing = $detail['val3'];
            $examType->cleanliiness = $detail['val4'];
            $examType->sv = $detail['val5'];
            $examType->att = $detail['att'] === '' ? 0 : $detail['att'];
            $examType->out_of = $detail['out_of'] === '' ? 0 : $detail['out_of'];
            $table->save($examType);
             
        }
        
        $msg = "Success|The exam header has been saved.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
    public function generateResultsClick($class_id,$shift_id,$exam_type_id){
        
        $table = TableRegistry::get('exam_result_normal');
        $query = $table->find()->hydrate(false);
        $query->select(['registration_id']);
        $query->distinct(['registration_id']);
        $query->where(['class_id'=>$class_id]);
        $query->andwhere(['shift_id'=>$shift_id]);
       // $query->andwhere(['registration_id'=>487]);
        //$query->andwhere(['exam_type_id'=>$exam_type_id]);
        //$query->where(['obtained_marks < '=>$min_marks]);
        $this->Resultsgenerate($class_id,$shift_id,$exam_type_id);
      //  exit();
        $students = $query->ToArray();
        foreach($students as $row){
        
            $sql = $table->find()->hydrate(false);
            $sql->where(['registration_id'=>$row['registration_id']]);
            $res = $sql->toArray();
            
            foreach($res as $r){
                
                $min = intval($r['min_marks']);
                $ob = $r['obtained_marks'];
                
                if($ob === 'A' || $ob === 'a' || $ob === 'L' || $ob === 'l'){
                    
                    $query = $table->query();
                    $query->update()
                    ->set(['rank' => 'False','grade'=>'F'])
                    ->where(['registration_id'=>$row['registration_id']])
                    ->execute();
                    break;
                    
                }
                elseif(intval($ob) < $min ){
                    $query = $table->query();
                    $query->update()
                    ->set(['rank' => 'False','grade'=>'F'])
                    ->where(['registration_id'=>$row['registration_id']])
                    ->execute();
                    break;
                    
                }
                else{
                    
                    $query = $table->query();
                    $query->update()
                    ->set(['rank' => 'True'])
                    ->where(['registration_id'=>$row['registration_id']])
                    ->execute();
                    
                }
                
            }
            
        }
        
        
        $msg = "Success|Result has been generated.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
       
    }
    
    public function Resultsgenerate($class_id,$shift_id,$exam_type_id){

        $table_grading = TableRegistry::get('grade_setting');
        $table = TableRegistry::get('exam_result_normal');
        $query = $table->find()->hydrate(false);
        $query->select(['mm' => $query->func()->sum('max_marks'),'registration_id']);
        $query->select(['om' => $query->func()->sum('obtained_marks')]);
        $query->where(['class_id'=>$class_id,'shift_id'=>$shift_id]);
        //$query->andwhere(['exam_type_id'=>$exam_type_id,'session_id'=>1]);
       // $query->andwhere(['registration_id'=>487]);
        $query->group('registration_id');
        $rs = $query->toArray();
        //print_r($rs);
        //exit();
        $sql = $table_grading->find()->hydrate(false);
        $grades_query = $sql->toArray();
        $grades = $grades_query[0];
        foreach($rs as $row){

            $mm = $row['mm'];
            $om = $row['om'];            
            $per = round($om / $mm * 100,2);            
            if( $per >= $grades['per_vii'] ){

                $grade = $grades['grade_vii'];
                $remarks = $grades['remarks_vii'];
            }
            elseif( $per >= $grades['per_vi'] ){

                $grade = $grades['grade_vi']; 
                $remarks = $grades['remarks_vi'];  
            }
            elseif( $per >= $grades['per_v'] ){

                $grade = $grades['grade_v']; 
                $remarks = $grades['remarks_v'];  
            }
            elseif( $per >= $grades['per_iv'] ){

                $grade = $grades['grade_iv']; 
                $remarks = $grades['remarks_iv']; 
            }
            elseif( $per >= $grades['per_iii'] ){

                $grade = $grades['grade_iii']; 
                $remarks = $grades['remarks_iii']; 
            }
            elseif( $per >= $grades['per_ii'] ){

                $grade = $grades['grade_ii']; 
                $remarks = $grades['remarks_ii']; 
            }
            elseif( $per >= $grades['per_i'] ){

                $grade = $grades['grade_i']; 
                $remarks = $grades['remarks_i']; 
            }
            else{

                $grade = $grades['grade']; 
                $remarks = "Need to work very hard"; 
            }
       // echo $grade;
            $query = $table->query();
            $query->update()
            ->set(['total_marks' => $mm
                    ,'total_obtained'=>$om
                    ,'per'=>$per
                    ,'grade'=>$grade
                    ,'remarks'=>$remarks])
            ->where(['registration_id' => $row['registration_id']])
            ->execute();
            
        }
    }
    
    
}
