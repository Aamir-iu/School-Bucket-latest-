<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class FocController extends AppController
{

    public function index(){

       $supplier_id = $this->request->params['pass'][0];
       $supplier_product_id = $this->request->params['pass'][1];
       $product_id = $this->request->params['pass'][2];
     
       $focTbl = TableRegistry::get('foc');
       $foc = $focTbl->find('all', ['contain' => ['products','SupplierProducts']]);
       $foc->all();
       $foc->where(['foc.supplier_id' => $supplier_id ]);
       $foc->andwhere(['foc.supplier_product_id' => $supplier_product_id ]);
       
       $productstbl = TableRegistry::get('products');
       $foc_product = $productstbl->find('all'); 
       $foc_product->where(['id_products' => $product_id]);
       $foc_product = $foc_product->toArray();
       
       $supplierstbl = TableRegistry::get('suppliers');
       $suppliers = $supplierstbl->find('all'); 
       $suppliers->where(['id_suppliers' => $supplier_id]);
       $suppliers = $suppliers->toArray();
       
       
       $productstbl = TableRegistry::get('products');
       $products = $productstbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'supplier_products',
                                'alias' => 'sp',
                                'type' => 'INNER',
                                'conditions' => 'sp.id_products = products.id_products'
                            ]
                        ]);
       $products->select(['id_products','product_name']);
       $products->where(['sp.id_suppliers'=>$supplier_id]);
       //$products = $products->ToArray();
       
        $this->set(compact('foc','supplier_id','supplier_product_id','product_id','foc_product','products','suppliers'));
        $this->set('_serialize', ['foc']);
        
    }
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add','edit','delete','getfocdetails'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    public function view($id = null){
        $foc = $this->Foc->get($id, [
            'contain' => ['Suppliers', 'Products']
        ]);

        $this->set('foc', $foc);
        $this->set('_serialize', ['foc']);
    }
    public function add(){
        $foc = $this->Foc->newEntity();
        if ($this->request->is('post')) {
            $foc = $this->Foc->patchEntity($foc, $this->request->data);
            if ($this->Foc->save($foc)) {
                $msg  = 'Success|The foc has been saved.';
        
            } else {
                $msg = 'Error|The foc could not be saved. Please, try again.';
            }
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    public function edit($id = null) {
        $id = $this->request->data['id_foc'];
        $foc = $this->Foc->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $foc = $this->Foc->patchEntity($foc, $this->request->data);
            if ($this->Foc->save($foc)) {
                $msg  = 'Success|The foc has been saved.';
            } else {
                $msg = 'Error|The foc could not be saved. Please, try again.';
            }
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    public function delete($id = null){
        $id = $this->request->data['id'];
        
        $this->request->allowMethod(['post', 'delete']);
        $foc = $this->Foc->get($id);
        if ($this->Foc->delete($foc)) {
            $msg = 'Success|The foc has been deleted.';
        } else {
            $msg = 'Error|The foc could not be deleted. Please, try again.';
        }

     //   return $this->redirect(['action' => 'index','supplier_id','supplier_product_id','product_id']);
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    public function getfocdetails($id = null) {
        $id = $this->request->data['id'];
        $foc = $this->Foc->get($id, [
            'contain' => []
        ]);
       
        $this->set(compact('foc'));
        $this->set('_serialize', ['foc']);
    }
    
    
}
