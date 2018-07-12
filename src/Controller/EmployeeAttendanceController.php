<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * EmployeeAttendance Controller
 *
 * @property \App\Model\Table\EmployeeAttendanceTable $EmployeeAttendance
 */
class EmployeeAttendanceController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $date = date("Y-m-d");
        $employeeAttendance = $this->EmployeeAttendance->find()->contain(['Employees']);
        $employeeAttendance->group('EmployeeAttendance.employee_id');
        $employeeAttendance->where(['attendace_date'=>date("Y-m-d", strtotime($date))]);
        $employeeAttendance->andwhere(['Employees.status'=>'Active']);
        
        $departmentstbl = TableRegistry::get('departments');
        $departments = $departmentstbl->find('all');
        
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        $table = TableRegistry::get('sms_setting');
        $query = $table->find();
        $messages = $query->toArray();
        
        $this->set(compact('employeeAttendance','departments','months','messages'));
        $this->set('_serialize', ['employeeAttendance','months']);
        
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','view','sendsms','getEmployees','setting'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    
    public function view($flag = null,$depart_id= null, $month_id=null, $year_id = null )
    {
         
        $mastertable = TableRegistry::get('employee_attendance');    
        $reg_result = $mastertable->find()->hydrate(false)
                ->join([
                        [   'table' => 'employees',
                            'type' => 'INNER',
                            'conditions' => 'employees.employee_id = employee_attendance.employee_id'
                        ],
                        [   'table' => 'departments',
                            'type' => 'INNER',
                            'conditions' => 'departments.department_id = employee_attendance.id_department'
                        ]
                    ]);
        
        $reg_result->select($mastertable);
        $reg_result->select(['emp_name'=>'employee_name','depar'=>'department_name']);
        $reg_result->where(['id_department'=>$depart_id]);
        $rs = $reg_result->toArray();
        
        $mdata =  array();
        foreach($rs as $row){
            $mdata[$row['employee_id']]['employee_id'] = $row['employee_id'];
            $mdata[$row['employee_id']]['name'] = $row['emp_name'];
            $mdata[$row['employee_id']]['department'] = $row['depar'];
            $department = $row['depar'];
          
            $table = TableRegistry::get('employee_attendance');
            $query = $table->find('all')->hydrate(false);
            $query->select(['employee_id','status','date'=>'attendace_date','attendance_time']);
            $query->where(['MONTH(attendace_date)'=>$month_id]);
            $query->andwhere(['employee_id'=>$row['employee_id']]);
            $rs = $query->toArray();
         
         
            
            foreach($rs as $rows){
                $day =  'd'.ltrim(date('d', strtotime($rows['date'])),'0');
                $mdata[$row['employee_id']][$day] = $rows['status'] == 'P' ? $rows['attendance_time'] : $rows['status'];
                }    

            }
  
        $this->set(compact('mdata','department'));
        $this ->render('att_report'); 
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $table = TableRegistry::get('employee_attendance');
        if ($this->request->is('post')) {
            
            $mData = [];
            $mData = $this->request->data['att'];
            $department_id = $this->request->data['department_id'];
            $date  = $this->request->data['ad'];
          
            foreach($mData as $row){
               
                $employeeAttendance = $this->EmployeeAttendance->newEntity();
                $exists = $table->exists(['employee_id' => $row['emp_id'], 'attendace_date' => date("Y-m-d", strtotime($date))]);
                if(empty($exists)){
               
                $employeeAttendance->employee_id = $row['emp_id'];
                $employeeAttendance->id_department =$department_id;
                $employeeAttendance->status =  $row['status'];
                if($row['status'] == 'A' || $row['status'] == 'L'){
                    $employeeAttendance->attendance_time =  '00:00:00';
                  }else{
                    $employeeAttendance->attendance_time =  $row['time'];
                }
                $employeeAttendance->attendace_date = date("Y-m-d", strtotime($date));
                $employeeAttendance->created_by =  $this->request->session()->read('Auth.User.id');       
                $table->save($employeeAttendance);
               
              
                }                
            }
            
        }
        $msg = "Success|Attendace has been saved.";
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    public function setting(){
        
          if ($this->request->is('post')) {
           
            $table = TableRegistry::get('sms_setting');
            $query = $table->find();
            $id = $query->first();
            $sql = $table->query();
            $sql->update()
            ->set(['staff_present'=> $this->request->data['staff_present'],
                    'staff_absent'=> $this->request->data['staff_absent'],
                    'staff_leave'=> $this->request->data['staff_leave'],
                    'staff_late'=> $this->request->data['staff_late'],
                    ])
            ->where(['id_setting' =>$id->id_setting])
            ->execute();
            $msg = 'Success|The SMS setting has been saved.';
            
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
   
    public function edit($id = null)
    {
        $employeeAttendance = $this->EmployeeAttendance->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeAttendance = $this->EmployeeAttendance->patchEntity($employeeAttendance, $this->request->data);
            if ($this->EmployeeAttendance->save($employeeAttendance)) {
                $this->Flash->success(__('The employee attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee attendance could not be saved. Please, try again.'));
        }
        $employees = $this->EmployeeAttendance->Employees->find('list', ['limit' => 200]);
        $this->set(compact('employeeAttendance', 'employees'));
        $this->set('_serialize', ['employeeAttendance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee Attendance id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $employeeAttendance = $this->EmployeeAttendance->get($id);
        if ($this->EmployeeAttendance->delete($employeeAttendance)) {
            $msg = 'Success|The employee attendance has been deleted.';
        } else {
            $msg = 'Error|The employee attendance could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);  
    }
    
    public function getEmployees(){
        
        $id = $this->request->data['department_id'];
        $table = TableRegistry::get('employees');
        $employee = $table->find();
        $employee->select(['employee_id','employee_name']);
        
        $employee->where(['department_id'=>$id]);
        $employee->andwhere(['status'=>'Active']);
        $data = $employee->toArray();
        
        $this->set('data', $data);
        $this->set('_serialize', ['data']);
        
    }
    
     public function sendsms($flag = null){
        
        $employee_id  = $this->request->data['id'];
        $status = $this->request->data['status'];
        $message = $this->request->data['message'];
        $date = date("Y-m-d");
        $file =  WWW_ROOT."download/csv_sample.txt";
      
        $mastertable = TableRegistry::get('employee_attendance');    
        $reg_result = $mastertable->find()->hydrate(false)
                ->join([
                        [   'table' => 'employees',
                            'type' => 'INNER',
                            'conditions' => 'employees.employee_id = employee_attendance.employee_id'
                        ],
                        [   'table' => 'departments',
                            'type' => 'INNER',
                            'conditions' => 'departments.department_id = employee_attendance.id_department'
                        ]
                    ]);
        
        $reg_result->select($mastertable);
        $reg_result->select(['emp_name'=>'employee_name','depar'=>'department_name','cell'=>'employee_phone2']);
        if($flag == 0){
            $reg_result->where(['employee_attendance.employee_id'=>$employee_id]);
            $reg_result->andwhere(['employee_attendance.attendace_date'=>date("Y-m-d", strtotime($date))]);
        }else{
            $reg_result->where(['employee_attendance.attendace_date'=>date("Y-m-d", strtotime($date))]);
        }
        $reg_result->andwhere(['employee_attendance.status'=>$status]);
      
        $data = $reg_result->toArray();
        $handle = fopen ($file, "w+");
        fclose($handle);
        
        foreach($data as $row){
            
            if($row['cell'] > 0){ 
                $contents = '92'.ltrim($row['cell'],'0').','.$row['emp_name'].PHP_EOL;
                if (($fd = fopen($file, "a")) !== false) { 
                     fwrite($fd, $contents);   
                     fclose($fd); 

                 }
            }
        } 
        
    
        $hostname = $this->url()."download/csv_sample.txt";
        $username = $this->request->session()->read('Info.user');
        $password = $this->request->session()->read('Info.password');
        $sender = "SenderID";
        $url = $hostname;
        $message = $message;
        
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
    
    public function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
}
