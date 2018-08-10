<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 */
class DepartmentsController extends AppController
{

    public function index()
    {

        $departmentsTbl = TableRegistry::get('departments');
        $departments = $departmentsTbl->find('all', ['contain' => ['users']]);
       

        $this->set(compact('departments'));
        $this->set('_serialize', ['departments']);
    }

   
    
      public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
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
        $department = $this->Departments->get($id, [
            'contain' => ['Departments']
        ]);

        $this->set('department', $department);
        $this->set('_serialize', ['department']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Departments->newEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->data);
            $department->department_created_on = date("Y-m-d H:i:s");
            $department->department_created_by = $this->request->session()->read('Auth.User.id');
                        
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The department could not be saved. Please, try again.'));
            }
        }
        
        $usertbl = TableRegistry::get('users');
        $departments = $usertbl->find('all');
       
        $this->set(compact('department', 'departments'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->data);
            $department->department_created_on = date("Y-m-d H:i:s");
            $department->department_created_by = $this->request->session()->read('Auth.User.id');
            
            
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The department could not be saved. Please, try again.'));
            }
        }
        
        $usertbl = TableRegistry::get('users');
        $departments = $usertbl->find('all');   

       
        //$departments = $this->Departments->Departments->find('list', ['limit' => 200]);
        $this->set(compact('department', 'departments'));
        $this->set('_serialize', ['department']);
        }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
            $this->Flash->success(__('The department has been deleted.'));
        } else {
            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
