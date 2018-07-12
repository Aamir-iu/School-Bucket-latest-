<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * ExamMarksDetails Controller
 *
 * @property \App\Model\Table\ExamMarksDetailsTable $ExamMarksDetails
 */
class ExamMarksDetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        $examMarksDetails = $this->ExamMarksDetails->find()->contain(['classes_sections']);
        $examMarksDetails->distinct(['classes_sections.class_name']);
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $table = TableRegistry::get('subjects');
        $subjects = $table->find('all');
 
        $exam_types = TableRegistry::get('exam_types');
        $exam_types = $exam_types->find('all');    
        
        
        $this->set(compact('examMarksDetails','class','subjects','exam_types'));
        $this->set('_serialize', ['examMarksDetails','adddMarksDetails','classs','subjects','exam_types']);
    }

    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','edit','view','generateResults','add','delete','addMarksDetails','addMarks','loadfeeheads','adddetails'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }

        return parent::isAuthorized($user);
    }
    
    
   public function view($flag = null ,$class_id = null ,$shift_id = null, $session_id = null, $exam_type_id = null,$session = null,$admin_card=null){
       
        if($flag ==1){
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
            $registration->andwhere(['shift_id'=>$exam_type_id]); // this is shift id actually
            $registration->andwhere(['registration.active'=>'Y']);
            $registration->hydrate(false);
            $data = $registration->toArray();
            
            $table = TableRegistry::get('exam_marks_details');
            $subject = $table->find()->contain(['Subjects']);
            $subject->select(['subject'=>'subject_name']);
            $subject->select(['subject_desc'=>'subject_desc']);
            $subject->select(['min_marks','max_marks']);
            
            $subject->where(['class_id'=>$class_id]);
            $subject->andwhere(['exam_type_id'=>$session_id]); // this is  exam_type_id actually
            $subject->andwhere(['id_subjects'=>$shift_id]); // this is subject id actually

            $results = $subject->toArray();
            
            $this->set(compact('data','results'));
            $this ->render('awad_list');  
            
        }
        else if($flag ==2){
            
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
            $registration->andwhere(['shift_id'=>$exam_type_id]); // this is shift id actually
            $registration->andwhere(['registration.active'=>'Y']);
            $registration->hydrate(false);
            $data = array();
            $rs = $registration->toArray();
            
            $table = TableRegistry::get('exam_marks_details');
            $subject = $table->find()->contain(['Subjects']);
            $subject->select(['subject'=>'subject_name']);
            $subject->select(['subject_desc'=>'subject_desc']);
            $subject->select(['min_marks','max_marks']);
            
            $subject->where(['class_id'=>$class_id]);
            $subject->andwhere(['exam_type_id'=>$session_id]); // this is  exam_type_id actually
            $subject->andwhere(['id_subjects'=>$shift_id]); // this is subject id actually
          
            $results = $subject->toArray();
            $table = TableRegistry::get('exam_results');
            foreach($rs as $dat){
                
                $query = $table->find()->hydrate(false)
                ->join([
                            [   'table' => 'exam_results',
                                'alias' => 'er',
                                'type' => 'INNER',
                                'conditions' => 'er.registration_id = exam_results.registration_id'
                            ],
                            [   'table' => 'exam_result_detail',
                                'type' => 'INNER',
                                'conditions' => 'er.id_exam = exam_result_detail.exam_result_id'
                            ]
                        ]);
                $query->select(['ob'=>'exam_result_detail.obtain_marks','registration_id']);
                $query->where(['er.class_id'=>$class_id]);
                $query->andwhere(['er.exam_type_id'=>3]); // this is  exam_type_id actually
                $query->andwhere(['exam_result_detail.subject_id'=>$shift_id]); // this is subject id actually
                $query->andwhere(['exam_results.registration_id'=>$dat['registration_id']]); // 
                $res =  $query->toArray();
      
                if($res){
                    $ob = $res[0]['ob'];
                }else{
                    $ob = 0;
                }
            
                $actions = array('obtained' => $ob);
                array_push($data, array_merge($dat, $actions));
                
                }
            $this->set(compact('data','results'));
            $this ->render('awad_list_fill');
            
        }
        else{
            if ($admin_card ==1) {
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
                $data = $registration->toArray();
                $this->set(compact('data'));
                $this ->render('front'); 
            }
            elseif ($admin_card ==2) {

               $table = TableRegistry::get('exam_marks_details');
               $subject = $table->find()->contain(['Subjects']);
               $subject->select(['subject'=>'subject_name']);
               $subject->where(['class_id'=>$class_id]);
               $subject->andwhere(['exam_type_id'=>$exam_type_id]);

               $data = $subject->toArray();

               $this->set(compact('data'));
               $this ->render('back');  
            }
            elseif ($admin_card ==3) {

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
                $data = $registration->toArray();
                $this->set(compact('data'));
                $this->set('_serialize', ['data']);
            }
            elseif ($admin_card ==4) {

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
                $data = $registration->toArray();
                $this->set(compact('data'));
                $this->set('_serialize', ['data']);
            }     
        }    

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       
        $examMarksDetail = $this->ExamMarksDetails->newEntity();
        if ($this->request->is('post')) {
            
            $exist = $this->ExamMarksDetails->exists(['class_id' => $this->request->data['class_id']]);
            if(empty($exist)){
                    $examMarksDetail = $this->ExamMarksDetails->patchEntity($examMarksDetail, $this->request->data);
                    $examMarksDetail->created_by = $this->request->session()->read('Auth.User.id');
                    $examMarksDetail->created_on = date("Y-m-d H:i:s");
                    $examMarksDetail->class_id = $this->request->data['class_id'];
                  
                    if ($this->ExamMarksDetails->save($examMarksDetail)) {
                        $msg =  'Success|The exam marks detail has been saved.';
                    } else {
                       $msg =  'Error|The exam marks detail could not be saved. Please, try again.';
                    }
            
            }else{
                $msg = 'Error|The class could not be saved. Already exists.';
            }  
            
        }
        
        
        
        $this->set(compact('examMarksDetail', 'msg'));
        $this->set('_serialize', ['examMarksDetail','msg']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exam Marks Detail id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $id = $this->request->data['id'];
        $examMarksDetail = $this->ExamMarksDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $examMarksDetail = $this->ExamMarksDetails->patchEntity($examMarksDetail, $this->request->data);
            if ($this->ExamMarksDetails->save($examMarksDetail)) {
                $msg =  'Success|The subject detail has been changed.';
            } else {
                $msg = 'Error|The subject detail could not be cahnged. Please, try again.';
            }
        }
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
        
        
        
    }

   
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $query = $this->ExamMarksDetails->query();
        $query->delete()
        ->where(['class_id' =>$id])
        ->execute();
        
        $msg = "Success|The exam marks detail has been deleted.";    
        $this->set(compact('examType','msg'));
        $this->set('_serialize', ['examType','msg']);
        
    }
    
    public function loadfeeheads(){
        
        $class = $this->request->data['class'];
        $exam_types = $this->request->data['exam_types'];
        
        $table = TableRegistry::get('exam_marks_details');
        $examType = $table->find()->contain(['Subjects','classes_sections','exam_types']);
        $examType->select(['subject_id','min_marks','max_marks','subject'=>'subject_name','sub_desc'=>'subject_desc']);
        $examType->select(['class'=>'class_name']);
        $examType->select(['et'=>'exam_type','exam_type_id','order_id','id_marks_detail']);
        $examType->where(['class_id'=>$class]);
        $examType->andwhere(['exam_type_id'=>$exam_types]);
        
        $examType = $examType->ToArray();
        $msg = "Success|Records found.";    
        $this->set(compact('examType','msg'));
        $this->set('_serialize', ['examType','msg']);
        
    }
    
    
    public function adddetails(){
        
        $mData = [];
        $mData = $this->request->data['details'];
        $class_id = $this->request->data['class_id'];
        $exam_types = $this->request->data['exam_types'];
     
        $table = TableRegistry::get('exam_marks_details');
        $query = $table->query();
        $query->delete()
        ->where(['class_id' =>$class_id,'exam_type_id'=>$exam_types])
        ->orwhere(['exam_type_id'=>0])        
        ->execute();
       
        foreach ($mData as $detail) {
            $examType = $table->newEntity();
            $examType->class_id = $class_id;
            $examType->subject_id = $detail['subject_id'];
            $examType->exam_type_id = $detail['exam_type_id'];
            $examType->min_marks = $detail['passing'];
            $examType->max_marks = $detail['total'];
            $examType->order_id = $detail['order_id'];
            $examType->created_on = date("Y-m-d H:i:s");
            $examType->created_by = $this->request->session()->read('Auth.User.id');
            $table->save($examType);
             
        }
        $msg = "Success|The exam header has been saved.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);

    }
    
    public function addMarks($flag = null ,$class_id = null ,$shift_id = null, $session_id = null, $exam_type_id = null,$session = null,$admin_card=null){
        
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
        $registration->andwhere(['shift_id'=>$exam_type_id]); // this is shift id actually
        $registration->andwhere(['registration.active'=>'Y']);
        $registration->hydrate(false);
        $rs = $registration->toArray();

        $table = TableRegistry::get('exam_marks_details');
        $subject = $table->find()->contain(['Subjects']);
        $subject->select(['subject'=>'subject_name']);
        $subject->select(['subject_desc'=>'subject_desc']);
        $subject->select(['min_marks','max_marks']);

        $subject->where(['class_id'=>$class_id]);
        $subject->andwhere(['exam_type_id'=>$session_id]); // this is  exam_type_id actually
        $subject->andwhere(['id_subjects'=>$shift_id]); // this is subject id actually

        $results = $subject->toArray();

        $resultTable = TableRegistry::get('exam_result_normal');
        $data = array();
        foreach($rs as $row){

            $sql = $resultTable->find()->hydrate(false);
            $sql->select(['obtained_marks']);
            $sql->where(['class_id'=>$class_id]);
            $sql->andwhere(['exam_type_id'=>$session_id]); // this is  exam_type_id actually
            $sql->andwhere(['subject_id'=>$shift_id]); // this is subject id actually
            $sql->andwhere(['shift_id'=>$exam_type_id]); // this is shift id actually
            $sql->andwhere(['registration_id'=>$row['registration_id']]); 
            $ob = $sql->toArray();
            if(count($ob) > 0){
                $obtained = array('obtained'=>$ob[0]['obtained_marks']);
            }else{
                $obtained = array('obtained'=>0);
            }
            array_push($data, array_merge($row,$obtained));    

        }

        $this->set(compact('data','results','class_id','session_id','shift_id','exam_type_id'));
        $this->set('_serialize', ['data']);
        
    }
    
    public function addMarksDetails(){
        
        $mData = [];
        $mData = $this->request->data['details'];
        $class_id = $this->request->data['class_id'];
        $exam_type_id = $this->request->data['exam_type_id'];
        $shift_id = $this->request->data['shift_id'];
        $subject_id = $this->request->data['subject_id'];
        $max_marks = $this->request->data['max_marks'];
        $min_marks = $this->request->data['min_marks'];
        
        $table = TableRegistry::get('exam_result_normal');
       
        foreach ($mData as $detail) {
            
            $query = $table->query();
            $query->delete()
            ->where(['class_id' =>$class_id,'exam_type_id'=>$exam_type_id,'registration_id'=>$detail['registration_id'],'subject_id'=>$subject_id])
            ->execute();
            
            $examType = $table->newEntity();
            $examType->registration_id = $detail['registration_id'];
            $examType->class_id = $class_id;
            $examType->shift_id = $shift_id;
            $examType->session_id = 1;
            $examType->exam_type_id = $exam_type_id;
            $examType->subject_id = $subject_id;
            $examType->max_marks = $max_marks;
            $examType->min_marks = $min_marks;
            $examType->obtained_marks = $detail['obMarks'];
            
            //$examType->created_on = date("Y-m-d H:i:s");
            //$examType->created_by = $this->request->session()->read('Auth.User.id');
            $table->save($examType);
            
             
        }
        
        $this->generateResults($class_id,$shift_id,$exam_type_id);
        $msg = "Success|The exam header has been saved.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }

    public function generateResults($class_id,$shift_id,$exam_type_id){

        $table_grading = TableRegistry::get('grade_setting');
        $table = TableRegistry::get('exam_result_normal');
        $query = $table->find()->hydrate(false);
        $query->select(['mm' => $query->func()->sum('max_marks'),'registration_id']);
        $query->select(['om' => $query->func()->sum('obtained_marks')]);
        $query->where(['class_id'=>$class_id,'shift_id'=>$shift_id]);
        $query->andwhere(['exam_type_id'=>$exam_type_id,'session_id'=>1]);
        $query->group('registration_id');
        $rs = $query->toArray();

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

            $query = $table->query();
            $query->update()
            ->set(['total_marks' => $mm
                    ,'total_obtained'=>$om
                    ,'per'=>$per
                    ,'grade'=>$grade
                    ,'remarks'=>$remarks])
            ->where(['registration_id' => $row['registration_id'],'exam_type_id'=>$exam_type_id])
            ->execute();
            
        }
    }
    
}
