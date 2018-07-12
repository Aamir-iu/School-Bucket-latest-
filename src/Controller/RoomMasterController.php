<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\I18n\Time;

/**
 * RoomMaster Controller
 *
 * @property \App\Model\Table\RoomMasterTable $RoomMaster
 */
class RoomMasterController extends AppController
{

     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','delete','add','edit','addStudents','addInRoom','updateRollNumbers'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }

        return parent::isAuthorized($user);
    }
    
    
    public function index(){
        
        $roomMaster = $this->RoomMaster->find();
        $roomMaster->select(['id_room_master','room_name','room_desc']);
        $roomMaster->select(['rom_date'=>'date_format(created_on,"%d-%M-%Y %H:%i")']);
        
        $this->set(compact('roomMaster'));
        $this->set('_serialize', ['roomMaster']);
        
    }

    
    public function view($id = null)
    {
        $roomMaster = $this->RoomMaster->get($id, [
            'contain' => []
        ]);

        $this->set('roomMaster', $roomMaster);
        $this->set('_serialize', ['roomMaster']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roomMaster = $this->RoomMaster->newEntity();
        if ($this->request->is('post')) {
            $roomMaster = $this->RoomMaster->patchEntity($roomMaster, $this->request->data);
            $roomMaster->created_on = date("Y-m-d");
            if ($this->RoomMaster->save($roomMaster)) {
                $this->Flash->success(__('The room master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room master could not be saved. Please, try again.'));
        }
        $this->set(compact('roomMaster'));
        $this->set('_serialize', ['roomMaster']);
    }

    public function addStudents($id = null){
        
        $roomMaster = $this->RoomMaster->find();
        $roomMaster->select(['id_room_master','room_name','room_desc']);
        $roomMaster->select(['rom_date'=>'date_format(created_on,"%d-%M-%Y %H:%i")']);
        $roomMaster->where(['id_room_master'=>$id]);
        $RM = $roomMaster->toArray();
        
        $tabl = TableRegistry::get('room_details');
        $query = $tabl->find()->hydrate(false)
            ->join([
                      [   'table' => 'registration',
                          'type' => 'INNER',
                          'conditions' => 'registration.id_registration = room_details.registration_id'
                      ],
                      [   'table' => 'students_master_details',
                          'type' => 'INNER',
                          'conditions' => 'students_master_details.registration_id = registration.id_registration'
                      ],
                      [   'table' => 'classes_sections',
                          'type' => 'INNER',
                          'conditions' => 'classes_sections.id_class = students_master_details.class_id'
                      ]
                  ]);
        $query->select($tabl);
        $query->select(['name'=>'registration.student_name','fname'=>'registration.father_name']);
        $query->select(['class'=>'classes_sections.class_name']);
        $query->where(['room_id'=>$id]);
        
        $data = $query->toArray();
        

        $classesbl = TableRegistry::get('classes_sections');
        $classes = $classesbl->find('all');
        
        $classesbl = TableRegistry::get('classes_sections');
        $classes2 = $classesbl->find('all');
        
        $sessionbl = TableRegistry::get('session');
        $session = $sessionbl->find('all');
        
        $sessionbl = TableRegistry::get('session');
        $session2 = $sessionbl->find('all');
        
        
       $this->set(compact('classes','session','classes2','session2','data','id','RM'));
       $this->set('_serialize', ['classes','session','classes2','session2']); 

    }
    
    
    public function edit($id = null)
    {
        $roomMaster = $this->RoomMaster->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomMaster = $this->RoomMaster->patchEntity($roomMaster, $this->request->data);
            if ($this->RoomMaster->save($roomMaster)) {
                $this->Flash->success(__('The room master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room master could not be saved. Please, try again.'));
        }
        $this->set(compact('roomMaster'));
        $this->set('_serialize', ['roomMaster']);
    }

   
    
    
    public function delete()
    {
        $id = $this->request->data['id'];
        $detailTable = TableRegistry::get('room_details');
        $query = $detailTable->query();
        $query->delete()
        ->where(['id_room_details' => $id])
        ->execute();
        $msg = 'Success|Record has been deleted.';
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
    public function addInRoom(){
       
        $room_id = $this->request->data['id'];
        $mData = [];
        $mData = $this->request->data['details'];
        $detailTable = TableRegistry::get('room_details');
        
        $query = $detailTable->find()->hydrate(false);
        $query->select(['exam_roll_no']);
        $query->orderDesc('id_room_details');
        $query->limit(1);
        $last_ID = $query->first();
        if($last_ID['exam_roll_no'] > 0){
            $roll_no = $last_ID['exam_roll_no'] + 1;
        }else{
            $roll_no = 1;
        }
        
        //print_r($roll_no);
        //exit();
        foreach($mData as $row){
            if($row['status'] === 'Y'){
                $roll_number = str_pad($roll_no, 5, '0', STR_PAD_LEFT);
                $exists = $detailTable->exists(['registration_id' => $row['reg_id']]);
                if (empty($exists)) {
                    $roomdetails = $detailTable->newEntity();
                    $roomdetails->room_id = $room_id;
                    $roomdetails->registration_id = $row['reg_id'];
                    $roomdetails->exam_roll_no = $roll_number;
                    $detailTable->save($roomdetails);
                    
                }
                $roll_no++;
                //$this->updateRollNumbers($room_id);
            }
        }
        $msg = "Success|Added.";
        $this->set(compact('msg','data'));
        $this->set('_serialize', ['msg','data']);
        
    }
    
    public function updateRollNumbers($room_id = null){
        
        $detailTable = TableRegistry::get('room_details');
        $query = $detailTable->find();
        $query->where(['room_id'=>$room_id]);
        $rs = $query->toArray();
        $i = 1;
        foreach($rs as $row){
            $roll_number = str_pad($i, 5, '0', STR_PAD_LEFT);
            $query = $detailTable->query();
            $query->update()
            ->set(['exam_roll_no' => $roll_number])
            ->where(['room_id' => $room_id,'registration_id'=>$row['registration_id']])
            ->execute();
            $i++;
        }    
       // return false;
    }
    
    
    
    
}
