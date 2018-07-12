<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * ClassesSections Controller
 *
 * @property \App\Model\Table\ClassesSectionsTable $ClassesSections
 */
class ClassesSectionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
       $classes_sections = TableRegistry::get('classes_sections');
       $classesSections = $classes_sections->find('all');

        $this->set(compact('classesSections'));
        $this->set('_serialize', ['classesSections']);
    }

   
    
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
         if (in_array($action, ['index','add','edit','delete']) && $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
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
        $classesSection = $this->ClassesSections->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('classesSection', $classesSection);
        $this->set('_serialize', ['classesSection']);
    }

   
    public function add()
    {
        $cl = trim($this->request->data['class_name']).':'.trim($this->request->data['section_name']);
      //  echo $cl;
      //  exit;
        $classesSection = $this->ClassesSections->newEntity();
        $exist = $this->ClassesSections->exists(['class_name' => $cl]);
        if(empty($exist)){
            if ($this->request->is('post')) {
                $class = $this->request->data['class_name'];
                $section = $this->request->data['section_name'];
                $classesSection = $this->ClassesSections->patchEntity($classesSection, $this->request->data);
                $classesSection->created_by = $this->request->session()->read('Auth.User.id');
                $classesSection->class_name  =  $class. " : " .$section;
                $classesSection->created_on  = date("Y-m-d H:i:s");
                if ($this->ClassesSections->save($classesSection)) {

                    $msg = 'Success|The classes section has been saved.';

                   // return $this->redirect(['action' => 'index']);
                } else {
                    $msg = 'Error|The classes section could not be saved. Please, try again.';
                }
            }
        }    
        else{
           $msg = 'Error|The classes could not be saved. Already exists.';  
        }    
        
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

    
    public function edit($id = null)
    {
        $classesSection = $this->ClassesSections->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classesSection = $this->ClassesSections->patchEntity($classesSection, $this->request->data);
            $classesSection->class_name  =  trim($_POST['class_name']). " :" .trim($_POST['section_name']);
            if ($this->ClassesSections->save($classesSection)) {
                $this->Flash->success(__('The classes section has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The classes section could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('classesSection'));
        $this->set('_serialize', ['classesSection']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Classes Section id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        
        $this->request->allowMethod(['post', 'delete']);
        $classesSection = $this->ClassesSections->get($id);
        if ($this->ClassesSections->delete($classesSection)) {
            $this->Flash->success(__('The classes section has been deleted.'));
        } else {
            $this->Flash->error(__('The classes section could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
        
        
        
    }
}
