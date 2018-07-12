<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MobileNotifications Controller
 *
 * @property \App\Model\Table\MobileNotificationsTable $MobileNotifications
 */
class MobileNotificationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $mobileNotifications = $this->paginate($this->MobileNotifications);

        $this->set(compact('mobileNotifications'));
        $this->set('_serialize', ['mobileNotifications']);
    }

    /**
     * View method
     *
     * @param string|null $id Mobile Notification id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mobileNotification = $this->MobileNotifications->get($id, [
            'contain' => []
        ]);

        $this->set('mobileNotification', $mobileNotification);
        $this->set('_serialize', ['mobileNotification']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mobileNotification = $this->MobileNotifications->newEntity();
        if ($this->request->is('post')) {
            $mobileNotification = $this->MobileNotifications->patchEntity($mobileNotification, $this->request->data);
            if ($this->MobileNotifications->save($mobileNotification)) {
                $this->Flash->success(__('The mobile notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mobile notification could not be saved. Please, try again.'));
        }
        $this->set(compact('mobileNotification'));
        $this->set('_serialize', ['mobileNotification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mobile Notification id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mobileNotification = $this->MobileNotifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mobileNotification = $this->MobileNotifications->patchEntity($mobileNotification, $this->request->data);
            if ($this->MobileNotifications->save($mobileNotification)) {
                $this->Flash->success(__('The mobile notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mobile notification could not be saved. Please, try again.'));
        }
        $this->set(compact('mobileNotification'));
        $this->set('_serialize', ['mobileNotification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mobile Notification id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mobileNotification = $this->MobileNotifications->get($id);
        if ($this->MobileNotifications->delete($mobileNotification)) {
            $this->Flash->success(__('The mobile notification has been deleted.'));
        } else {
            $this->Flash->error(__('The mobile notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
