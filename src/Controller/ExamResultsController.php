<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use App\Controller\AppController;

/**
 * ExamResults Controller
 *
 * @property \App\Model\Table\ExamResultsTable $ExamResults
 */
class ExamResultsController extends AppController
{
    public function index(){
        
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
        
        
        $link = $this->url()."download/csv_sample.csv";
        
        
       $this->set(compact('ExamResults','classes','session','campuses','feetype'
                          ,'class_name','subjects','getMarks','ExamTypes','grades','card_template','sess','link'));
    }
    
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','view','getStudentIfo',
            'getSubjects','getMarks','getbysearch','editStudentIfo','generateRank','resultSettings','sendsms'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    
    public function view($flag = null ,$class_id = null ,$shift_id = null, $session_id = null, $exam_type_id = null){
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
        $query->select(['att','out_of']);
        $query->orderAsc('students_master_details.roll_no');
       // $query->where(['registration_id'=>$reg_id]);
        $query->where(['exam_results.class_id'=>$class_id]);
        $query->andwhere(['exam_results.shift_id'=>$shift_id]);
        $query->andwhere(['exam_type_id'=>$exam_type_id]);
        $query->andwhere(['exam_results.session_id'=>$session_id]);
        $query->hydrate(false);
        $res = $query->toArray();
        $data= array();
        foreach($res as $row){
        
            $table = TableRegistry::get('exam_result_detail');
            $query = $table->find()->hydrate(false)->join([
                            [   'table' => 'subjects',
                                'type' => 'INNER',
                                'conditions' => 'subjects.id_subjects = exam_result_detail.subject_id'
                            ]
                        ]);
            $query->select(['subject_id','subject'=>'exam_result_detail.subject_name','max_marks'=>'mm','min_marks'=>'pm','order_id'=>'sub_order_id']);
            $query->select(['test_obtain_marks','obtain_marks','total_obtain_marks','sub_desc'=>'subjects.short_name']);
            $query->where(['exam_result_id'=>$row['id_exam']]);
            $query->orderAsc('order_id');
            $ressult = $query->toArray();
            
            if($ressult){
                $arr = array('exam_details'=>$ressult);
            }else{
                $arr = array('exam_details'=>'');
            }
            array_push($data, array_merge($row, $arr));
            
        
        }
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
        
        
    }
    public function add($id_exam = null){
        
        $tabl_detail = TableRegistry::get('exam_result_detail');
        $exam_result_go = TableRegistry::get('exam_result_go');
        if($id_exam > 0){
                        
            $tabl_detail->query()->delete()
            ->where(['exam_result_id' =>$id_exam])
            ->execute();
            
            $this->ExamResults->query()->delete()
            ->where(['id_exam' =>$id_exam])
            ->execute();
            
            $exam_result_go->query()->delete()
            ->where(['registration_id' =>$this->request->data['cc']])
            ->andwhere(['session_id' =>$this->request->data['session_id']])
            ->andwhere(['exam_type_id' =>$this->request->data['exam_type']])        
            ->execute();
            
        }
        
        $mdata = $this->request->data['marks_details'];
        
        $exists = $this->ExamResults->exists(['registration_id' => $this->request->data['cc'], 'exam_type_id' =>$this->request->data['exam_type'],'session_id' =>$this->request->data['session_id']]);
       
        if($exists){
            $msg = 'Error|The exam result is already exists.';
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
         
        }else{
        // Storing Generl Observation 
            if(isset($this->request->data['hw'])){
              $hw =   $this->request->data['hw'];
            }else{
              $hw = 1;  
            }
            if(isset($this->request->data['reading'])){
              $read =   $this->request->data['reading'];
            }else{
              $read = 1;  
            }
            if(isset($this->request->data['writing'])){
              $write =   $this->request->data['writing'];
            }else{
              $write = 1;  
            }
            if(isset($this->request->data['cleanliness'])){
              $clean =   $this->request->data['cleanliness'];
            }else{
              $clean = 1;  
            }
            if(isset($this->request->data['sv'])){
              $sv =   $this->request->data['sv'];
            }else{
              $sv = 1;  
            }
            
            
        $go = $exam_result_go->newEntity();    
        $go->registration_id = $this->request->data['cc'];
        $go->session_id = $this->request->data['session_id'];
        $go->exam_type_id = $this->request->data['exam_type'];
        $go->home_work = $hw;
        $go->reading = $read;
        $go->writing = $write;
        $go->cleanliiness = $clean;
        $go->sv = $sv;
        $exam_result_go->save($go); 
        // Storing Result 
        $examResult = $this->ExamResults->newEntity();
        $examResult->registration_id = $this->request->data['cc'];
        $examResult->class_id = $this->request->data['class_id'];
        $examResult->shift_id = $this->request->data['shift_id'];
        $examResult->session_id = $this->request->data['session_id'];
        $examResult->exam_type_id = $this->request->data['exam_type'];
        $examResult->per = $this->request->data['per'];
        $examResult->grade = $this->request->data['grade'];
        $examResult->rank = $this->request->data['rank'];
        $examResult->remarks = $this->request->data['remarks'];
        $examResult->total_marks = $this->request->data['total'];
        $examResult->obtain_marks = $this->request->data['obtain'];
        $examResult->att = $this->request->data['att'];
        $examResult->out_of = $this->request->data['att_out_of'];
        $examResult->result = $this->request->data['result'];
        $examResult->test_om = $this->request->data['test_om'];
        $examResult->test_mm = $this->request->data['test_mm'];
        $examResult->created_by = $this->request->session()->read('Auth.User.full_name');
        
        if ($this->ExamResults->save($examResult)) {
            // Storing Result Details
            foreach($mdata as $row){
            $examResultDetail = $tabl_detail->newEntity();
            $examResultDetail->exam_result_id = $examResult->id_exam;
            $examResultDetail->subject_id = $row['sub_id'];
            $examResultDetail->subject_name = $row['sub_name'];
            $examResultDetail->mm = $row['max'];
            $examResultDetail->pm = $row['min'];
            $examResultDetail->test_obtain_marks = $row['test_marks'];
            $examResultDetail->obtain_marks = $row['obtain_marks'];
            $examResultDetail->obtain_marks = $row['obtain_marks'];
            $examResultDetail->total_obtain_marks = $row['total_obtain_marks'];
            $examResultDetail->sub_order_id = $row['order_id'];
            $tabl_detail->save($examResultDetail);
            
            }
            
            $msg = 'Success|The exam result has been saved.';
        }
        else{
            $msg = 'Error|The exam result could not be saved. Please, try again.';
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
        }
    }
    public function edit($id = null){
        
        $class_id = $this->request->data['class'];
        $shift_id = $this->request->data['shift'];
        $exam_type_id = $this->request->data['exam_type_id'];
        $session_id = $this->request->data['session_id'];
        
        $table = TableRegistry::get('registration');
        $query = $table->find()->contain(['exam_results']);
     //   $query->select(['id_registration','student_name','father_name']);
        $query->where(['active'=>'Y']);
        $query->andwhere(['class_id'=>$class_id]);
        $data = $query->toArray();
        
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }
    public function delete($id = null){
        
        $tabl_detail = TableRegistry::get('exam_result_detail');
        $exam_result_go = TableRegistry::get('exam_result_go');
        
        $tabl_detail->query()->delete()
        ->where(['exam_result_id' =>$this->request->data['id_exam']])
        ->execute();

        $this->ExamResults->query()->delete()
        ->where(['id_exam' =>$this->request->data['id_exam']])
        ->execute();

        $exam_result_go->query()->delete()
        ->where(['registration_id' =>$this->request->data['cc']])
        ->andwhere(['session_id' =>$this->request->data['session_id']])
        ->andwhere(['exam_type_id' =>$this->request->data['exam_type_id']])        
        ->execute();
        
        $msg  = "Success|The result has been deleted.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
            
    }    
    public function getStudentIfo(){
        
        $cc = $this->request->data['cc'];
        $exam_type_id = $this->request->data['exam_type_id'];
        
        $table = TableRegistry::get('students_master_details');
        $query = $table->find()
                ->join([
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = students_master_details.registration_id'
                            ],
                            [   'table' => 'classes_sections',
                                'alias' => 'SS',
                                'type' => 'INNER',
                                'conditions' => 'SS.id_class = students_master_details.class_id'
                            ],
                            [   'table' => 'shift',
                                'type' => 'INNER',
                                'conditions' => 'shift.id_shift = students_master_details.shift_id'
                            ]
                        ]);
        
        $query->select(['registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['class'=>'SS.class_name','shift'=>'shift.shift_name','class_id','shift_id']);
        
        $query->where(['registration_id'=>$cc]);
        $query->andwhere(['registration.active'=>'Y']);
        $query->hydrate(false);
        $data = $query->toArray();
  
        if($data){
        
        $table = TableRegistry::get('exam_marks_details');
        $query = $table->find()->contain(['Subjects']);
        $query->select(['subject_id','subject'=>'subject_name','max_marks','min_marks','order_id','sub_desc'=>'subject_desc']);
        $query->where(['class_id'=>$data[0]['class_id']]);
        $query->andwhere(['exam_type_id'=>$exam_type_id]);
        
        $query->orderAsc('exam_marks_details.order_id');
        $exam_details = $query->toArray();
        
        }
        
        
        $msg  = "Success|Found records. ". count($data) ;
        $this->set(compact('data','msg','exam_details'));
        $this->set('_serialize', ['data','msg','exam_details']);
        
        
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
            $orderby = 'class_id';
            $orderdir = 'asc';
        }
        
        
        
        $ExamResults = $this->ExamResults->find()->contain(['classes_sections','shift','Registration','exam_types','session']); 
        $ExamResults->select($this->ExamResults);
        $ExamResults->select(['class'=>'class_name','shift'=>'shift_name','exam'=>'exam_type','session_name'=>'session']);
        $ExamResults->select(['sname'=>'student_name','fname'=>'father_name']);
        $ExamResults->where(['term'=>0]);
        
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
            $actions = array('actions' => "<button onclick='javascript:edit_record(" . $dat['class_id'].','.$dat['shift_id'].','.$dat['exam_type_id'].','.$dat['session_id'].','.$dat['registration_id'].")' class='btn btn-icon waves-effect waves-light btn-warning m-b-5'><i class='fa fa-eye'></i> Open</button> <button onclick='javascript:print_result(" . $dat['class_id'].','.$dat['shift_id'].','.$dat['exam_type_id'].','.$dat['session_id'].','.$dat['id_exam'].','.$session_name.")' class='btn btn-icon waves-effect waves-light btn-success m-b-5'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:delete_record(" .$dat['registration_id'].','.$dat['exam_type_id'].','.$dat['session_id'] .','.$dat['id_exam'].")' class='btn btn-icon waves-effect waves-light btn-danger m-b-5'><i class='fa fa-trash'></i> Delete</button>");
            array_push($data, array_merge($dat, $actions));
            
        }
       
       
       $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
       $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
    }
    public function editStudentIfo(){
        
        $class = $this->request->data['class'];
        $shift = $this->request->data['shift'];
        $exam_type_id = $this->request->data['exam_type_id'];
        $session_id = $this->request->data['session_id'];
        $reg_id = $this->request->data['reg_id'];
     
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
                            ]
                        ]);
        
        $query->select(['id_exam','registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['class'=>'SS.class_name','shift'=>'shift.shift_name','class_id','shift_id','exam_type_id','session_id']);
        $query->select(['att','out_of','remarks','result','obtain_marks','per','grade','test_om','test_mm']);
        $query->where(['registration_id'=>$reg_id]);
        $query->andwhere(['class_id'=>$class]);
        $query->andwhere(['shift_id'=>$shift]);
        $query->andwhere(['exam_type_id'=>$exam_type_id]);
        $query->andwhere(['session_id'=>$session_id]);
        $query->hydrate(false);
        $data = $query->toArray();
            
        $table = TableRegistry::get('exam_result_detail');
        $query = $table->find()->hydrate(false);
        $query->select(['subject_id','subject'=>'subject_name','max_marks'=>'mm','min_marks'=>'pm','order_id'=>'sub_order_id']);
        $query->select(['test_obtain_marks','obtain_marks','total_obtain_marks']);
        $query->where(['exam_result_id'=>$data[0]['id_exam']]);
        $query->orderAsc('order_id');
        $exam_details = $query->toArray();
         
        $table = TableRegistry::get('exam_result_go');
        $query = $table->find()->hydrate(false);
        $query->where(['session_id'=>$data[0]['session_id']]);
        $query->andwhere(['exam_type_id'=>$data[0]['exam_type_id']]);
        $query->andwhere(['registration_id'=>$data[0]['registration_id']]);
        $general_observation = $query->toArray();
        
      
        $msg  = "Success|Found records. ". count($data) ;
        $this->set(compact('data','msg','exam_details','general_observation'));
        $this->set('_serialize', ['data','msg','exam_details','general_observation']);
        
        
    }
    public function generateRank($class_id = null, $shift_id = null , $session_id=null, $exam_type_id=null){
        
//        $class_id = $this->request->data['class_id'];
//        $shift_id = $this->request->data['shift_id'];
//        $session_id = $this->request->data['session_id'];
//        $exam_type_id = $this->request->data['exam_type_id'];
        
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
    public function resultSettings(){
        
        $table = TableRegistry::get('exam_result_card_templates');    
        $query = $table->query();
        $query->update()
            ->set(['status' =>'Inactive'])
            //->where(['id_result_card_template' => $this->request->date['id']])
            ->execute();
        
        $table = TableRegistry::get('exam_result_card_templates');    
        $query = $table->query();
        $query->update()
            ->set(['status' =>'Active'])
            ->where(['id_result_card_template' => $this->request->data['id']])
            ->execute();
        
        $msg  = "Success|The tempalte has been changed";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
     public function sendsms(){
      
        $file =  WWW_ROOT."download/csv_sample.txt";
        $class  = $this->request->data['class_id'];
        $shift  = $this->request->data['shift_id'];
        $session_id  = $this->request->data['session_id'];
        $exam_id  = $this->request->data['exam_id'];
        $message = $this->request->data['message'];
       
       
        $date = date("Y-m-d");
        $table = TableRegistry::get('exam_results');
        $query   = $table->find('all')->contain(['Registration']);
        $query->select(['obtain_marks','total_marks','per','grade','result','no_of_rank']);
        $query->select(['cell1'=>'contact1','sname'=>'student_name','fname'=>'father_name']);
      
        $query->where(['class_id'=>$class]);
        $query->andwhere(['shift_id'=>$shift]);
        $query->andwhere(['session_id'=>$session_id]);
        $query->andwhere(['exam_type_id'=>$exam_id]);
        $query->hydrate(false);
        
        $data = $query->toArray();
      
        $handle = fopen ($file, "w+");
        fclose($handle);
    
        foreach($data as $row){
           if($row['cell1'] > 0){ 
               $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].','.$row['fname'].','.$row['obtain_marks'].','.$row['total_marks'].','.$row['per'].','.$row['grade'].','.$row['result'].','.$row['no_of_rank'].PHP_EOL;
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
    
    
}
