<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BusinessPartners Controller
 *
 * @property \App\Model\Table\BusinessPartnersTable $BusinessPartners
 */
class BusinessPartnersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RelatedTables']
        ];
        $businessPartners = $this->paginate($this->BusinessPartners);

        $this->set(compact('businessPartners'));
        $this->set('_serialize', ['businessPartners']);
    }

    /**
     * View method
     *
     * @param string|null $id Business Partner id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $businessPartner = $this->BusinessPartners->get($id, [
            'contain' => ['RelatedTables']
        ]);

        $this->set('businessPartner', $businessPartner);
        $this->set('_serialize', ['businessPartner']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $businessPartner = $this->BusinessPartners->newEntity();
        if ($this->request->is('post')) {
            $businessPartner = $this->BusinessPartners->patchEntity($businessPartner, $this->request->data);
            if ($this->BusinessPartners->save($businessPartner)) {
                $this->Flash->success(__('The business partner has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The business partner could not be saved. Please, try again.'));
            }
        }
        $relatedTables = $this->BusinessPartners->RelatedTables->find('list', ['limit' => 200]);
        $this->set(compact('businessPartner', 'relatedTables'));
        $this->set('_serialize', ['businessPartner']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Business Partner id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $businessPartner = $this->BusinessPartners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $businessPartner = $this->BusinessPartners->patchEntity($businessPartner, $this->request->data);
            if ($this->BusinessPartners->save($businessPartner)) {
                $this->Flash->success(__('The business partner has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The business partner could not be saved. Please, try again.'));
            }
        }
        $relatedTables = $this->BusinessPartners->RelatedTables->find('list', ['limit' => 200]);
        $this->set(compact('businessPartner', 'relatedTables'));
        $this->set('_serialize', ['businessPartner']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Business Partner id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $businessPartner = $this->BusinessPartners->get($id);
        if ($this->BusinessPartners->delete($businessPartner)) {
            $this->Flash->success(__('The business partner has been deleted.'));
        } else {
            $this->Flash->error(__('The business partner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
