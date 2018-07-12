<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * TransactionAccount Controller
 *
 * @property \App\Model\Table\TransactionAccountTable $TransactionAccount
 */
class TransactionAccountController extends AppController
{

    public function index()
    {
        
        $sub_control_account_id  = $this->request->params['pass'][0];
        $control_account_id  = $this->request->query('control_account_id');
        $main_account_id  = $this->request->query('main_account_id');
        
        $maincontrol_accountTbl = TableRegistry::get('main_account');
        $main_account =$maincontrol_accountTbl->find('all');
        $main_account->where(['id_main_account'=>$main_account_id]);
        $main_account = $main_account->ToArray();
        
        
        $sub_control_accountTbl = TableRegistry::get('sub_control_account');
        $sub_control_account = $sub_control_accountTbl->find('all');
        $sub_control_account->where(['id_sub_control_account'=>$sub_control_account_id]);
        $sub_control_account = $sub_control_account->ToArray();
        
        $control_accountTbl = TableRegistry::get('control_account');
        $control_account = $control_accountTbl->find('all');
        $control_account->where(['id_control_account'=>$control_account_id]);
        $control_account = $control_account->ToArray();
        
        
        
        $transactionAccountTbl = TableRegistry::get('transaction_account');
        $transactionAccount = $transactionAccountTbl->find()->contain(['users' => function ($q) {
        return $q
            ->select(['created_by'=>'full_name','id']);
            }
           ]); 
        $control_account_created = $transactionAccount->func()->date_format([
                    'transaction_account_createdon' => 'identifier',
                    "'%d-%m-%Y %H:%i'" => 'literal'
                ]);
        $transactionAccount->select(['id_transaction_account','transaction_account_number','transaction_account_name','sub_control_account_id','transaction_account_createdby','transaction_account_date'=>$control_account_created]);
        $transactionAccount->where(['sub_control_account_id' => $sub_control_account_id]);
        
        $this->set(compact('transactionAccount','sub_control_account','control_account','sub_control_account_id','subcontrol_account_name','main_account'));
        $this->set('_serialize', ['transactionAccount']);
        
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];
        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'view','delete'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
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
       
        $account  =  array();
        $maincontrol_accountTbl = TableRegistry::get('main_account');
        $main_account =$maincontrol_accountTbl->find('all');
        //$main_account->where(['id_main_account'=>$main_account_id]);
        $main_account = $main_account->ToArray();
        
        foreach($main_account as $main_account){
            $account['FNo'][] = $main_account->main_account_number;
            $account['FName'][] = $main_account->main_account_name;
        }
        
        $control_accountTbl = TableRegistry::get('control_account');
        $control_account = $control_accountTbl->find('all');
        //$sub_control_account->where(['id_sub_control_account'=>$sub_control_account_id]);
        $control_account = $control_account->ToArray();
        
        foreach($control_account as $control_account){
            $account['SNo'][] = $control_account->control_account_number;
            $account['SName'][] = $control_account->control_account_name;
        }
        
        $sub_control_accountTbl = TableRegistry::get('sub_control_account');
        $sub_control_account = $sub_control_accountTbl->find('all');
      //  $sub_control_account->where(['id_sub_control_account'=>$sub_control_account_id]);
        $sub_control_account = $sub_control_account->ToArray();
        
        foreach($sub_control_account as $sub_control_account){
            $account['TNo'][] = $sub_control_account->sub_control_account_number;
            $account['TName'][] = $sub_control_account->sub_control_account_name;
        }
        
        
        
        $transaction_accountTbl = TableRegistry::get('transaction_account');
        $transaction_account = $transaction_accountTbl->find('all');
      //  $transaction_account->where(['id_main_account'=>$main_account_id]);
        $transaction_account = $transaction_account->ToArray();
        
        foreach($transaction_account as $transaction_account){
            $account['FRNo'][] = $transaction_account->transaction_account_number;
            $account['FRName'][] = $transaction_account->transaction_account_name;
        }
        
        $this->set(compact('transaction_account','account'));
        $this->set('_serialize', ['transaction_account']);
        
        
        
        
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transactionAccount = $this->TransactionAccount->newEntity();
        $transControlAccountTbl = TableRegistry::get('transaction_account');
        if ($this->request->is('post')) {
            
            
            $query = $transControlAccountTbl->find();
            $query->select(['lastID'=> 'max(transaction_account.id_transaction_account)']);
            $last_ID = $query->first();
            $last_no = $last_ID->lastID + 1;
            if($last_no >= 1 &&  $last_no <= 9){
                 $transcontrol_account_no = "000".$last_no;
            }elseif($last_no >= 10 && $last_no <= 99){
                $transcontrol_account_no = "00".$last_no;
            } elseif($last_no >= 100 && $last_no <= 999){
                $transcontrol_account_no = "0".$last_no;
            }else{
                $transcontrol_account_no = $last_no;
            }
                        
            $transactionAccount = $this->TransactionAccount->patchEntity($transactionAccount, $this->request->data);
            $transactionAccount->transaction_account_number = $transcontrol_account_no;
            $transactionAccount->sub_control_account_id = $this->request->data['transaction_ID'];
            $transactionAccount->transaction_account_name = $this->request->data['trans_acc_name'];
            $transactionAccount->transaction_account_createdby = $this->request->session()->read('Auth.User.id');
            
            if ($this->TransactionAccount->save($transactionAccount)) {
                $msg = "Success|The transaction account has been saved";
            } else {
               $msg = "Error|The transaction account not saved.Please, try again.";
            }
        }
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

    
    
    
    
    public function edit($id = null)
    {
         $id =  $this->request->data['sub_acc_id'];
        $transactionAccount = $this->TransactionAccount->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transactionAccount = $this->TransactionAccount->patchEntity($transactionAccount, $this->request->data);
            
            $transactionAccount->transaction_account_number = $this->request->data['controlaccountid'];
            $transactionAccount->transaction_account_name = $this->request->data['sub_acc_name'];
            
            
            if ($this->TransactionAccount->save($transactionAccount)) {
               $msg = "Success|The transaction account has been saved";
            } else {
               $msg = "Error|The transaction account not saved.Please, try again.";
            }
        }
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction Account id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $id = $this->request->data['id'];
        $this->request->allowMethod(['post', 'delete']);
        $transactionAccount = $this->TransactionAccount->get($id);
        if ($this->TransactionAccount->delete($transactionAccount)) {
            $msg = 'Success|The transaction account has been deleted.';
        } else {
            $msg = 'Success|The transaction account could not be deleted. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
}
