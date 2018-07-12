<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * FeeHeads Controller
 *
 * @property \App\Model\Table\FeeHeadsTable $FeeHeads
 */
class FeeHeadsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
   
        $feeHeadstable = TableRegistry::get('fee_heads');
        $feeHeads = $feeHeadstable->find()->contain(['fee_types','classes_sections','campuses']);
        $feeHeads->select(['id_fee_heads','class'=>'classes_sections.class_name']);
        $feeHeads->select(['campus'=>'campuses.campus_name','class_id']);
        $feeHeads->distinct(['classes_sections.class_name']);
        $feeHeads = $feeHeads->ToArray();
        
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feetype->where(['status_active'=>'Y']);
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        
        
        $this->set(compact('feeHeads','feetype','class'));
        $this->set('_serialize', ['feeHeads','feetype','class']);
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'view','loadfeeheads','adddetails','delete'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    public function view($id = null,$class_id = null)
    {
        
       
        $feeHead = $this->FeeHeads->find();
        $feeHead->where(['fee_type_id'=>$id]);
        $feeHead->andwhere(['class_id'=>$class_id]);
        $fee = $feeHead->toArray();
        
        $this->set(compact('fee'));
        $this->set('_serialize', ['fee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feeHead = $this->FeeHeads->newEntity();
        if ($this->request->is('post')) {
            
            $exist = $this->FeeHeads->exists(['class_id' => $this->request->data['class_id']]);
            if(empty($exist)){
                    $feeHead = $this->FeeHeads->patchEntity($feeHead, $this->request->data);
                    $feeHead->created_by = $this->request->session()->read('Auth.User.id');
                    $feeHead->created_on = date("Y-m-d H:i:s");
                    $feeHead->class_id = $this->request->data['class_id'];
                    $feeHead->campus_id = $this->request->session()->read('Auth.User.campus_id');
                    if ($this->FeeHeads->save($feeHead)) {
                        $msg = 'Success|The class has been saved.';
                    } else {
                        $msg = 'Error|The class could not be saved. Please, try again.';
                    }
            
            }else{
                $msg = 'Error|The class could not be saved. Already exists.';
            }  
            
        }
     
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

   
    public function edit($id = null)
    {
        $feeHead = $this->FeeHeads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feeHead = $this->FeeHeads->patchEntity($feeHead, $this->request->data);
            if ($this->FeeHeads->save($feeHead)) {
                $this->Flash->success(__('The fee head has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fee head could not be saved. Please, try again.'));
            }
        }
        
        $classes_sectionsble = TableRegistry::get('classes_sections');
        $class               = $classes_sectionsble->find('all');
        $campusesble = TableRegistry::get('campuses');
        $campus               = $campusesble->find('all');
        if($this->request->session()->read('Auth.User.role_id')!==1){
            $campus->where(['id_campus'=>$this->request->session()->read('Auth.User.campus_id')]);    
        }
        $fee_typesble = TableRegistry::get('fee_types');
        $feetype               = $fee_typesble->find('all');
        $feeHeadstable = TableRegistry::get('fee_heads');
        $FeeeHead = $feeHeadstable->find('all');
        
        $this->set(compact('feeHead', 'class','campus','feetype'));
        $this->set('_serialize', ['feeHead','class','campus','feetype']);
    }

   
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $query = $this->FeeHeads->query();
        $query->delete()
        ->where(['class_id' =>$id])
        ->execute();
        $msg = 'Success|The class has been deleted.';
        
      
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
    
    public function loadfeeheads(){
        
        $class = $this->request->data['class'];
        
        $feeHeadstable = TableRegistry::get('fee_heads');
        $feeHeads = $feeHeadstable->find()->contain(['fee_types','classes_sections','campuses']);
        $feeHeads->select(['id_fee_heads','fee_type_id','class_fees','fine','fee_head'=>'fee_type_name']);
        $feeHeads->select(['class'=>'class_name']);
        $feeHeads->where(['class_id'=>$class]);
        $feeHeads = $feeHeads->ToArray();
        $msg = "Success|Records found.";    
        $this->set(compact('feeHeads','msg'));
        $this->set('_serialize', ['feeHeads','msg']);
        
    }
    
    
    public function adddetails(){
        
        $mData = [];
        $mData = $this->request->data['details'];
        $class_id = $this->request->data['class_id'];
     
        $query = $this->FeeHeads->query();
        $query->delete()
        ->where(['class_id' =>$class_id])
        ->execute();
        
        
        foreach ($mData as $detail) {
            $feeHead = $this->FeeHeads->newEntity();
            $feeHead->class_id = $class_id;
            $feeHead->campus_id = $this->request->session()->read('Auth.User.campus_id');
            $feeHead->fee_type_id = $detail['fee_type_id'];
            $feeHead->class_fees = $detail['amount'];
            $feeHead->fine = $detail['fine'];
            $feeHead->created_on = date("Y-m-d H:i:s");
            $feeHead->created_by = $this->request->session()->read('Auth.User.id');
            $this->FeeHeads->save($feeHead);
             
        }
        $msg = "Success|The fee headers has been saved.";
        $this->set(compact('feeHeads','msg'));
        $this->set('_serialize', ['feeHeads','msg']);
    }
    
}
