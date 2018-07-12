<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * PurchaseReturnNote Controller
 *
 * @property \App\Model\Table\PurchaseReturnNoteTable $PurchaseReturnNote
 */
class PurchaseReturnNoteController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'delete', 'add', 'edit', 'view', 'getprnnotetable', 'ajaxdeleteprn', 'setPrnForSelectedGrn', 'addPrn'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Pos']
        ];

        $purchaseReturnNote = $this->paginate($this->PurchaseReturnNote);

        $this->set(compact('purchaseReturnNote'));
        $this->set('_serialize', ['purchaseReturnNote']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Return Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {

        $purchaseReturnNote = $this->PurchaseReturnNote->get($id, [
            'contain' => ['PoGrnDetail', 'suppliers', 'purchase_orders', 'purchase_return_note_detail']
        ]);

        $this->set('purchaseReturnNote', $purchaseReturnNote);
        $this->set('_serialize', ['purchaseReturnNote']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $purchaseReturnNote = $this->PurchaseReturnNote->newEntity();
        if ($this->request->is('post')) {
            $purchaseReturnNote = $this->PurchaseReturnNote->patchEntity($purchaseReturnNote, $this->request->data);
            if ($this->PurchaseReturnNote->save($purchaseReturnNote)) {
                $this->Flash->success(__('The purchase return note has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The purchase return note could not be saved. Please, try again.'));
            }
        }
        $pos = $this->PurchaseReturnNote->Pos->find('list', ['limit' => 200]);
        $this->set(compact('purchaseReturnNote', 'pos'));
        $this->set('_serialize', ['purchaseReturnNote']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Return Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $purchaseReturnNote = $this->PurchaseReturnNote->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseReturnNote = $this->PurchaseReturnNote->patchEntity($purchaseReturnNote, $this->request->data);
            if ($this->PurchaseReturnNote->save($purchaseReturnNote)) {
                $this->Flash->success(__('The purchase return note has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The purchase return note could not be saved. Please, try again.'));
            }
        }
        $pos = $this->PurchaseReturnNote->Pos->find('list', ['limit' => 200]);
        $this->set(compact('purchaseReturnNote', 'pos'));
        $this->set('_serialize', ['purchaseReturnNote']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Return Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseReturnNote = $this->PurchaseReturnNote->get($id);
        if ($this->PurchaseReturnNote->delete($purchaseReturnNote)) {
            $this->Flash->success(__('The purchase return note has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase return note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    function getprnnotetable() {
        //ajax call
        $grnTbl = TableRegistry::get('PurchaseReturnNote');

        $PO_id = $this->request->data['po_id'];

        $query = $grnTbl->find();

        $grn_d = $query->func()->date_format([
            'date' => 'identifier',
            "'%d-%m-%Y %H:%i'" => 'literal'
        ]);

        $query->select(['grn_id', 'remarks', 'id_prn_note', 'po_id', 'po_number', 'prn_date' => 'date_format(PurchaseReturnNote.date,"%d-%m-%Y %H:%i")', 'created_date' => 'date_format(PurchaseReturnNote.created_on,"%d-%m-%Y %H:%i")']);
        $query->where(['po_id' => $PO_id]);


        $query->hydrate(false); // Results as arrays intead of entities
        $total = $query->count();
        $res = $query->toArray(); // Execute the query and return the array

        $data = array(); //declare our new array for returning to datatable
        //$PAtable = TableRegistry::get('payment_advice');
        foreach ($res as $dat) {
            //$exists = $PAtable->exists(['grn_id' => $dat['id_po_grn'], 'status' => 'Active']);
            $time = new Time($dat['created_date']);
            if ($time->isToday()) {

                //if ($exists) {
                $actions = array('actions' => "<button onclick='javascript:printPRN(" . $dat['id_prn_note'] . ")' class='btn btn-sm btn-warning'><i class='fa fa-print'></i></button> <button onclick='javascript:deletePRN(" . $dat['id_prn_note'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button>");
                //} else {
                //  $actions = array('actions' => "<button onclick='javascript:printGRN(" . $dat['id_prn_note'] . ")' class='btn btn-sm amber-500'><i class='fa fa-print'></i></button><button onclick='javascript:deleteGRN(" . $dat['id_prn_note'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button><button onclick='javascript:adviveNOTE(" . $dat['id_prn_note'] . ")' class='btn btn-sm btn-info'><i class='fa fa-dollar'></i> Advice Note</button>");
                // }
            } else {
                //if ($exists) {
                $actions = array('actions' => "<button onclick='javascript:printPRN(" . $dat['id_prn_note'] . ")' class='btn btn-sm btn-warning'><i class='fa fa-print'></i>");
                //} else {
                //  $actions = array('actions' => "<button onclick='javascript:printGRN(" . $dat['id_prn_note'] . ")' class='btn btn-sm amber-500'><i class='fa fa-print'></i></button><button onclick='javascript:adviveNOTE(" . $dat['id_prn_note'] . ")' class='btn btn-sm btn-info'><i class='fa fa-dollar'></i> Advice Note</button>");
                //}
            }
            array_push($data, array_merge($dat, $actions));
        }



        $this->set(compact('data', 'total'));
        $this->set('_serialize', ['data']);
    }

    public function ajaxdeleteprn() {

        if ($this->request->is('post')) {
            $id = $this->request->data['prnid'];

            $PoGrnDetailsTable = TableRegistry::get('purchase_return_note_detail');
            $prn_detail = $PoGrnDetailsTable->find()->select(['product_id', 'qty_returned'])->where(['prn_note_id' => $id]);
            $prn_detail = $prn_detail->toArray();

            foreach ($prn_detail as $row) {

                $returned_qty = $row->qty_returned;

                $productstbl = TableRegistry::get('products');
                $query = $productstbl->find()->select(['id_products', 'stock'])->where(['id_products' => $row->product_id]);
                $res = $query->toArray();

                $stock = $res[0]->stock;
                $current_stock = $stock + $returned_qty;
                $query = $productstbl->query();
                $query->update()->set(['stock' => $current_stock])
                        ->where(['id_products' => $row->product_id])
                        ->execute();
            }
            $table = TableRegistry::get('purchase_return_note_detail');
            $query = $table->query();
            $query->delete()
                    ->where(['prn_note_id' => $id])
                    ->execute();

            $table = TableRegistry::get('purchase_return_note');
            $query = $table->query();
            $query->delete()
                    ->where(['id_prn_note' => $id])
                    ->execute();
            $msg = 'Success|The po detail has been deleted.';
            echo 'Success';
            exit;
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        exit;
    }

    public function setPrnForSelectedGrn() {

        $grnid = $this->request->data['grn_id'];
        $poid = $this->request->data['po_id'];
        $supplierid = $this->request->data['supplier_id'];
        //echo $grnid.'---'.$poid.'---'.$supplierid;exit;
        $PurchaseReturnNote = TableRegistry::get('po_grn');
        $PRN_details = $PurchaseReturnNote->find()->hydrate(false)
                ->join([
            [ 'table' => 'po_grn_detail',
                'alias' => 'po_grn_d',
                'type' => 'INNER',
                'conditions' => 'po_grn_d.po_grn_id = po_grn.id_po_grn'
            ],
            [ 'table' => 'supplier_products',
                'alias' => 'sp',
                'type' => 'INNER',
                'conditions' => 'sp.id_products = po_grn_d.grn_product_id'
            ]
        ]);
        $PRN_details->select(['GrnBatchNo' => 'po_grn_d.grn_batch_no', 'po_grn.po_number', 'product_id' => 'po_grn_d.grn_product_id', 'product_name' => 'po_grn_d.grn_product_name', 'pack_qty' => $PRN_details->func()->sum('distinct po_grn_d.received_pack_qty'), 'id_po_grn' => 'po_grn.id_po_grn']);
        $PRN_details->where(['po_grn.po_id' => $poid]);
        $PRN_details->andwhere(['po_grn.id_po_grn' => $grnid]);
        $PRN_details->andwhere(['sp.id_suppliers' => $supplierid]);
        //$PRN_details->group(['po_grn_d.grn_product_id', 'prn_d.product_id']);
        $PRN_details->group(['product_id']);
        $PRN_details = $PRN_details->ToArray();

        $prn_qty = 0;
        $data = [];
        foreach ($PRN_details as $d) {
            $PrnQty = TableRegistry::get('purchase_return_note');
            $Prn_Qty = $PrnQty->find()->hydrate(false)
                    ->join([
                [ 'table' => 'purchase_return_note_detail',
                    'alias' => 'prn_d',
                    'type' => 'INNER',
                    'conditions' => 'prn_d.prn_note_id = purchase_return_note.id_prn_note'
                ]
            ]);
            $Prn_Qty->select(['product_id' => 'prn_d.product_id', 'prn_qty' => $Prn_Qty->func()->sum('prn_d.qty_returned')]);
            $Prn_Qty->where(['purchase_return_note.po_id' => $poid]);
            $Prn_Qty->andwhere(['purchase_return_note.grn_id' => $grnid]);
            $Prn_Qty->andwhere(['purchase_return_note.suppliers_id' => $supplierid]);
            $Prn_Qty->andwhere(['prn_d.product_id' => $d['product_id']]);
            $Prn_Qty->group(['prn_d.product_id']);
            $Prn_Qty = $Prn_Qty->first();

            if ($Prn_Qty['prn_qty'] > 0) {
                $prn_qty = $Prn_Qty['prn_qty'];
            } else {
                $prn_qty = 0;
            }

            $array_merge = array_merge(
                    array('prn_qty' => $prn_qty), 
                    array('product_id' => $d['product_id']), 
                    array('product_name' => $d['product_name']),
                    array('pack_qty' => $d['pack_qty']),
                    array('po_number' => $d['po_number']),
                    array('GrnBatchNo' => $d['GrnBatchNo']),
                    array('id_po_grn' => $d['id_po_grn'])
            );

            array_push($data, $array_merge);
        }
        echo json_encode($data);
        exit;
    }

    public function addPrn() {
        $date = date("Y-m-d", strtotime($this->request->data['date'])) . ' ' . date("h:i:s");
        if ($this->request->is('post')) {

            $mData = [];
            $mData = $this->request->data['prndetails'];

            $addnote = $this->PurchaseReturnNote->newEntity();
            $addnote->grn_id = $this->request->data['grn_id'];
            $addnote->po_id = $this->request->data['po_id'];
            $addnote->po_number = $this->request->data['po_number'];
            $addnote->remarks = $this->request->data['remarks'];
            $addnote->suppliers_id = $this->request->data['supplier_id'];
            $addnote->date = $date;

            $addnote->created_by = $this->request->session()->read('Auth.User.id');
            $this->PurchaseReturnNote->save($addnote);

            $advicetable = TableRegistry::get('purchase_return_note');
            $query = $advicetable->find();
            $query->select(['lastID' => 'max(purchase_return_note.id_prn_note)']);
            $last_ID = $query->first();

            $addnote_detail = TableRegistry::get('purchase_return_note_detail');
            foreach ($mData as $row) {
                if ($row['return_qty'] !== "") {
                    $productstbl = TableRegistry::get('products');
                    $query = $productstbl->find()->select(['id_products', 'stock'])->where(['id_products' => $row['product_id']]);
                    $res = $query->toArray();

                    $stock = $res[0]->stock;
                    $current_stock = $stock - $row['return_qty'];
                    $query = $productstbl->query();
                    $query->update()->set(['stock' => $current_stock])
                            ->where(['id_products' => $row['product_id']])
                            ->execute();

                    $detail = $addnote_detail->newEntity();
                    $detail->prn_note_id = $last_ID->lastID;
                    $detail->product_id = $row['product_id'];
                    $detail->product_name = $row['product_name'];
                    $detail->qty_returned = $row['return_qty'];
                    $detail->grn_batch_no = $row['grn_batch_no'];

                    $addnote_detail->save($detail);
                }
            }

            $msg = "Success|The PRN has been saved.";
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

}
