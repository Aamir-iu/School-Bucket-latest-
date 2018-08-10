<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Concession Controller
 *
 * @property \App\Model\Table\ConcessionTable $Concession
 */

class ConcessionController extends AppController
{

    
    public function index()
    {
        $concessiontbl = TableRegistry::get('concession');
        $concession = $concessiontbl->find()->contain(['Registration']);
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all'); 
        $concession = $concession->join(
                   [    'table' => 'students_master_details',
                        'type' => 'INNER',
                        'conditions' => 'students_master_details.registration_id = concession.registration_id'
                   ]);

        
        if (isset($_GET['class_id'])){
            $concession->where(['students_master_details.class_id '=> $_GET['class_id']]);
            /*echo "<pre>";
            print_r($concession);
            echo "<pre"; 
            exit();*/
 
        }
        else{

        }
        // print_r($_REQUEST);
        // exit();




/*echo "<pre>";
print_r($concession);
echo "<pre"; 
exit();*/
        $this->set(compact('concession','class'));
        $this->set('_serialize', ['concession']);
    }

   
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','studentinfo','view','adjust','stude'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
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

        $table = TableRegistry::get('concession');
        $mastertable = TableRegistry::get('students_master_details');
        $concession = $table->find()->hydrate(false)
            ->join([
                   [   'table' => 'registration',
                       'type' => 'INNER',
                       'conditions' => 'registration.id_registration = concession.registration_id'
                   ],
                   [   'table' => 'fee_types',
                       'type' => 'INNER',
                       'conditions' => 'fee_types.id_fee_type = concession.fee_type_id'
                   ],
                   [    'table' => 'students_master_details',
                        'type' => 'INNER',
                        'conditions' => 'students_master_details.registration_id = concession.registration_id'
                   ],
                   [   
                        'table' => 'classes_sections',
                         'alias' => 'cs',
                        'type' => 'INNER',
                        'conditions' => 'cs.id_class = students_master_details.class_id'
                    ]
               ]);
        
        $concession->select(['id_concession','registration_id','amount','from_date','to_date']);
        $concession->select(['sname'=>'registration.student_name','fname'=>'registration.father_name']);
        $concession->select(['clasid'=>'students_master_details.class_id']);
      
        $concession->select(['fee_type'=>'fee_types.fee_type_name']);
        if ($id == 1){
           // $concession->where(['concession_type'=>$id]);
            $concession->where(['amount >'=>0]);
        }else if ($id == 2){
          //  $concession->where(['concession_type'=>$id]);
            $concession->where(['amount ='=>0]);
        }
        $data = $concession->toArray();
        
        $this->set(compact('data','id'));
        $this->set('_serialize', ['data']);
        
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $concession = $this->Concession->newEntity();
        if ($this->request->is('post')) {
            $concession = $this->Concession->patchEntity($concession, $this->request->data);

            $conTable = TableRegistry::get('concession');
            $registrationble = TableRegistry::get('registration');
            $exists = $conTable->exists(['registration_id' => $this->request->data['registration_id'],'fee_type_id'=>$this->request->data['fee_type_id'], 'status' => 1]);
            if(empty($exists)){

                    $concession->from_date = date("Y-m-d H:i:s", strtotime($this->request->data['from_date']));
                    $concession->to_date = date("Y-m-d H:i:s", strtotime($this->request->data['to_date']));
                    $concession->registration_id = $this->request->data['registration_id'];
                    $concession->created_by = $this->request->session()->read('Auth.User.id');
                    if ($this->Concession->save($concession)) {
                        $query = $registrationble->query();
                        $query->update()
                        ->set(['fee_status' => 'C'])
                        ->where(['id_registration' => $this->request->data['registration_id']])
                        ->execute();
                        
                        
                        $duesTable = TableRegistry::get('dues');
                        $exists = $duesTable->exists(['registration_id' => $this->request->data['registration_id']]);
                        if(!empty($exists)){
                            
                            $query = $duesTable->query();
                            $query->update()
                            ->set(['amount' => $this->request->data['amount'],
                                   'fine' => $this->request->data['fine'] ])
                            ->where(['registration_id' => $this->request->data['registration_id'],
                                    'fee_type_id' => $this->request->data['fee_type_id']])
                            ->execute();
                        
                        }
                        
                        if($this->request->session()->read('Note.on_concession') == 1){
                            $this->sendNotification($this->request->data['registration_id']);
                        }
                        
                        $this->Flash->success(__('The concession has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The concession could not be saved. Please, try again.'));
                    }
                    
            }else{
                $this->Flash->error(__('The concession could not be saved.Record already exist and Active '));
            }
        }
      
        
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
        
        $this->set(compact('concession','feetype'));
        $this->set('_serialize', ['concession','feetype']);
    }

  public function sendNotification($id){
         
        $username 	= $this->request->session()->read('Info.user');
        $password 	= $this->request->session()->read('Info.password');
        $mobile 	= $this->request->session()->read('Info.phone'); 
        $sender 	= "SenderID";
        $message 	= "Admin Alert:";
        $message 	.= "\rThe User:". $this->request->session()->read('Auth.User.full_name');
        $message 	.= "\rHas Added The Concession :";
        $message 	.= "\rStudent ID Is :".$id;
        $message 	.= "\rThis is system generated automatic notification";
        $message 	.= "\r\n".$this->request->session()->read('Auth.school');
//        $url = "http://sms.eschools.cloud/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
//        $ch = curl_init();
//        $timeout = 30;
//        curl_setopt($ch,CURLOPT_URL,$url);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//        $responce = curl_exec($ch);
//        curl_close($ch);
        $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
        $url = "http://send.eschools.cloud/web_distributor/api/sms.php?username=".$username."&password=".$password."";
        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch); 
        
    }
    
    
    
    public function edit($id = null)
    {
        $concession = $this->Concession->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $concession = $this->Concession->patchEntity($concession, $this->request->data);
            $concession->from_date = date("Y-m-d", strtotime($this->request->data['from_date']));
            $concession->to_date = date("Y-m-d", strtotime($this->request->data['to_date']));
                    
            if ($this->Concession->save($concession)) {
                $this->Flash->success(__('The concession has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The concession could not be saved. Please, try again.'));
            }
        }
       
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        
        
        $this->set(compact('concession','feetype'));
        $this->set('_serialize', ['concession','feetype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Concession id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $id = $this->request->data['id'];
        $rid = $this->request->data['rid']; 
        $registrationble = TableRegistry::get('registration');
        $concession = $this->Concession->get($id);
        if ($this->Concession->delete($concession)) {
            $query = $registrationble->query();
                        $query->update()
                        ->set(['fee_status' => 'P'])
                        ->where(['id_registration' => $rid])
                        ->execute();
            
           $msg =  'Success|The concession has been deleted.';
        } else {
            $msg = 'Success|The concession could not be deleted. Please, try again.';
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
    
    public function studentinfo(){
        
        $id = $this->request->data['id'];
        $fee_type = $this->request->data['fee_type'];
        $registrationtbl = TableRegistry::get('students_master_details');
        $registration = $registrationtbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = students_master_details.registration_id'
                            ],
                            [   'table' => 'fee_heads',
                                'type' => 'INNER',
                                'conditions' => 'fee_heads.class_id = students_master_details.class_id'
                            ],
                            [   
                                'table' => 'classes_sections',
                                'type' => 'INNER',
                                'conditions' => 'classes_sections.id_class = students_master_details.class_id'
                            ]
                        ]);
        
        $registration->select(['student_name'=>'registration.student_name','father_name'=>'registration.father_name']);
        $registration->select(['clasname'=>'classes_sections.class_name']);
        $registration->select(['current_fee'=>'fee_heads.class_fees','class_id']);
        $registration->where(['registration_id'=>$id]);
        $registration->andwhere(['fee_type_id'=>$fee_type]);
        $data = $registration->toArray();
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }
    
    public function adjust(){
        
     
        
        $concessiontbl = TableRegistry::get('concession');
        $concession = $concessiontbl->find()->hydrate(false);
        $data = $concession->toArray();
        $dues = TableRegistry::get('dues');   
        foreach($data as $row){
        
           
            $query = $dues->query();
            $query->update()
            ->set(['amount' => $row['amount'],
                    'fine'=>$row['fine']])
            ->where(['registration_id' => $row['registration_id']])
            ->andwhere(['fee_type_id' => $row['fee_type_id']])
            ->execute();
      
        }
        $msg = "Success|Concession has been adjusted";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    public function students(){
        
        
       $classes_sectionsble = TableRegistry::get('classes_sections');
       $class               = $classes_sectionsble->find('all'); 
        
       $this->set(compact('class'));
       $this->set('_serialize', ['class']); 
        
    }
}
