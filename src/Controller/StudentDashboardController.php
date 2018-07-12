<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;


class StudentDashboardController extends AppController
{

   
    public function index()
    {
        $settingtbl = TableRegistry::get('sms_setting');
        $setting = $settingtbl->find();
        $setting->where(['status'=>1]);
        $result = $setting->first();
        $this->request->session()->write('Info.school',$result->school_name); 
        $this->request->session()->write('Info.user',$result->user_name); 
        $this->request->session()->write('Info.password',$result->password);
        $this->set(compact('m','f','class_wise','ayd','income','expanse','class_att','dues','birthdays','fees','montlyincome','monthlyexpanse'));
         
    }
    
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','getstudentsrecord','getpincode','generatepin'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    public function getstudentsrecord(){
        
        $cc = $this->request->data['cc'];
        $tbl = TableRegistry::get('registration');
        $query = $tbl->find();
        $query->where(['active'=>'Y']);
        $query->andwhere(['id_registration'=>$cc]);
        
        $result = $query->first();
        if(count($result) > 0){
            $msg = "Success|Record found";
            $this->request->session()->write('Student.Reg_id',$cc);
        }else{
            $msg = "Error|Sorry we couldn't find any results for this search.";
        }
      
        $this->set(compact('msg','result'));
        $this->set('_serialize', ['msg','result']);

    }
    
    public function getpincode(){
        
        $pin = $this->request->data['pin'];
        $tbl = TableRegistry::get('registration');
        $query = $tbl->find();
        $query->where(['active'=>'Y']);
        $query->andwhere(['pin_code'=>$pin]);
        
        $result = $query->first();
        if(count($result) > 0){
            $msg = "Success|Record found";
        }else{
            $msg = "Error|Sorry we couldn't find any PIN Code in database. Please click get PIN button.";
        }
      
        $this->set(compact('msg','result'));
        $this->set('_serialize', ['msg','result']);

    }
    
    public function generatepin(){
   
        $cc = $this->request->data['cc'];
        $tbl = TableRegistry::get('registration');
        $query = $tbl->find();
        $query->select(['pin_code','contact1']);
        $query->where(['active'=>'Y']);
        $query->andwhere(['id_registration'=>$cc]);
        $result = $query->first();
        if(count($result) > 0){
            
            $pincode  = $result->pin_code;
            if($pincode){
              
                $mobile = $result->contact1;
                $username 	= $this->request->session()->read('Info.user');
                $password 	= $this->request->session()->read('Info.password');
                $mobile 	= $mobile; 
                $sender 	= "SenderID";
                $message 	= "$pincode is PIN Code.";
                $url = "http://sms.eschools.cloud/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
               // $url = "http://sendpk.com/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
                $ch = curl_init();
                $timeout = 30;
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                $responce = curl_exec($ch);
                curl_close($ch);
                $msg = "Success|PIN Code has been sent to your mobile number.";
                
            }else{
              
                $pin = rand(1000,5000);
                $mobile = $result->contact1;
                $username 	= $this->request->session()->read('Info.user');
                $password 	= $this->request->session()->read('Info.password');
                $mobile 	= $mobile; 
                $sender 	= "SenderID";
                $message 	= "$pin is PIN Code.";
                $url = "http://sms.eschools.cloud/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
               // $url = "http://sendpk.com/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
                $ch = curl_init();
                $timeout = 30;
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                $responce = curl_exec($ch);
                curl_close($ch);
                
                $query = $tbl->query();
                $query->update()
                ->set(['pin_code' => $pin])
                ->where(['id_registration' => $cc])
                ->execute();
                $msg = "Success|PIN Code has been sent to your mobile number.";
            }
        }else{
            $msg = "Error|Sorry Your Mobile Number is Invalid.";
        }
        
        $this->set(compact('msg','mobile'));
        $this->set('_serialize', ['msg','mobile']);
        
    }
    
    
}
