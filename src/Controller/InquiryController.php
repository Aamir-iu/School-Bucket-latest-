<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Inquiry Controller
 *
 * @property \App\Model\Table\InquiryTable $Inquiry
 */
class InquiryController extends AppController
{

    
    public function index()
    {
        $table = TableRegistry::get('inquiry');
        $inquiry = $table->find('all')->contain(['Users','classes_sections']);
        // $inquiry->where(['status'=>'confirmed']);
        // $inquiry->andwhere(['status'=>'Pending']);
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        
        $areaTable = TableRegistry::get('area');
        $area               = $areaTable->find('all');
        
        $link = $this->url()."download/csv_sample.csv";

        $settingtbl = TableRegistry::get('sms_setting');
        $setting = $settingtbl->find();
        $setting->where(['status'=>1]);
        $result = $setting->first();
        //$mobile = '92'.ltrim($number,'0');
        $msg =  $result->feepayment_msg;


        
        $this->set(compact('inquiry','class','area','link','msg'));
        $this->set('_serialize', ['inquiry','class','area','link','msg']);
        
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
        if (in_array($action, ['index','view','edit','delete','close','pending','add','sendsmsall','exportnumbers','inquiryreport','sendsms','addarea'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    
    
    public function view($id = null){
        
        $flag = $this->request->params['pass'][0];
        $from = $this->request->params['pass'][1];
        $to = $this->request->params['pass'][2];
        $class = $this->request->params['pass'][3];
        $area = $this->request->params['pass'][4];
       ;
        
        $inquiry = $this->Inquiry->find()->contain(['classes_sections','area']);
        $inquiry->where(['inquery_date >=' => date("Y-m-d H:i:s", strtotime($from)), 'inquery_date <=' => date("Y-m-d H:i:s", strtotime($to))]);
        if (!empty($class) && $class !== 'Select') {
        $inquiry->andwhere(['for_class_id'=>$class]);
        }
        if (!empty($area) && $area !== 'Select') {
        $inquiry->andwhere(['area_id'=>$area]);
        }
        
         $this->set(compact('inquiry','from','to'));
        $this->set('_serialize', ['inquiry','from','to']);
        
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $date = date("Y-m-d");
        $inquiry = $this->Inquiry->newEntity();
        if ($this->request->is('post')) {
            $inquiry = $this->Inquiry->patchEntity($inquiry, $this->request->data);
            $inquiry->f_name = $this->request->data['fn'];
            $inquiry->l_name = $this->request->data['ln'];
            $inquiry->for_class_id = $this->request->data['class_id'];
            $inquiry->contact = $this->request->data['contact'];
            $inquiry->occupation = $this->request->data['occupation'];
            $inquiry->address = $this->request->data['address'];
            $inquiry->area_id = $this->request->data['area_id'];
            $inquiry->sibling = $this->request->data['sibling'];
            $inquiry->inquery_date = date("Y-m-d", strtotime($date));
            $inquiry->created_by = $this->request->session()->read('Auth.User.id');

            if ($this->Inquiry->save($inquiry)) {
                $msg = 'Success|The inquiry has been saved.';
            } else {
                $msg = 'Success|The inquiry could not be saved. Please, try again.';
            }
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

   
    
    
    public function edit($id = null)
    {
        $inquiry = $this->Inquiry->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inquiry = $this->Inquiry->patchEntity($inquiry, $this->request->data);
            if ($this->Inquiry->save($inquiry)) {
                $this->Flash->success(__('The inquiry has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The inquiry could not be saved. Please, try again.'));
            }
        }
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        
        $this->set(compact('inquiry','class'));
        $this->set('_serialize', ['inquiry','class']);
    }

   
    public function delete($id = null)
    {
        
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $inquiry = $this->Inquiry->get($id);
        if ($this->Inquiry->delete($inquiry)) {
            $msg = 'Success|The inquiry has been deleted.';
        } else {
            $msg = 'Success|The inquiry could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    //   close function
    public function close($id = null)
    {
        if(!empty($this->request->data['id'])){
            $inquirytbl = TableRegistry::get('inquiry');
            $query = $inquirytbl->query();
            $query->update()
                ->set(['status' => 'Closed'])
                ->where(['id_inquery' => $this->request->data['id']])
                ->execute();

                 
            $msg = 'Success|The inquiry has been closed.';
        } else {
            $msg = 'Success|The inquiry could not be closed. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

    public function pending($id = null)
    {
        
        /*$id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'close']);
        $inquiry = $this->Inquiry->get($id);
        if ($this->Inquiry->update($inquiry)->set(['status' => 'Closed'])->execute()) {*/
            if(!empty($this->request->data['id'])){
                   $inquirytbl = TableRegistry::get('inquiry');
                   $query = $inquirytbl->query();
                   $query->update()
                       ->set(['status' => 'Pending'])
                       ->where(['id_inquery' => $this->request->data['id']])
                       ->execute();

                 
            $msg = 'Success|The inquiry has been pending.';
        } else {
            $msg = 'Success|The inquiry could not be pending. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    public function sendsms(){
         
        $message = $this->request->data['message'];
        $id = $this->request->data['reg_id'];
        $date = date("Y-m-d");
        $table = TableRegistry::get('inquiry');
        $query = $table->find();
        $query->select($table);
        $query->where(['id_inquery'=>$id]);
        $data = $query->first();
        $cell = $data->contact;
            
            if($cell){
                
                $username 	= $this->request->session()->read('Info.user');
                $password 	= $this->request->session()->read('Info.password');
                $mobile 	=$cell; 
                $sender 	= "SenderID";
                $message        = $message;

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
                $responce = curl_exec($ch); 
                $msg  = "Success|Messages has been send. ";
            }else{
                $msg  = "Error|Sorry SMS could not be send.Invalid contact number";
            }
            
            $this->set(compact('data','msg'));
            $this->set('_serialize', ['data','msg']);
        
        
    }
    
    
     public function addarea() {

        $this->loadModel('Area');
        $Area = $this->Area->newEntity();
        if ($this->request->is('post')) {
           // $Area = $this->Area->patchEntity($Area, $this->request->data);
            $Area->area_name = ucwords($this->request->data['area']);
            $Area->created_by = $this->request->session()->read('Auth.User.id');
            $exists = $this->Area->exists(['area_name' => $this->request->data['area']]);
            if ($exists) {
                $msg = 'Exist';
            } else {
                if ($this->Area->save($Area)) {
                    $msg = 'Success|The area has been saved.';
                } else {
                    $msg = 'Error|The area could not be saved. Please, try again.';
                }
            }

            $this->set(compact('msg', 'Area'));
            $this->set('_serialize', ['msg', 'Area']);
        }
    }
    
    
    public function inquiryreport(){
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        $areaTable = TableRegistry::get('area');
        $area               = $areaTable->find('all');
        $class->toArray();
        $this->set(compact('inquiry','class','area'));
        $this->set('_serialize', ['inquiry','class','area']); 
    }
    
    
    public function sendsmsall(){
         
        $message = $this->request->data['message'];
        $date = date("Y-m-d");
        $table = TableRegistry::get('inquiry');
        $query = $table->find();
        $query->select($table);
        $data = $query->toArray();
        $cell = '';
        foreach($data as $row){
            $cell .= $row['contact'].',';  
            
        }
       $cell = rtrim($cell,','); 
            
            if($cell){
                
                $username 	= $this->request->session()->read('Info.user');
                $password 	= $this->request->session()->read('Info.password');
                $mobile 	=$cell; 
                $sender 	= "SenderID";
                $message        = $message;

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
                $responce = curl_exec($ch); 
                $msg  = "Success|Messages has been send. ";
                
            }else{
                $msg  = "Error|Sorry SMS could not be send.Invalid contact number";
            }
            
            $this->set(compact('data','msg'));
            $this->set('_serialize', ['data','msg']);
        
        
    }
    
    
     public function exportnumbers(){
        
        $file =  WWW_ROOT."download/csv_sample.csv";
       
        $table = TableRegistry::get('inquiry');
        $query = $table->find()->hydrate(false);
        $query->select(['contact']);
        $result = $query->toArray();
        
     
        if($result){
  
            $file = fopen($file, 'w');
            fputcsv($file, array('Contact'));
            foreach ($result as $row){
                fputcsv($file, $row);
                }
                fclose($file);
        
        }
   
       
        $msg = "Success|The numbers has been export.";        
        $this->set(compact('msg','result','mobile'));
        $this->set('_serialize', ['msg','result','mobile']);
        
    }
    
    
}
