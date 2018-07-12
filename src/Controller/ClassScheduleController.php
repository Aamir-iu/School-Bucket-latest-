<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * ClassSchedule Controller
 *
 * @property \App\Model\Table\ClassScheduleTable $ClassSchedule
 */
class ClassScheduleController extends AppController
{

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','getemp','add','delete','uodatescheduler','getscheduler','search']) && $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
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
//        $this->paginate = [
//            'contain' => []
//        ];
        $classSchedule = $this->ClassSchedule->find();
        
        
        $table = TableRegistry::get('subjects');
        $subjects = $table->find('all');
        
        
        $classes_sections = TableRegistry::get('classes_sections');
        $class = $classes_sections->find('all');
        $class = $class->toArray();
        
        $table = TableRegistry::get('class_schedule');
        $query = $table->find('all')->contain(['Subjects','classes_sections','employees']);
        $query->select($table);
        $query->select(['sub'=>'Subjects.subject_name','class'=>'classes_sections.class_name','teacher'=>'employee_name']);
        
        $class_id = '';
        $shift_id = '';
        if ($this->request->is('post')) {
            $query->where(['class_id'=>$this->request->data['class_id']]);
            $query->andwhere(['shift_id'=>$this->request->data['shift_id']]);
            $class_id = $this->request->data['class_id'];
            $shift_id = $this->request->data['shift_id'];
        }else{
            $query->where(['class_id'=>$class[0]['id_class']]);
            $query->andwhere(['shift_id'=>1]);
        }
        $data = $query->toArray(); 
        
         // $table = TableRegistry::get('scheduler');
        $table = TableRegistry::get('employees');
        $query = $table->find(); //->contain(['employees']);
        $query->select(['id'=>'employees.employee_id','title'=>'employees.employee_name','color_code'=>'employees.color_code']);
        $query->where(['scheduler_status'=>'true']);
        $query->andwhere(['status'=>'Active']);
        $teacher = $query->toArray();
        
        
        $response = array(); 
        $response[1]['title'] = 'Monday';
        $response[2]['title'] = 'Tuesday';
        $response[3]['title'] = 'Wednesday';
        $response[4]['title'] = 'Thursday';
        $response[5]['title'] = 'Friday';
        $response[6]['title'] = 'Saturday';
     
        $this->set(compact('response','subjects','class','data','teacher','class_id','shift_id'));
        $this->set('_serialize', ['response','subjects','class','data','teacher']);
    }

    /**
     * View method
     *
     * @param string|null $id Class Schedule id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $classSchedule = $this->ClassSchedule->get($id, [
            'contain' => ['Days', 'Subjects', 'Classes', 'Shifts']
        ]);

        $this->set('classSchedule', $classSchedule);
        $this->set('_serialize', ['classSchedule']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      
        $classSchedule = $this->ClassSchedule->newEntity();
        if ($this->request->is('post')) {
            
            $day_id = $this->request->data['day_id'];
            $teacher_id = $this->request->data['teacher_id'];
            $temp_start_time = explode('T',$this->request->data['start_time']);
            $temp_end_time = explode('T',$this->request->data['end_time']);
           
            $exist = $this->ClassSchedule->exists(['day_id' => $day_id,'teacher_id'=>$teacher_id,'start_time >=' =>$temp_start_time[1],'end_time <='=>$temp_end_time[1]]);
            if(!empty($exist)){
            
                $msg = 'Error|The Teacher is already engged in this time. Please, try again.';
            }
            else{
                $classSchedule = $this->ClassSchedule->patchEntity($classSchedule, $this->request->data);
                $classSchedule->start_time = $temp_start_time[1];
                $classSchedule->end_time = $temp_end_time[1];       
                if ($this->ClassSchedule->save($classSchedule)) {
                    $msg =  'Success|The class schedule has been saved.';
                }else{
                    $msg = 'Error|The class schedule could not be saved. Please, try again.';
                }
            }    
        }
   
        $this->set(compact('scheduler','msg'));
        $this->set('_serialize', ['scheduler','msg']);
    }

    
    public function edit($id = null)
    {
        $classSchedule = $this->ClassSchedule->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classSchedule = $this->ClassSchedule->patchEntity($classSchedule, $this->request->data);
            if ($this->ClassSchedule->save($classSchedule)) {
                $this->Flash->success(__('The class schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The class schedule could not be saved. Please, try again.'));
        }
        $days = $this->ClassSchedule->Days->find('list', ['limit' => 200]);
        $subjects = $this->ClassSchedule->Subjects->find('list', ['limit' => 200]);
        $classes = $this->ClassSchedule->Classes->find('list', ['limit' => 200]);
        $shifts = $this->ClassSchedule->Shifts->find('list', ['limit' => 200]);
        $this->set(compact('classSchedule', 'days', 'subjects', 'classes', 'shifts'));
        $this->set('_serialize', ['classSchedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Class Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $classSchedule = $this->ClassSchedule->get($id);
        if ($this->ClassSchedule->delete($classSchedule)) {
            $msg =  'Success|The scheduler has been deleted.';
        } else {
            $msg =  'Error|The scheduler could not be deleted. Please, try again.';
        }
        
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
     public function uodatescheduler(){
        
            $event_id = $this->request->data['e_id'];  
            $res_id = $this->request->data['r_id'];
            $st = $this->request->data['st'];
            $et = $this->request->data['et'];
           
            $users = TableRegistry::get('class_schedule');    
            $query = $users->query();
            $query->update()
                ->set(['day_id' => $res_id
                        ,'start_time'=>$st
                        ,'end_time'=>$et])
                ->where(['id_class_schedule' => $event_id])
                ->execute();
            $msg = "Success|The event has been updated";
       
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
        
    }
    
    public function search(){
        
        echo "ok";
        exit;
        $msg = "Success|The event has been updated";

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
}
