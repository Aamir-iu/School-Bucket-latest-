<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * UsersRoleManagement Controller
 *
 * @property \App\Model\Table\UsersRoleManagementTable $UsersRoleManagement
 */
class UsersRoleManagementController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
       // $usersRoleManagement =$this->UsersRoleManagement->find()->contain(['Roles']);
      //  $usersRoleManagement->distinct('role_id');
        
        $table_Roles = TableRegistry::get('roles');
        $roles = $table_Roles->find();
       
        
        $this->set(compact('usersRoleManagement','roles'));
        $this->set('_serialize', ['usersRoleManagement','roles']);
        
    }
    
    public function setRoles($role_id = null){
        
       
        $table_parent_menu = TableRegistry::get('main_menu');
        $parent_menu = $table_parent_menu->find();
       
        $this->set(compact('usersRoleManagement','roles','parent_menu','role_id'));
        $this->set('_serialize', ['usersRoleManagement','roles','parent_menu','role_id']);
        
    }
    
    public function getChildmenu($id = null){
                
        $id = $this->request->data['id'];
        $role_id = $this->request->data['role_id'];
        $table_sub_menu = TableRegistry::get('sub_menu');
        $chlid_menu = $table_sub_menu->find()->hydrate(false);
        $chlid_menu->where(['main_menu_id'=>$id]);
        $sql = $chlid_menu->toArray();
        
        $users_role_management = TableRegistry::get('users_role_management');
        
        $data = array();
        foreach($sql as $row){
            
            $query = $users_role_management->find()->hydrate(false);
            $query->where(['main_menu_id'=>$id]);
            $query->andwhere(['sub_menu_id'=>$row['id_sub_menu']]);
            $query->andwhere(['role_id' => $role_id]);
            $res = $query->toArray();
           
                if($res){
                    foreach($res as $rs){
                    $data[$row['sub_menu_name']][] = $rs['main_menu_id'];
                    $data[$row['sub_menu_name']][] = $rs['sub_menu_id'];
                    $data[$row['sub_menu_name']][] = $rs['persmissions'];
                    
                    } 
                }
                else{

                    $data[$row['sub_menu_name']][] = $row['main_menu_id'];
                    $data[$row['sub_menu_name']][] = $row['id_sub_menu'];
                    $data[$row['sub_menu_name']][] = 'No';
                }
            
            
        }
        
        $this->set(compact('sql','data'));
        $this->set('_serialize', ['sql','data']);
        
    }
    
    
    
      public function isAuthorized($user) {
          
        $action = $this->request->params['action'];
        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','setRoles','getChildmenu','edit'])) {
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
        $usersRoleManagement = $this->UsersRoleManagement->get($id, [
            'contain' => ['Roles', 'MainMenus', 'SubMneus']
        ]);

        $this->set('usersRoleManagement', $usersRoleManagement);
        $this->set('_serialize', ['usersRoleManagement']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role_id = $this->request->data['role_id'];
        $table = TableRegistry::get('users_role_management');
       
        $exists = $table->exists(['role_id'=>$role_id]);
        if($exists){
            $msg = 'Error|The users role management could not be saved. Already exists.';
        }{
            $usersRoleManagement = $this->UsersRoleManagement->newEntity();
            if ($this->request->is('post')) {
                $usersRoleManagement = $this->UsersRoleManagement->patchEntity($usersRoleManagement, $this->request->data);
                if ($this->UsersRoleManagement->save($usersRoleManagement)) {
                    $msg = 'Success|The users role management has been saved.';
                }else{
                    $msg = 'Error|The users role management could not be saved. Please, try again.';
                }
            }
        }
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }

   
    
    
    public function edit($id = null)
    {
        
        $mdata = $this->request->data['menu_details'];
        $role_id = $this->request->data['role_id'];
      
        foreach($mdata as $row){
            $this->UsersRoleManagement->query()->delete()->where(['role_id' =>$role_id,'main_menu_id'=>$row['main_menu_id'],'sub_menu_id'=>$row['sub_menu_id']])->execute();
            $usersRoleManagement = $this->UsersRoleManagement->newEntity();
            $usersRoleManagement = $this->UsersRoleManagement->patchEntity($usersRoleManagement, $this->request->data);
            $usersRoleManagement->role_id = $role_id;
            $usersRoleManagement->main_menu_id = $row['main_menu_id'];
            $usersRoleManagement->sub_menu_id = $row['sub_menu_id'];
            $usersRoleManagement->persmissions = $row['permissions'];
            if ($this->UsersRoleManagement->save($usersRoleManagement)) {
                $msg = 'Success|The users role management has been saved.';
            }else{
                $msg = 'Error|The users role management could not be saved. Please, try again.';
            }
        
        }
        
        $this->request->session()->write('menu', $this->userRoles());
         
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

    public function userRoles(){
        
         $table_main_menu = TableRegistry::get('main_menu');
        $SQL = $table_main_menu->find()->hydrate(false);
        $RS  = $SQL->toArray();
        $menu_data = array();
        foreach($RS as $row){
           
            $table_user_roles = TableRegistry::get('users_role_management');
            $query = $table_user_roles->find()->hydrate(false)
                ->join([
                        [   'table' => 'sub_menu',
                            'alias' => 'sm',
                            'type' => 'INNER',
                            'conditions' => 'sm.id_sub_menu = users_role_management.sub_menu_id'
                        ]
                    ]);
            $query->select(['child_menu'=>'sm.sub_menu_name']);
            $query->select(['persmissions']);
            $query->where(['users_role_management.main_menu_id'=>$row['id_main_menu']]);
            if($this->request->session()->read('Auth.User.role_id') !=1){
                $query->andwhere(['role_id'=>$this->request->session()->read('Auth.User.role_id')]);
            }
            $menus = $query->toArray();
            $mm = array();
            foreach($menus as $m){
              $mm[$m['child_menu']] = $m['child_menu'];
              $mm[$m['child_menu']] = $m['persmissions'];
            }
            
            $menu_data[$row['manu_name']] = $mm;
        }
        return $menu_data;
       
        
    }
    
    
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersRoleManagement = $this->UsersRoleManagement->get($id);
        if ($this->UsersRoleManagement->delete($usersRoleManagement)) {
            $this->Flash->success(__('The users role management has been deleted.'));
        } else {
            $this->Flash->error(__('The users role management could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function updateRoles(){
        
        
        
        
        
    }
    
    
    
}
