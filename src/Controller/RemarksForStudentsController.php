<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * RemarksForStudents Controller
 *
 * @property \App\Model\Table\RemarksForStudentsTable $RemarksForStudents
 */
class RemarksForStudentsController extends AppController
{

    
    public function index(){
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus' => $this->request->session()->read('Auth.User.campus_id')]);    
        }
        
        $date = date("Y-m-d");
        $table = TableRegistry::get('remarks_for_students');
        $query = $table->find()
                ->join([
                            [   'table' => 'classes_sections',
                                'alias' => 'cs',
                                'type' => 'INNER',
                                'conditions' => 'cs.id_class = remarks_for_students.class_id'
                            ],
                            [   'table' => 'shift',
                                'alias' => 'shift',
                                'type' => 'INNER',
                                'conditions' => 'shift.id_shift = remarks_for_students.shift_id'
                            ]
                        ]);
        
        $query->select(['id_remarks_for_students','shift_id','class_id','class'=>'cs.class_name','shift'=>'shift.shift_name']);
        $query->select(['dated'=>'date_format(remarks_for_students.date,"%d-%m-%Y %H:%i")']);
        $query->group(['class_id','shift_id']);
        //$query->where(['remarks_for_students.date'=>date("Y-m-d", strtotime($date))]);
        //$query->andwhere(['campus_id'=>$this->request->session()->read('Auth.User.campus_id')]);
        $data = $query->toArray();
       
        $this->set(compact('class','campus','data'));
        $this->set('_serialize', ['data','class','campus']);
        
    }

   
    
     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','edit','delete','add','loadstudents','getremarks','updateRollNumbers','setRollNumbers'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    public function view($class_id = null, $shift_id = null)
    {
        $remarksForStudent = $this->RemarksForStudents->get($id, [
            'contain' => []
        ]);

        $this->set('remarksForStudent', $remarksForStudent);
        $this->set('_serialize', ['remarksForStudent']);
    }
    
    
    public function getremarks($class_id = null, $shift_id = null)
    {
        
        $remarksForStudent = $this->RemarksForStudents->find()->contain(['Registration']);
        $remarksForStudent->select($this->RemarksForStudents);
        $remarksForStudent->select(['sname'=>'Registration.student_name','fname'=>'Registration.father_name']);
        $remarksForStudent->where(['class_id'=>$class_id]);
        $remarksForStudent->andwhere(['shift_id'=>$shift_id]);
        $data = $remarksForStudent->toArray();
        
        $msg = 'Success|Please wait collecting information.';
        $this->set(compact('remarksForStudent','msg','data'));
        $this->set('_serialize', ['remarksForStudent','msg','data']);
        
    }
    
    public function add()
    {
        $exists = $this->RemarksForStudents->exists(['class_id' => $this->request->data['class_id'], 'shift_id' => $this->request->data['shift_id']]);
        if(!empty($exists)){
            $query = $this->RemarksForStudents->query();
            $query->delete()
            ->where(['class_id' => $this->request->data['class_id'], 'shift_id' => $this->request->data['shift_id']])
            ->execute();
        }
        
        $mData = [];
        $mData = $this->request->data['remarks_details'];
        foreach ($mData as $row){
            $remarksForStudent = $this->RemarksForStudents->newEntity();
            if ($this->request->is('post')) {
                $remarksForStudent = $this->RemarksForStudents->patchEntity($remarksForStudent, $this->request->data);
                $remarksForStudent->registration_id = $row['regid'];
                $remarksForStudent->Attitude = $row['val_1'];
                $remarksForStudent->Communicationskills = $row['val_2'];
                $remarksForStudent->interestsandtalents = $row['val_3'];
                $remarksForStudent->participation = $row['val_4'];
                $remarksForStudent->timemanagement = $row['val_5'];
                $remarksForStudent->workhabits = $row['val_6'];
                $remarksForStudent->date = date("Y-m-d", strtotime($this->request->data['date']));
                if ($this->RemarksForStudents->save($remarksForStudent)) {
                    $msg = 'Success|The remarks for student has been saved.';

                  //  return $this->redirect(['action' => 'index']);
                } else {
                    $msg = 'Error|The remarks for student could not be saved. Please, try again.';
                }
            }
        }    
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
    }

    
    public function edit($id = null)
    {
        $remarksForStudent = $this->RemarksForStudents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $remarksForStudent = $this->RemarksForStudents->patchEntity($remarksForStudent, $this->request->data);
            if ($this->RemarksForStudents->save($remarksForStudent)) {
                $this->Flash->success(__('The remarks for student has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The remarks for student could not be saved. Please, try again.'));
            }
        }
        $registrations = $this->RemarksForStudents->Registrations->find('list', ['limit' => 200]);
        $classes = $this->RemarksForStudents->Classes->find('list', ['limit' => 200]);
        $shifts = $this->RemarksForStudents->Shifts->find('list', ['limit' => 200]);
        $this->set(compact('remarksForStudent', 'registrations', 'classes', 'shifts'));
        $this->set('_serialize', ['remarksForStudent']);
    }

    
    public function delete($class_id = null, $shift_id = null)
    {
        
        $query = $this->RemarksForStudents->query();
        $query->delete()
        ->where(['class_id' => $class_id, 'shift_id' => $shift_id])
        ->execute();
        
        $msg = "Success|The remarks for student has been deleted.";
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
    public function setRollNumbers(){
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus' => $this->request->session()->read('Auth.User.campus_id')]);    
        }

        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
       
        $this->set(compact('class','campus','data','session'));
        $this->set('_serialize', ['data','class','campus']);
        
        
    }
    
     public function loadstudents(){
        
        $class = $this->request->data['class'];
        $shift = $this->request->data['shift'];
        $session_id = $this->request->data['session_id'];
        $campus = $this->request->session()->read('Auth.User.campus_id');
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
        $query->select(['gr_no'=>'registration.gr','fmc_code'=>'registration.fmc','roll_no']);
        $query->where(['class_id'=>$class]);
        $query->andwhere(['registration.active'=>'Y']);
        $query->andwhere(['shift_id'=>$shift]);
        $query->andwhere(['campus_id'=>$campus]);
        $query->andwhere(['session_id'=>$session_id]);
        
        $data = $query->toArray();
        $msg  = "Success|Found records. ". count($data) ;
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
        
    }
    
    public function updateRollNumbers(){
        
        $mData = [];
        $mData = $this->request->data['remarks_details'];
        $registration = TableRegistry::get('registration');
        $students_master_details = TableRegistry::get('students_master_details');
        foreach($mData as $row){
                
            $query = $registration->query();
            $query->update()
            ->set(['gr' => $row['gr_no'],
                    'fmc'=>$row['fmc_code']])
            ->where(['id_registration' => $row['regid'] ])
            ->execute();
            
            $query = $students_master_details->query();
            $query->update()
            ->set(['roll_no' => $row['roll_no']])
            ->where(['registration_id' => $row['regid'] ])
            ->execute();
        
        }
        $msg  = "Success|Record has been update.";
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
    }
}
