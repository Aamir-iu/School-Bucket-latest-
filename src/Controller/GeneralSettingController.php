<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * GeneralSetting Controller
 *
 * @property \App\Model\Table\GeneralSettingTable $GeneralSetting
 */
class GeneralSettingController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $generalSetting = $this->GeneralSetting->find();
        $generalSetting = $generalSetting->toArray();
        
        $table = TableRegistry::get('apps_countries');
        $country = $table->find('all');
        
        $table = TableRegistry::get('currency');
        $currency = $table->find('all');
        
        $table = TableRegistry::get('timezone');
        $timezone = $table->find('all');
        
        $this->set(compact('generalSetting','country','currency','timezone'));
        $this->set('_serialize', ['generalSetting','country','currency','timezone']);
        
        
        
    }

     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','edit','updatelogo','smssetting'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
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
        $generalSetting = $this->GeneralSetting->get($id, [
            'contain' => []
        ]);

        $this->set('generalSetting', $generalSetting);
        $this->set('_serialize', ['generalSetting']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $generalSetting = $this->GeneralSetting->newEntity();
        if ($this->request->is('post')) {
            $generalSetting = $this->GeneralSetting->patchEntity($generalSetting, $this->request->data);
            if ($this->GeneralSetting->save($generalSetting)) {
                $this->Flash->success(__('The general setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The general setting could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('generalSetting'));
        $this->set('_serialize', ['generalSetting']);
    }

   
    public function edit($id = null){
    
        $generalSetting = $this->GeneralSetting->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $generalSetting = $this->GeneralSetting->patchEntity($generalSetting, $this->request->data);
            if ($this->GeneralSetting->save($generalSetting)) {
               // $this->Flash->success(__('The general setting has been saved.'));
                $msg = "Success|The general setting has been saved.";
              //  return $this->redirect(['action' => 'index']);
            } else {
              //  $this->Flash->error(__('The general setting could not be saved. Please, try again.'));
                 $msg = "Error|The general setting could not be saved. Please, try again.";
            }
        }
        $this->set(compact('generalSetting','msg'));
        $this->set('_serialize', ['generalSetting','msg']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $generalSetting = $this->GeneralSetting->get($id);
        if ($this->GeneralSetting->delete($generalSetting)) {
            $this->Flash->success(__('The general setting has been deleted.'));
        } else {
            $this->Flash->error(__('The general setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function updatelogo(){
        
        if(!empty($this->request->data['file']['tmp_name'])){
                
                $fileName = $this->request->data['file']['name'];
                $image_info = getimagesize($this->request->data['file']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $file_type    = $image_info['mime'];

                if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                   && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" ) {
                   $msg =  'Warning|Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                   
                }elseif($image_width>127 || $image_height>127) 
                { 
                    $msg = 'Warning| Exceeded image dimension limits.You can upload 127px X 127px maximam dimension. ';
                }else{
                    $fileName = $this->request->data['file']['name'];
                    $image_info = getimagesize($this->request->data['file']['tmp_name']);

                    $newname ="logo"; //rand(1000,5000).'-'.$id;
                    $tmp = explode(".", $fileName);
                    $extension = end($tmp);

                    $uploadPath = 'img/';
                    $uploadFile = $uploadPath.$newname.".png";
                    $insertindb = $newname.".png";
                    move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
                    //$registration->image = $insertindb;
                    $settingable = TableRegistry::get('general_setting');    
                    $query = $settingable->query();
                    $query->update()
                    ->set(['logo' => $insertindb])
                    ->where(['id_general_setting' => 1])
                    ->execute();
                    
                    
                    $fileName = $this->request->data['file']['name'];
                    $msg = "Success|Image load successfully";
                }    
             }
        
        $this->set(compact('msg','fileName'));
        $this->set('_serialize', ['msg','fileName']);
        
    }
    
    public function smssetting(){
        
       // $generalSetting = $this->GeneralSetting->newEntity();
        if ($this->request->is('post')) {
           
            $table = TableRegistry::get('sms_setting');
            $query = $table->find();
            $id = $query->first();
          
            $sql = $table->query();
            $sql->update()
            ->set(['admission'          => $this->request->data['admission'],
                    'admission_msg'     => $this->request->data['admission_msg'],
                    'absent'            => $this->request->data['absent'],
                    'absent_msg'        => $this->request->data['absent_msg'],
                    'examcreation'      => $this->request->data['examcreation'],
                    'examcreation_msg'  => $this->request->data['examcreation_msg'],
                    'examresults'       => $this->request->data['examresults'],
                    'examresults_msg'   => $this->request->data['examresults_msg'],
                    'feedates'          => $this->request->data['feedates'],
                    'feedates_msg'      => $this->request->data['feedates_msg'],
                    'events'            => $this->request->data['events'],
                    'events_msg'        => $this->request->data['events_msg'],
                    'onlineenquiry'     => $this->request->data['onlineenquiry'],
                    'onlineenquiry_msg' => $this->request->data['onlineenquiry_msg'],
                    'feepayment'        => $this->request->data['feepayment'],
                    'feepayment_msg'    => $this->request->data['feepayment_msg'],
                    'transportallocation'       => $this->request->data['transportallocation'],
                    'transportallocation_msg'   => $this->request->data['transportallocation_msg'],
                   // 'assignment'        => $this->request->data['assignment'],
                   // 'assignment_msg'    => $this->request->data['assignment_msg'],
                    ])
            ->where(['id_setting' => $id->id_setting])
            ->execute();
            //absent message
            $this->request->session()->write('Info.absent',$this->request->data['absent']);
            $this->request->session()->write('Info.absent_msg',$this->request->data['absent_msg']);
            //prsent message
            $this->request->session()->write('Info.examcreation',$this->request->data['examcreation']);
            $this->request->session()->write('Info.examcreation_msg',$this->request->data['examcreation_msg']);
            
            //General message
            $this->request->session()->write('Info.events',$this->request->data['events']);
            $this->request->session()->write('Info.events_msg',$this->request->data['events_msg']);
            
            
            $msg = 'Success|The SMS setting has been saved.';
            
        }
        $table = TableRegistry::get('sms_setting');
        $query = $table->find();
        $settings = $query->toArray();
        
        $this->set(compact('msg','settings'));
        $this->set('_serialize', ['msg','settings']);
    }
    
    
}
