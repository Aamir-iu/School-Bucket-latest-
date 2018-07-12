<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;


class StudentPortalController extends AppController
{

   
    public function index()
    {
        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d"); 
        
        
        $tbl = TableRegistry::get('remarks_for_students');
        $query = $tbl->find();
        $query->where(['registration_id'=>$this->request->session()->read('Student.Reg_id')]);
        $remarks = $query->first();
        
        
        $tbl = TableRegistry::get('registration');
        $query = $tbl->find();
        $query->where(['id_registration'=>$this->request->session()->read('Student.Reg_id')]);
        $registration = $query->first();
        
        $att_data =  array();
        $pre_data =  array();
        for($i = 1; $i <= 12;  $i++){
        
        $tbl = TableRegistry::get('student_attendance');
        $query = $tbl->find();
        $query->select(['prsent' => $query->func()->count('status')]);
        $query->where(['registration_id'=>$this->request->session()->read('Student.Reg_id')]);
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
        $query->where(['registration_id'=>$this->request->session()->read('Student.Reg_id')]);
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
    
        $this->set(compact('remarks','registration','att_data','pre_data'));
         
    }
    
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','dailydairy','viewsyllabus','download','imagegallery','videogallery'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    
    
    public function dailydairy(){
        
        
        $tbl = TableRegistry::get('students_master_details');
        $query = $tbl->find();
        $query->select(['class_id','shift_id']);
        $query->where(['registration_id'=>$this->request->session()->read('Student.Reg_id')]);
        $class_info = $query->first();
        
        
        $tbl = TableRegistry::get('daily_diary');
        $query = $tbl->find();
        $query->where(['class_id'=>$class_info->class_id]);
        $query->andwhere(['shift_id'=>$class_info->shift_id]);
        $query->orderDesc('date');
        $diary = $query->toArray();
          
        $this->set(compact('class_info','diary'));
        $this->set('_serialize', ['class_info','diary']);
    }
    
    public function viewsyllabus(){
       
        
        $tbl = TableRegistry::get('download_syllabus');
        $query = $tbl->find();
        $query->where(['registration_id'=>$this->request->session()->read('Student.Reg_id')]);
        $query->orderDesc('date');
        $syllabus = $query->toArray();
        $query->hydrate(false);  
        $res = $query->ToArray();
      
       
        foreach ($res as $dat) {
            $link = $this->url()."download/".$dat['download'];
            $actions = array('actions' => "<a href='$link' target='_blank' class='btn btn-sm btn-success'><i class='fa  fa-cloud-download'></i> Download Syllabus</a>");
            $data[] =  array_merge($dat, $actions);
       
        }
        
     
        
        $this->set(compact('class_info','data'));
        $this->set('_serialize', ['class_info','data']);
        
    }
    
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
    
    public function imagegallery(){
          
        $this->set(compact(''));
        $this->set('_serialize', ['']);
    }
    
     public function videogallery(){
          
        $this->set(compact(''));
        $this->set('_serialize', ['']);
    }
    
    
}
