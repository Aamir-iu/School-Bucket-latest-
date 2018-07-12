<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\I18n\Time;
/**
 * Sale Controller
 *
 * @property \App\Model\Table\SaleTable $Sale
 */
class SaleController extends AppController
{

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','delete','getProducts','getproductrate','add','view','getbysearch','stockReport','saleReport'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }

        return parent::isAuthorized($user);
    }
    
    
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $sale = $this->paginate($this->Sale);
        
        
        $SupplierProductsTbl = TableRegistry::get('SupplierProducts');
        $query = $SupplierProductsTbl->find('all');
        $query->contain(['products', 'suppliers']);
        
     
        $query->where(['id_supplier_products > ' => 0]);
        $query->andwhere(['product_active' => 'y']);
        
        $supplierproducts = $query->toArray();
        
        
        
        $this->set(compact('sale','supplierproducts'));
        $this->set('_serialize', ['sale']);
    }

  
    public function view($flag = null, $inv_no = null){
        
        if($flag == 0 ){ // receipt
        
            $sale = $this->Sale->get($inv_no, [
                'contain' => ['sale_details','Users']
            ]);

            $this->set('sale', $sale);
            $this->set('_serialize', ['sale']);
        
        }
        elseif ($flag == 1){ // sale report
            
            $from_date =  $this->request->params['pass'][1]; // from date
            $to_date =  $this->request->params['pass'][2];   // to date
            $product_type_id =  $this->request->params['pass'][3];  // product type
            $product_type =  $this->request->params['pass'][4];  // product name
            $product_id =  $this->request->params['pass'][5];  // product id
            $product_name =  $this->request->params['pass'][6];  // product id
           
            $table =  $table = TableRegistry::get('producttypes');
            $product_types = $table->find()->hydrate(false);
            if($product_type_id > 0){
                $product_types->where(['type_id'=>$product_type_id]);
            }
            $pt  = $product_types->toArray();
            $data = array();
            foreach($pt as $row){ 
            
                $table = TableRegistry::get('sale'); //$this->Sale->find()->hydrate(false)
                $sale = $table->find()->hydrate(false)        
                        ->join([
                            [   'table' => 'sale_details',
                                'type' => 'INNER',
                                'conditions' => 'sale_details.sale_id = sale.id_sale'
                            ]
                        ]);
                
                $sale->select($table);
                $sale->select(['p_id'=>'sale_details.product_id','p_name'=>'sale_details.product_name']);
                $sale->select(['up'=>'sale_details.unit_price','uq'=>'sale_details.unit_qty']);
                $sale->select(['subtotal'=>'sale_details.sub_total','discount'=>'sale_details.discount_amount']);
                $sale->select(['total'=>'sale_details.grand_total']);
                $sale->where(['created_on >='=> date("Y-m-d H:i:s", strtotime($from_date)), 'created_on <='=> date("Y-m-d H:i:s", strtotime($to_date))]);
                $sale->andwhere(['sale_details.product_type_id'=>$row['type_id']]);
                if($product_id > 0){
                    $sale->andwhere(['sale_details.product_id'=>$product_id]);
                }
                $rs = $sale->toArray(); 
                
                $data[$row['type_name']] = $rs;
                
            
            }
            $this->set(compact('data','from_date','to_date'));
            $this->render('sale_report_print');
            
            
        }
        elseif ($flag == 2){ // stock report
             
            $product_type_id =  $this->request->params['pass'][1];  // product type
            $product_type =  $this->request->params['pass'][2];  // product name
            $product_id =  $this->request->params['pass'][3];  // product id
            $product_name =  $this->request->params['pass'][4];  // product id
             
            $table =  $table = TableRegistry::get('producttypes');
            $product_types = $table->find()->hydrate(false);
            if($product_type_id > 0){
                $product_types->where(['type_id'=>$product_type_id]);
            }
            $pt  = $product_types->toArray();
            $data = array();
            foreach($pt as $row){
            
                $table = TableRegistry::get('products'); //$this->Sale->find()->hydrate(false)
                $sale = $table->find()->hydrate(false)
                        ->join([
                            [   'table' => 'supplier_products',
                                'type' => 'INNER',
                                'conditions' => 'supplier_products.id_products = products.id_products'
                            ]
                        ]);
                        
                $sale->select($table);
                $sale->select(['unit_per_pack'=>'supplier_products.units_per_pack']);
                $sale->select(['pack_price'=>'supplier_products.pack_price']);
                $sale->select(['unit_price'=>'supplier_products.unit_price']);
                $sale->select(['sale_price'=>'supplier_products.sale_price']);
                $sale->select(['sale_price'=>'supplier_products.sale_price']);
                $sale->distinct('supplier_products.id_products');
                
                $sale->where(['product_type'=>$row['type_id']]);
                if($product_id > 0){
                    $sale->andwhere(['products.id_products'=>$product_id]);
                }
                $rs = $sale->toArray(); 
                $data[$row['type_name']] = $rs;
            
            }
            $this->set(compact('data','from_date','to_date'));
            $this->render('stock_report_print');
         }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sale_details_table = TableRegistry::get('sale_details');
        $productstbl = TableRegistry::get('products');
        $sale = $this->Sale->newEntity();
        if ($this->request->is('post')) {
            $mData = [];
            $mData = $this->request->data['details'];
            $sale = $this->Sale->patchEntity($sale, $this->request->data);
            $sale->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Sale->save($sale)) {
                foreach($mData as $row){
                    
                    $sale_details = $sale_details_table->newEntity();
                    $sale_details->sale_id = $sale->id_sale;
                    $sale_details->product_id = $row['product_id'];
                    $sale_details->product_name = $row['product_name'];
                    $sale_details->unit_price = $row['unit_price'];
                    $sale_details->unit_qty = $row['unit_qty'];
                    $sale_details->sub_total = $row['sub_total'];
                    $sale_details->discount_amount = $row['discount'];
                    $sale_details->grand_total = $row['grand_total'];
                    $sale_details->product_type_id = $row['type_id'];
                    
                    $sale_details_table->save($sale_details);
                    
                    // subtract products from products table
                    $query = $productstbl->find()->select(['id_products','stock'])->where(['id_products' => $row['product_id']]);  // $row->product_id
                    $res = $query->toArray();

                    $stock =  $res[0]->stock;
                    $current_stock = $stock - $row['unit_qty']; //$row->unit_qty;
                    $query = $productstbl->query();
                    $query->update()->set(['stock'=> $current_stock])
                    ->where(['id_products' => $row['product_id']]) //$row->product_id
                    ->execute();
                    
                }
                $inv_no = $sale->id_sale;
                $msg = 'Success|The sale has been saved.';
            } else {
                $msg = 'Error|The sale could not be saved. Please, try again.';
            }
        }
        
        $this->set(compact('msg','inv_no'));
        $this->set('_serialize', ['msg','inv_no']);
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sale = $this->Sale->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sale->patchEntity($sale, $this->request->data);
            if ($this->Sale->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sale could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Sale->Customers->find('list', ['limit' => 200]);
        $this->set(compact('sale', 'customers'));
        $this->set('_serialize', ['sale']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $productstbl = TableRegistry::get('products');
        $tables = TableRegistry::get('sale_details');  
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sale->get($id);
        if ($this->Sale->delete($sale)) {
             
            $query = $tables->find()->select(['product_id','unit_qty'])->where(['sale_id' => $id]);
            $rs = $query->toArray();
            foreach($rs as $row){
            
                $query = $productstbl->find()->select(['id_products','stock'])->where(['id_products' => $row['product_id']]);
                $res = $query->toArray();

                $stock =  $res[0]->stock;
                $current_stock = $stock + $row['unit_qty'];
                $query = $productstbl->query();
                $query->update()->set(['stock'=> $current_stock])
                ->where(['id_products' => $row['product_id']])
                ->execute();    
           
            }
              
            $query = $tables->query()->delete()->where(['sale_id'=>$id])->execute();

            $msg = 'Success|The sale has been deleted.';
            
        } else {
            $msg = 'Error|The sale could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    public function getproductrate(){
        
        $product_id = $this->request->data['product_id'];
        $suppliers_id = $this->request->data['s_id'];
       
        $table = TableRegistry::get('supplier_products');
        $query = $table->find()->hydrate(false)
                        ->join([
                            [   'table' => 'products',
                                'type' => 'INNER',
                                'conditions' => 'products.id_products = supplier_products.id_products'
                            ]
                        ]);
        $query->select($table);
        $query->select(['stock'=>'products.stock']);
        $query->where(['supplier_products.id_products'=> $product_id]);
        $query->andwhere(['id_suppliers'=> $suppliers_id]);
        $product_rates = $query->toArray();
       
        
        $this->set(compact('product_rates'));
        $this->set('_serialize', ['product_rates']);
        
    }
    
     public function getbysearch(){
        
       
        $draw = $this->request->data['draw'];
        $start = $this->request->data['start'];
       
        $length = $this->request->data['length'];
        
         if (isset($this->request->data['order'])) {
            $order = $this->request->data['order'];
            $columns = $this->request->data['columns'];
            $orderby = $columns[$order[0]['column']]['data'];
            $orderdir = $order[0]['dir'];
        } else {
            $orderby = 'id_sale';
            $orderdir = 'desc';
        }
       // $status =  $this->request->data['status'];
        if(!empty($this->request->data['inv_no'])){
            $ids    = explode(',', $this->request->data['inv_no']);
           
        }
       
        if (isset($this->request->data['name'])) {
            $name =  $this->request->data['name'];
        }
        if (isset($this->request->data['status'])) {
            $status =  $this->request->data['status'];
        }
       
        $query = $this->Sale->find("all");
        $query->select(['id_sale','customer_name','status','date'=>'date_format(created_on,"%d-%m-%Y %H:%i")']);
        
      
        $recordsTotal = $query->count();
        
        $query->where(['id_sale >'=>0]);
        
        if (!empty($ids)) {
           $query->andwhere(['id_sale IN' =>$ids]);
        }
       
        if (!empty($name)) {
           $query->andwhere(['customer_name LIKE' =>'%' .$name. '%']);
        }
        if (!empty($status)) {
           $query->andwhere(['status' =>$status]);
        }
       
        
        $recordsFiltered  = $query->count();
        $query->order([$orderby => $orderdir]);
        if($length>-1){
                $query->limit($length);
            }
            if($start>0){
                $query->offset($start);
        }
      
      
        $query->hydrate(false);
        $res = $query->ToArray();
        $data = array();
      
        foreach ($res as $dat) {
           
           $role_id = $this->request->session()->read('Auth.User.role_id');
           if($role_id == '1'){ 
                $actions = array('actions' => "<button onclick='javascript:print_invoice(0," . $dat['id_sale'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:delete_invoice(" . $dat['id_sale'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Cancel</button>");
           }
           else{
               
                $time = new Time($dat['date']);
                if($time->isToday()){
                     $actions = array('actions' => "<button onclick='javascript:print_invoice(0," . $dat['id_sale'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button> <button onclick='javascript:delete_invoice(" . $dat['id_sale'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Cancel</button>");
                }else{
                    $actions = array('actions' => "<button onclick='javascript:print_invoice(0," . $dat['id_sale'] . ")' class='btn btn-sm btn-success'><i class='fa fa-print'></i> Print</button>");
                }
           }
            
            array_push($data, array_merge($dat, $actions));
        }
       
     
       $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
       $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
    }
    
    public function saleReport(){
        
        $table = TableRegistry::get('producttypes');
        $product_types = $table->find();
        
        
        $this->set(compact('product_types'));
        $this->set('_serialize', ['product_types']);
    }
    
    public function stockReport(){
        
        
        $table = TableRegistry::get('producttypes');
        $product_types = $table->find();
        
        
        $this->set(compact('product_types'));
        $this->set('_serialize', ['product_types']);
    }
    
    public function getProducts(){
        
        $id = $this->request->data['type_id'];
        $SupplierProductsTbl = TableRegistry::get('products');
        $query = $SupplierProductsTbl->find('all');
        $query->where(['product_active' => 'y']);
        $query->andwhere(['product_type' => $id]);
        
        $products = $query->toArray();
        
        
        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }
    
}
