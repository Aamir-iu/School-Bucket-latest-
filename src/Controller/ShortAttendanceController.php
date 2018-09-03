<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Holiday Controller
 *
 * @property \App\Model\Table\ExpansesTable $Expanses
 */
class ShortAttendanceController extends AppController
{

    public function index()
    {
          /*
            *Previuos month Attendance those student whose attendance is short
            */
          // $date = $this->request->data('from');
          // print_r($date);
          // exit();
          if ($this->request->is('post')) {
            $from = $this->request->data('from');
            print_r($from);
            exit();
        }
         $previuos_month = date('m',(strtotime ( '-1 MONTH' ) ));
                    //print_r($date);
            
            
       
     
            $mastertable = TableRegistry::get('students_master_details');
            $reg_result = $mastertable->find()->hydrate(false)
                ->join([
                        [   'table' => 'registration',
                            'type' => 'INNER',
                            'conditions' => 'registration.id_registration = students_master_details.registration_id'
                        ],
                        [   'table' => 'classes_sections',
                             'alias' => 'cs',
                            'type' => 'INNER',
                            'conditions' => 'cs.id_class = students_master_details.class_id'
                        ],
                        [   'table' => 'shift',
                            'type' => 'INNER',
                            'conditions' => 'shift.id_shift = students_master_details.shift_id'
                        ]
                    ]);
            $reg_result->select(['registration_id','sname'=>'registration.student_name','fname'=>'registration.father_name']);
            $reg_result->select(['class'=>'cs.class_name','shift'=>'shift.shift_name']);
            $reg_result->select(['roll_no','gr_no'=>'registration.gr']);
            $reg_result->where(['registration.active'=>'Y']);
            $reg_result->orderAsc('students_master_details.class_id');
            $sql = $reg_result->toArray();

            $mdata =  array();
            foreach($sql as $row){
            $mdata[$row['registration_id']]['registration_id'] = $row['registration_id'];
            $mdata[$row['registration_id']]['roll_no'] = $row['roll_no'];
            $mdata[$row['registration_id']]['grno'] = $row['gr_no'];
            $mdata[$row['registration_id']]['s_name'] = $row['sname'];
            $mdata[$row['registration_id']]['f_name'] = $row['fname'];
            $mdata[$row['registration_id']]['class_name'] = $row['class'];
            $mdata[$row['registration_id']]['shift_name'] = $row['shift'];
            $class = $row['class'];
            $shift = $row['shift'];
            
           
            $table = TableRegistry::get('student_attendance');
            $query = $table->find('all')->hydrate(false);
            $query->select(['registration_id','status','date'=>'attendace_date']);
            $query->where(['MONTH(attendace_date)'=>$previuos_month]);
            $query->andwhere(['registration_id'=>$row['registration_id']]);
            $rs = $query->toArray();
         
         
                $query = $table->find();
                $query->select(['present' => $query->func()->count('status')]);
                $query->where(['registration_id'=>$row['registration_id']]);
                $query->andwhere(['MONTH(attendace_date) =' => $previuos_month]);
                $query->andwhere(['status' => 'P']);
                $present = $query->first();
                if(count($present->present) > 0){
                    $att_data = $present->present;
                }else{
                    $att_data = 0;
                }
            $count = 0;
            foreach($rs as $rows){
                $day =  'd'.ltrim(date('d', strtotime($rows['date'])),'0');
                $mdata[$row['registration_id']][$day] = $rows['status'];
                    if( isset($rows['status']) > 0)
                    {
                        $count++;
                    }

                }    
                $mdata[$row['registration_id']]['days'] = $count;  
                $mdata[$row['registration_id']]['present'] = $att_data;                

                $mdata[$row['registration_id']]['percentage'] = 0;
                if ($count > 0 ) {
                 # code...
                    $att = round($att_data/$count* 100,0);
                    $mdata[$row['registration_id']]['percentage'] = $att;
                    $data[] = $att;
                }

                if ($att < 70 ) {
                    # code...
                    //$day    = date("31");
                    //$year   = date("Y");
                    //$month  = date("m");
                    //$date1 = date("m");
                    //$mdata[$row['registration_id']]['short'] = $row['class'];
                    
                //print_r($row['registration_id'] . $row['sname'] ." (". $row['class'] ." )" );
                //echo " ";
                //$this->sendmail();
                
                //die('lol');
                    //exit();
                    

                }else{
                   //echo "no"."/";
                }

                  
            }

        /*echo "<pre";
        print_r($now);
        echo "</pre";
        exit();*/
        
            $this->set(compact('mdata'));
        
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'delete','getdetails'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
   
   
    
    
}
