<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Campuses Controller
 *
 * @property \App\Model\Table\CampusesTable $Campuses
 */
class CampusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $campuses = $this->paginate($this->Campuses);

        $this->set(compact('campuses'));
        $this->set('_serialize', ['campuses']);
    }

    /**
     * View method
     *
     * @param string|null $id Campus id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $campus = $this->Campuses->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('campus', $campus);
        $this->set('_serialize', ['campus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $campus = $this->Campuses->newEntity();
        if ($this->request->is('post')) {
            $campus = $this->Campuses->patchEntity($campus, $this->request->data);
            if ($this->Campuses->save($campus)) {
                $this->Flash->success(__('The campus has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The campus could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('campus'));
        $this->set('_serialize', ['campus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Campus id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $campus = $this->Campuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $campus = $this->Campuses->patchEntity($campus, $this->request->data);
            if ($this->Campuses->save($campus)) {
                $this->Flash->success(__('The campus has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The campus could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('campus'));
        $this->set('_serialize', ['campus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Campus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $campus = $this->Campuses->get($id);
        if ($this->Campuses->delete($campus)) {
            $this->Flash->success(__('The campus has been deleted.'));
        } else {
            $this->Flash->error(__('The campus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
