<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
/**
 * Purchaseorders Controller
 *
 * @property \App\Model\Table\PurchaseordersTable $PurchaseordersTable
 */
class PurchaseordersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index() {
        $supplierTbl = TableRegistry::get('Suppliers');
        $suppliers = $supplierTbl->find()  ->join([
                            [   'table' => 'supplier_products',
                                'alias' => 'sp',
                                'type' => 'INNER',
                                'conditions' => 'sp.id_suppliers = Suppliers.id_suppliers'
                            ]
                        ]);
        $suppliers->select(['id_suppliers','supplier_name']);
        $suppliers->group(['supplier_name']);
        $suppliers = $suppliers->ToArray();
        
        $postatusTbl= TableRegistry::get('PoStatus');
        $purchaseorderstatuses = $postatusTbl->find();

        $poconditionTbl= TableRegistry::get('PoCondition');
        $purchaseorderconditions = $poconditionTbl->find();

        $reasonsTbl= TableRegistry::get('reasons');
        $reasons = $reasonsTbl->find();

        $this->set(compact('purchaseorderstatuses', 'purchaseorderconditions', 'suppliers','reasons'));
        //$this->set('_serialize', ['purchaseorders']);
        
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'addpo', 'getpobysearch','updatestatus','delete'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }

        return parent::isAuthorized($user);
    }

     /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addpo()
    {
        $msg="nothing";
        $this->loadModel('PurchaseOrders');
        $po = $this->PurchaseOrders->newEntity();
       
        if ($this->request->is('post')) {
          
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute("select purchase_order_number  as PO_NO from  purchase_orders where id_purchase_orders =(select max(id_purchase_orders) from purchase_orders)");
            $res = $stmt ->fetchAll('assoc');
            if($res){
            $last_ID =  $res[0];
            }else{
                $last_ID =  1;
            }
            $po_no = "";
            if(count($last_ID) > 0){
                
                if (strpos($last_ID['PO_NO'], '-') !== false) {
                     $temp = explode("-",$last_ID['PO_NO']); 
                     $po_no = intval($temp[1]) + 1;
                     $PO_Number = "P-".$po_no;
                }else{
                     $po_no = $last_ID['PO_NO'] + 1;
                     $PO_Number = "P-".$po_no;
                    }
            }else{
                $PO_Number = "P-1";
            }
            
            $po = $this->PurchaseOrders->patchEntity($po, $this->request->data);
            $po->purchase_order_number = $PO_Number;
            if ($this->Purchaseorders->save($po)) {
                $msg='Success|New Purchase order created';
                
            } else {
                $msg='Error|Purchase order could not be saved';
                
            }
        }
        
        $table = TableRegistry::get('purchase_orders');
        $query = $table->find('all');
        $query->select(['lastID'=> 'max(purchase_orders.id_purchase_orders)']);
        $last_ID = $query->first();
        $id =  $last_ID->lastID;
        
        $this->set(compact('msg','id'));
        $this->set('_serialize', ['msg','id']);

    }
    
    public function updatestatus($id=null){
        $id = $this->request->data['id'];
        $this->loadModel('PurchaseOrders');
        $po = $this->PurchaseOrders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $po = $this->PurchaseOrders->patchEntity($po, $this->request->data);
            if ($this->PurchaseOrders->save($po)) {
                $this->Flash->success(__('The po detail has been saved.'));
            } else {
                $this->Flash->error(__('The po detail could not be saved. Please, try again.'));
            }
        }
        $msg= "Success";
      //  return $this->redirect(['controller' => 'PoDetails', 'action' => 'openPO', $id]);
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
    public function getpobysearch() {
        //ajax call
        
        $purchaseordersTbl = TableRegistry::get('PurchaseOrders');
        
        //** get all table definitions **//
        $draw = $this->request->data['draw'];
        $start = $this->request->data['start'];
       
        $length = $this->request->data['length'];
        
        
        
        if (isset($this->request->data['order'])) {
            $order = $this->request->data['order'];
            $columns = $this->request->data['columns'];
            $orderby = $columns[$order[0]['column']]['data'];
            $orderdir = $order[0]['dir'];
        } else {
            $orderby = 'id_purchase_orders';
            $orderdir = 'asc';
        }

        
         $query = $purchaseordersTbl->find();
            
            $po_date = $query->func()->date_format([
                'purchase_order_date' => 'identifier',
                "'%d-%m-%Y %H:%i'" => 'literal'
            ]);
            
        if (isset($this->request->data['po_supplier'])) {
            $PO_no = $this->request->data['po_number'];
            $PO_id = $this->request->data['order_number'];
            $from = $this->request->data['order_date_from'];
            $to = $this->request->data['order_date_to'];
            $supplier = strtoupper($this->request->data['po_supplier']);
            $status = $this->request->data['order_status'];
            $condition = $this->request->data['order_condition'];
            
            $query->select(['id_purchase_orders', 'purchase_order_number', 'po_date' => $po_date, 'supplier_name', 'purchase_order_status']);
            $query->where(['purchase_order_condition_id' => $condition]);

           if (!empty($PO_no)) {
                $query->andwhere(['purchase_order_number LIKE' => '%' . $PO_no . '%']);
            }
            if (!empty($supplier)) {
                $query->andwhere(['supplier_name LIKE' => '%' . $supplier . '%']);
            }
            if (!empty($status)) {
                $query->andwhere(['purchase_order_status_id' => $status]);
            }
            if (!empty($from) && !empty($to)) {
                $query->andwhere(['purchase_order_date >=' => date("Y-m-d H:i:s", strtotime($from)), 'purchase_order_date <=' => date("Y-m-d H:i:s", strtotime($to))]);
            }
            if (!empty($PO_id)) {
                $query->andwhere(['id_purchase_orders' =>  $PO_id]);
            }
            $query->order([$orderby => $orderdir]);
            if($length>-1){
                $query->limit($length);
            }
            if($start>0){
                $query->offset($start);
                //debug($query);
            }
            
        } else {
            
            $query = $purchaseordersTbl->find();
            $query->select(['id_purchase_orders', 'purchase_order_number',  'po_date'=>$po_date, 'supplier_name', 'purchase_order_status']);
            $query->where(['purchase_order_condition_id' => 1]);
            $query->order([$orderby => $orderdir]);
            if($length>-1){
                $query->limit($length);
            }
            if($start>0){
                $query->offset($start);
            }
          
        }

        
        $query->hydrate(false); // Results as arrays intead of entities
        $total = $query->count();
        $res = $query->toArray(); // Execute the query and return the array

        $data = array(); //declare our new array for returning to datatable

        foreach ($res as $dat) {
            
            $actions = array('actions' => "<button onclick='javascript:editPO(" . $dat['id_purchase_orders'] . ")' class='btn btn-icon waves-effect waves-light btn-success m-b-5'>Open</button>");
            array_push($data, array_merge($dat, $actions));
        }

        $recordsTotal = $total;
        $recordsFiltered = $total;
        
        $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
        $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
    }

   
}
