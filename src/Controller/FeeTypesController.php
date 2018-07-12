<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FeeTypes Controller
 *
 * @property \App\Model\Table\FeeTypesTable $FeeTypes
 */
class FeeTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $feeTypes = $this->FeeTypes->find();
        $this->set(compact('feeTypes'));
        $this->set('_serialize', ['feeTypes']);
    }

     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','view','edit','add','fetch'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
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
        $feeType = $this->FeeTypes->get($id, [
            'contain' => ['Concession', 'Dues', 'FeeHeads', 'Fees']
        ]);

        $this->set('feeType', $feeType);
        $this->set('_serialize', ['feeType']);
    }
    public function fetch($id = null)
    {
        $feeType = $this->FeeTypes->get($id, [
            'contain' => []
        ]);
        $msg = "Success|Records found";
        
        $this->set(compact('feeType','msg'));
        $this->set('_serialize', ['feeType','msg']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feeType = $this->FeeTypes->newEntity();
        if ($this->request->is('post')) {
            $feeType = $this->FeeTypes->patchEntity($feeType, $this->request->data);
            if ($this->FeeTypes->save($feeType)) {
               // $this->Flash->success(__('The fee type has been saved.'));
                $msg = 'Success|The fee type has been saved.';

               // return $this->redirect(['action' => 'index']);
            } else {
               // $this->Flash->error(__('The fee type could not be saved. Please, try again.'));
                $msg = 'Error|The fee type could not be saved. Please, try again.';
            }
        }
        $this->set(compact('feeType','msg'));
        $this->set('_serialize', ['feeType','msg']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fee Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      
        $feeType = $this->FeeTypes->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feeType = $this->FeeTypes->patchEntity($feeType, $this->request->data);
           
           if ($this->FeeTypes->save($feeType)) {
               $msg = 'Success|The fee type has been saved.';

            } else {
                $msg = 'Error|The fee type could not be saved. Please, try again.';
            }
        }
        $this->set(compact('feeType','msg'));
        $this->set('_serialize', ['feeType','msg']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fee Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feeType = $this->FeeTypes->get($id);
        if ($this->FeeTypes->delete($feeType)) {
            $this->Flash->success(__('The fee type has been deleted.'));
        } else {
            $this->Flash->error(__('The fee type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
