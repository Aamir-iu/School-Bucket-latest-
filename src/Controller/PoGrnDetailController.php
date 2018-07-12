<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PoGrnDetail Controller
 *
 * @property \App\Model\Table\PoGrnDetailTable $PoGrnDetail
 */
class PoGrnDetailController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PoGrns', 'GrnProducts']
        ];
        $poGrnDetail = $this->paginate($this->PoGrnDetail);

        $this->set(compact('poGrnDetail'));
        $this->set('_serialize', ['poGrnDetail']);
    }

      public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'view','delete', 'addgrndetail'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }
    
    /**
     * View method
     *
     * @param string|null $id Po Grn Detail id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $poGrnDetail = $this->PoGrnDetail->get($id, [
            'contain' => ['PoGrn', 'Products']
        ]);

        $this->set('poGrnDetail', $poGrnDetail);
        $this->set('_serialize', ['poGrnDetail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $poGrnDetail = $this->PoGrnDetail->newEntity();
        if ($this->request->is('post')) {
            $poGrnDetail = $this->PoGrnDetail->patchEntity($poGrnDetail, $this->request->data);
            if ($this->PoGrnDetail->save($poGrnDetail)) {
                $this->Flash->success(__('The po grn detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The po grn detail could not be saved. Please, try again.'));
            }
        }
        $poGrns = $this->PoGrnDetail->PoGrns->find('list', ['limit' => 200]);
        $grnProducts = $this->PoGrnDetail->GrnProducts->find('list', ['limit' => 200]);
        $this->set(compact('poGrnDetail', 'poGrns', 'grnProducts'));
        $this->set('_serialize', ['poGrnDetail']);
    }

    public function addgrndetail(){
        $this->loadModel('PoGrn');
        $this->loadModel('Products');
        $mData = [];
        $mData = $this->request->data['grndetails'];
        
        //$grndetails= $this->request->data('grndetails');
        $po_id= $this->request->data('po_id');
        $po_number = $this->request->data('po_number');
        $poGrn= $this->PoGrn->newEntity();
        $msg = "";
        if ($this->request->is('post')) {
            $grn_id=0;
            $poGrn = $this->PoGrn->patchEntity($poGrn, $this->request->data);
             if ($this->PoGrn->save($poGrn)) {
                $grn_id=$poGrn->id_po_grn;
                $msg='Success|The po grn detail has been saved.';
            } else {
                $msg='Error|The po grn detail not saved.';
            }
           // debug($grn_id);
            if($grn_id>0){
                foreach ($mData as $grndetail) {
                    
                    $poGrnDetail = $this->PoGrnDetail->newEntity();
                    $productid = $grndetail['product_id'];
                    $productname = $grndetail['product_name'];
                    $po_qty = $grndetail['po_qty'];
                    $received_pack_qty = $grndetail['received_pack_qty'];
                    $received_pack_price = $grndetail['received_pack_price'];
                    $grn_item_expiry = $grndetail['grn_item_expiry'];
                    $grn_batch_no = $grndetail['grn_batch_no'];
                    $bonus        =   $grndetail['bonus'];
                    $gst        =   $grndetail['gst'];
                    $disc        =   $grndetail['disc'];
                    $sub_total   =   $grndetail['sub_total'];
                    $received_unit_price    = $grndetail['received_unit_price'];
                    
                    $newdata = [
                       'po_grn_id' => $grn_id,
                       'grn_product_id' => $productid,
                       'grn_product_name' => $productname,
                       'received_pack_qty' => $received_pack_qty,
                       'received_pack_price' => $received_pack_price,
                       'received_unit_price' => $received_unit_price,
                //       'received_units_per_pack' => $received_units_per_pack,
                       'grn_item_expiry' => $grn_item_expiry,
                       'grn_batch_no' => $grn_batch_no,
                       'bonus' => $bonus,
                       'gst' => $gst,
                       'disc' => $disc,
                       'sub_total' => $sub_total,
                            
                   ];

                   $poGrnDetail = $this->PoGrnDetail->patchEntity($poGrnDetail, $newdata);

                   if ($this->PoGrnDetail->save($poGrnDetail)) {
                       
                       $mValue= 'stock = stock +'.  $received_pack_qty;
                       
                       $query = $this->Products->query();
                        $query->update()
                            ->set(
                                $query->newExpr($mValue)
                            )
                            ->where(['id_products' => $productid])
                            ->execute();
                       
                       $msg='Success|The po grn detail has been saved.';
                   } else {
                       $msg='Error|The po grn detail not saved.';
                   }
                }
            }
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Po Grn Detail id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $poGrnDetail = $this->PoGrnDetail->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $poGrnDetail = $this->PoGrnDetail->patchEntity($poGrnDetail, $this->request->data);
            if ($this->PoGrnDetail->save($poGrnDetail)) {
                $this->Flash->success(__('The po grn detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The po grn detail could not be saved. Please, try again.'));
            }
        }
        $poGrns = $this->PoGrnDetail->PoGrns->find('list', ['limit' => 200]);
        $grnProducts = $this->PoGrnDetail->GrnProducts->find('list', ['limit' => 200]);
        $this->set(compact('poGrnDetail', 'poGrns', 'grnProducts'));
        $this->set('_serialize', ['poGrnDetail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Po Grn Detail id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $poGrnDetail = $this->PoGrnDetail->get($id);
        if ($this->PoGrnDetail->delete($poGrnDetail)) {
            $this->Flash->success(__('The po grn detail has been deleted.'));
        } else {
            $this->Flash->error(__('The po grn detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    
    
}
