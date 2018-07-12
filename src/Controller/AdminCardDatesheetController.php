<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * AdminCardDatesheet Controller
 *
 * @property \App\Model\Table\AdminCardDatesheetTable $AdminCardDatesheet
 */
class AdminCardDatesheetController extends AppController
{

    public function index()
    {
        
        $examMarksDetails = $this->AdminCardDatesheet->find()->contain(['classes_sections']);
        $examMarksDetails->distinct(['classes_sections.class_name']);
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        $table = TableRegistry::get('subjects');
        $subjects = $table->find('all');
 
        $exam_types = TableRegistry::get('exam_types');
        $exam_types = $exam_types->find('all');    
        
        
        $this->set(compact('examMarksDetails','class','subjects','exam_types'));
        $this->set('_serialize', ['examMarksDetails','classs','subjects','exam_types']);
        
    }

   
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
         if (in_array($action, ['index','add','edit','view','delete','adddetails','loadrecords']) && $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    
    
    
    public function view($class_id = null,$shift_id = null, $exam_type_id = null ,$temp_id = null)
    {
        $table = TableRegistry::get('students_master_details');
        $adminCardDatesheet = $table->find()->contain(['classes_sections','registration'])->hydrate(false);

        $adminCardDatesheet->select(['name'=>'student_name','fname'=>'father_name','img'=>'image']);
        $adminCardDatesheet->select(['class'=>'class_name','roll'=>'students_master_details.roll_no']);
        $adminCardDatesheet->select(['class_id','shift_id','registration_id','grno'=>'gr']);
        $adminCardDatesheet->where(['students_master_details.class_id'=>$class_id]);
        $adminCardDatesheet->andwhere(['students_master_details.shift_id'=>$shift_id]);
        $adminCardDatesheet->andwhere(['registration.active'=>'Y']);
        $adminCardDatesheet->order('roll_no');
        $res = $adminCardDatesheet->toArray();
        
        $table = TableRegistry::get('admin_card_datesheet');
        $data = array();
        foreach ($res as $dat) {
            
            $query = $table->find()->contain(['Subjects'])->hydrate(false);
            $query->where(['class_id'=>$dat['class_id']]);
            $query->andwhere(['shift_id'=>$dat['shift_id']]);
            $query->select(['date','time','day']);
            $query->select(['subject'=>'subject_name','message']);
            $sql = $query->toArray();
            
            
            $detailTable = TableRegistry::get('room_details');
            $query = $detailTable->find()->hydrate(false)
                    ->join([
                            [   'table' => 'room_master',
                                'type' => 'INNER',
                                'conditions' => 'room_master.id_room_master = room_details.room_id'
                            ]
                        ]);
            $query->select($detailTable);
            $query->select(['room'=>'room_master.room_name']);
            $query->where(['registration_id'=>$dat['registration_id']]);
            $rs = $query->toArray();
            
            $actions = array('details' =>$sql,'exam_roll'=>$rs);
            array_push($data, array_merge($dat, $actions));
        }
        
        if($temp_id == 1){
            $this->set('data', $data);
            $this->set('_serialize', ['adminCardDatesheet']);
        }else{
            $this->set('data', $data);
            $this ->render('view_1');
        }
    }

    public function loadrecords(){
        
        $class = $this->request->data['class'];
        $exam_types = $this->request->data['exam_types'];
        $shift_id = $this->request->data['shift_id'];
        
        $table = TableRegistry::get('admin_card_datesheet');
        $examType = $table->find()->contain(['Subjects','classes_sections','exam_types']);
        $examType->select(['subject_id','subject'=>'subject_name','sub_desc'=>'subject_desc']);
        $examType->select(['class'=>'class_name','dated'=>'date_format(admin_card_datesheet.date,"%d-%m-%Y")','day','time']);
        $examType->select(['et'=>'exam_type','exam_type_id','id_time_table','message']);
        $examType->where(['class_id'=>$class]);
        $examType->andwhere(['shift_id'=>$shift_id]);
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
        $shift_id = $this->request->data['shift_id'];
        $message = $this->request->data['message'];
        
        $table = TableRegistry::get('admin_card_datesheet');
        $query = $table->query();
        $query->delete()
        ->where(['class_id' =>$class_id,'exam_type_id'=>$exam_types,'shift_id'=>$shift_id])
        //->orwhere(['exam_type_id'=>0])        
        ->execute();
       
        foreach ($mData as $detail) {
            $examType = $table->newEntity();
            $examType->class_id = $class_id;
            $examType->shift_id = $shift_id;
            $examType->subject_id = $detail['subject_id'];
            $examType->exam_type_id = $detail['exam_type_id'];
            $examType->date = date("Y-m-d H:i:s", strtotime($detail['date']));
            $examType->day = $detail['day'];
            $examType->time = $detail['time'];
            $examType->created_on = date("Y-m-d H:i:s");
            $examType->created_by = $this->request->session()->read('Auth.User.id');
            $examType->message = $message;
            $table->save($examType);
             
        }
        $msg = "Success|The exam header has been saved.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    public function add()
    {
        $adminCardDatesheet = $this->AdminCardDatesheet->newEntity();
        if ($this->request->is('post')) {
            $adminCardDatesheet = $this->AdminCardDatesheet->patchEntity($adminCardDatesheet, $this->request->data);
            if ($this->AdminCardDatesheet->save($adminCardDatesheet)) {
                $this->Flash->success(__('The admin card datesheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin card datesheet could not be saved. Please, try again.'));
        }
        $classes = $this->AdminCardDatesheet->Classes->find('list', ['limit' => 200]);
        $shifts = $this->AdminCardDatesheet->Shifts->find('list', ['limit' => 200]);
        $subjects = $this->AdminCardDatesheet->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('adminCardDatesheet', 'classes', 'shifts', 'subjects'));
        $this->set('_serialize', ['adminCardDatesheet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin Card Datesheet id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminCardDatesheet = $this->AdminCardDatesheet->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminCardDatesheet = $this->AdminCardDatesheet->patchEntity($adminCardDatesheet, $this->request->data);
            if ($this->AdminCardDatesheet->save($adminCardDatesheet)) {
                $this->Flash->success(__('The admin card datesheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin card datesheet could not be saved. Please, try again.'));
        }
        $classes = $this->AdminCardDatesheet->Classes->find('list', ['limit' => 200]);
        $shifts = $this->AdminCardDatesheet->Shifts->find('list', ['limit' => 200]);
        $subjects = $this->AdminCardDatesheet->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('adminCardDatesheet', 'classes', 'shifts', 'subjects'));
        $this->set('_serialize', ['adminCardDatesheet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin Card Datesheet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminCardDatesheet = $this->AdminCardDatesheet->get($id);
        if ($this->AdminCardDatesheet->delete($adminCardDatesheet)) {
            $this->Flash->success(__('The admin card datesheet has been deleted.'));
        } else {
            $this->Flash->error(__('The admin card datesheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
