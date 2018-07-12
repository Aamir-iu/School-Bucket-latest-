<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * EmployeeSalary Controller
 *
 * @property \App\Model\Table\EmployeeSalaryTable $EmployeeSalary
 */
class EmployeeSalaryController extends AppController
{

    
    public function index()
    {
       
        $employeeSalary = $this->EmployeeSalary->find()->contain(['Employees']);
        
        $monthsble = TableRegistry::get('months');
        $months = $monthsble->find('all');
        
        $departmentstbl = TableRegistry::get('departments');
        $departments = $departmentstbl->find('all');
        
        $this->set(compact('employeeSalary','months','departments'));
        $this->set('_serialize', ['employeeSalary']);
        
    }

   public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','view','getEnployee','generateSalary','addSalaries'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    
    public function view($flag = null,$department_id = null,$month_id=null,$year=null,$report_type=null)
    {
        
        if($flag == 0){
            $id = $department_id;
            $employeeSalary = $this->EmployeeSalary->find()->contain(['Employees','Departments','months']);
            $employeeSalary->where(['id_employee_salary '=>$id]);
            $this->set(compact('employeeSalary'));
            $this ->render('slip');
            
        }else if ($flag == 1){
            
            $employeeSalary = $this->EmployeeSalary->find()->contain(['Employees','Departments','months']);
            $employeeSalary->where(['id_department'=>$department_id]);
            $employeeSalary->andwhere(['salary_month'=>$month_id]);
            $employeeSalary->andwhere(['salary_year'=>$year]);
            
            if($report_type == 'detail'){
                $this->set(compact('employeeSalary'));
                $this->set('_serialize', ['employeeSalary']);
            }else{
                $this->set(compact('employeeSalary'));
                $this ->render('slip'); 
            }
        }
    }

   
    public function add()
    {
        $table = TableRegistry::get('employee_salary');    
        $employeeSalary = $this->EmployeeSalary->newEntity();
        $emp_id = $this->request->data['employee_id'];
        $month = $this->request->data['salary_month'];
        $year = $this->request->data['salary_year'];
        $exist = $table->exists(['employee_id' => $emp_id, 'salary_month' => $month,'salary_year'=>$year]);
        if  (!$exist){
            if ($this->request->is('post')) {
            $employeeSalary = $this->EmployeeSalary->patchEntity($employeeSalary, $this->request->data);
            if ($this->EmployeeSalary->save($employeeSalary)) {
                $msg = 'Success|The employee salary has been saved.';
            }else{
                $msg = 'Error|The employee salary could not be saved. Please, try again.';
                }
            }
        } else {
            $msg = 'Warning|The employee salary could not be saved. already exists.';
        }
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

   
    public function edit($id = null)
    {
        $employeeSalary = $this->EmployeeSalary->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeSalary = $this->EmployeeSalary->patchEntity($employeeSalary, $this->request->data);
            if ($this->EmployeeSalary->save($employeeSalary)) {
                $this->Flash->success(__('The employee salary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee salary could not be saved. Please, try again.'));
        }
        $employees = $this->EmployeeSalary->Employees->find('list', ['limit' => 200]);
        $this->set(compact('employeeSalary', 'employees'));
        $this->set('_serialize', ['employeeSalary']);
    }

   
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $employeeSalary = $this->EmployeeSalary->get($id);
        if ($this->EmployeeSalary->delete($employeeSalary)) {
            $msg = 'Success|The employee salary has been deleted.';
        } else {
            $msg = 'Error|The employee salary could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
     public function getbysearch(){
        
        
        $draw = $this->request->data['draw'];
        $start = $this->request->data['start'];
       
        $length = $this->request->data['length'];
        
         if (isset($this->request->data['order'])) {
            $order = $this->request->data['order'];
            $columns = $this->request->data['columns'];
            $orderby = $columns[$order[0]['column']]['data'];
            $orderdir = $order[0]['dir'];
        } else {
            $orderby = 'id_employee_salary';
            $orderdir = 'desc';
        }
        
        
        
        $ExamResults = $this->ExamResults->find()->contain(['classes_sections','shift','Registration','exam_types','session']); 
        $ExamResults->select($this->ExamResults);
        $ExamResults->select(['class'=>'class_name','shift'=>'shift_name','exam'=>'exam_type','session_name'=>'session']);
        $ExamResults->select(['sname'=>'student_name','fname'=>'father_name']);
       // $ExamResults->group(['class_id','shift_id','session_id','exam_type_id']);
        
        $recordsTotal = $ExamResults->count();
        
        if (isset($this->request->data['id']) && !empty($this->request->data['id'])) {
            $ExamResults->where(['registration_id'=>$this->request->data['id']]);
        }
        
        
        $recordsFiltered  = $ExamResults->count();
        $ExamResults->order([$orderby => $orderdir]);
        if($length>-1){
                $ExamResults->limit($length);
            }
            if($start>0){
                $ExamResults->offset($start);
        }
        
      
        $ExamResults->hydrate(false);
        
        
        
        $res = $ExamResults->ToArray();
        $data = array();
       
       foreach ($res as $dat) {
            $session_name  = str_replace("-","00",$dat['session_name']);
            $actions = array('actions' => "<button onclick='javascript:edit_record(" . $dat['class_id'].','.$dat['shift_id'].','.$dat['exam_type_id'].','.$dat['session_id'].','.$dat['registration_id'].")' class='btn btn-icon waves-effect waves-light btn-warning m-b-5'><i class='fa fa-eye'></i> Open</button> <button onclick='javascript:print_result(" . $dat['class_id'].','.$dat['shift_id'].','.$dat['exam_type_id'].','.$dat['session_id'].','.$dat['registration_id'].','.$session_name.")' class='btn btn-icon waves-effect waves-light btn-success m-b-5'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:delete_record(" .$dat['registration_id'].','.$dat['exam_type_id'].','.$dat['session_id'] .','.$dat['id_exam'].")' class='btn btn-icon waves-effect waves-light btn-danger m-b-5'><i class='fa fa-trash'></i> Delete</button>");
            array_push($data, array_merge($dat, $actions));
        }
       
       
       $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
       $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
    }
    
    public function getEnployee(){
        
        $id = $this->request->data['employee_id'];
        $table = TableRegistry::get('employees');
        $employee = $table->get($id, [
            'contain' => []
        ]);

        $this->set('employee', $employee);
        $this->set('_serialize', ['employee']);
      
    }
    
    public function generateSalary(){
        
        $department_id = $this->request->data['department_id'];
        $month_id = $this->request->data['month_id'];
        $year_id = $this->request->data['year_id'];
        
        $table = TableRegistry::get('employees');
        $employeeSalary = $table->find()->hydrate(false);
        $employeeSalary->where(['department_id'=>$department_id]);
        $employeeSalary->andwhere(['status'=>'Active']);
        $rs = $employeeSalary->toArray();
        
        $tbl = TableRegistry::get('employee_attendance');
        $data = array();
        foreach($rs as $row){
    
            $query = $tbl->find();
            $query->select(['absent' => $query->func()->count('status')]);
            $query->where(['employee_id'=>$row['employee_id']]);
            $query->andwhere(['MONTH(attendace_date) =' => $month_id]);
            $query->andwhere(['YEAR(attendace_date) =' => $year_id]);
            $query->andwhere(['status' => 'A']);
            $absent = $query->first();
            if(count($absent->absent) > 0){
               $att_data = $absent->absent;
            }else{
               $att_data = 0;
            }
                
            $query = $tbl->find();
            $query->select(['late' => $query->func()->count('status')]);
            $query->where(['employee_id'=>$row['employee_id']]);
            $query->andwhere(['MONTH(attendace_date) =' => $month_id]);
            $query->andwhere(['YEAR(attendace_date) =' => $year_id]);
            $query->andwhere(['status' => 'T']);
            $late = $query->first();
            if(count($late->late) > 0){
               $late_data = $late->late;
            }else{
               $late_data = 0;
            }    
                
                
            $actions = array('absentees' =>$att_data,'late'=> $late_data);    
            array_push($data, array_merge($row, $actions));    
        }
        
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
        
    }
    
    public function addSalaries(){
        
        
        $department_id = $this->request->data['department_id'];
        $month_id = $this->request->data['month_id'];
        $year_id = $this->request->data['year_id'];
        $mData = [];
        $mData = $this->request->data['salaries'];
        $table = TableRegistry::get('employee_salary'); 
        foreach($mData as $row){
            $employeeSalary = $this->EmployeeSalary->newEntity();
            $exist = $table->exists(['employee_id' => $row['emp_id'], 'salary_month' => $month_id,'salary_year'=>$year_id]);
            if  (!$exist){
                if ($this->request->is('post')) {
                $employeeSalary = $this->EmployeeSalary->patchEntity($employeeSalary, $this->request->data);
                $employeeSalary->employee_id = $row['emp_id'];
                $employeeSalary->id_department =$department_id;
                $employeeSalary->basic_salary =  $row['bs'];
                $employeeSalary->working_days =  $row['wd'];
                $employeeSalary->per_day_salary =  $row['pds'];
                $employeeSalary->extra_amount =  $row['es'];
                $employeeSalary->late =  $row['late'];
                $employeeSalary->absents =  $row['ab'];
                $employeeSalary->detect_salary =  $row['ds'];
                $employeeSalary->ma =  $row['ma'];
                $employeeSalary->ca =  $row['ca'];
                $employeeSalary->pa =  $row['pa'];
                $employeeSalary->gross_salary =  $row['ns'];
                $employeeSalary->Net_salary  =  $row['ns']; 
                $employeeSalary->salary_month  =  $month_id; 
                $employeeSalary->salary_year  =  $year_id; 
               
                
                if ($this->EmployeeSalary->save($employeeSalary)) {
                    $msg = 'Success|The employee salaries has been saved.';
                }else{
                    $msg = 'Error|The employee salaries could not be saved. Please, try again.';
                    }
                }
            } else {
                $msg = 'Warning|The employee salaries could not be saved. already exists.';
            }
            
        }
       
      
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
}
