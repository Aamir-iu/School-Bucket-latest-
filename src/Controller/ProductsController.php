<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
            
            $producttype_id = $this->request->params['pass'][0];
           
            $productsTbl = TableRegistry::get('products');
            $products = $productsTbl->find('all', ['contain' => ['producttypes']]);
            $products->where(['products.product_type' => $producttype_id ]);
            $products = $products->ToArray();
           
            $this->set(compact('products','producttype_id'));
            $this->set('_serialize', ['products','producttype_id']);
   
        }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'view','delete', 'getMinProducts'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    public function getMinProducts(){
        $conn = ConnectionManager::get('default');
        $query = $conn->execute("
            select count(id_products) as total_min_products
            from products
            where stock <= min_stock
        ");
        $row = $query->fetchAll('obj');
        echo $row[0]->total_min_products; exit;
    }
    
    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
            
        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $producttype_id = $this->request->query('producttype_id');
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                
                return $this->redirect(['action' => 'index',$producttype_id]);
                
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
               
            $producttypetbl = TableRegistry::get('Producttypes');
            $producttypes = $producttypetbl->find('all');
           
            
            $this->set(compact('product','producttypes','producttype_id','producttype_id'));
            $this->set('_serialize', ['product']);
            
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        
        $producttype_id = $this->request->query('producttype_id');
        
        $product = $this->Products->get($id, [
            'contain' => ['producttypes']
        ]);
        
       
        
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index',$producttype_id]);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        
      
        
        $producttypetbl = TableRegistry::get('Producttypes');
        $producttypes = $producttypetbl->find('all');
        
        $this->set(compact('product','producttypes','producttype_id'));
        
       
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $producttype_id = $this->request->query('producttype_id');
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index',$producttype_id]);
    }
}
