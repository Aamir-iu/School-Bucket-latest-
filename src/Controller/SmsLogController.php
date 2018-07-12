<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * SmsLog Controller
 *
 * @property \App\Model\Table\SmsLogTable $SmsLog
 */
class SmsLogController extends AppController
{

    public function index()
    {
        
        $classes_sections = TableRegistry::get('classes_sections');
        $class = $classes_sections->find('all');
        
        
        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
        
        $link = $this->url()."download/csv_sample.csv";
        
        $this->set(compact('smsLog','class','link','log','data','session'));
        $this->set('_serialize', ['smsLog','link','log']);
        
    }

   public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','edit','delete','add','ajaxSearch','sendsms',
            'sendsmsdefaulerts','bulksms','smsreport','exportnumbers','statistics'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
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
        $smsLog = $this->SmsLog->get($id, [
            'contain' => ['Campuses']
        ]);

        $this->set('smsLog', $smsLog);
        $this->set('_serialize', ['smsLog']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add(){
        
        $file =  WWW_ROOT."download/csv_sample.txt";
        $class_id = $this->request->data['class_id'];
        $shift_id = $this->request->data['shift_id'];
        $option_id = $this->request->data['option_id'];
        $message = $this->request->data['message'];
        $ids = $this->request->data['ids'];
        $type = $this->request->data['type'];
        $session_id = $this->request->data['session_id'];
        $status = $this->request->data['status'];
        
        $table = TableRegistry::get('registration');
        $query = $table->find()->hydrate(false)
                    ->join([
                            [   'table' => 'students_master_details',
                                'alias' => 'sm',
                                'type' => 'INNER',
                                'conditions' => 'sm.registration_id = registration.id_registration'
                            ]
                        ]);
        $query->select(['contact1','contact2','contact3','sname'=>'student_name']);
        //$query->group(['contact1']);
        $query->where(['active'=>$status]);
        $query->andwhere(['sm.session_id'=>$session_id]);
        
        if($option_id == 1){
            $query->andwhere(['sm.class_id'=>$class_id]);
            $query->andwhere(['sm.shift_id'=>$shift_id]);
        }elseif($option_id == 3){
            $query->where(['sm.registration_id IN' => $ids]);
        }
        $result = $query->toArray();
        
        if($result){
  
            $handle = fopen ($file, "w+");
            fclose($handle);

            $msg_status = $this->request->session()->read('Info.events');
            
            if($msg_status ==1){ /// Guardian
            
                    foreach($result as $row){
                       if($row['contact2'] > 0){ 
                           $contents = '92'.ltrim($row['contact2'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
            }elseif($msg_status ==2){ // students
            
                    foreach($result as $row){
                       if($row['contact3'] > 0){ 
                           $contents = '92'.ltrim($row['contact3'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
            }elseif($msg_status ==3){
            
                    foreach($result as $row){
                       if($row['contact1'] > 0){ 
                           $contents = '92'.ltrim($row['contact1'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
            }elseif($msg_status ==4){
            
                    foreach($result as $row){
                       if($row['contact1'] > 0){ 
                           $contents = '92'.ltrim($row['contact1'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($result as $row){
                       if($row['contact2'] > 0){ 
                           $contents = '92'.ltrim($row['contact2'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($result as $row){
                       if($row['contact3'] > 0){ 
                           $contents = '92'.ltrim($row['contact3'],'0').','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
        }
              
        $hostname = $this->url()."download/csv_sample.txt";
        $username = $this->request->session()->read('Info.user');
        $password = $this->request->session()->read('Info.password');
        $sender = "8023";
        $url = $hostname;
        $message = str_replace("&","and",$message);

        $post = "sender=".urlencode($sender)."&url=".$url."&message=".urlencode($message)."";
        $duplicate = 1;
        $url = "http://send.eschools.cloud/web_distributor/api/personalized.php?username=".$username."&password=".$password."&duplicate=".$duplicate."";
        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch); 
       
        
        $msg = "Success|The messages has been send.";        
        }else{       
        $msg = "Warning|Sorry no record found.";
        }
        $this->set(compact('msg','result','mobile'));
        $this->set('_serialize', ['msg','result','mobile']);
    }

    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    public function edit($id = null){
        $smsLog = $this->SmsLog->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $smsLog = $this->SmsLog->patchEntity($smsLog, $this->request->data);
            if ($this->SmsLog->save($smsLog)) {
                $this->Flash->success(__('The sms log has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sms log could not be saved. Please, try again.'));
            }
        }
        $campuses = $this->SmsLog->Campuses->find('list', ['limit' => 200]);
        $this->set(compact('smsLog', 'campuses'));
        $this->set('_serialize', ['smsLog']);
    }

   
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $smsLog = $this->SmsLog->get($id);
        if ($this->SmsLog->delete($smsLog)) {
            $this->Flash->success(__('The sms log has been deleted.'));
        } else {
            $this->Flash->error(__('The sms log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function bulksms(){
        
       // $this->render(false);
      
        ///$file = fopen("csv_sample.csv","w");
       $file =  WWW_ROOT."download/csv_sample.txt";
       $handle = fopen ($file, "w+");
       fclose($handle);
    
       if (($fd = fopen($file, "a")) !== false) { 
            fwrite($fd, 'hello word' . "\n");   
            fclose($fd); 
          }
        exit;
        
    } 
  
    public function exportnumbers(){
        
        $file =  WWW_ROOT."download/csv_sample.csv";
        $class_id = $this->request->data['class_id'];
        $shift_id = $this->request->data['shift_id'];
        $option_id = $this->request->data['option_id'];
        ///$message = $this->request->data['message'];
        $message = $this->request->data['message'];
        $ids = $this->request->data['ids'];
        
        $table = TableRegistry::get('registration');
        $query = $table->find()->hydrate(false)
                    ->join([
                            [   'table' => 'students_master_details',
                                'alias' => 'sm',
                                'type' => 'INNER',
                                'conditions' => 'sm.registration_id = registration.id_registration'
                            ]
                        ]);
        $query->select(['contact1','contact2','contact3']);
        $query->where(['active'=>'Y']);
        if($option_id == 1){
            $query->andwhere(['sm.class_id'=>$class_id]);
            $query->andwhere(['sm.shift_id'=>$shift_id]);
        }elseif($option_id == 3){
            $query->where(['sm.registration_id IN' => $ids]);
        }
        $result = $query->toArray();
        
        if($result){
  
            $file = fopen($file, 'w');
            fputcsv($file, array('Contact1'));
            foreach ($result as $row){
                fputcsv($file, $row);
                }
                fclose($file);
        
        }

      
        $msg = "Success|The numbers has been export.";        
        $this->set(compact('msg','result','mobile'));
        $this->set('_serialize', ['msg','result','mobile']);
        
    }
    
     public function smsreport(){
         
        $draw = $this->request->data['draw'];
        $start = $this->request->data['start'];
       
        $length = $this->request->data['length'];
        
         if (isset($this->request->data['order'])) {
            $order = $this->request->data['order'];
            $columns = $this->request->data['columns'];
            $orderby = $columns[$order[0]['column']]['data'];
            $orderdir = $order[0]['dir'];
        } else {
            $orderby = 'id';
            $orderdir = 'asc';
        }

        $status =  $this->request->data['apivalue']; 
         
        $username 	=  $this->request->session()->read('Info.user');
        $password 	=  $this->request->session()->read('Info.password');
//        $username = '923443005000';///Your Username
//        $password = 'gms';///Your Password
        
        $url = "http://send.eschools.cloud/web_distributor/users/view_sent_sms_details.php?username=".$username."&password=".$password."&time=".$status."&page=1"; 
        $ch  =  curl_init();
        $timeout  =  30;
        curl_setopt ($ch,CURLOPT_URL, $url) ;
        curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
        $response = curl_exec($ch) ;
        curl_close($ch) ; 
        
        $rs = json_decode($response);
      
        if(isset($rs->results[0]->messageid)){
            $data = $rs->results;
            $recordsTotal = $rs->total_records;
            $recordsFiltered = $rs->total_records;
        }else{
            $data = 0;
            $recordsTotal = 0;
            $recordsFiltered = 0;
        }
        $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
        $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']); 
        
        
        
    }
    
     public function sendsmsdefaulerts($flag = null){
     
        $file =  WWW_ROOT."download/csv_sample.txt";
        $class  = $this->request->data['class'];
        $shift  = $this->request->data['shift'];
        $status = $this->request->data['status'];
        $date = date("Y-m-d");
        $table = TableRegistry::get('student_attendance');
        $query = $table->find()->hydrate(false)
                ->join([
                            [   'table' => 'registration',
                                'alias' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = student_attendance.registration_id'
                            ]
                        ]);
        
        $query->select(['registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name','cell'=>'registration.contact1']);
        $query->select(['cell1'=>'registration.contact2','cell2'=>'registration.contact3']);
        
        $query->where(['student_attendance.attendace_date'=>date("Y-m-d", strtotime($date))]);
        $query->andwhere(['registration.active'=>'Y']);
        $query->andwhere(['status'=>$status]);
        
        if($flag ==0){
            $query->andwhere(['class_id'=>$class]);
            $query->andwhere(['shift_id'=>$shift]);
        }
        
        $data = $query->toArray();
        
        $message = $this->request->data['message'];
        $handle = fopen ($file, "w+");
        fclose($handle);
    
       // get id by session     
       $msg_status = $this->request->session()->read('Info.absent');
            
        if($msg_status ==1){ /// Guardian  
            
                    foreach($data as $row){
                       if($row['cell1'] > 0){ 
                           $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==2){ // students
            
                    foreach($data as $row){
                       if($row['cell2'] > 0){ 
                           $contents = '92'.ltrim($row['cell2'],'0').','.$row['sname'].','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==3){
            
                    foreach($data as $row){
                       if($row['cell'] > 0){ 
                           $contents = '92'.ltrim($row['cell'],'0').','.$row['sname'].','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
            
        }elseif($msg_status ==4){  // all
            
                    foreach($data as $row){
                       if($row['cell1'] > 0){ 
                           $contents = '92'.ltrim($row['cell1'],'0').','.$row['sname'].','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($data as $row){
                       if($row['cell2'] > 0){ 
                           $contents = '92'.ltrim($row['cell2'],'0').','.$row['sname'].','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
                    foreach($data as $row){
                       if($row['cell'] > 0){ 
                           $contents = '92'.ltrim($row['cell'],'0').','.$row['sname'].','.$row['sname'].PHP_EOL;
                           if (($fd = fopen($file, "a")) !== false) { 
                                fwrite($fd, $contents);   
                                fclose($fd); 
                            }
                       }  
                    }
                    
        }
      
       
        $hostname = $this->url()."download/csv_sample.txt";
        $username = $this->request->session()->read('Info.user');
        $password = $this->request->session()->read('Info.password');
        $sender = "SenderID";
        $url = $hostname;
        $message = str_replace("&","and",$message);

        $post = "sender=".urlencode($sender)."&url=".$url."&message=".urlencode($message)."";
        $duplicate = 1;
        $url = "http://send.eschools.cloud/web_distributor/api/personalized.php?username=".$username."&password=".$password."&duplicate=".$duplicate."";
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
    
    public function statistics(){
        
        $this->set(compact('data','msg'));
        $this->set('_serialize', ['data','msg']);
    }
    
}

