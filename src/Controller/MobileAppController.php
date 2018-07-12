<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;


// src/Controller/RecipesController.php
class MobileAppController extends AppController
{

    public function initialize(){
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['index','cashregister','getpincode','verifyschoolinstance','complains',
                            'studentinfos','accounts','homeworks','mastergallaery','gallerydetails'
                            ,'verifysms','getComplainsById','getComplainsByCompId','seggestions'
                            ,'dues','videogallaery','attendanceGraphs','remarks','downloadSyllabus'
                            ,'examinations','dailyNews','classSchedule','updateFMC','sentNotifications'
                            ,'sendMessage','notificationList','getLocation']);
    }
    public function index(){
      $msg = "done";
        
        //$recipes = $this->Recipes->find('all');
        $this->set([
            'msg' => $msg,
            '_serialize' => ['msg']
        ]);
    }
    public function view($id){
        $recipe = $this->Recipes->get($id);
        $this->set([
            'recipe' => $recipe,
            '_serialize' => ['recipe']
        ]);
    }
    public function add(){
        $recipe = $this->Recipes->newEntity($this->request->getData());
        if ($this->Recipes->save($recipe)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'recipe' => $recipe,
            '_serialize' => ['message', 'recipe']
        ]);
    }
    public function edit($id){
        $recipe = $this->Recipes->get($id);
        if ($this->request->is(['post', 'put'])) {
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
            if ($this->Recipes->save($recipe)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
    public function getpincode($id = null){
        
        $cc = $id;
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
                $username 	= "923452188682";//$this->request->session()->read('Info.user');
                $password 	= "1738";//$this->request->session()->read('Info.password');
                $mobile 	= $mobile; 
                $sender 	= "SenderID";
                $message 	= "Your pin code is : $pincode";
//                $url = "http://sms.eschools.cloud/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
//               // $url = "http://sendpk.com/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
//                $ch = curl_init();
//                $timeout = 30;
//                curl_setopt($ch,CURLOPT_URL,$url);
//                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//                $responce = curl_exec($ch);
//                curl_close($ch);
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
                $url = "http://bulksms.com.pk/api/sms.php?username=923452188682&password=1738";
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $result = curl_exec($ch); 
                $status = true;
                
            }else{
              
                $pin = rand(1000,5000);
                $mobile = $result->contact1;
                $username 	= "923452188682"; //$this->request->session()->read('Info.user');
                $password 	= "1738"; //$this->request->session()->read('Info.password');
                $mobile 	= $mobile; 
                $sender 	= "SenderID";
                $message 	= "Your pin code is : $pin";
//                $url = "http://sms.eschools.cloud/api/sms.php?username=".$username."&password=".$password."&mobile=".$mobile."&sender=".urlencode($sender)."&message=".urlencode($message)."";
//                $ch = curl_init();
//                $timeout = 30;
//                curl_setopt($ch,CURLOPT_URL,$url);
//                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//                $responce = curl_exec($ch);
//                curl_close($ch);
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
                $url = "http://bulksms.com.pk/api/sms.php?username=923452188682&password=1738";
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $result = curl_exec($ch); 
                $status = true;
                
                $query = $tbl->query();
                $query->update()
                ->set(['pin_code' => $pin])
                ->where(['id_registration' => $cc])
                ->execute();
                $status = true;
                $message = "Pin Code has been send to your given mobile number";
            }
        }else{
            $status = false;
            $message = "Oops! we are could not find your information";
        }
        
        $this->set([
            'status'=>$status,
            'messages'=>$message,
            '_serialize' => ['result','status','messages']
        ]);
  
    }
    public function verifysms($id, $pin) {
        $table_name = TableRegistry::get('registration');
        $query = $table_name->find('all');
        $query->where(['id_registration' => $id]);
        $query->andwhere(['pin_code' => $pin]);
        $result = $query->toArray();
        $data = array();
        $status = '';
        if ($result) {
            
                $table = TableRegistry::get('students_master_details');
                $sql = $table->find('all')->hydrate(false)
                            ->join([
                                    [   'table' => 'registration',
                                        'type' => 'INNER',
                                        'conditions' => 'registration.id_registration = students_master_details.registration_id'
                                    ],
                                    [   'table' => 'classes_sections',
                                        'type' => 'INNER',
                                        'conditions' => 'classes_sections.id_class = students_master_details.class_id'
                                    ]
                                ]);
                $sql->select(['registration_id','name'=>'registration.student_name','fname'=>'registration.father_name','img'=>'registration.image']);
                $sql->select(['class'=>'classes_sections.class_name']);
                $sql->select(['class_id','shift_id']);

                $sql->where(['registration_id'=>$id]);

                $res = $sql->toArray();
                $result1 = array();

                foreach ($res as $dat) {
                    $hostname = $this->url()."img/students_images/".$dat['img']; 
                    $img = array('image'=>$hostname);
                    array_push($result1, array_merge($dat, $img));
                }
                  
            $data = $result1;
            $status = true;
            $messsage = "Student Record found";
        } else {
            $messsage = "Sorry! No record found";
            $status = false;
        }
        $this->set([
            'status' => $status, 'studentDetails' => $data,'messages'=>$messsage,
            '_serialize' => ['studentDetails', 'status','messages']
        ]);
    }
    public function verifyschoolinstance($name = null){
        
        $table = TableRegistry::get('general_setting');
        $sql = $table->find('all');
        $instanceInfos = $sql->toArray();
        
        if(count($instanceInfos) > 0){
            $status = true;
            $message = "Instance Found.";
        }else{
            $status = false;
            $message = "Instance not Found.";
        }
        $this->set([
            'status'=>$status,
            'instanceInfos'=>$instanceInfos,
            'messages'=>$message,
            '_serialize' => ['instanceInfod','status','messages']
        ]);
    }
    public function studentinfos($id = null){
        
        $table = TableRegistry::get('students_master_details');
        $sql = $table->find('all')->hydrate(false)
                    ->join([
                            [   'table' => 'registration',
                                'type' => 'INNER',
                                'conditions' => 'registration.id_registration = students_master_details.registration_id'
                            ],
                            [   'table' => 'classes_sections',
                                'type' => 'INNER',
                                'conditions' => 'classes_sections.id_class = students_master_details.class_id'
                            ]
                        ]);
        $sql->select(['registration_id','name'=>'registration.student_name','img'=>'registration.image']);
        $sql->select(['class'=>'classes_sections.class_name']);
        $sql->select(['class_id','shift_id']);
        
        $sql->where(['registration_id'=>$id]);
        
        $res = $sql->toArray();
        $studentInfos = array();
        
        foreach ($res as $dat) {
            $hostname = $this->url()."img/students_images/".$dat['img']; 
            $img = array('image'=>$hostname);
            array_push($studentInfos, array_merge($dat, $img));
        }
        
        if(count($studentInfos) > 0){
            $status = true;
            $message = "Student information";
        }else{
            $status = false;
            $message = "Sorry! No Records Found.";
        }
        $this->set([
            'status'=>$status,
            'studentinfos'=>$studentInfos,
            'messsages'=>$message,
            '_serialize' => ['studentinfos','status','messsages']
        ]);
    }
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    public function accounts($id = null){
        
        $table = TableRegistry::get('fees');
        $sql = $table->find('all')->hydrate(false)
                    ->join([
                            [   'table' => 'months',
                                'type' => 'INNER',
                                'conditions' => 'months.id_month = fees.fee_month'
                            ],
                            [   'table' => 'fee_types',
                                'type' => 'INNER',
                                'conditions' => 'fee_types.id_fee_type = fees.fee_type_id'
                            ]
                        ]);
        
        $sql->select(['registration_id','inv_no','year','amount','date'=>'date_format(fees.fee_date,"%d-%M-%y")','payment_mode']);
        $sql->select(['fee_type'=>'fee_types.fee_type_name','month'=>'months.month_name']);
        $sql->where(['registration_id'=>$id]);
        $sql->orderDesc('inv_no');
        
        
        $accounts = $sql->toArray();
        
        if(count($accounts) > 0){
            $status = true;
            $message = "Fees History Found";
        }else{
            $status = false;
            $message = "Fees History Not Found";
        }
        $this->set([
            'status'=>$status,
            'accounts'=>$accounts,
            'messages'=>$message,
            '_serialize' => ['accounts','status','messages']
        ]);
    }
    public function dues($id = null){
        
        $table = TableRegistry::get('dues');
        $sql = $table->find('all')->hydrate(false)
                    ->join([
                            [   'table' => 'months',
                                'type' => 'INNER',
                                'conditions' => 'months.id_month = dues.fee_month'
                            ],
                            [   'table' => 'fee_types',
                                'type' => 'INNER',
                                'conditions' => 'fee_types.id_fee_type = dues.fee_type_id'
                            ]
                        ]);
        
        $sql->select(['registration_id','id_dues','year','amount','date'=>'date_format(dues.due_date,"%d-%M-%y")']);
        $sql->select(['fee_type'=>'fee_types.fee_type_name','month'=>'months.month_name']);
        $sql->where(['registration_id'=>$id]);
        $sql->orderDesc('id_dues');
        
        $dues = $sql->toArray();
        
        if(count($dues) > 0){
            $status = true;
            $message = "Dues History Found";
        }else{
            $status = false;
            $message = "Dues History Not Found";
        }
        $this->set([
            'status'=>$status,
            'dues'=>$dues,
            'messages'=>$message,
            '_serialize' => ['dues','status','messages']
        ]);
    }
    public function homeworks($class = null,$shift = null ){
                
        $table = TableRegistry::get('daily_diary');
        $sql = $table->find('all');
        $sql->select(['description','addiotion','priority','image','dated'=>'date_format(daily_diary.date,"%d-%M-%Y")']);
        
        $sql->where(['class_id'=>$class]);
        $sql->andwhere(['shift_id'=>$shift]);
        
        $homeworks = $sql->toArray();
        
        if(count($homeworks) > 0){
            $status = true;
            $message = "Homework found";
        }else{
            $status = false;
            $message = "Homework not found";
        }
        $this->set([
            'status'=>$status,
            'homeworks'=>$homeworks,
            'messages'=>$message,
            '_serialize' => ['result','status','homeworks','messages']
        ]);
    }
    public function mastergallaery() {

        $table_name = TableRegistry::get('master_gallery');
        $query = $table_name->find('all');
        $query->join([
            [ 'table' => 'gallery_details',
                'type' => 'INNER',
                'conditions' => 'gallery_details.master_gallery_id = master_gallery.id_master_gallery'
        ]]);
        $query->select($table_name);
        $query->select(["thumb" => "gallery_details.pic"]);
        $query->group(["master_gallery.id_master_gallery"]);
        $result = $query->toArray();
        $data = array();
        $status = '';
        if ($result) {
            $data = $result;
            $status = true;
        } else {
            $data = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'gallaries' => $data,
            '_serialize' => ['gallaries', 'status']
        ]);
    }
    public function gallerydetails($gid) {

        $table_name = TableRegistry::get('gallery_details');
        $query = $table_name->find('all');
        $query->select(["pic" => "gallery_details.pic"]);
        $query->where(["master_gallery_id" => $gid]);
        $result = $query->toArray();
        $data = array();
        $status = '';
        $arr = array();
        foreach ($result as $res) {
            $arr[] = $res['pic'];
        }
        if ($result) {
            $data = $arr;
            $status = true;
        } else {
            $data = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'images' => $data,
            '_serialize' => ['images', 'status']
        ]);
    }
    public function seggestions() {

        $campus_id = $this->request->data['campus_id']; //$this->request->query('campus_id');
        $registration_id = $this->request->data['registration_id'];
        $suggestion = $this->request->data['suggestion'];
        
        $table_name = TableRegistry::get('suggestions');
        $query = $table_name->newEntity();
        $query->campus_id = $campus_id;
        $query->registration = $registration_id;
        $query->suggestion = $suggestion;
        $message = '';
        if ($table_name->save($query)) {
            $message = "The seggestion has been submiited";
            $status = true;
        } else {
            $message = "The suggestion could not be submitted. Please, try again.";
            $status = false;
        }

        $this->set([
            'status' => $status, 'result' => $message,
            '_serialize' => ['result', 'status']
        ]);
    }
    public function complains() {

        $campus_id = $this->request->data['campus_id'];
        $registration_id = $this->request->data['registration_id'];
        $complain = $this->request->data['complain'];

        $table_name = TableRegistry::get('complains');
        $query = $table_name->newEntity();
        $query->campus_id = $campus_id;
        //  $query->department_id = $department_id;
        $query->registration_id = $registration_id;
        $query->complain = $complain;
        $query->comp_date = date("Y-m-d H:i:s");
        $message = '';
        if ($table_name->save($query)) {
                     
            $message = "The complain has been submiited";
            $status = true;
        } else {
            $message = "The complain could not be submitted. Please, try again.";
            $status = false;
        }

        $this->set([
            'status' => $status, 'result' => $message,
            '_serialize' => ['result', 'status']
        ]);
    }
    public function updateFCMToken() {

        $patientId = $this->request->query['patient_id'];
        $regId = $this->request->query['reg_id'];
        
        $table = TableRegistry::get('patients');    
        $query = $table->query();
        $id = $query->update()->set(['fcm_id' => $regId])->where(['id_patients' => $patientId])->execute();
        if($id){
            $this->set([
                'status' => true, 'result' => "Registered Succesfull",
                '_serialize' => ['result', 'status']
            ]);
        }else{
            $this->set([
                'status' =>false, 'result' => "Registration Failed",
                '_serialize' => ['result', 'status']
            ]);
        }
        
    }
    public function sendNotification2(){

        define( 'API_ACCESS_KEY', 'AAAAKSSZeKA:APA91bEYQSNvEvgGNDaDqJI9antLEF-FhLLz1A-AwuFRR_0BlkQY9_XpCMwoxWTlW28QQvA0nAP-FLqNrruzGt5G-tzbbIpWjDt33tVUFCIq_sGwcAZfx1tkOUI4J8DF7M3PbAgXwkku' );
        define( 'FIREBASE_SEND_URL', 'https://fcm.googleapis.com/fcm/send' );
        $msg = array(
		'to'=>'eCenQtVWHYI:APA91bEPjFy_quyFP64VhqwI9N25Rp0njpkmJLjnSwTeomb3qgCy2svYzbM6wdLeDLuQm_vGdNWT2gWdvgID2RpjKChWW9MfwjjRt9joClCi4EpKLsehQZfPb_rkgxlqp2eWteeOQeBe',
		'notification' => array('body'=>"test",'title'=>'Essa Lab',
			'click_action'=>'COMPLAIN_DETAIL','sound'=>'tone'),
		'data' => array('type'=>"type",'title'=>'Essa Lab',"compId"=>"15"));
//        $msg = array(
//            'type' => 'Notification',
//            'title' => 'Essa Lab',
//            'message' => "Your X-Ray report is ready");
        $fields = array(
            'registration_ids'=> array('eCenQtVWHYI:APA91bEPjFy_quyFP64VhqwI9N25Rp0njpkmJLjnSwTeomb3qgCy2svYzbM6wdLeDLuQm_vGdNWT2gWdvgID2RpjKChWW9MfwjjRt9joClCi4EpKLsehQZfPb_rkgxlqp2eWteeOQeBe'),
            'data'=> $msg
        );
		 
        $headers = array(
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json');
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, FIREBASE_SEND_URL );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $msg ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        $resp = json_decode($result);
        //echo $result;
        if($resp->success == 1){
            $this->set([
                'status' =>true, 'result' => "Sent Succesfull",
                '_serialize' => ['result', 'status']
            ]);
        }else{
            $this->set([
                'status' =>false, 'result' => "Failed to Send",
                '_serialize' => ['result', 'status']
            ]);
        }
    }
    public function getComplainsById($id){
        $tbl = TableRegistry::get("complains");
        $qry = $tbl->find('all');
        $date = $qry->func()->date_format([
                'complains.comp_date' => 'identifier',
                "'%d-%m-%Y'" => 'literal'
            ]);
        $qry = $qry->select(
                ["id_complain"=>"complains.id_complain",
                "campus_id"=>"complains.campus_id",
                "status"=>"complains.status",
                "complain"=>"complains.complain",
                "registration_id"=>"complains.registration_id",
                "date_complain"=>$date
            ]);
        $qry = $qry->where(["registration_id"=>$id]);
        $res = $qry->toArray();
        
        if($res){
            $this->set([
                "status"=>true,"complains"=>$res,
                "_serialize"=>['status','complains']]);
        }else{
            $this->set([
                "status"=>false,"complains"=>array(),
                "_serialize"=>['status','complains']]);
        }
    }
    public function getComplainsByCompId($compId){
        $tbl = TableRegistry::get("complains");
        $qry = $tbl->find('all');
        $date = $qry->func()->date_format([
                'complains.comp_date' => 'identifier',
                "'%d-%m-%Y'" => 'literal'
            ]);
        $qry = $qry->select(
                ["id_complain"=>"complains.id_complain",
                "campus_id"=>"complains.campus_id",
                "status"=>"complains.status",
                "complain"=>"complains.complain",
                "registration_id"=>"complains.registration_id",
                "date_complain"=>$date
            ]);
        $qry = $qry->where(["id_complain"=>$compId]);
        $res = $qry->toArray();
        if($res){
            $this->set([
                "status"=>true,"complains"=>$res,
                "_serialize"=>['status','complains']]);
        }else{
            $this->set([
                "status"=>false,"complains"=>array(),
                "_serialize"=>['status','complains']]);
        }
    }
    public function getCompMessagesById($compId){
        $tbl = TableRegistry::get("complain_messages");
        $qry = $tbl->find('all');
        $qry = $qry->select(["sent"=>"if(TIMESTAMPDIFF(day,sent_on,now()) > 0 ,
                CONCAT(TIMESTAMPDIFF(day,sent_on,now()),'d'),
                if(TIMESTAMPDIFF(hour,sent_on,now())>0,
                CONCAT(TIMESTAMPDIFF(hour,sent_on,now()),'h'),
                if(TIMESTAMPDIFF(minute,sent_on,now())>0,
                   CONCAT(TIMESTAMPDIFF(minute,sent_on,now()),'m'),
                   if(TIMESTAMPDIFF(second,sent_on,now())>0,
                      CONCAT(TIMESTAMPDIFF(second,sent_on,now()),'s'),
                      '0s')
                  )
               ) 
             )"]);
            
//            $date = $qry->func()->date_format([
//                'sent_on' => 'identifier',
//                "'%d-%m-%Y'" => 'literal'
//            ]);
        
        $qry = $qry->select(
                ["id_complain"=>"id_complain",
                "message"=>"message",
                "is_admin"=>"is_admin",
                "have_seen"=>"have_seen"
            ]);
        $qry = $qry->where(["id_complain"=>$compId]);
        $qry = $qry->order('sent_on desc');
        $res = $qry->toArray();
        if($res){
            $this->set([
                "status"=>true,"complainMessages"=>$res,
                "_serialize"=>['status','complainMessages']]);
        }else{
            $this->set([
                "status"=>false,"complainMessages"=>array(),
                "_serialize"=>['status','complainMessages']]);
        }
    }
    public function sendMsgComplain(){
        $complaindId = $this->request->query['complainId'];
        $msg = $this->request->query['message'];
        if(!$complaindId && !$msg){
           $this->set([
                'status' => false, 'result' => "Param missing",
                '_serialize' => ['result', 'status']
            ]); 
           return;
        }
        $isAdmin = 0;
        $table_name = TableRegistry::get('complain_messages');
        $query = $table_name->newEntity();
        $query->id_complain = $complaindId;
        $query->message = $msg;
        $query->is_admin = $isAdmin;
        if ($table_name->save($query)) {
            $message = "The complain messsage has been received";
            $status = true;
        } else {
            $message = "The complain message could not be submitted. Please, try again.";
            $status = false;
        }

        $this->set([
            'status' => $status, 'result' => $message,
            '_serialize' => ['result', 'status']
        ]);
    }
    public function videogallaery() {

        $table_name = TableRegistry::get('video_gallery');
        $query = $table_name->find('all');
        $result = $query->toArray();
        $data = array();
        $status = '';
        if ($result) {
            $data = $result;
            $status = true;
        } else {
            $data = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'videos' => $data,
            '_serialize' => ['videos', 'status']
        ]);
    }
    public function attendanceGraphs($id = null) {

        $att_data =  array();
        $pre_data =  array();
        $year   = date("Y");
        for($i = 1; $i <= 12;  $i++){
        
        $tbl = TableRegistry::get('student_attendance');
        $query = $tbl->find();
        $query->select(['registration_id','prsent' => $query->func()->count('status')]);
        $query->where(['registration_id'=>$id]);
        $query->andwhere(['MONTH(attendace_date) =' => $i]);
        $query->andwhere(['YEAR(attendace_date) =' => $year]);
        $query->andwhere(['status' => 'A']);
        $present = $query->first();
            if(count($present->prsent) > 0){
               $att_data[$i] = $present->prsent;
            }else{
               $att_data[$i] = 0;
            }
        
        }
      
        for($j = 1; $j <= 12;  $j++){
        $query = $tbl->find();
        $query->select(['prsent' => $query->func()->count('status')]);
        $query->where(['registration_id'=>$id]);
        $query->andwhere(['MONTH(attendace_date) =' => $j]);
        $query->andwhere(['YEAR(attendace_date) =' => $year]);
        $query->andwhere(['status' => 'P']);
        $present = $query->first();
            if(count($present->prsent) > 0){
               $pre_data[$j] = $present->prsent;
            }else{
                $pre_data[$j] = 0;
            }
        
        }
        if ($query) {
            $status = true;
            $messages = "Record record found";
        } else {
            $messages = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'prsents' => $pre_data,'absents'=>$att_data,
            '_serialize' => ['prsents','absents', 'status','messages']
        ]);
    }
    public function remarks($id = null) {

        $tbl = TableRegistry::get('remarks_for_students');
        $query = $tbl->find();
        $query->where(['registration_id'=>$id]);
        $remarks = $query->first();
        
        
        $data = array();
        $status = '';
        if ($remarks) {
            $data = $remarks;
            $status = true;
            $messages = "Record found";
        } else {
            $messages = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'remarks' => $data,
            '_serialize' => ['remarks', 'status','messages']
        ]);
    }
    public function downloadSyllabus($id = null) {

        $tbl = TableRegistry::get('download_syllabus');
        $query = $tbl->find();
        $query->where(['registration_id'=>$id]);
        $syllabus = $query->first();
        $data = '';
        $status = '';
        if ($syllabus) {
            $data = $syllabus;
            $status = true;
            $messages = "Record found";
        } else {
             $data = null;
            $messages = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'syllabus' => $data,
            '_serialize' => ['syllabus', 'status','messages']
        ]);
    }
    public function examinations($id = null) {

        $tbl = TableRegistry::get('exam_results');
        $query = $tbl->find()->hydrate(false)
            ->join([
                    [   'table' => 'exam_types',
                        'type' => 'INNER',
                        'conditions' => 'exam_types.id_exam_types = exam_results.exam_type_id'
                    ],
                [   'table' => 'session',
                        'type' => 'INNER',
                        'conditions' => 'session.id_session = exam_results.session_id'
                    ]
                
                ]);
        $query->select(['registration_id','total_marks','obtain_marks','per','grade','no_of_rank','remarks','result']);
        $query->select(['exam_type'=>'exam_types.exam_type','session'=>'session.session']);
        $query->where(['registration_id'=>$id]);
        $test = $query->toArray();
        
        $data = array();
        $status = '';
        if ($test) {
            $data = $test;
            $status = true;
            $messages = "Record found";
        } else {
            $messages = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'examinations' => $data,
            '_serialize' => ['examinations', 'status','messages']
        ]);
        
    }
    public function dailyNews() {

        $tbl = TableRegistry::get('daily_news');
        $query = $tbl->find();
        $query->select(['id_news','subject','desc','date'=>'date_format(daily_news.news_date,"%d-%M-%y")']);
        $news = $query->first();
        
        
        $data = array();
        $status = '';
        if ($news) {
            $data = $news;
            $status = true;
            $messages = "Record found";
        } else {
            $messages = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'news' => $data,
            '_serialize' => ['news', 'status','messages']
        ]);
    }
    public function classSchedule($class_id = null,$shift_id = null){
        
        $tbl = TableRegistry::get('days');
        $query = $tbl->find()->hydrate(false);
        $query->where(['status'=>'Yes']);
        $rs = $query->toArray();
        $result = '';
        $data = array();
        foreach($rs as $row){
        
        $table = TableRegistry::get('class_schedule');
        $query = $table->find()->hydrate(false)->contain(['Subjects']);
        $query->select(['period_id'=>'id_class_schedule']);
        $query->select(['S_Time'=>'date_format(class_schedule.start_time,"%H:%i:%s")']);
        $query->select(['E_Time'=>'date_format(class_schedule.end_time,"%H:%i:%s")']);
        $query->select(['subject'=>'subject_name']);
        $query->where(['class_id'=>$class_id]);
        $query->andwhere(['shift_id'=>$shift_id]);
        $query->andwhere(['day_id'=>$row['id_days']]);
        $res = $query->all();
        
        
            $arr = array();
            foreach($res as $r){
                
                $arr['period_id'] = $r['period_id'];
                $arr['S_Time'] = $r['S_Time'];
                $arr['E_Time'] = $r['E_Time'];
                $arr['subject'] = $r['subject'];
                $arr['day'] = trim($row['day_name']);
               
                array_push($data, array_merge($arr));
            }
            
          
            
        }
        
        $status = '';
        
        if ($data) {
            $result = $data;
            $status = true;
            $messages = "Record found";
        } else {
            $messages = "Sorry! No record found";
            $status = false;
        }
     
        $this->set([
            'status' => $status, 'timeTables' => $result,
            '_serialize' => ['timeTables', 'status','messages']
        ]);
    }
    public function updateFMC(){
        
        if(isset($this->request->data['fcm_id']) && isset($this->request->data['registration_id'])){
            $fmc_id = $this->request->data['fcm_id'];
            $registration_id = $this->request->data['registration_id'];
        }else{
             $this->set([
                'status' => false, 'result' => "Param missing",
                '_serialize' => ['result', 'status']
            ]); 
           return;
        }
       
       
        if(!$fmc_id && !$registration_id){
           $this->set([
                'status' => false, 'result' => "Param missing",
                '_serialize' => ['result', 'status']
            ]); 
           return;
        }
        
       
        $table = TableRegistry::get('registration');    
        $query = $table->query()->update()->set(['fmc_id' => $fmc_id])->where(['id_registration' => $registration_id])
        ->execute();
        $message = "The FMC ID has been updated";
        $status = true;
        
//        if ($table->query()->update()->set(['fmc_id' => $fmc_id])->where(['id_registration' => $registration_id])) {
//            $message = "The FMC ID has been updated";
//            $status = true;
//        } else {
//            $message = "The FMC ID could not be updated. Please, try again.";
//            $status = false;
//        }

        $this->set([
            'status' => $status, 'results' => $message,
            '_serialize' => ['results', 'status']
        ]);
    }
    public function sendMessage(){
        
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
        
        $rs = $query->toArray();
        
        if($rs){
        
            foreach($rs as $row){

                $this->sentNotifications($row['fcm_id'],$row['message'],$row['notification_id']);

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
        if($resp->success == 1){
            return true;
        }else{
            return false;
        }
        
    }
    public function notificationList($id = null){
       
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
        $query->select(['registration_id','notification_id','message'=>'MN.notification']);
        $query->where(['registration_id'=>$id]);
        
        $data = $query->toArray();
    
        $status = '';
        if ($data) {
            $data = $data;
            $status = true;
            $messages = "Record found";
        } else {
            $messages = "Sorry! No record found";
            $status = false;
        }

        $this->set([
            'status' => $status, 'notifications' => $data,
            '_serialize' => ['notifications', 'status','messages']
        ]);
        
    }
    
    
    public function getLocation($name = null){
        
        $table = TableRegistry::get('google_location');
        $sql = $table->find();
        
        $instanceInfos = $sql->first();
        
        if(count($sql) > 0){
            $status = true;
            $message = "Locatiion Found.";
        }else{
            $status = false;
            $message = "Locatiion not Found.";
        }
        $this->set([
            'status'=>$status,
            'locations'=>$sql,
            'messages'=>$message,
            '_serialize' => ['locations','status','messages']
        ]);
    }
    
    
}
