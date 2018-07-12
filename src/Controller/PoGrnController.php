<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * PoGrn Controller
 *
 * @property \App\Model\Table\PoGrnTable $PoGrn
 */
class PoGrnController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){
        $this->paginate = [
            'contain' => ['Pos']
        ];
        $poGrn = $this->paginate($this->PoGrn);

        $this->set(compact('poGrn'));
        $this->set('_serialize', ['poGrn']);
    }

    
     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','delete', 'add', 'edit', 'view', 'getpogrn','getpogrndatatable','ajaxdeletegrn','getdeliverystatus','getadvicedetails'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    function getpogrndatatable(){
        //ajax call
        $grnTbl = TableRegistry::get('PoGrn');
       
        $PO_id = $this->request->data['po_id'];

        $query = $grnTbl->find();
        
        $grn_d = $query->func()->date_format([
            'grn_date' => 'identifier',
            "'%d-%m-%Y %H:%i'" => 'literal'
        ]);
        $query->select(['po_id','suppliers_id','id_po_grn', 'po_number', 'grn_dat'=>$grn_d]);
        $query->where(['po_id' => $PO_id]);
       
        
        $query->hydrate(false); // Results as arrays intead of entities
        $total = $query->count();
        $res = $query->toArray(); // Execute the query and return the array
        
        $data = array(); //declare our new array for returning to datatable
        $PAtable = TableRegistry::get('payment_advice');
        foreach ($res as $dat) {
            $exists = $PAtable->exists(['grn_id' => $dat['id_po_grn'], 'status'=>'Active']);
            $time = new Time($dat['grn_dat']);
            if($time->isToday()){
                
                if($exists){
                    $actions = array('actions' => "<button onclick='javascript:printGRN(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-warning'><i class='fa fa-print'></i></button> <button onclick='javascript:deleteGRN(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button> <button onclick='javascript:adviveOK(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-success'><i class='icon-like'></i> Submitted</button>");
                }else{
                    $actions = array('actions' => "<button onclick='javascript:printGRN(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-warning'><i class='fa fa-print'></i></button> <button onclick='javascript:deleteGRN(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button> <button onclick='javascript:adviveNOTE(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-info'><i class='fa fa-dollar'></i> Advice Note</button> <button onclick='javascript:set_prn(" . $dat['id_po_grn'] . ", " . $dat['po_id'] . ", " . $dat['suppliers_id'] . ")' class='btn btn-sm btn-success'><i class='fa fa-arrow-circle-right' aria-hidden='true'></i> Add PRN</button>");
                }
                
                
            }else{
                if($exists){
                    $actions=array('actions' => "<button onclick='javascript:printGRN(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-warning'><i class='fa fa-print'></i></button> <button onclick='javascript:adviveOK(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-success'><i class='icon-like'></i> Submitted</button>");
                }else{
                    $actions=array('actions' => "<button onclick='javascript:printGRN(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-warning'><i class='fa fa-print'></i></button> <button onclick='javascript:adviveNOTE(" . $dat['id_po_grn'] . ")' class='btn btn-sm btn-info'><i class='fa fa-dollar'></i> Advice Note</button> <button onclick='javascript:set_prn(" . $dat['id_po_grn'] . ", " . $dat['po_id'] . ", " . $dat['suppliers_id'] . ")' class='btn btn-sm btn-success'><i class='fa fa-arrow-circle-right' aria-hidden='true'></i> Add PRN</button>");
                }
            }
            array_push($data, array_merge($dat,$actions));
        }
        
        
        
        $this->set(compact('data', 'total'));
        $this->set('_serialize', ['data']);
        
    }
    
    public function getpogrn(){
        //ajax call
        $grnTbl = TableRegistry::get('PoGrn');
       
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
            $orderby = 'id_po_grn';
            $orderdir = 'asc';
        }


        $PO_id = $this->request->data['po_id'];

        $query = $grnTbl->find();
        $grn_date = $query->func()->date_format([
            'grn_date' => 'identifier',
            "'%d-%m-%Y %H:%i'" => 'literal'
        ]);
        $query->select(['id_po_grn', 'po_number', 'grn_date'=>$grn_date]);
        $query->where(['po_id' => $PO_id]);

        $query->order([$orderby => $orderdir]);
        $query->limit($length);
        if($start>0){
            $query->offset($start);
        }
        
                
        $query->hydrate(false); // Results as arrays intead of entities
        $total = $query->count();
        $data = $query->toArray(); // Execute the query and return the array

//        $data = array(); //declare our new array for returning to datatable
//
//        foreach ($res as $dat) {
//
//            //$actions = array('actions' => "<button onclick='javascript:editPO(" . $dat['id_purchase_orders'] . ")' class='btn btn-sm amber-500'>Open</button>");
//            array_push($data, array_merge($dat));
//        }


        $recordsTotal = $total;
        $recordsFiltered = $total;
        
        $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
        $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
        
    }
        
    public function view($id = null){
        $query=$this->PoGrn->find();
        $query->contain([
            'PoGrnDetail','suppliers','purchase_orders'
        ]);
        $query->where(['id_po_grn' => $id]);
        $grn_date = $query->func()->date_format([
            'grn_date' => 'identifier',
            "'%d-%m-%Y %H:%i'" => 'literal'
        ]);

        $poGrn=$query->first();
        $this->set('poGrn', $poGrn);
        $this->set('_serialize', ['poGrn']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $poGrn = $this->PoGrn->newEntity();
        if ($this->request->is('post')) {
            $poGrn = $this->PoGrn->patchEntity($poGrn, $this->request->data);
            if ($this->PoGrn->save($poGrn)) {
                $this->Flash->success(__('The po grn has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The po grn could not be saved. Please, try again.'));
            }
        }
        $pos = $this->PoGrn->Pos->find('list', ['limit' => 200]);
        $this->set(compact('poGrn', 'pos'));
        $this->set('_serialize', ['poGrn']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Po Grn id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $poGrn = $this->PoGrn->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $poGrn = $this->PoGrn->patchEntity($poGrn, $this->request->data);
            if ($this->PoGrn->save($poGrn)) {
                $this->Flash->success(__('The po grn has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The po grn could not be saved. Please, try again.'));
            }
        }
        $pos = $this->PoGrn->Pos->find('list', ['limit' => 200]);
        $this->set(compact('poGrn', 'pos'));
        $this->set('_serialize', ['poGrn']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Po Grn id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $poGrn = $this->PoGrn->get($id);
        if ($this->PoGrn->delete($poGrn)) {
            $this->Flash->success(__('The po grn has been deleted.'));
        } else {
            $this->Flash->error(__('The po grn could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function ajaxdeletegrn() {
       // $this->loadModel('Products');
        if ($this->request->is('post')) {
            $id = $this->request->data['grnid'];
            
            //delete grn details
            $PoGrnDetailsTable = TableRegistry::get('PoGrnDetail');
            $ProductsTable = TableRegistry::get('Products');
            $PoGrnDetails = $PoGrnDetailsTable->find('all')->where(['po_grn_id' => $id]);
            
            foreach($PoGrnDetails as $PoGrnDetail){
                
                //Update stock 
                $productid = $PoGrnDetail->grn_product_id;
                
                $received_pack_qty = $PoGrnDetail->received_pack_qty;
                $mValue= 'stock = stock - '.  $received_pack_qty;

                $stock = $ProductsTable->query();
                        $stock->update()
                            ->set(
                                $stock->newExpr($mValue)
                            )
                            ->where(['id_products' => $productid])
                            ->execute();     
                
                $PoGrnDetailid=$PoGrnDetail->id_po_grn_detail;
                $query = $PoGrnDetailsTable->query();
                $query->delete()
                    ->where(['id_po_grn_detail' => $PoGrnDetailid])
                    ->execute();
                
                          
            }
            
            
            //delete GRN
            $poGrn = $this->PoGrn->get($id);
            if ($this->PoGrn->delete($poGrn)) {
                
                $msg = 'Success|The po detail has been deleted.';
            } else {
                $msg = 'The GRN could not be deleted. Please, try again.';
            }

        } else {
            $msg = 'Should be ajax post.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
    }
    
     public function getdeliverystatus(){
        /*
         * select grn_batch_no, grn_product_name, sum(received_pack_price) as 'Price', 
            sum(received_pack_qty) as 'Received' from purchase_orders
            join po_grn on po_grn.po_id = purchase_orders.id_purchase_orders
            join po_grn_detail on po_grn.id_po_grn = po_grn_detail.po_grn_id
            where purchase_orders.id_purchase_orders=35
            group by  grn_batch_no, grn_product_name
         * 
         */
       
        $PoGrnDetailTbl = TableRegistry::get('PoGrnDetail');
        
        $query = $PoGrnDetailTbl->find();
        $query->matching('PoGrn', function ($q) {
            $POID = $this->request->data['po_id'];
            return $q->where(['po_id'=>$POID]);
        });
        $query->select(['grn_batch_no','grn_product_name','Price'=>'sum(received_pack_price)', 'Received'=>'sum(received_pack_qty)']);
        $query->group(['grn_batch_no','grn_product_name']);
        $query->hydrate(false); // Results as arrays intead of entities
        
        $data = $query->toArray(); // Execute the query and return the array
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }
    
    
    
    public function getadvicedetails(){
        
        $id = $this->request->data['id'];
        
        $query=$this->PoGrn->find();
        $query->contain([
            'PoGrnDetail','suppliers','purchase_orders'
        ]);
        
        $query->where(['id_po_grn' => $id]);
        
        $bill_date = $query->func()->date_format([
            'bill_date' => 'identifier',
            "'%d-%m-%Y %H:%i'" => 'literal'
        ]);

        $poGrn = $query->first();
        
        $msg = "Success|The details of advice note has been loaded.";
        
        $this->set(compact('poGrn'));
        $this->set('_serialize', ['poGrn','msg']);
        
        
    }
    
    
    
    
    
    
}
