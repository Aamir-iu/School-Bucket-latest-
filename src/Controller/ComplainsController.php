<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Complains Controller
 *
 * @property \App\Model\Table\ComplainsTable $Complains
 */
class ComplainsController extends AppController
{

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
         if (in_array($action, ['index','add','edit','delete','sentNotifications','sendMessage','sendItems']) && $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
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
      
        $comp = $this->Complains->find()->contain(['Registration']);
        $unread = count($comp->where(['status'=>'Pending'])->toArray());
        $unread = $unread > 0 ? $unread : 0; 
        
        $complains = $this->Complains->find()->contain(['Registration'])->orderDesc('comp_date');
       
        
        
        $this->set(compact('complains','unread'));
        $this->set('_serialize', ['complains']);
        
        
    }

    
    public function sendItems(){
        
        $comp = $this->Complains->find()->contain(['Registration']);
        $unread = count($comp->where(['status'=>'Pending'])->toArray());
        $unread = $unread > 0 ? $unread : 0; 
        
        
        $this->loadModel('StudentsNotifications');
        $sentitems = $this->StudentsNotifications->find()->contain(['Registration','MobileNotifications']);
        
        $this->set(compact('sentitems','unread'));
        $this->set('_serialize', ['sentitems','unread']);
        
    }
    
    
    public function view($id = null)
    {
        $complain = $this->Complains->get($id, [
            'contain' => ['Campuses', 'Departments', 'Registrations']
        ]);

        $this->set('complain', $complain);
        $this->set('_serialize', ['complain']);
    }

   
    
    public function add($id = 0)
    {
        $this->loadModel('MobileNotifications');
        $complain = $this->Complains->newEntity();
        $mobileNotification = $this->MobileNotifications->newEntity();
        $table = TableRegistry::get('students_notifications');
        if ($this->request->is('post')) {
            $temp = explode(',',$this->request->data['to']);
            $mobileNotification = $this->MobileNotifications->patchEntity($mobileNotification, $this->request->data);
            if ($this->MobileNotifications->save($mobileNotification)) {
                
                foreach($temp as $row){
                    
                    $mn = $table->newEntity();
                    $mn->notification_id = $mobileNotification->id_notifications;
                    $mn->registration_id = $row;
                    $table->save($mn);
                    
                }
                
                $this->sendMessage($mobileNotification->id_notifications);
                $this->Flash->success(__('The mobile notification has been send.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mobile notification could not be send. Please, try again.'));
        }
        
        $comp = $this->Complains->find()->contain(['Registration']);
        $unread = count($comp->where(['status'=>'Pending'])->toArray());
        $unread = $unread > 0 ? $unread : 0;
        
        $this->set(compact('complain', 'Registration','unread','id'));
        $this->set('_serialize', ['complain']);
    }

   
    
    public function edit($id = null){
        $complain = $this->Complains->get($id, [
            'contain' => ['Registration']
        ]);
       
        $complain = $this->Complains->patchEntity($complain, $this->request->data);
        $complain->status = 'Received'; 
        if ($this->Complains->save($complain)) {
           // $this->Flash->success(__('The complain has been saved.'));
           // return $this->redirect(['action' => 'index']);
        }
        
        $comp = $this->Complains->find()->contain(['Registration']);
        $unread = count($comp->where(['status'=>'Pending'])->toArray());
        $unread = $unread > 0 ? $unread : 0; 
        
        $this->set(compact('complain', 'Registration','unread'));
        $this->set('_serialize', ['complain']);
    }

   
    
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $complain = $this->Complains->get($id);
        if ($this->Complains->delete($complain)) {
            $this->Flash->success(__('The complain has been deleted.'));
        } else {
            $this->Flash->error(__('The complain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function sendMessage($id = null){
        
        $table = TableRegistry::get('students_notifications');
        $query = $table->find()->hydrate(false)
            ->join([
                    [   'table' => 'mobile_notifications',
                        'alias' => 'MN',
                        'type' => 'INNER',
                        'conditions' => 'MN.id_notifications = students_notifications.notification_id'
                    ],
                    [   'table' => 'registration',
                        'type' => 'INNER',
                        'conditions' => 'registration.id_registration = students_notifications.registration_id'
                    ]
                ]);    
        $query->select(['notification_id','fcm_id'=>'registration.fmc_id','message'=>'MN.notification']);
        $query->where(['notification_id'=>$id]);
        $rs = $query->toArray();
        
        if($rs){
        
            foreach($rs as $row){
                if(!empty($row['fcm_id'])){
                    $this->sentNotifications($row['fcm_id'],$row['message'],$row['notification_id']);
                }

            }
        $message = "Notifiation has been sent.";
        $status = true;
        }else{
            $message = "Sorry! No Records Found";
            $status = false;
        }
        
        $this->set([
            'status' => $status, 'results' => $message,
            '_serialize' => ['results', 'status']
        ]);
         
        
    }
    public function sentNotifications($fcmId,$message,$messsage_id){
        
        $msg = array(
            'to'=>$fcmId,
            'notification' => array('body'=>"E-School App",'title'=>'E-Schools',
            'click_action'=>'ANNOUNCEMENTS','sound'=>'tone'),
            'data' => array(
                'type'=>"E-School App",
                'title'=>'E-Schools',
                "message"=>$message,
                "ann_id"=>$messsage_id));
        $headers = array(
                'Authorization: key=AAAAXxqH7kk:APA91bE02vQUWU0qEnIQ6LFkcvrLaP8aZ78BeXZjSu6DvwqRT8cHYMrBH57-9ogGrNKVC0cVk9oH2F3J-MoZmja_-z5KNjXPds3XdBhbomhtBkQD7o2TcmopwvZkAErGcIRhdHML8TTs',
                'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $msg ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        $resp = json_decode($result);
        if(isset($resp) && $resp->success == 1){
            return true;
        }else{
            return false;
        }
        
    }
    
    
}
