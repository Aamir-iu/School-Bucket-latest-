<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * PaymentAdvice Controller
 *
 * @property \App\Model\Table\PaymentAdviceTable $PaymentAdvice
 */
class PaymentAdviceController extends AppController
{

  
    public function index()
    {
       
       // $paymentAdvice = $this->paginate($this->PaymentAdvice);

      //  $this->set(compact('paymentAdvice'));
      //  $this->set('_serialize', ['paymentAdvice']);
    }

     public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index','add', 'edit', 'view', 'delete','addadvicedetail','getadvice','getpaymentadvicebysearch'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    
    public function view()
    {
       
        $flag =   $this->request->pass[0];
        $id =   $this->request->pass[1];
        if($flag==0){
        
            $table = TableRegistry::get('payment_advice');
            $data  = $table->find('all')->contain(['payment_advice_details','suppliers']);
            $data->where(['id_payment_advice' => $id ]);
            $data->andwhere(['status' => 'Active' ]);
            $data->orwhere(['status' => 'Created' ]);
            $data = $data->toArray();
            $this->set(compact('data'));
            $this->set('_serialize', ['data']);
            
        }
        
    }
   
    public function add()
    {
        $paymentAdvice = $this->PaymentAdvice->newEntity();
        if ($this->request->is('post')) {
            $paymentAdvice = $this->PaymentAdvice->patchEntity($paymentAdvice, $this->request->data);
            if ($this->PaymentAdvice->save($paymentAdvice)) {
                $this->Flash->success(__('The payment advice has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment advice could not be saved. Please, try again.'));
            }
        }
        $products = $this->PaymentAdvice->Products->find('list', ['limit' => 200]);
        $this->set(compact('paymentAdvice', 'products'));
        $this->set('_serialize', ['paymentAdvice']);
    }

    
    public function edit($id = null) {
        $id = $this->request->data['id'];
        $paymentAdvice = $this->PaymentAdvice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentAdvice = $this->PaymentAdvice->patchEntity($paymentAdvice, $this->request->data);
            $paymentAdvice->status = "Cancelled";
            if ($this->PaymentAdvice->save($paymentAdvice)) {
                $msg = 'Success|The payment advice has been deleted.';
            } else {
                $msg =  'Error|The payment advice could not be deleted. Please, try again.';
            }
        }

        $this->set(compact('msg', 'msg'));
        $this->set('_serialize', ['msg']);
    }

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $paymentAdvice = $this->PaymentAdvice->get($id);
        if ($this->PaymentAdvice->delete($paymentAdvice)) {
            $this->Flash->success(__('The payment advice has been deleted.'));
        } else {
            $this->Flash->error(__('The payment advice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
 
    public function addadvicedetail(){
        
        $data = date("Y-m-d");
        if ($this->request->is('post')) {
            $mData = [];
            $mData = $this->request->data['advicedetails'];
            
            $paymentAdvice = $this->PaymentAdvice->newEntity();
            $paymentAdvice->invoice_number = $this->request->data['invoice_number'];
            $paymentAdvice->po_id = $this->request->data['po_id'];
            $paymentAdvice->grn_id = $this->request->data['id'];
            $paymentAdvice->po_number = $this->request->data['po_number'];
            $paymentAdvice->supplier_id = $this->request->data['supp_id'];
            $paymentAdvice->advice_date    = date("Y-m-d H:i:s", strtotime($this->request->data['pa_date']));
            
            $paymentAdvice->created_by = $this->request->session()->read('Auth.User.id');
            $this->PaymentAdvice->save($paymentAdvice);
            
            $advicetable = TableRegistry::get('payment_advice');
            $query      = $advicetable->find();        
            $query->select(['lastID'=> 'max(payment_advice.id_payment_advice)']);
            $last_ID = $query->first();
            
            
            $payment_advice_detailsble = TableRegistry::get('payment_advice_details');
            foreach($mData as $row){
             $paymentAdviceDetails =$payment_advice_detailsble->newEntity();
             $paymentAdviceDetails->payment_advice_id = $last_ID->lastID;
             $paymentAdviceDetails->product_id = $row['product_id'];
             $paymentAdviceDetails->product_name = $row['product_name'];
             $paymentAdviceDetails->pack_qty = $row['received_pack_qty'];
             $paymentAdviceDetails->pack_price = $row['received_pack_price'];
             $paymentAdviceDetails->sub_total = $row['st_price'];
             $paymentAdviceDetails->created_by = $this->request->session()->read('Auth.User.id');
             
             $payment_advice_detailsble->save($paymentAdviceDetails);
            
             
            }
            
            
            $msg = "Success|The payment advice has been saved.";
        }
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

    public function getadvice(){
        
        if ($this->request->is('post')) {
            
            $po_id = $this->request->data['po_id'];
            $table = TableRegistry::get('payment_advice');
            $payment_advice =  $table->find('all')->hydrate(false)
                    ->join([
                            [   'table' => 'users',
                                'alias' => 'users',
                                'type' => 'INNER',
                                'conditions' => 'users.id = payment_advice.created_by'
                            ]
                        ]);
            $payment_advice->select(['user'=>'users.full_name']);
            $payment_advice->select(['status','id_payment_advice','invoice_number','ad_date'=>'date_format(payment_advice.advice_date,"%d-%m-%Y %H:%i")']);
            $payment_advice->where(['po_id'=> $po_id ]);
            $payment_advice->andwhere(['status' => 'Active' ]);
            $res = $payment_advice->ToArray();
            
            $data = array(); //declare our new array for returning to datatable

            foreach ($res as $dat) {
                
                $actions = array('actions' => "<button onclick='javascript:printAdvice(" . $dat['id_payment_advice'] . ")' class='btn btn-sm btn-warning'><i class='fa fa-print'></i></button> <button onclick='javascript:deleteAdvice(" . $dat['id_payment_advice'] . ")' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button>");
                array_push($data, array_merge($dat,$actions));
            }
            
            $this->set(compact('data'));
            $this->set('_serialize', ['data']);
        
        }
        
    
    }
    public function getpaymentadvicebysearch(){
        
            $payment_adviceTbl = TableRegistry::get('payment_advice');
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
                $orderby = 'id_account_voucher';
                $orderdir = 'asc';
            }
           
           $query = $payment_adviceTbl->find();
           
          if (isset($this->request->data['status'])){ 
              
            $id_payment_advice =  $this->request->data['paymentadvice_id'];
            $po_id             =  $this->request->data['po_id'];
            $from              =  $this->request->data['date_from'];
            $to                =  $this->request->data['date_to'];
            $invoice_number    =  $this->request->data['invoice_no'];
            
            $query->select(['status','id_payment_advice','po_number','status','invoice_number','date'=>'date_format(payment_advice.advice_date,"%d-%m-%Y %H:%i")']);
            $query->where(['id_payment_advice >' =>0]);
            $query->andwhere(['status'=> 'Active']);
            $query->orwhere(['status'=> 'Created']);

                if (!empty($id_payment_advice)) {
                    $query->andwhere(['id_payment_advice' => $voucher_id ]);
                }
                if (!empty($po_id)) {
                    $query->andwhere(['po_id' => $po_id]);
                }
                if (!empty($from) && !empty($to)) {
                    $query->andwhere(['payment_advice.advice_date >=' => date("Y-m-d H:i:s", strtotime($from)), 'payment_advice.advice_date <=' => date("Y-m-d H:i:s", strtotime($to))]);
                }
                
                if (!empty($invoice_number)) {
                    $query->andwhere(['invoice_number LIKE' => '%'.$invoice_number.'%']);
                }
                
                $query->order([$orderby => $orderdir]);
                if($length>-1){
                    $query->limit($length);
                }
                if($start>0){
                    $query->offset($start);

                }
         
            
        } else {
                 $query = $payment_adviceTbl->find();
                 $query->select(['id_payment_advice','po_number','status','invoice_number','date'=>'date_format(payment_advice.advice_date,"%d-%m-%Y %H:%i")']);
                 $query->where(['id_payment_advice >' =>0]);
                 $query->andwhere(['status'=> 'Active']);
                 $query->orwhere(['status'=> 'Created']);
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
            $accounts = array(); //  new array for concating accounts
            $debit = array();
            $credit = array();
            
            foreach ($res as $dat) {
                if($dat['status'] ==='Created'){
                    $actions = array('actions' => "<button onclick='javascript:openadvice(" . $dat['id_payment_advice'] . ")' class='btn btn-sm amber-500'>Open</button><button onclick='javascript:alreadycreated(" . $dat['id_payment_advice'] . ")' title='The Voucher Already Created.' class='btn btn-sm green-500' disabled>Voucher Created</button>");
                }else{
                    $actions = array('actions' => "<button onclick='javascript:openadvice(" . $dat['id_payment_advice'] . ")' class='btn btn-sm amber-500'>Open</button><button onclick='javascript:deleteAdvice(" . $dat['id_payment_advice'] . ")' class='btn btn-sm red-500'>Delete</button><button onclick='javascript:createvoucher(" . $dat['id_payment_advice'] . ")' class='btn btn-sm blue-500'>Create Voucher</button>");
                }
                array_push($data, array_merge($dat,$actions));
            }
           
            $recordsTotal = $total;
            $recordsFiltered = $total;
            $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
            $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
        
        }
    
    
    
}
