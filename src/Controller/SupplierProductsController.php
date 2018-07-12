<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * SupplierProducts Controller
 *
 * @property \App\Model\Table\SupplierProductsTable $SupplierProducts
 */
class SupplierProductsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
 
        
        $supplier_id = $this->request->params['pass'][0];
        
        $supplierproductsTbl = TableRegistry::get('supplier_products');
        $supplierProducts = $supplierproductsTbl->find('all', ['contain' => ['suppliers', 'products','packing_types','foc']]);
        $supplierProducts->all();
        $supplierProducts->where(['supplier_products.id_suppliers' => $supplier_id ]);
        
        $this->set(compact('supplierProducts','supplier_id'));
        $this->set('_serialize', ['supplierProducts']);    
        
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
    
    
    public function view($id = null)
    {
        $supplierProduct = $this->SupplierProducts->get($id, [
            'contain' => ['Focs']
        ]);

        $this->set('supplierProduct', $supplierProduct);
        $this->set('_serialize', ['supplierProduct']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $supplier_id = $this->request->query('supplier_id');
        $supplierProduct = $this->SupplierProducts->newEntity();
        if ($this->request->is('post')) {
            $supplierProduct = $this->SupplierProducts->patchEntity($supplierProduct, $this->request->data);
            $supplierProduct->created_on = date("Y-m-d H:i:s");
            $supplierProduct->created_by = $this->request->session()->read('Auth.User.id');
            
            if ($this->SupplierProducts->save($supplierProduct)) {
                $this->Flash->success(__('The supplier product has been saved.'));

                return $this->redirect(['action' => 'index',$supplier_id]);
            } else {
                $this->Flash->error(__('The supplier product could not be saved. Please, try again.'));
            }
        }
        
        $supplierstbl = TableRegistry::get('suppliers');
        $suppliers = $supplierstbl->find('all');   

        $productstbl = TableRegistry::get('products');
        $products = $productstbl->find('all'); 
        
        $foctbl = TableRegistry::get('foc');
        $foc = $foctbl->find('all'); 
        
        $packing_typesbl = TableRegistry::get('packing_types');
        $packingtypes = $packing_typesbl->find('all'); 
        
        //$focs = $this->SupplierProducts->Focs->find('list', ['limit' => 200]);
        
        $this->set(compact('supplierProduct', 'suppliers','products','foc','packingtypes','supplier_id'));
        $this->set('_serialize', ['supplierProduct']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Supplier Product id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supplier_id = $this->request->query('supplier_id');
        $supplierProduct = $this->SupplierProducts->get($id, [
            'contain' => []
        ]);
        
        
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supplierProduct = $this->SupplierProducts->patchEntity($supplierProduct, $this->request->data);
            if ($this->SupplierProducts->save($supplierProduct)) {
                $this->Flash->success(__('The supplier product has been saved.'));

                return $this->redirect(['action' => 'index',$supplier_id]);
            } else {
                $this->Flash->error(__('The supplier product could not be saved. Please, try again.'));
            }
        }
         $supplierstbl = TableRegistry::get('suppliers');
        $suppliers = $supplierstbl->find('all');   

        $productstbl = TableRegistry::get('products');
        $products = $productstbl->find('all'); 
        
        $foctbl = TableRegistry::get('foc');
        $foc = $foctbl->find('all'); 
        
        $packing_typesbl = TableRegistry::get('packing_types');
        $packingtypes = $packing_typesbl->find('all'); 
        
        //$focs = $this->SupplierProducts->Focs->find('list', ['limit' => 200]);
        
        $this->set(compact('supplierProduct', 'suppliers','products','foc','packingtypes'));
        $this->set('_serialize', ['supplierProduct']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Supplier Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplierProduct = $this->SupplierProducts->get($id);
        if ($this->SupplierProducts->delete($supplierProduct)) {
            $this->Flash->success(__('The supplier product has been deleted.'));
        } else {
            $this->Flash->error(__('The supplier product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
