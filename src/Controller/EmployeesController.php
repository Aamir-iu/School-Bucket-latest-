<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{

    public function index()
    {

        
        $department_id = $this->request->params['pass'][0];
        $employeesTbl = TableRegistry::get('employees');
        $employees = $employeesTbl->find('all', ['contain' => ['Users','Departments']]);
        $employees->all();
        $employees->where(['employees.department_id' => $department_id]);
     
        $this->set(compact('employees','department_id'));
        $this->set('_serialize', ['employees']);
    }
    
    public function getemployees(){
        
        $department_id = $this->request->data['depart_id'];
        $employeesTbl = TableRegistry::get('employees');
        $employees = $employeesTbl->find('all');
        //$employees->all();
         $employees->orderAsc('order_id');
        $employees->where(['employees.department_id' => $department_id]);
       
        $employees->hydrate(false);
        $res = $employees->toArray();
        $data = array();
        
        foreach ($res as $dat) {
            $hostname = $this->url()."img/students_images/".$dat['employee_pic']; 
            $host = array('host'=>$hostname);
            array_push($data, array_merge($dat, $host));
        }
        
        
        $msg = "Success|Employees Found";
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
    
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Employees', 'Users']
        ]);

        $this->set('employee', $employee);
        $this->set('_serialize', ['employee']);
    }
    
     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'view','editstatus','getemployees','delete'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
  
    public function add()
    {
        $department_id  = $this->request->query('department_id');
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            if(!empty($this->request->data['file']['tmp_name'])){
                
                $fileName = $this->request->data['file']['name'];
                $image_info = getimagesize($this->request->data['file']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $file_type    = $image_info['mime'];

                if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                   && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" ) {
                   $this->Flash->error(__('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
                   return $this->redirect(['action' => 'Userprofile']);
                }

                if($image_width>127 || $image_height>127) 
                { 
                    $this->Flash->error(__('Exceeded image dimension limits.You can upload 127px X 127px maximam dimension. '));
                    return $this->redirect(['action' => 'Userprofile']); 
                }    


                $newname = $this->request->data['employee_name'].$this->request->data['employee_no'];
                $tmp = explode(".", $fileName);
                $extension = end($tmp);
                
                $uploadPath = 'img/employees/';
                $uploadFile = $uploadPath.$newname.".jpg";
                $insertindb = $newname.".jpg";
                move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
                $employee->employee_pic = $insertindb;    
             }
            
           
            $employee->employee_created_by = $this->request->session()->read('Auth.User.id');
            $employee->employee_created_on = date("Y-m-d H:i:s");
                        
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index',$department_id]);
            } else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        
        $departmentstbl = TableRegistry::get('departments');
        $departments = $departmentstbl->find('all');
        
        $this->set(compact('employee', 'employees', 'users','departments','department_id'));
        $this->set('_serialize', ['employee']);
    }

  
    public function edit($id = null)
    {
        
        $department_id  = $this->request->query('department_id');
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            
            if(!empty($this->request->data['file']['tmp_name'])){
                $fileName = $this->request->data['file']['name'];
                $image_info = getimagesize($this->request->data['file']['tmp_name']);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $file_type    = $image_info['mime'];

                if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                   && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" ) {
                   $this->Flash->error(__('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
                   return $this->redirect(['action' => 'Userprofile']);
                }

                if($image_width>127 || $image_height>127) 
                { 
                    $this->Flash->error(__('Exceeded image dimension limits.You can upload 127px X 127px maximam dimension. '));
                    return $this->redirect(['action' => 'Userprofile']); 
                }    


                $newname = $this->request->data['employee_name'].$this->request->data['employee_no'];
                $tmp = explode(".", $fileName);
                $extension = end($tmp);
                //$uploadPath = WWW_ROOT . "users";    
                $uploadPath = 'img/employees/';
                $uploadFile = $uploadPath.$newname.".jpg";
                $insertindb = $newname.".jpg";
                move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
                $employee->employee_pic = $insertindb;    
             }
            
            
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index',$department_id]);
            } else {
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $departmentstbl = TableRegistry::get('departments');
        $departments = $departmentstbl->find('all');
       
        $this->set(compact('employee', 'employees', 'users','departments','department_id'));
        $this->set('_serialize', ['employee']);
    }

   
    public function delete($id = null)
    {
        $id  = $this->request->data['id'];
       
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $msg =  'Success|The employee has been deleted.';
        } else {
            $msg = 'Error|The employee could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
    
     public function editstatus($id = null)
    {
            $id = $this->request->data['id'];  
            $status = $this->request->data['status'];  
           
            $users = TableRegistry::get('employees');    
            $query = $users->query();
            $query->update()
                ->set(['scheduler_status' => $status])
                ->where(['employee_id' => $id])
                ->execute();
            $msg = "Success|Employee has been updated";
       
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
    }

}
