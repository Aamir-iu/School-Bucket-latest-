<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class ToolsController extends AppController
{

   
    public function index()
    {
         
    }
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','studentsrecord','feerecord','adddues','attendance','backup','admindatabasemysqldump','updateapp','clearcache'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    
    public function studentsrecord(){
        
        
        if ($this->request->is('post')) {
            
            $csv_file = $_FILES['file']['tmp_name'];
            if (is_file( $csv_file )){
                
            $registrationble = TableRegistry::get('registration');
            $students_master_detailsble = TableRegistry::get('students_master_details');
            
            $i = 0;	
            $sql = '';
            set_time_limit(0);
            if (($handle = fopen( $csv_file, "r")) !== FALSE)
            {
                    while (($data = fgetcsv($handle, 3000, ",")) !== FALSE)
                    {
                    if($i==0){}
                    else{
                            $exists = $registrationble->exists(['id_registration' => $data[0]]);
                            if(!empty($exists)){
                              $query = $registrationble->query();
                              $query->delete()->where(['id_registration' => $data[0]])->execute();   
                            }    
                            $registration = $registrationble->newEntity();
                            $registration->id_registration = $data[0];
                            $registration->gr = $data[1];
                            $registration->fmc = $data[2];
                            $registration->student_name = $data[3];
                            $registration->father_name = $data[4];
                            if(!empty($data[5])){
                            $registration->contact1 = "0".$data[5];
                            }
                            if(!empty($data[6])){
                            $registration->contact2 = "0".$data[6];
                            }
                            if(!empty($data[7])){
                            $registration->contact2 = "0".$data[7];
                            }
                            $registration->dob = date("Y-m-d H:i:s", strtotime($data[8]));
                            $registration->doa = date("Y-m-d H:i:s", strtotime($data[9]));
                            $registration->address = $data[10];
                            $registration->sex = $data[11];
                            $registration->religion = $data[12];
                            $registration->image = "avatar-1.jpg";
                            
                            $registration->created_on = date("Y-m-d H:i:s");
                            $registration->created_by = $this->request->session()->read('Auth.User.id');
                            $registrationble->save($registration);
                            
                            $exists = $students_master_detailsble->exists(['registration_id' => $data[0]]);
                            if(!empty($exists)){
                              $query = $students_master_detailsble->query();
                              $query->delete()->where(['registration_id' => $data[0]])->execute();   
                            }   
                            $students_master_details = $students_master_detailsble->newEntity();
                            $students_master_details->registration_id = $data[0];
                            $students_master_details->roll_no = $data[13];
                            $students_master_details->class_id = $this->request->data['class_id'];
                            $students_master_details->shift_id = $data[14]; //$this->request->data['shift_id'];
                            $students_master_details->session_id = $this->request->data['session_id'];
                            $students_master_details->campus_id = $this->request->session()->read('Auth.User.campus_id');
                            $students_master_detailsble->save($students_master_details);
     
                         }
                    $i++;
                    }
                    fclose($handle);

            }
            
            }
            $this->Flash->success(__('The students record has been saved.'));
            return $this->redirect(['action' => 'index']);
        }   
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');

        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');

        $campusesbl = TableRegistry::get('campuses');
        $campuses = $campusesbl->find('all');


         if($this->request->session()->read('Auth.User.role_id')!==1){
             $campuses->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
         }

       $this->set(compact('registration','classes','session','campuses'));
        
        
        
        
    }
    
    
    public function feerecord(){
        
        if ($this->request->is('post')) {
            
            $csv_file = $_FILES['file']['tmp_name'];
            if (is_file( $csv_file )){
            $feesble = TableRegistry::get('Fees');
            $i = 0;	
            $sql = '';
            set_time_limit(0);
            if (($handle = fopen( $csv_file, "r")) !== FALSE)
            {
                    while (($data = fgetcsv($handle, 3000, ",")) !== FALSE)
                    {
                    if($i==0){}
                    else{
                            $exists = $feesble->exists(['registration_id' => $data[1],'fee_month'=>$data[4],'Year'=>$data[5],'fee_type_id'=>$data[7]]);
                            if(!empty($exists)){
                              $query = $feesble->query();
                              $query->delete()->where(['registration_id' => $data[1],'fee_month'=>$data[4],'Year'=>$data[5],'fee_type_id'=>$data[7] ])->execute();   
                            }    
                            $fees = $feesble->newEntity();
                            $fees->inv_no = $data[0];
                            $fees->registration_id = $data[1];
                            $fees->campus_id = $this->request->session()->read('Auth.User.campus_id');
                            $fees->session_id = $data[2];
                            $fees->class_id = $this->request->data['class_id'];
                            $fees->shift_id = $data[3];
                            $fees->fee_month = $data[4];
                            $fees->year = $data[5];
                            $fees->sub_total = $data[6];
                            $fees->amount = $data[6];
                            $fees->retruned_amount = 0;
                            $fees->fee_type_id = $data[7];
                            $fees->status = 1;
                            $fees->payment_mode = "Cash";
                            $fees->fee_date = date("Y-m-d H:i:s", strtotime($data[8])); 
                            $fees->created_on = date("Y-m-d H:i:s");
                            $fees->created_by = $this->request->session()->read('Auth.User.id');
                            $feesble->save($fees);
                           
                         }
                    $i++;
                    }
                    fclose($handle);

            }
            
            }
            $this->Flash->success(__('The students fees record has been saved.'));
            return $this->redirect(['action' => 'index']);
        }   
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        $this->set(compact('registration','classes'));
 
    }
    
    
    public function adddues(){
        
        if ($this->request->is('post')) {
            
            $csv_file = $_FILES['file']['tmp_name'];
            if (is_file( $csv_file )){
            $duesble = TableRegistry::get('Dues');
            $tbl = TableRegistry::get('students_master_details');
            $date = "2018-02-10";//date("Y/m/d"); 
            $i = 0;	
            $sql = '';
            set_time_limit(0);
            if (($handle = fopen( $csv_file, "r")) !== FALSE)
            {
                    while (($data = fgetcsv($handle, 3000, ",")) !== FALSE)
                    {
                    if($i==0){}
                    else{
                        
                        $query =  $tbl->find();
                        $query->where(['registration_id'=>$data[0]]);  
                        $result = $query->first();
                        if($result->registration_id > 0){
                                $exists = $duesble->exists(['registration_id' => $data[0],'fee_type_id'=>$data[5],'fee_month'=>$data[3],'year'=>$data[4]]);
                                if(!empty($exists)){
                                  $query = $duesble->query();
                                  $query->delete()->where(['registration_id' => $data[0],'fee_type_id'=>$data[5],'fee_month'=>$data[3],'year'=>$data[4]])->execute();   
                                }    
                                $dues = $duesble->newEntity();
                                $dues->registration_id = $data[0];
                                $dues->campus_id = $this->request->session()->read('Auth.User.campus_id');
                                $dues->session_id = $result->session_id;
                                $dues->class_id = $result->class_id; //$data[4];
                                $dues->shift_id = $result->shift_id;
                                $dues->fee_month = $data[3];
                                $dues->year = $data[4];
                                $dues->fee_type_id = $data[5];
                                $dues->amount = $data[6];
                                $dues->fine = 0;
                                $fee_date =  $data[4]."/".$data[3]."/1";
                                $dues->fee_date = date("Y-m-d H:i:s", strtotime($fee_date));
                                $dues->due_date = date("Y-m-d H:i:s", strtotime($fee_date)); 
                                $dues->created_on = date("Y-m-d H:i:s");
                                $dues->created_by = $this->request->session()->read('Auth.User.id');
                                $duesble->save($dues);
                        }   
                         }
                    $i++;
                    }
                    fclose($handle);

            }
            
            }
            $this->Flash->success(__('The students Dues record has been saved.'));
            return $this->redirect(['action' => 'index']);
        }   
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        $this->set(compact('registration','classes'));
        
        
    }
    
      public function attendance(){
        
        if ($this->request->is('post')) {
            $date = date("Y-m-d H:i:s");
            $csv_file = $_FILES['file']['tmp_name'];
            if (is_file( $csv_file )){
            $student_attendance = TableRegistry::get('student_attendance');
            $i = 0;	
            $sql = '';
            set_time_limit(0);
            if (($handle = fopen( $csv_file, "r")) !== FALSE)
            {
                    while (($data = fgetcsv($handle, 3000, ",")) !== FALSE)
                    {
                    if($i==0){}
                    else{
                            $exists = $student_attendance->exists(['registration_id' =>  $data[0] ,'attendace_date'=> date("Y-m-d", strtotime($date)) ]);
                            if(!empty($exists)){
                              $query = $student_attendance->query();
                              $query->delete()->where(['registration_id' =>  $data[0] ,'attendace_date'=> date("Y-m-d", strtotime($date)) ])->execute();   
                            }    
                            $att = $student_attendance->newEntity();
                            $att->registration_id = $data[0];
                            if(!empty($data[1]) && $data[2]==''){
                              $status = "P";  
                            }
                            if(empty($data[1]) && strtoupper($data[2])=='TRUE'){
                              $status = "A";  
                            }
                            if(empty($data[1]) && strtoupper($data[2])=='L' || strtoupper($data[2])=='LEAVE'){
                              $status = "L";  
                            }
                            
                            $att->status = $status;
                            $att->campus_id = $this->request->session()->read('Auth.User.campus_id');
                            $att->class_id = $this->request->data['class_id'];
                            $att->shift_id = $this->request->data['shift_id'];
                            $att->attendace_date = date("Y-m-d H:i:s");
                            $att->created_by = $this->request->session()->read('Auth.User.id');
                            $student_attendance->save($att);
                           
                         }
                    $i++;
                    }
                    fclose($handle);
                  
            }
            
            }
            $this->Flash->success(__('The students Dues record has been saved.'));
            return $this->redirect(['action' => 'index']);
        }   
        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        $this->set(compact('registration','classes'));
        
        
    }
    
    
    public function updateapp(){
       //$this->set(compact('registration','classes'));  
    }
    
     public function clearcache() {
       // Cache::clear();
       // clearCache();

        $files = array();
//        $files = array_merge($files, glob(CACHE . '*')); // remove cached css
        $files = array_merge($files, glob(CACHE . 'css' . DS . '*')); // remove cached css
//        $files = array_merge($files, glob(CACHE . 'js' . DS . '*'));  // remove cached js
        $files = array_merge($files, glob(CACHE . 'models' . DS . '*'));  // remove cached models
        $files = array_merge($files, glob(CACHE . 'persistent' . DS . '*'));  // remove cached persistent
//
        foreach ($files as $f) {
            if (is_file($f)) {
                try {
                    @unlink($f);
                } catch (Exception $ex) {
                    $files['errors'][] = $ex->getMessage();
                }
            }
        }
//
//        if (function_exists('apc_clear_cache')):
//            apc_clear_cache();
//            apc_clear_cache('user');
//        endif;
//
//        return $files;
        
        
    //    print_r($files);
        $msg = "Success|The updates has benn installed";
        $this->set(compact('files','msg'));
       
        
     }
    
     public function backup(){
         
       
         
     }
     
  function admindatabasemysqldump($tables = '*') {

    $return = '';

    $modelName = $this->modelClass;

    echo  $modelName;
    exit;
    $dataSource = $this->{$modelName}->getDataSource();
    $databaseName = $dataSource->getSchemaName();


    // Do a short header
    $return .= '-- Database: `' . $databaseName . '`' . "\n";
    $return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";


    if ($tables == '*') {
        $tables = array();
        $result = $this->{$modelName}->query('SHOW TABLES');
        foreach($result as $resultKey => $resultValue){
            $tables[] = current($resultValue['TABLE_NAMES']);
        }
    } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
    }

    // Run through all the tables
    foreach ($tables as $table) {
        $tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

        $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
        $createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
        $createTableEntry = current(current($createTableResult));
        $return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";

        // Output the table data
        foreach($tableData as $tableDataIndex => $tableDataDetails) {

            $return .= 'INSERT INTO ' . $table . ' VALUES(';

            foreach($tableDataDetails[$table] as $dataKey => $dataValue) {

                if(is_null($dataValue)){
                    $escapedDataValue = 'NULL';
                }
                else {
                    // Convert the encoding
                    $escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );

                    // Escape any apostrophes using the datasource of the model.
                    $escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
                }

                $tableDataDetails[$table][$dataKey] = $escapedDataValue;
            }
            $return .= implode(',', $tableDataDetails[$table]);

            $return .= ");\n";
        }

        $return .= "\n\n\n";
    }

    // Set the default file name
    $fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';

    // Serve the file as a download
    $this->autoRender = false;
    $this->response->type('Content-Type: text/x-sql');
    $this->response->download($fileName);
    $this->response->body($return);
}

     
     
}
