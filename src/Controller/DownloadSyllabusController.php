<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * DownloadSyllabus Controller
 *
 * @property \App\Model\Table\DownloadSyllabusTable $DownloadSyllabus
 */
class DownloadSyllabusController extends AppController
{

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'view','delete'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    public function index(){
       
        $query = $this->DownloadSyllabus->find()->contain(['Registration', 'classes_sections', 'Shift']);
        $query->orderDesc('date');
      //  $query->group('class_id','date');
      //  $query->limit(50);
        $syllabus = $query->toArray();
        $query->hydrate(false);  
        $res = $query->ToArray();
        //$data = array();
        foreach ($res as $dat) {
            $link = $this->url()."download/".$dat['download'];
            $actions = array('actions' => "<a download href='$link' target='_blank' class='btn btn-icon waves-effect waves-light btn-success m-b-5'><i class='fa  fa-cloud-download'></i> Download Syllabus</a>");
            $data[] =  array_merge($dat, $actions);
        }
        
        if(isset($data)){
            $downloadSyllabus = $data;
        }else{
            $downloadSyllabus = array();
        }
        
        $classesbl = TableRegistry::get('classes_sections');
        $class_name = $classesbl->find('all');

        $this->set(compact('downloadSyllabus','class_name'));
        $this->set('_serialize', ['downloadSyllabus','DS']);
        
        
    }

    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    public function view($id = null)
    {
        $downloadSyllabus = $this->DownloadSyllabus->get($id, [
            'contain' => ['Registrations', 'Classes', 'Shifts']
        ]);

        $this->set('downloadSyllabus', $downloadSyllabus);
        $this->set('_serialize', ['downloadSyllabus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       
        if ($this->request->is('post')) {
            $insertindb = "";
            if(!empty($this->request->data['file']['tmp_name'])){
                
                $fileName = $this->request->data['file']['name'];
                $image_info = getimagesize($this->request->data['file']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $file_type    = $image_info['mime'];

              //  $newname = rand(1000,4000);
                $tmp = explode(".", $fileName);
                $extension = end($tmp);
                $name =  preg_replace('/\s+/', '', $fileName);
                $uploadPath = 'download/';
                $uploadFile = $uploadPath.$name.".".$extension;
                $insertindb = $name;
                move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
               // $registration->image = $insertindb;  
                
             }
            
            $table = TableRegistry::get('students_master_details');
            $query  = $table->find()->hydrate(false)->join([
                            [   'table' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = students_master_details.registration_id'
                            ]
                        ]);
            $query->select(['class_id','shift_id','registration_id']);
            $query->where(['class_id'=>$this->request->data['class_id']]);
            $query->andwhere(['shift_id'=>$this->request->data['shift_id']]);
            $query->andwhere(['registration.active'=>'Y']);
            $rs = $query->toArray();
            
            foreach($rs as $row){
                
                $downloadSyllabus = $this->DownloadSyllabus->newEntity();
                $downloadSyllabus->registration_id = $row['registration_id'];
                $downloadSyllabus->class_id = $row['class_id'];
                $downloadSyllabus->shift_id = $row['shift_id'];
                $downloadSyllabus->description = $this->request->data['desc'];
                $downloadSyllabus->download = $insertindb;
                $downloadSyllabus->date = date("Y-m-d");
                $this->DownloadSyllabus->save($downloadSyllabus);
               
            }
            
            $this->Flash->success(__('The download syllabus has been saved.'));
            return $this->redirect(['action' => 'index']);
            
         
        }
       
        $this->set(compact('downloadSyllabus', 'registrations', 'classes', 'shifts'));
        $this->set('_serialize', ['downloadSyllabus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Download Syllabus id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $downloadSyllabus = $this->DownloadSyllabus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $downloadSyllabus = $this->DownloadSyllabus->patchEntity($downloadSyllabus, $this->request->data);
            if ($this->DownloadSyllabus->save($downloadSyllabus)) {
                $this->Flash->success(__('The download syllabus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The download syllabus could not be saved. Please, try again.'));
        }
        
        $registrations = $this->DownloadSyllabus->Registrations->find('list', ['limit' => 200]);
        $classes = $this->DownloadSyllabus->Classes->find('list', ['limit' => 200]);
        $shifts = $this->DownloadSyllabus->Shifts->find('list', ['limit' => 200]);
        
        $this->set(compact('downloadSyllabus', 'registrations', 'classes', 'shifts'));
        $this->set('_serialize', ['downloadSyllabus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Download Syllabus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $downloadSyllabus = $this->DownloadSyllabus->get($id);
        if ($this->DownloadSyllabus->delete($downloadSyllabus)) {
            $this->Flash->success(__('The download syllabus has been deleted.'));
        } else {
            $this->Flash->error(__('The download syllabus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
