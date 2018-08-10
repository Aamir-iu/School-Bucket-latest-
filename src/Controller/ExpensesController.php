<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Expanses Controller
 *
 * @property \App\Model\Table\ExpansesTable $Expanses
 */
class ExpensesController extends AppController
{

    public function index()
    {
        $dat = date("Y-d-m");
        $expansesTbl = TableRegistry::get('expanses');
        $query    =  $expansesTbl->find()->contain([
                'Users' => function ($q) {
                    return $q
                        ->select(['user_name'=>'Users.full_name']);
                        }
                    ]);
                   
        
        $query->select(['voucher_number','exp_date'=>'date_format(expanses.created_on,"%d-%m-%Y %H:%i")']);
        $query->select(['expanse_desc']);
        $query->select(['amount' => $query->func()->sum('amount')]);
        $query->group('voucher_number');
        $query->orderDesc('voucher_number');
       // $query->where(['expanse_date'=>date("Y-d-m H:i:s", strtotime($dat))]);
        $query->orderAsc('voucher_number');
        $expanses = $query->ToArray();
        
        $transaction_accountTbl = TableRegistry::get('transaction_account');
        $query = $transaction_accountTbl->find()
            ->join([
                   [   'table' => 'sub_control_account',
                    'alias' => 'subaccount',
                    'type' => 'INNER',
                    'conditions' => 'transaction_account.sub_control_account_id = subaccount.id_sub_control_account'
                    ],
                    [   'table' => 'control_account',
                        'alias' => 'controlaccount',
                        'type' => 'INNER',
                        'conditions' => 'subaccount.control_account_id = controlaccount.id_control_account'
                    ],
                    [   'table' => 'main_account',
                        'alias' => 'mainaccount',
                        'type' => 'INNER',
                        'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                    ]
            ]);
        
            $query->select(['id_transaction_account','transaction_account_number','transaction_account_name']); 
            $query->select(['sca'=>'subaccount.sub_control_account_number']);
            $query->select(['ca'=>'controlaccount.control_account_number']);
            $query->select(['ma'=>'mainaccount.main_account_number']);
            $query->select(['ta'=>'transaction_account.transaction_account_number']);
            $query->select(['ta_name'=>'transaction_account.transaction_account_name']);
            
            $transaction_account  = $query->ToArray();
            $this->set(compact('transaction_account','expanses'));
        
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'delete', 'view','getdetails','expansereport'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
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
        $flag = $this->request->params['pass'][0] ;
        if($flag==1){ 
           
            $voucher_no = $this->request->params['pass'][1];
            $expansestbl = TableRegistry::get('expanses');
            $query = $expansestbl->find('all')->contain(['Users']);
            $query->where(['voucher_number ='=> $voucher_no]);
            $query->hydrate(false);
            $data = $query->ToArray();
            $this->set(compact('data'));
            $this->set('_serialize', ['data']);
        }
         if($flag==2){
            
            $from = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][1]));
            $to = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][2]));
            if(isset($this->request->params['pass'][3])){
                $ac = $this->request->params['pass'][3];
            }
          
           $tag = $this->request->params['pass'][4];
           $shift_id = $this->request->params['pass'][5];
           $shift_name = $this->request->params['pass'][6];
           
            
            $expansestbl = TableRegistry::get('expanses');
                    $query = $expansestbl->find()
                    ->join([
                            [   'table' => 'transaction_account',
                                'alias' => 'ta',
                                'type' => 'INNER',
                                'conditions' => 'expanses.transaction_account_id = ta.id_transaction_account '
                             ],
                            [   'table' => 'sub_control_account',
                                'alias' => 'subaccount',
                                'type' => 'INNER',
                                'conditions' => 'ta.sub_control_account_id = subaccount.id_sub_control_account'
                             ],
                             [   'table' => 'control_account',
                                 'alias' => 'controlaccount',
                                 'type' => 'INNER',
                                 'conditions' => 'subaccount.control_account_id = controlaccount.id_control_account'
                             ],
                             [   'table' => 'main_account',
                                 'alias' => 'mainaccount',
                                 'type' => 'INNER',
                                 'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                             ]
                ]);

            $query->select(['ta'=>'ta.id_transaction_account','ta_no'=>'ta.transaction_account_number','ta_name'=>'ta.transaction_account_name']); 
            $query->select(['sca'=>'subaccount.sub_control_account_number']);
            $query->select(['ca'=>'controlaccount.control_account_number']);
            $query->select(['ma'=>'mainaccount.main_account_number','shift_id']);
            $query->select(['amount' => $query->func()->sum('amount'),'expanse_desc']);
            
            if($tag == 2){
                $query->group('transaction_account_id');
            }
            $query->where(['expanse_date >='=> $from ,'expanse_date <='=>$to]);
            
            if($shift_id > 0){
               $query->andwhere(['shift_id'=>$shift_id]);
            }
            
            if(!empty($ac)){
                $query->andwhere(['transaction_account_id >='=> $ac]);
            }
            
            $query->hydrate(false);
            $data = $query->ToArray();
              
         
            $this->set(compact('data','from','to','tag','shift_name'));
            $this ->render('exapnse_report');  
             
         }
        
    }

   
    public function add()
    {
       
        $exp = TableRegistry::get('expanses');
        $query = $exp->find();
        $query->select(['lastID'=> 'max(expanses.id_expanses)']);
        $last_ID = $query->first();
         if($last_ID->lastID>0){
            $VN = $last_ID->lastID + 1;
            $voucher_number = $VN.date('y').date('m');
        }else{
            $VN = $last_ID->lastID + 1;
            $voucher_number = $VN.date('y').date('m');
        }
       
        if ($this->request->is('post')) {
            $mData = [];
            $mData = $this->request->data['data'];
            foreach($mData as $row){
                $expanse = $exp->newEntity();
                $expanse->voucher_number = $voucher_number;
                $expanse->transaction_account_id = $row['tca'];
                $expanse->expanse_desc = $row['expanse_desc'];
                $expanse->amount = $row['amount'];
                $expanse->shift_id = $row['shift_id'];
                $expanse->expanse_date = date("Y-m-d H:i:s", strtotime($row['expanse_date'])); 
                $expanse->created_by = $this->request->session()->read('Auth.User.id'); 
                $this->Expanses->save($expanse);
              
                
            }
           
            $msg ='Success|The transaction has been saved.';
        }
        
        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

  
    public function edit($id = null)
    {
        $expanse = $this->Expanses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expanse = $this->Expanses->patchEntity($expanse, $this->request->data);
            if ($this->Expanses->save($expanse)) {
                $this->Flash->success(__('The expanse has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The expanse could not be saved. Please, try again.'));
            }
        }
        $transactionAccounts = $this->Expanses->TransactionAccounts->find('list', ['limit' => 200]);
        $this->set(compact('expanse', 'transactionAccounts'));
        $this->set('_serialize', ['expanse']);
    }

   
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $expanse = $this->Expanses->get($id);
        if ($this->Expanses->delete($expanse)) {
            $msg = 'Success|The expanse has been deleted.';
        } else {
            $msg = 'Success|The expanse could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
    public function getdetails(){
        
        $voucher_no = $this->request->data['vo'];
        $expansestbl = TableRegistry::get('expanses');
        $query = $expansestbl->find('all');
        $query->where(['voucher_number ='=> $voucher_no]);
        $query->hydrate(false);
        $data = $query->ToArray();
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }
    
    public function expansereport(){
        
        $transaction_accountTbl = TableRegistry::get('transaction_account');
        $query = $transaction_accountTbl->find()
            ->join([
                   [   'table' => 'sub_control_account',
                    'alias' => 'subaccount',
                    'type' => 'INNER',
                    'conditions' => 'transaction_account.sub_control_account_id = subaccount.id_sub_control_account'
                    ],
                    [   'table' => 'control_account',
                        'alias' => 'controlaccount',
                        'type' => 'INNER',
                        'conditions' => 'subaccount.control_account_id = controlaccount.id_control_account'
                    ],
                    [   'table' => 'main_account',
                        'alias' => 'mainaccount',
                        'type' => 'INNER',
                        'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                    ]
            ]);
        
        $query->select(['id_transaction_account','transaction_account_number','transaction_account_name']); 
        $query->select(['sca'=>'subaccount.sub_control_account_number']);
        $query->select(['ca'=>'controlaccount.control_account_number']);
        $query->select(['ma'=>'mainaccount.main_account_number']);
        $transaction_account  = $query->ToArray();
       
        
        $this->set(compact('transaction_account'));
        $this->set('_serialize', ['transaction_account']);
    }
    
}
