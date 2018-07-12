<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    
 
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $users = $this->Users->find();
        $users->where(['email !='=>'system@eschools.cloud']);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        
    }

    
     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','logout',  'login','forgotpassword','resetpassword','userprofile','updateUserProfile','updateImage','getuserlevel'])) {
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
        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->image = "avatar-1.jpg";
             if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
            
           
        $rolestbl = TableRegistry::get('roles');
        $roles = $rolestbl->find('all');

        $campusesbl = TableRegistry::get('campuses');
        $campuses = $campusesbl->find('all');


        $this->set(compact('user', 'roles','campuses'));
        $this->set('_serialize', ['user','campuses']);
            
    }

  
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles','Campuses']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                
                $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
        
                $rolestbl = TableRegistry::get('roles');
                $roles = $rolestbl->find('all');

                $campusesbl = TableRegistry::get('campuses');
                $campuses = $campusesbl->find('all');
 
            $this->set(compact('user', 'roles','campuses'));
            $this->set('_serialize', ['user','campuses']);
                
    }

   
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     public function login()
    {
         
        if($this->request->session()->check('Auth.User')){
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
         
         if ($this->request->is('post')) {
            $user = $this->Auth->identify();
           if ($user) {
                $this->Auth->setUser($user);
                $this->request->session()->write('menu', $this->userRoles());
//                return $this->redirect($this->Auth->redirectUrl());
                if($this->request->session()->read('Auth.User.role_id') == 4){
                    return $this->redirect(['controller' => 'StudentDashboard', 'action' => 'index']);
                }else{
                    $this->request->session()->write('Info.pop_flag',1);
                    return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
                }
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
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
          //  if($this->request->session()->read('Auth.User.role_id') !=1){
                $query->andwhere(['role_id'=>$this->request->session()->read('Auth.User.role_id')]);
          //  }
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
    
    public function logout()
    {
       $this->Flash->success('You are now logged out.');
       return $this->redirect($this->Auth->logout());
    }
    
    public function forgotpassword(){
      
        if ($this->request->is('post')) {
                $users = TableRegistry::get('users');
                $user = $users->find()
                            ->where(['email' => trim($_POST['email'])])
                            ->first();
                           
                if($user->email){
                  // email sending function call from here  
                  $this->Flash->success('Password has been sent to your email address'); 
                  return $this->redirect($this->Auth->logout());
                 
                }else{
                  $this->Flash->error('Sorry, the username entered was not found.');  
                  return $this->redirect($this->Auth->logout());
                    
                }
                
        }        
        
    }
    
    
    public function Getpassword(){
        
         if ($this->request->is('get')) {
                $users = TableRegistry::get('users');
                $user = $users->find()
                            ->where(['email' => trim($_POST['email'])])
                            ->first();
                           
                if($user->email){
                  // email sending function will call send from here  
                  $this->Flash->success('Password has been sent to your email address'); 
                   return $this->redirect($this->Auth->logout());
                }else{
                  $this->Flash->error('Sorry, the username entered was not found.');  
                  return $this->redirect($this->Auth->logout());
                    
                }
                
        }        
        
        
    }
    
    
    
    
    public function resetpassword($id = null){
        if(count($id)>0){
        $user = $this->Users->get($id, [
            'contain' => []
        ]); 
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
           if(trim($_POST['newpassword']) != trim($_POST['confirmpassword'])){
                $this->Flash->error(__('Password not matched.'));
                return $this->redirect(['action' => 'ResetPassword']);
            }else{
              $hasher  = new DefaultPasswordHasher();
              $haspass = $hasher->hash($_POST['newpassword']);
              
                     
              $users = TableRegistry::get('users');
              $user = $users->find()
                            ->where(['email' => trim($_POST['email'])])
                            ->first();
              
               if($user->email){
                                   
               
                   $query = $users->query();
                    $query->update()
                        ->set(['password' => $haspass])
                        ->where(['email' => $user->email])
                        ->execute();
                    
                        $this->Flash->success($user->full_name  .' Password has been change. '); 
                        //return $this->redirect(['action' => 'index']);
                        return $this->redirect(['action' => 'Userprofile']);
                   
                }else{
                    $this->Flash->error('Sorry, the username entered was not found.');  
                    return $this->redirect(['action' => 'ResetPassword']);
                    
                }
                
            }
               
        }
              
        $this->set(compact('Reset_Password', 'user'));
        $this->set('_serialize', ['user']);
        
        
    }
    
    
    public function userprofile(){
        
       
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'), [
            'contain' => ['Roles','Campuses']
        ]);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);      
    }
    
    
    public function updateUserProfile(){
       
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            
                if(!empty($this->request->data['file']['name'])){
                    $fileName = $this->request->data['file']['name'];
                    $image_info = getimagesize($this->request->data['file']['tmp_name']);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $file_type    = $image_info['mime'];
                    
                    
                    
                    if($file_type != "image/jpg" && $file_type != "image/png" && $file_type != "image/jpeg"
                       && $file_type != "image/gif" && $file_type != "image/bmp" && $file_type != "image/JPG" ) {
                       $this->Flash->error(__('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'));
                       return $this->redirect(['action' => 'Userprofile']);
                    }
                                       
                    if($image_width>127 || $image_height>127) 
                    { 
                        $this->Flash->error(__('Exceeded image dimension limits.You can upload 127px X 127px maximam dimension. '));
                        return $this->redirect(['action' => 'Userprofile']); 
                    }    
                                       
                
                    $newname = $this->request->session()->read('Auth.User.id');
                    $tmp = explode(".", $fileName);
                    $extension = end($tmp);
                    $uploadPath = 'img/users_images/';
                    $uploadFile = $uploadPath.$newname.".jpg";
                    $insertindb = $newname.".jpg";
                    move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile);
                    }else{
                        $insertindb = trim($_POST['image']);
                    }
                    
                    $name       = trim($_POST['full_name']);
                    $address    = trim($_POST['address']);
                    $phone1       = trim($_POST['phone1']);
                    $phone2      = trim($_POST['phone2']);
                    $users = TableRegistry::get('users');    
                    $query = $users->query();
                    $query->update()
                        ->set(['full_name' => $name,
                                'Address'=>$address,
                                'modified'=>date("Y-m-d H:i:s"),
                                'phone1'=>$phone1,
                                'phone2'=>$phone2,
                                'image'=>$insertindb])
                        ->where(['id' => $this->request->session()->read('Auth.User.id')])
                        ->execute();
                        $this->request->session()->write('Auth.User.image',$insertindb);
                        $this->Flash->success('Profile has been updated.'); 
                        return $this->redirect(['action' => 'Userprofile']);
        
           }
        
        
    }
    
    
}
