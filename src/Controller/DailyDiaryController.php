<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * DailyDiary Controller
 *
 * @property \App\Model\Table\DailyDiaryTable $DailyDiary
 */
class DailyDiaryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $path = "img/homework";
        if(!is_dir($path)) {
           mkdir($path);
        }       


        $day    = date("d");
        $year   = date("Y");
        $month  = date("m");
        $date = date("Y/m/d"); 
        $this->loadModel('ClassesSections');
        $class = $this->ClassesSections->find(); 
        
        $dailyDiary = $this->DailyDiary->find()->contain(['ClassesSections','Shift']);
        $dailyDiary->where(['MONTH(date)' => $month]);
        $dailyDiary->andwhere(['YEAR(date) ' => $year]);
        $dailyDiary->orderDesc('id_daily_diary');
        
        $this->set(compact('dailyDiary','class'));
        $this->set('_serialize', ['dailyDiary']);

    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','edit','delete','add'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
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
        $dailyDiary = $this->DailyDiary->get($id, [
            'contain' => ['Classes', 'Shifts']
        ]);

        $this->set('dailyDiary', $dailyDiary);
        $this->set('_serialize', ['dailyDiary']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
      $exists = $this->DailyDiary->exists(['class_id' => $this->request->data['class_id'], 'shift_id' => $this->request->data['shift_id'],'date'=> date("Y-m-d", strtotime($this->request->data['date']))]);
      if(!empty($exists)){
         $msg = "Error|The daily diary could not be saved. record already exists.";
      }else{  
        //echo "<pre>";
        //print_r($this->request->data);
        //exit();
            $dailyDiary = $this->DailyDiary->newEntity();
                if ($this->request->is('post')) {
                    $dailyDiary = $this->DailyDiary->patchEntity($dailyDiary, $this->request->data);
                    $dailyDiary->created_by = $this->request->session()->read('Auth.User.id');
                    $dailyDiary->date = date("Y-m-d", strtotime($this->request->data['date']));

                    if(!empty($this->request->data['file']['tmp_name'])){
                    
                        $fileName = $this->request->data['file']['name'];
                        $image_info = getimagesize($this->request->data['file']['tmp_name']);
                        $image_width = $image_info[0];
                        $image_height = $image_info[1];
                        $file_type    = $image_info['mime'];

                        if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                           && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" && $file_type != "image/JPEG") {
                           $this->Flash->error(__('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
                           return $this->redirect(['action' => 'index']);
                        }


                        $newname = //$this->request->data['student_name'].$this->request->data['father_name'].$this->request->data['contact1'];
                        $newname = uniqid() . md5(rand(1000,10000));
                        $tmp = explode(".", $fileName);
                        $extension = end($tmp);
                        
                        $uploadPath = 'img/homework/';
                        $uploadFile = $uploadPath.$newname.".jpg";
                        $insertindb = $newname.".jpg";
                        move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
                        $dailyDiary->image = $insertindb;    
                 }    

                if ($this->DailyDiary->save($dailyDiary)) {
                     $msg = "Success|The daily diary has been saved.";
                  } else {
                    $msg = "Error|The daily diary could not be saved. Please, try again.";
                }
            }
        }

        $this->Flash->success(__($msg));
        return $this->redirect(['action' => 'index']);
        //$this->set(compact('classes', 'shifts','msg'));
        //$this->set('_serialize', ['msg']);
    }

    public function edit($id = null)
    {
        $dailyDiary = $this->DailyDiary->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dailyDiary = $this->DailyDiary->patchEntity($dailyDiary, $this->request->data);
            if ($this->DailyDiary->save($dailyDiary)) {
                $this->Flash->success(__('The daily diary has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The daily diary could not be saved. Please, try again.'));
            }
        }
        $classes = $this->DailyDiary->Classes->find('list', ['limit' => 200]);
        $shifts = $this->DailyDiary->Shifts->find('list', ['limit' => 200]);
        $this->set(compact('dailyDiary', 'classes', 'shifts'));
        $this->set('_serialize', ['dailyDiary']);
    }

   
    public function delete($id = null)
    {
       
        $this->request->allowMethod(['post', 'delete']);
        $dailyDiary = $this->DailyDiary->get($id);
        if ($this->DailyDiary->delete($dailyDiary)) {
            $msg = 'Success|The daily diary has been deleted.';
        } else {
            $msg  = 'Error|The daily diary could not be deleted. Please, try again.';
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
}
