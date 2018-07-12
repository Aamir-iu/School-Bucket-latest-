<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Scheduler Controller
 *
 * @property \App\Model\Table\SchedulerTable $Scheduler
 */
class SchedulerController extends AppController
{

    public function index()
    {
       // $table = TableRegistry::get('scheduler');
        $table = TableRegistry::get('employees');
        $query = $table->find(); //->contain(['employees']);
        $query->select(['id'=>'employees.employee_id','title'=>'employees.employee_name','color_code'=>'employees.color_code']);
        $query->where(['scheduler_status'=>'true']);
        $response = $query->toArray();
        
        $table = TableRegistry::get('subjects');
        $subjects = $table->find('all');
        
        $table = TableRegistry::get('class_schedule');
        $query = $table->find('all')->contain(['Subjects','classes_sections','Days'])->hydrate(false);
        $query->select($table);
        $query->select(['sub'=>'Subjects.subject_name','class'=>'classes_sections.class_name','day'=>'day_name']);
        $data = $query->toArray(); 
        
       
        $classes_sections = TableRegistry::get('classes_sections');
        $class = $classes_sections->find('all');
        
        
        $this->set(compact('response','subjects','class','data'));
        $this->set('_serialize', ['response','subjects','class','data']);
    }

   public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','getemp','add','delete','uodatescheduler','getscheduler']) && $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    
    public function view($id = null)
    {
        $table = TableRegistry::get('scheduler');
        $query = $table->find()->contain(['employees']);
        $query->select(['id'=>'employees.employee_id','title'=>'employees.employee_name','color_code']);
        $response = $query->toArray();
        
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
       
        $scheduler = $this->Scheduler->newEntity();
        if ($this->request->is('post')) {
            $scheduler = $this->Scheduler->patchEntity($scheduler, $this->request->data);
       
            if ($this->Scheduler->save($scheduler)) {
                $msg =  'Success|The scheduler has been saved.';
            }else{
                $msg = 'Error|The scheduler could not be saved. Please, try again.';
            }
        }
        
        $this->set(compact('scheduler','msg'));
        $this->set('_serialize', ['scheduler','msg']);
        
    }

   
    public function edit($id = null)
    {
        $scheduler = $this->Scheduler->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $scheduler = $this->Scheduler->patchEntity($scheduler, $this->request->data);
            if ($this->Scheduler->save($scheduler)) {
                $this->Flash->success(__('The scheduler has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The scheduler could not be saved. Please, try again.'));
        }
        $this->set(compact('scheduler'));
        $this->set('_serialize', ['scheduler']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Scheduler id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $scheduler = $this->Scheduler->get($id);
        if ($this->Scheduler->delete($scheduler)) {
            $msg =  'Success|The scheduler has been deleted.';
        } else {
            $msg =  'Error|The scheduler could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
    public function getemp(){
        
        $id = $this->request->data['staff_id'];
        $table = TableRegistry::get('employees');
        $query = $table->find();
        $query->where(['employee_id'=>$id]);
        $res = $query->toArray();
        $staff_image = '';
        foreach ($res as $dat) {
            $staff_image = $this->url()."img/employees/".$dat['employee_pic']; 
        }
      
       $this->set(compact('staff_image'));
       $this->set('_serialize', ['staff_image']);
        
    }
    
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    public function getscheduler(){
        
        $table = TableRegistry::get('scheduler');
        $query = $table->find('all')->hydrate(false);
        $data = $query->toArray(); 
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
        
    }
    
   
    public function uodatescheduler(){
        
            $event_id = $this->request->data['e_id'];  
            $res_id = $this->request->data['r_id'];
            $st = $this->request->data['st'];
            $et = $this->request->data['et'];
           
            $users = TableRegistry::get('scheduler');    
            $query = $users->query();
            $query->update()
                ->set(['staff_id' => $res_id
                        ,'start_time'=>$st
                        ,'end_time'=>$et])
                ->where(['id_scheduler' => $event_id])
                ->execute();
            $msg = "Success|The event has been updated";
       
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
        
    }
    
    
    
}
