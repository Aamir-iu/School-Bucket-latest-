<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;


class PoDetailsController extends AppController {

    
    public function openPO() {

        $poid = $this->request->pass[0];

        $purchaseordersTbl = TableRegistry::get('PurchaseOrders');
        $SuppliersTbl = TableRegistry::get('Suppliers');
        $SupplierProductsTbl = TableRegistry::get('SupplierProducts');

        //get PO details
        $query = $purchaseordersTbl->find('all')->contain(['PoDetails']);
        $po_date = $query->func()->date_format([
            'purchase_order_date' => 'identifier',
            "'%M %e, %Y %h:%i:%s %p'" => 'literal'
        ]);
        $query->select(['id_purchase_orders', 'purchase_order_number', 'po_date' => $po_date, 'supplier_id', 'supplier_name', 'purchase_order_status', 'purchase_order_status_id', 'purchase_order_condition', 'purchase_order_condition_id','po_reason']);
        $query->where(['id_purchase_orders ' => $poid]); //here search po with passed id
        //add calculated fields
        $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
            return $results->map(function ($row) {
                        $collection = new Collection($row->po_details);
                        $row['subtotal'] = $collection->sumOf('total');
                        $row['taxes'] = $collection->sumOf('tax');
                        $row['items'] = $collection->countBy('po_id');
                        return $row;
                    });
        });

        
        $purchaseOrder = $query->toArray();

        $supplierid = $purchaseOrder[0]['supplier_id'];
        //get Products of the supplier
        $query = $SupplierProductsTbl->find('all');
        $query->contain(['products', 'suppliers']);
        
        $query->where(['SupplierProducts.id_suppliers' => $supplierid]); //here search po with passed id
        $query->andwhere(['id_supplier_products > ' => 0]);
        
        $supplierproducts = $query->toArray();

        $postatusTbl= TableRegistry::get('PoStatus');
        $purchaseorderstatuses = $postatusTbl->find();

        $poconditionTbl= TableRegistry::get('PoCondition');
        $purchaseorderconditions = $poconditionTbl->find();
        
        
        $purchas_po_details_Tbl = TableRegistry::get('po_details');
        $PO_details             = $purchas_po_details_Tbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'po_grn',
                                'alias' => 'po_grn',
                                'type' => 'INNER',
                                'conditions' => 'po_grn.po_id = po_details.po_id'
                            ],
                            [   'table' => 'supplier_products',
                                'alias' => 'sp',
                                'type' => 'INNER',
                                'conditions' => 'sp.id_products = po_details.product_id'
                            ]
                        ]);
        
        $PO_details->select(['product_id','product_name','required_pack_qty'=>'pack_qty','id_po_grn'=>'po_grn.id_po_grn']);
        $PO_details->select(['unit_price'=>'sp.unit_price','foc_status']);
        $PO_details->where(['po_grn.po_id'=>$poid]);
        $PO_details->andwhere(['sp.id_suppliers'=>$supplierid]);
        $PO_details = $PO_details->ToArray();
        if(!empty($PO_details)){
            $po_grn_id = $PO_details[0];
        }else{
            $po_grn_id = 0;
        }
        
        
        
        $po_grn_detail_details_Tbl = TableRegistry::get('po_grn_detail');
        $details_of_grn = $po_grn_detail_details_Tbl->find()->hydrate(false);
        $details_of_grn->select(['r_qty' => $details_of_grn->func()->sum('po_grn_detail.received_pack_qty')]);
        $details_of_grn->where(['po_grn_id'=>$po_grn_id['id_po_grn']]);
        $details_of_grn->group('grn_product_id');
        $grn_details    = $details_of_grn->toArray();
        
        
        $this->set(compact('purchaseOrder'));
        $this->set(compact('supplierproducts'));
        $this->set(compact('items', 'purchaseorderstatuses', 'purchaseorderconditions'));
        
        
    }
    public function view(){
        $poid = $this->request->pass[0];

        $purchaseordersTbl = TableRegistry::get('PurchaseOrders');
        $SuppliersTbl = TableRegistry::get('Suppliers');

        //get PO details
        $query = $purchaseordersTbl->find('all')->contain(['PoDetails', 'Suppliers']);
        $po_date = $query->func()->date_format([
            'purchase_order_date' => 'identifier',
            "'%M %e, %Y %h:%i:%s %p'" => 'literal'
        ]);
        $query->where(['id_purchase_orders ' => $poid]); //here search po with passed id
        //add calculated fields
        $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
            return $results->map(function ($row) {
                        $collection = new Collection($row->po_details);
                        $row['subtotal'] = $collection->sumOf('total');
                        $row['taxes'] = $collection->sumOf('tax');
                        $row['items'] = $collection->countBy('po_id');
                        return $row;
                    });
        });

        
        $purchaseOrder = $query->toArray();
        $this->set(compact('purchaseOrder'));
    }
    public function updatestatus(){ debug('ok');
    }
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['openPO', 'addpodetailproducts', 'getpodetails', 
            'ajaxdelete', 'updatestatus', 'view','getproductrate','delete','checkexistinggrn'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    public function add() {
        
        $poDetail = $this->PoDetails->newEntity();
        if ($this->request->is('post')) {
            $poDetail = $this->PoDetails->patchEntity($poDetail, $this->request->data);
            if ($this->PoDetails->save($poDetail)) {
                $this->Flash->success(__('The po detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The po detail could not be saved. Please, try again.'));
            }
        }
        
        $pos = $this->PoDetails->Pos->find('list', ['limit' => 200]);
        $products = $this->PoDetails->Products->find('list', ['limit' => 200]);
        
        $this->set(compact('poDetail', 'pos', 'products'));
        $this->set('_serialize', ['poDetail']);
        
    }

    public function getpodetails() {
        $poid = $this->request->data['po_id'];

        $PoDetailsTbl = TableRegistry::get('PoDetails');

        //get PO details
        $query = $PoDetailsTbl->find('all');
        $query->where(['po_id' => $poid]); //here search podetails with passed id
        $query->hydrate(false); // Results as arrays intead of entities
        $podetails = $query->toArray();

        // Json
        //$data = json_encode($podetails);


        $this->set(compact('podetails'));
        $this->set('_serialize', ['podetails']);
    }

    public function addpodetailproducts() {
        //ajax call

        $mData = [];
        $mData = $this->request->data['podetails'];
        $poid = $this->request->data['po_id'];
        $sp_id = $this->request->data['sp_id'];
        foreach ($mData as $podetail) {

            $msg = "";
            $productid = $podetail['product_id'];
            $packqty = $podetail['pack_qty'];
            $productname = $podetail['product_name'];
            $foc_status = $podetail['foc_status'];
             
            //get product details from supplier_products, products, packing, foc
            $SupplierProductsTbl = TableRegistry::get('SupplierProducts');
            $query = $SupplierProductsTbl->find();
            $query->contain(['products', 'packing_types', 'foc']);
            $query->where(['SupplierProducts.id_products' => $productid]); //here search podetails with passed id
            $query->where(['SupplierProducts.id_suppliers' => $sp_id]); //here search podetails with passed id
            $query->all();

            foreach ($query as $row) {
               
                if($foc_status === 'Y'){
                    $units_per_pack = $row->units_per_pack;
                    $pack_price = 0; 
                    $total_units = $packqty; //$units_per_pack * $packqty;
                    $unitprice = 0; // $pack_price / $total_units;
                    $tax= 0; //($row->tax_rate / 100) * ($pack_price *  $packqty);
                    $total = 0; // ($packqty * $pack_price);
                 }else{
                    $units_per_pack = $row->units_per_pack;
                    $pack_price = $row->pack_price; 
                    $total_units = $units_per_pack * $packqty;
                    $unitprice = $pack_price / $total_units;
                    $tax= ($row->tax_rate / 100) * ($pack_price *  $packqty);
                    $total = ($packqty * $pack_price);
                    
                }
            }

            //create array to be patched from product details
            $newdata = [
                'product_id' => $productid,
                'product_name' => $productname,
                'pack_qty' => $packqty,
                'units_per_pack' => $units_per_pack,
                'pack_price' => $pack_price, 
                'total_units' => $total_units,
                'unit_price' => $unitprice,
                'tax' => $tax,
                'total' => $total,
                'foc_status' => $foc_status
            ];
            
            //check if product already exists in the PO
            $PoDetailsTbl = TableRegistry::get('PoDetails');
            $podquery = $PoDetailsTbl->find('all');
            $podquery->where(['po_id' => $poid]);
            $podquery->where(['product_id' => $productid]);
            $existingPoDetails=$podquery->all();
            $podCount=$podquery->count();
            
            
            if($podCount==0){
                //patch entity with data and save new record
                $poDetail = $this->PoDetails->newEntity();
                if ($this->request->is('post')) {
                    $poDetail = $this->PoDetails->patchEntity($poDetail, $this->request->data);
                    $poDetail = $this->PoDetails->patchEntity($poDetail, $newdata);

                    if ($this->PoDetails->save($poDetail)) {
                        $msg = 'Success|Products added to the Purchase order.';
                    } else {
                        $msg = 'Error|The Product could not be added to PO. Please, try again.';
                    }
                }
            } else {
                //update the existing podetail record
                $msg="Warning|Product ".$productname." already exists in the PO";
            }

            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
        }
    }

    
    
    public function edit($id = null) {
        $poDetail = $this->PoDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $poDetail = $this->PoDetails->patchEntity($poDetail, $this->request->data);
            if ($this->PoDetails->save($poDetail)) {
                $this->Flash->success(__('The po detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The po detail could not be saved. Please, try again.'));
            }
        }
        $pos = $this->PoDetails->Pos->find('list', ['limit' => 200]);
        $products = $this->PoDetails->Products->find('list', ['limit' => 200]);
        $this->set(compact('poDetail', 'pos', 'products'));
        $this->set('_serialize', ['poDetail']);
    }

    public function ajaxdelete() {
        
        if ($this->request->is('post')) {
            
            $id = $this->request->data['podid'];
            $p_id = $this->request->data['p_id'];
            $po_id = $this->request->data['po_id'];
            
            $po_grn_detailble = TableRegistry::get('po_grn_detail');
            $po_grnble = TableRegistry::get('po_grn');
            $query_grn = $po_grnble->find();
            $query_grn->select(['id_po_grn']);
            $query_grn->where(['po_id' => $po_id]);
            $result = $query_grn->first();
            if(count($result) > 0){
                $msg = 'Warning|Sorry you can not delete, GRN already exists';
                }else{
                        $poDetail = $this->PoDetails->get($id);
                        if ($this->PoDetails->delete($poDetail)) {
                        $msg = 'Success|The po detail has been deleted.';
                        } else {
                        $msg = 'The po detail could not be deleted. Please, try again.';
                        }
                    }
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);    
       
         }   
    
    }
    public function getproductrate(){
        
        $product_id = $this->request->data['product_id'];
        $suppliers_id = $this->request->data['s_id'];
       
        $table = TableRegistry::get('supplier_products');
        $query = $table->find('all');
        $query->where(['id_suppliers'=> $suppliers_id]);
        $query->andwhere(['id_products'=> $product_id]);
        $product_rates = $query->toArray();
        
        $table = TableRegistry::get('foc');
        $query = $table->find()->hydrate(false)
                    ->join([
                            [   'table' => 'products',
                                'type' => 'INNER',
                                'conditions' => 'products.id_products = foc.foc_product'
                            ]
                        ]);
        $query->select(['pname'=>'products.product_name','foc_for_qty','foc_product_qty']);
        $query->select(['pid'=>'products.id_products']);
        
        $query->where(['supplier_id'=> $suppliers_id]);
        $query->andwhere(['foc_for'=> $product_id]);
        $for_foc = $query->toArray();
        
        $this->set(compact('product_rates','for_foc'));
        $this->set('_serialize', ['product_rates','for_foc']);
        
    }
    
    public function checkexistinggrn(){
        
        if($this->request->is('post')){
            $po_id = $this->request->data['id'];
            $po_grnble = TableRegistry::get('po_grn');
            $query_grn = $po_grnble->find();
            $query_grn->select(['id_po_grn']);
            $query_grn->where(['po_id' => $po_id]);
            $result = $query_grn->first();
            if(count($result) > 0){
                $msg = "Yes";
            }else{
                $msg = "NO";
            }
            $this->set(compact('msg'));
            $this->set('_serialize', ['msg']);
            
        }   
    }
    

}
