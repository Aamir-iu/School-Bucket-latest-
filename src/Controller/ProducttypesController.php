<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Producttypes Controller
 *
 * @property \App\Model\Table\ProducttypesTable $Producttypes
 */
class ProducttypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
       
        $producttypesTbl = TableRegistry::get('producttypes');
        $producttypes = $producttypesTbl->find('all');
        $this->set(compact('producttypes'));
        $this->set('_serialize', ['producttypes']);
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'view','delete'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    
    /**
     * View method
     *
     * @param string|null $id Producttype id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $producttype = $this->Producttypes->get($id, [
            'contain' => []
        ]);

        $this->set('producttype', $producttype);
        $this->set('_serialize', ['producttype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $producttype = $this->Producttypes->newEntity();
        if ($this->request->is('post')) {
            $producttype = $this->Producttypes->patchEntity($producttype, $this->request->data);
            if ($this->Producttypes->save($producttype)) {
                $this->Flash->success(__('The producttype has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The producttype could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('producttype'));
        $this->set('_serialize', ['producttype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Producttype id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $producttype = $this->Producttypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $producttype = $this->Producttypes->patchEntity($producttype, $this->request->data);
            if ($this->Producttypes->save($producttype)) {
                $this->Flash->success(__('The producttype has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The producttype could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('producttype'));
        $this->set('_serialize', ['producttype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Producttype id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producttype = $this->Producttypes->get($id);
        if ($this->Producttypes->delete($producttype)) {
            $this->Flash->success(__('The producttype has been deleted.'));
        } else {
            $this->Flash->error(__('The producttype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
