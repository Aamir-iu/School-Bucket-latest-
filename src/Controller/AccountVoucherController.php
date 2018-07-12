<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Number;
use Cake\Datasource\ConnectionManager;

class AccountVoucherController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        
     }
    public function index(){
        $subcontrolaccountTbl = TableRegistry::get('sub_control_account');
        $query = $subcontrolaccountTbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'control_account',
                                'alias' => 'controlaccount',
                                'type' => 'INNER',
                                'conditions' => 'sub_control_account.control_account_id = controlaccount.id_control_account'
                            ],
                            [   'table' => 'main_account',
                                'alias' => 'mainaccount',
                                'type' => 'INNER',
                                'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                            ]
                        ]);
        $query->select(['id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sub_control_account.sub_control_account_number','subaccountname'=>'sub_control_account.sub_control_account_Name']);
        $accounts = $query->toArray();           
        $this->set(compact('accounts'));
      
    }
    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add','getbanks','printaccounts',
            'getgeneralledgerdetails', 'view','getvoucherbysearch','cancelvoucher',
            'openvoucher','trialbalance','gettrialblance','getcentertype',
            'printchartofaccounts','getbusinesstype','generalledger','financialstatements'
            ,'profitandloss','balancesheet','storepl','updatevoucherstatus','verifyvoucher','voucheredit','edit', 'microbiologyform',
            'cytologyform', 'histopathologyform'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }
    public function openvoucher(){
   
        $Vid = $this->request->pass[0];
        $account_voucherTbl = TableRegistry::get('account_voucher');
        $query = $account_voucherTbl->find()->hydrate(false)
                    ->join([
                    [   'table' => 'account_voucher_details',
                        'alias' => 'voucherdetails',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.account_voucher_id = account_voucher.id_account_voucher',
                    ]
                    ,
                    [   'table' => 'account_voucher_type',
                        'alias' => 'accountvouchertype',
                        'type' => 'INNER',
                        'conditions' => 'accountvouchertype.id_account_voucher_type = account_voucher.account_voucher_type_id',
                    ]
                    ,
                    [   'table' => 'transaction_account',
                        'alias' => 'transactionaccount',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.transaction_account_id = transactionaccount.id_transaction_account'
                    ]
                    ,
                    [   'table' => 'sub_control_account',
                        'alias' => 'subaccount',
                        'type' => 'INNER',
                        'conditions' => 'transactionaccount.sub_control_account_id = subaccount.id_sub_control_account'
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

         $query->select(['center_name'=>'voucherdetails.cost_center_name','center_type'=>'voucherdetails.cost_center_type','description','id_account_voucher','voucher_number','voucher_date_created'=>'date_format(account_voucher.created_on,"%d-%m-%Y %H:%i")','voucher_status','paymentmode'=>'voucherdetails.payment_mode']);
         $query->select(['credit'=>'voucherdetails.credit','debit'=>'voucherdetails.debit','type'=>'voucherdetails.transaction_type','trans_account_no'=>'transactionaccount.transaction_account_number','trans_account_title'=>'transactionaccount.transaction_account_name','sub_account_no'=>'subaccount.sub_control_account_number','control_account_no'=>'controlaccount.control_account_number','main_account_no'=>'mainaccount.main_account_number']);
         $query->select(['remakrs'=>'voucherdetails.remarks','instrument_no'=>'voucherdetails.instrument_no','vouchertype'=>'accountvouchertype.account_voucher_type']);
         $query->select(['bp_name']);
         $query->select(['voucher_dated'=>'date_format(account_voucher.voucher_date,"%d-%m-%Y %H:%i")']);
         $query->where(['id_account_voucher ' => $Vid]);
       
         $accountvoucher = $query->toArray();
        
         $this->set(compact('accountvoucher'));
        
        
       }
    public function view($id = null,$flag = null) {
        
        $Vid = $this->request->pass[0];
        $flag = $this->request->pass[1];
       
        if($flag==1){ //voucher  report
        $account_voucherTbl = TableRegistry::get('account_voucher');
        $query = $account_voucherTbl->find()->hydrate(false)
                    ->join([
                    [   'table' => 'account_voucher_details',
                        'alias' => 'voucherdetails',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.account_voucher_id = account_voucher.id_account_voucher',
                    ],
                    [   'table' => 'account_voucher_type',
                        'alias' => 'accountvouchertype',
                        'type' => 'INNER',
                        'conditions' => 'accountvouchertype.id_account_voucher_type = account_voucher.account_voucher_type_id',
                    ],
                    [   'table' => 'transaction_account',
                        'alias' => 'transactionaccount',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.transaction_account_id = transactionaccount.id_transaction_account'
                    ],
                    [   'table' => 'sub_control_account',
                        'alias' => 'subaccount',
                        'type' => 'INNER',
                        'conditions' => 'transactionaccount.sub_control_account_id = subaccount.id_sub_control_account'
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
                    ],
                    [   'table' => 'users',
                        'alias' => 'users',
                        'type' => 'INNER',
                        'conditions' => 'users.id = account_voucher.created_by'
                    ]

                ]);

                $query->select(['center_name'=>'voucherdetails.cost_center_name','center_type'=>'voucherdetails.cost_center_type','description','id_account_voucher','voucher_number','voucher_date_created'=>'date_format(account_voucher.created_on,"%d-%m-%Y %H:%i")','voucher_status','paymentmode'=>'voucherdetails.payment_mode']);
                $query->select(['credit'=>'voucherdetails.credit','debit'=>'voucherdetails.debit','type'=>'voucherdetails.transaction_type','trans_account_no'=>'transactionaccount.transaction_account_number','trans_account_title'=>'transactionaccount.transaction_account_name','sub_account_no'=>'subaccount.sub_control_account_number','control_account_no'=>'controlaccount.control_account_number','main_account_no'=>'mainaccount.main_account_number']);
                $query->select(['remakrs'=>'voucherdetails.remarks','instrument_no'=>'voucherdetails.instrument_no','vouchertype'=>'accountvouchertype.account_voucher_type']);
                $query->select(['bp_name','full_name'=>'users.full_name']);
                $query->select(['voucher_dated'=>'date_format(account_voucher.voucher_date,"%d-%m-%Y %H:%i")']);
                $query->where(['id_account_voucher ' => $Vid]);
                $accountvoucher = $query->toArray();
                $this->set(compact('accountvoucher'));
                
        }
        if($flag==2){ /// chart of accounts report
             
            $data = array();
            $masteraccountTbl = TableRegistry::get('main_account');
            $master_account = $masteraccountTbl->find('all');
                $master_accounts = $master_account->toArray();
                foreach($master_accounts as $master_account){
                   $controlaccountTbl = TableRegistry::get('control_account');
                   $control_account = $controlaccountTbl->find('all');
                   $control_account->where(['main_account_id' => $master_account->id_main_account]);
                   $control_accounts = $control_account->toArray();
                         $subcontrolaccountTbl = TableRegistry::get('sub_control_account');
                            foreach($control_accounts as $ca){
                                $subcontrol_account = $subcontrolaccountTbl->find('all');
                                $subcontrol_account->where(['control_account_id' => $ca->id_control_account]);
                                $subcontrol_accounts = $subcontrol_account->toArray();
                                $taTbl = TableRegistry::get('transaction_account');
                                    foreach($subcontrol_accounts as $sca){
                                        $ta = $taTbl->find('all')
                                                ->join([
                                                    [   'table' => 'users',
                                                        'alias' => 'users',
                                                        'type' => 'INNER',
                                                        'conditions' => 'users.id = transaction_account.transaction_account_createdby'
                                                    ]
                                                ]);
                                    $ta->select(['transaction_account_name','created_on'=>'date_format(transaction_account.transaction_account_createdon,"%d-%m-%Y %H:%i")','full_name'=>'users.full_name']);
                                    $ta->where(['sub_control_account_id' => $sca->id_sub_control_account]);
                                        $ta->where(['sub_control_account_id' => $sca->id_sub_control_account]);
                                        $ta = $ta->toArray();
                                        foreach($ta as $ta){
                                            $data[$master_account->main_account_name][$ca->control_account_name][ $sca->sub_control_account_name][] = $ta->transaction_account_name . "|".$ta->created_on."|".$ta->full_name;
                                        }
                                    }
                            }
                }
            $this->set(compact('data'));    
            $this ->render('printchartofaccounts');
        }
        if($flag==3){ /// trial balance report
            if(isset($this->request->params['pass'][0])){
                $from = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][2]));
            }
            if(isset($this->request->params['pass'][1])){
                $to = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][3]));
            }
            if($this->request->params['pass'][4] > 0){
                $sub_account_from = $this->request->params['pass'][4];
            }
            if($this->request->params['pass'][5] >0 ){
                $sub_account_to = $this->request->params['pass'][5];
            }
           
          
            $data = array();
            $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
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
            $query->select(['id_transaction_account','transaction_account_number','transaction_account_name','sub_control_account_id']); 
            $query->select(['sca'=>'subaccount.sub_control_account_number']);
            $query->select(['ca'=>'controlaccount.control_account_number']);
            $query->select(['ma'=>'mainaccount.main_account_number']);

            $query->group('id_transaction_account');
            $query->order('id_transaction_account');

            if (!empty($sub_account_from)) {
                $query->where(['id_transaction_account >=' => $sub_account_from, 'id_transaction_account <='=>$sub_account_to]);
             }
                 
            $query->hydrate(false);
            $data = array();
            $AC = $query->ToArray();
            $conn = ConnectionManager::get('default');
            foreach($AC as $account){
            $trans_ac_id = $account['id_transaction_account'];
                    
                $stmt = $conn->execute("SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account, id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(debit)-sum(credit),0)>=0 Then replace(ifnull(sum(debit)-sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)<0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(debit)-sum(credit),0)<0 Then replace(ifnull(sum(debit)- sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)>=0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted'		
                and ma.main_account_name in ('Assets', 'Expenses') and avd.voucher_detail_date < '$from'
                and  id_transaction_account = '$trans_ac_id' 
                group by id_transaction_account,transaction_account_name

                union
                SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account,id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(credit)-sum(debit),0)<0 Then replace(ifnull(sum(credit)- sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)>=0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(credit)-sum(debit),0)>=0 Then replace(ifnull(sum(credit)-sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)<0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted'		
                and ma.main_account_name in ('Liabilities', 'Capital','Revenue') and avd.voucher_detail_date < '$from'
                and  id_transaction_account = '$trans_ac_id'   
                group by id_transaction_account,transaction_account_name ");
                $rs = $stmt ->fetchAll('assoc');
                $odebit = 0;
                $ocredit = 0;
                if(!empty($rs)){
                    $odebit = $rs[0]['odebit'];
                    $ocredit = $rs[0]['ocredit'];
                }else{
                    $odebit = 0;
                    $ocredit = 0;
                }
                
                
                $stmts = $conn->execute("SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account, id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(debit)-sum(credit),0)>=0 Then replace(ifnull(sum(debit)-sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)<0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(debit)-sum(credit),0)<0 Then replace(ifnull(sum(debit)- sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)>=0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted' and avd.voucher_detail_date >= '$from' and avd.voucher_detail_date <= '$to'	
                and ma.main_account_name in ('Assets', 'Expenses') 
                and  id_transaction_account = '$trans_ac_id' 
                group by id_transaction_account,transaction_account_name

                union
                SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account,id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(credit)-sum(debit),0)<0 Then replace(ifnull(sum(credit)- sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)>=0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(credit)-sum(debit),0)>=0 Then replace(ifnull(sum(credit)-sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)<0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted' and avd.voucher_detail_date >= '$from' and avd.voucher_detail_date <= '$to'		
                and ma.main_account_name in ('Liabilities', 'Capital','Revenue') 
                and  id_transaction_account = '$trans_ac_id'   
                group by id_transaction_account,transaction_account_name ");
                $res = $stmts ->fetchAll('assoc');
                $cdebit = 0;
                $ccredit = 0;
             
                if(!empty($res)){
                    $cdebit = $res[0]['odebit'];
                    $ccredit = $res[0]['ocredit'];
                  
                }else{
                    $cdebit = 0;
                    $ccredit = 0;
                }
              
                /// geting opening balance 
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['ODEBIT'] = $odebit;
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['OCREDIT'] = $ocredit;
                
                
                /// geting opening balance 
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['CDEBIT'] = $cdebit;
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['CCREDIT'] = $ccredit;
                
            }
            
            $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
                        ->join([
                                [   'table' => 'sub_control_account',
                                    'alias' => 'sca',
                                    'type' => 'INNER',
                                    'conditions' => 'sca.id_sub_control_account = transaction_account.sub_control_account_id'
                                ],
                                [   'table' => 'control_account',
                                    'alias' => 'controlaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.id_control_account = sca.control_account_id'
                                ],
                                [   'table' => 'main_account',
                                    'alias' => 'mainaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                ]
                            ]);
            $query->select(['sca_id'=>'id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sca.sub_control_account_number','subaccountname'=>'sca.sub_control_account_Name']);
            $query->select(['ta_no'=>'transaction_account_number','ta_title'=>'transaction_account_name']);
            $query->select(['transaction_account_id'=>'id_transaction_account']);
            $accounts = $query->toArray();           
            $cost_center_typeTbl = TableRegistry::get('cost_center_type');
            $cost_center_type = $cost_center_typeTbl->find();
           
            $this->set(compact('cost_center_type','accounts','data','from','to', 'sub_account_from', 'sub_account_to'));
            $this->set('_serialize', ['data']);
            $this ->render('report_trial_balance');
            
        }
        if($flag==4){ /// profit and loss report
         $conn = ConnectionManager::get('default');
         $from               = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][2]));
         $to                 = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][3]));
         $head = ['Revenue','Expenses'];  // $head = ['Revenue','Expenses'];
         $data = array();
         foreach($head as $account_names){
                            $sqlquery = "select control_account_name
                            from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' 
                            group by  ca.control_account_name order by control_account_number asc ";
                            $stmt = $conn->execute($sqlquery);
                            $rs = $stmt ->fetchAll('assoc');
                foreach($rs as $rows){
                     foreach($rows as $row){
                            $sql = "select sub_control_account_name from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and  ca.control_account_name = '$row'
                            group by  ca.control_account_name,sub_control_account_name";
                            $stmt2 = $conn->execute($sql);
                            $res = $stmt2 ->fetchAll('assoc');
                        foreach($res as $subaccountname){
                            foreach($subaccountname as $acname){
                            if($account_names=='Revenue'){
                            $sql = "select ifnull(sum(Credit),0)-ifnull(sum(Debit),0) as amount,add_sub ";
                           //  $sql = "select ifnull(sum(Credit),0) as amount,add_sub ";   
                                }else{
                            $sql = "select ifnull(sum(Debit),0)-ifnull(sum(Credit),0) as amount,add_sub "; 
                           // $sql = "select ifnull(sum(Debit),0) as amount,add_sub "; 
                            }
                            $sql .= "from account_voucher_details  as avd 
                            join account_voucher as av on av.id_account_voucher = avd.account_voucher_id    
                            join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and ca.control_account_name ='$row' and sca.sub_control_account_name = '$acname' 
                            and avd.voucher_detail_date >= '$from' and  avd.voucher_detail_date <= '$to' and av.voucher_status = 'Posted'
                            group by  ma.main_account_name,control_account_name,ca.control_account_name,sca.sub_control_account_name";
                            
                            $stmt3 = $conn->execute($sql);
                            $trs = $stmt3 ->fetchAll('assoc');
                             if($trs){   
                                foreach($trs as $amount){

                                 $data[$account_names][$row][$acname][] =  $amount['amount']. "|".$amount['add_sub']; 

                                }
                             }else{
                                 $data[$account_names][$row][$acname][] =  "0|Add";  
                             }   
                        }
                     }
                }
         }
       }
      
       
           $subcontrolaccountTbl = TableRegistry::get('sub_control_account');
           $query = $subcontrolaccountTbl->find()->hydrate(false)
                           ->join([
                                   [   'table' => 'control_account',
                                       'alias' => 'controlaccount',
                                       'type' => 'INNER',
                                       'conditions' => 'sub_control_account.control_account_id = controlaccount.id_control_account'
                                   ],
                                   [   'table' => 'main_account',
                                       'alias' => 'mainaccount',
                                       'type' => 'INNER',
                                       'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                   ]
                               ]);
            $query->select(['id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sub_control_account.sub_control_account_number','subaccountname'=>'sub_control_account.sub_control_account_Name']);
            $accounts = $query->toArray();           
            $cost_center_typeTbl = TableRegistry::get('cost_center_type');
            $cost_center_type = $cost_center_typeTbl->find();
            
            $this->set(compact('accounts','cost_center_type','data','from','to'));
            $this ->render('report_profit_loss');   
            
        }
        if($flag==5){ /// balance sheet report
             
         $conn = ConnectionManager::get('default');
         $from = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][2]));
         $to   = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][3]));
         $head = ['Assets'];  // $head = ['Revenue','Expenses'];
         foreach($head as $account_names){
                            $sqlquery = "select control_account_name
                            from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names'
                            group by  ca.control_account_name order by control_account_number asc";
                            $stmt = $conn->execute($sqlquery);
                            $rs = $stmt ->fetchAll('assoc');
                foreach($rs as $rows){
                     foreach($rows as $row){
                            $sql = "select sub_control_account_name from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and  ca.control_account_name = '$row'
                            group by  ca.control_account_name,sub_control_account_name   order by sca.orders asc";
                            $stmt2 = $conn->execute($sql);
                            $res = $stmt2 ->fetchAll('assoc');
                        foreach($res as $subaccountname){
                            foreach($subaccountname as $acname){
                            $sql = "select ifnull(sum(Debit),0)-ifnull(sum(Credit),0) as amount,add_sub "; 
                            $sql .= "from account_voucher_details  as avd 
                            join account_voucher as av on av.id_account_voucher = avd.account_voucher_id    
                            join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and ca.control_account_name ='$row' and sca.sub_control_account_name = '$acname' 
                            and avd.voucher_detail_date >= '$from' and  avd.voucher_detail_date <= '$to' and av.voucher_status =  'Posted'
                            group by  ma.main_account_name,control_account_name,ca.control_account_name,sca.sub_control_account_name";
                            
                            $stmt3 = $conn->execute($sql);
                            $trs = $stmt3 ->fetchAll('assoc');
                             if($trs){   
                                foreach($trs as $amount){

                                 $Assets[$row][$acname][] =  $amount['amount']. "|".$amount['add_sub']; 

                                }
                             }else{
                                 $Assets[$row][$acname][] =  "0|Add";  
                             }   
                        }
                     }
                }
         }
       }
        // end assets 
         $head = ['Liabilities','Capital'];  // $head = ['Revenue','Expenses'];
         $Equities = array();
         foreach($head as $account_names){
                            $sqlquery = "select control_account_name
                            from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' 
                            group by  ca.control_account_name ";
                            $stmt = $conn->execute($sqlquery);
                            $rs = $stmt ->fetchAll('assoc');
                foreach($rs as $rows){
                     foreach($rows as $row){
                            $sql = "select sub_control_account_name from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and  ca.control_account_name = '$row'
                            group by  ca.control_account_name,sub_control_account_name";
                            $stmt2 = $conn->execute($sql);
                            $res = $stmt2 ->fetchAll('assoc');
                        foreach($res as $subaccountname){
                            foreach($subaccountname as $acname){
                            if($account_names === 'Liabilities'){
                            $sql = "select ifnull(sum(Credit),0)-ifnull(sum(Debit),0) as amount,add_sub ";
                                }else{
                            $sql = "select ifnull(sum(Credit),0)-ifnull(sum(Debit),0) as amount,add_sub "; 
                            }
                            $sql .= "from account_voucher_details  as avd 
                            join account_voucher as av on av.id_account_voucher = avd.account_voucher_id       
                            join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and ca.control_account_name ='$row' and sca.sub_control_account_name = '$acname' 
                            and avd.voucher_detail_date >= '$from' and  avd.voucher_detail_date <= '$to' and av.voucher_status = 'Posted'
                            group by  ma.main_account_name,control_account_name,ca.control_account_name,sca.sub_control_account_name";
                            
                            $stmt3 = $conn->execute($sql);
                            $trs = $stmt3 ->fetchAll('assoc');
                             if($trs){   
                                foreach($trs as $amount){

                                 $Equities[$account_names][$row][$acname][] =  $amount['amount']. "|".$amount['add_sub']; 

                                }
                             }else{
                                 $Equities[$account_names][$row][$acname][] =  "0|Add";  
                             }   
                        }
                     }
                }
         }
       }
          $transaction_accountTbl = TableRegistry::get('transaction_account');
          $query = $transaction_accountTbl->find()->hydrate(false)
                        ->join([
                                [   'table' => 'sub_control_account',
                                    'alias' => 'sca',
                                    'type' => 'INNER',
                                    'conditions' => 'sca.id_sub_control_account = transaction_account.sub_control_account_id'
                                ],
                                [   'table' => 'control_account',
                                    'alias' => 'controlaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.id_control_account = sca.control_account_id'
                                ],
                                [   'table' => 'main_account',
                                    'alias' => 'mainaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                ]
                            ]);
            $query->select(['sca_id'=>'id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sca.sub_control_account_number','subaccountname'=>'sca.sub_control_account_Name']);
            $query->select(['ta_no'=>'transaction_account_number','ta_title'=>'transaction_account_name']);
            $query->select(['transaction_account_id'=>'id_transaction_account']);
            $accounts = $query->toArray();   
            
            $cost_center_typeTbl = TableRegistry::get('cost_center_type');
            $cost_center_type = $cost_center_typeTbl->find();
            
            // getting net profit
            $net_profittbl = TableRegistry::get('net_profit');
            $query = $net_profittbl->find('all');
            $query->where(['from_date' => date("Y-m-d H:i:s", strtotime($from)), 'to_date' => date("Y-m-d H:i:s", strtotime($to))]);
            $result = $query->first();
            if(!empty($result)){
                $net_profit = $result->net_profit;
            }else{
                $net_profit = 0;
            }
            
          //  $this->set(compact('Assets','Equities','cost_center_type','accounts','from','to','net_profit'));
          //  $this->set('_serialize', ['Assets','Equities','net_profit']);
            
            $this->set(compact('Assets','Equities','cost_center_type','accounts','from','to','net_profit'));
            $this ->render('report_balance_sheet');  
             
             
         }
        if($flag==6){
            
            $from               = date("Y-m-d H:i:s", strtotime($this->request->pass[2]));
            $to                 = date("Y-m-d H:i:s", strtotime($this->request->pass[3]));
         
            $cost_center        = $this->request->pass[4];
            $cost_center_type   = $this->request->pass[5];
            
            if(isset($this->request->pass[6])){
            $sub_account_from   = $this->request->pass[6];
            }
            if(isset($this->request->pass[7])){
            $sub_account_to     = $this->request->pass[7];
            }
            
            $start_date         = date("Y-m-d H:i:s", strtotime(date("Y")."-7-1"));
            $data = array();
            $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
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
                $query->select(['id_transaction_account','transaction_account_number','transaction_account_name','sub_control_account_id']); 
                $query->select(['sca'=>'subaccount.sub_control_account_number']);
                $query->select(['ca'=>'controlaccount.control_account_number']);
                $query->select(['ma'=>'mainaccount.main_account_number']);
             
                $query->group('id_transaction_account');
                $query->order('id_transaction_account');
                
                if (!empty($sub_account_from)) {
                    $query->where(['id_transaction_account >=' => $sub_account_from, 'id_transaction_account <='=>$sub_account_to]);
                 }
                 
                $query->hydrate(false);
                $AC = $query->ToArray();
              
                $conn = ConnectionManager::get('default');
                foreach($AC as $account){
                    
                    //$sub_ac_id = $account['sub_control_account_id'];
                    $sub_ac_id = $account['id_transaction_account'];
                    
                    $stmt = $conn->execute("select ifnull(sum(ifnull(Debit,0))-sum(ifnull(Credit,0)),0) as 'opening',avd.voucher_detail_date
                    from account_voucher_details as avd
                    join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                    join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                    where sca.id_sub_control_account = '$sub_ac_id' and avd.voucher_detail_date >= '$start_date' and  avd.voucher_detail_date < '$from' ");
                    $rs = $stmt ->fetchAll('assoc');
                    
                    foreach($rs as $row){
                       
                        $sql = "select date_format(voucher_detail_date,'%d-%m-%Y %H:%i') as date  ,Debit,Credit,cost_center_type,cost_center_name,id_sub_control_account,remarks,voucher_number
                        from account_voucher as av
                        join account_voucher_details as avd on av.id_account_voucher = avd.account_voucher_id
                        join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                        join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account";
                        
                       
                     //   $sql .= " where sca.id_sub_control_account = '$sub_ac_id' ";
                        $sql .= " where ta.id_transaction_account = '$sub_ac_id' ";
                        $sql .= " and av.voucher_status = 'Posted' ";
                        if(!empty($from)){
                            $sql .= " and avd.voucher_detail_date >= '$from' and avd.voucher_detail_date <= '$to' ";
                        }
                        
                        if(!empty($cost_center_type) && ($cost_center_type) > 0){
                            $sql .= " and avd.cost_center_type = '$cost_center_type' ";
                        }
                        
                        if(!empty($cost_center) && ($cost_center) > 0 ){
                            $sql .= " and avd.cost_center_name = '$cost_center' ";
                        }
                       
                        
                        $result = $conn->execute($sql);
                        $res = $result ->fetchAll('assoc');
                        $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['opning'][$row['opening']]['details'] =  $res;
                         
                    }
                }
              
                $this->set(compact('data','from','to','cost_center','cost_center_type','sub_account_from','sub_account_to'));
                $this ->render('print_report_general_ledger');
          } 
   
   }
    public function add($id = null, $flag = null){
        
        $accountVoucher = $this->AccountVoucher->newEntity();
        $vouchertable = TableRegistry::get('account_voucher');
        if ($this->request->is('post')) {
            $accountVoucher = $this->AccountVoucher->patchEntity($accountVoucher, $this->request->data);
            $query = $vouchertable->find();

            $vt = $this->request->data['voucher_type'];
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute("select voucher_number as last_ID from account_voucher  where id_account_voucher =(select max(id_account_voucher) from account_voucher where  account_voucher_type_id = '$vt' )");
          //  $stmt = $conn->execute("select id_account_voucher, voucher_number, substring(voucher_number, 8, length(voucher_number)) as voucher_number, (substring(voucher_number, 8, length(voucher_number))) +1 as next_voucher_number from account_voucher where account_voucher_type_id = '$vt' order by 1 desc");
            $res = $stmt ->fetchAll('assoc');
            if($res){
            $last_ID =  $res[0];
            }else{
                $last_ID =  0;
            }
            $vt = "";
            if($this->request->data['voucher_type']==3){
                $vt = "RV-";    
            }elseif($this->request->data['voucher_type']==4){
                $vt = "PV-";    
            }elseif($this->request->data['voucher_type']==5){
                $vt = "JV-";
            }
            
           // $voucher_number = $vt.date('y').date('m').$last_ID['next_voucher_number'];
            
            $VN = "";
            $voucher_number = "";
            $current_year_month = date('y').date('m');
            if(count($last_ID) > 0){
                if (strpos($last_ID['last_ID'], '-') !== false) {
                     $temp = explode("-",$last_ID['last_ID']);
                     $db_year_month      =  substr($temp[1],0,4);
                      if($db_year_month == $current_year_month){
                          $VN = intval(substr($temp[1],4,10) ) + 1;
                          $voucher_number = $vt.date('y').date('m').$VN;
                      }else{
                          $VN = 1;
                          $voucher_number = $vt.date('y').date('m').$VN;
                        }
               }else{
                     $VN = 1;
                     $voucher_number = $vt.date('y').date('m').$VN;
                    }
            }else{
                $VN = 1;
                $voucher_number = $vt.date('y').date('m').$VN;
            }
    
            
            $accountVoucher ->voucher_number = $voucher_number;
            $accountVoucher ->account_voucher_type_id = $this->request->data['voucher_type'];
            $accountVoucher ->voucher_date = $this->request->data['voucher_date'];
            $accountVoucher ->created_by = $this->request->session()->read('Auth.User.id');
            $accountVoucher ->description = $this->request->data['voucher_desc'];
            $accountVoucher ->voucher_status = $this->request->data['vs'];  //  VS : voucher status
            $accountVoucher ->bp_id = $this->request->data['bn_id'];
            $accountVoucher ->bp_type = $this->request->data['bn_type'];
            $accountVoucher ->bp_name = $this->request->data['bn_name'];
        
            $mData = $this->request->data['transactions'];
            $account_voucher_detailsble = TableRegistry::get('account_voucher_details');
            if ($this->AccountVoucher->save($accountVoucher)) {
                
                $this->request->session()->write('instrument_number', $this->request->data['instrument_no_for_session']);
                
                $query = $vouchertable->find();
                $query->select(['lastID'=> 'max(account_voucher.id_account_voucher)']);
                $last_ID = $query->first();
                
                foreach($mData as $row){ 
                   
                $account_voucher_details = $account_voucher_detailsble->newEntity();
                $account_voucher_details->transaction_account_id = $row['account_id'];
                $acount_voucher_id = $last_ID->lastID;
                $account_voucher_details->account_voucher_id = $last_ID['lastID'];
                $account_voucher_details->remarks = $row['remarks'];
                $account_voucher_details->payment_mode = $row['paymentmode'];
                $account_voucher_details->payment_method = $this->request->data['payment_method'];
                $account_voucher_details->instrument_no = $row['instrumentno'];
                $account_voucher_details->cost_center_type = $row['costcentertype'];
                $account_voucher_details->cost_center_name = $row['costcenter'];
                $account_voucher_details->cost_center_id = $row['costcentertid'];
                $account_voucher_details->voucher_detail_date =  $this->request->data['voucher_date'];
                
                if($row['debit']!==""){                
                    $account_voucher_details->transaction_type = "Debit";
                    $account_voucher_details->debit = $row['debit'];
                } elseif($row['credit']!==""){
                    $account_voucher_details->transaction_type = "Credit";
                    $account_voucher_details->credit = $row['credit'];
                }
                
                $account_voucher_detailsble->save($account_voucher_details);
              } 
                if($flag > 0){
                  $table = TableRegistry::get('payment_advice');    
                  $query = $table->query();
                  $query->update()->set(['status' => 'Created'])->where(['id_payment_advice' => $flag])->execute();
                }
                $msg = "Success|The account voucher has been saved. Transaction No. is ". $voucher_number;
              
            }else{
              $msg = "Success|The account voucher could not be saved. Please, try again.";
                
            }
           
         }
        
            $account_voucher_typeTbl = TableRegistry::get('account_voucher_type');
            $accountvouchertype = $account_voucher_typeTbl->find();
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
               
                $cost_center_typeTbl = TableRegistry::get('cost_center_type');
                $cost_center_type = $cost_center_typeTbl->find();

                $business_partnersTbl = TableRegistry::get('business_partners');
                $business_partners = $business_partnersTbl->find();
                $flag = 0;
                if(!empty($id)){
                    $payment_adviceTbl = TableRegistry::get('payment_advice');
                    $query = $payment_adviceTbl->find() ->join([
                            [   'table' => 'payment_advice_details',
                                'alias' => 'payment_advice_details',
                                'type' => 'INNER',
                                'conditions' => 'payment_advice_details.payment_advice_id = payment_advice.id_payment_advice'
                            ],
                            [   'table' => 'suppliers',
                                'alias' => 'suppliers',
                                'type' => 'INNER',
                                'conditions' => 'suppliers.id_suppliers = payment_advice.supplier_id'
                            ]
                        ]);
                    $query->select(['id_payment_advice','sup_id'=>'suppliers.id_suppliers','sup_name'=>'suppliers.supplier_name']);
                    $query->select(['amount' => $query->func()->sum('sub_total')]);
                    $query->select(['tax' => 'suppliers.taxation']);
                    $query->group('suppliers.id_suppliers');
                    $query->where(['id_payment_advice'=>$id]);
                    $paymentadvice = $query->toArray();
                    $flag = 2;
                }
                
                

                $this->set(compact('accountVoucher','acount_voucher_id', 'accountvouchertype','transaction_account','msg','cost_center_type','business_partners','paymentadvice','flag'));
                $this->set('_serialize', ['accountVoucher','acount_voucher_id','accountvouchertype','transaction_account','msg','cost_center_type','business_partners']);
        
    }
    public function edit($id = null){
            // parameter from post ajax
            $id =  $this->request->data['voucher_id'];
            $desc =  $this->request->data['desc'];
           
            // getting  voucher_details for new entry
           
            $account_voucher_detailsble = TableRegistry::get('account_voucher_details');
            $query = $account_voucher_detailsble->find('all')->contain(['account_voucher']);
            $query->where(['account_voucher_id' => $id ]); 
            $rs = $query->toArray();
            $voucher_details = $rs[0];
          
            if($voucher_details['account_voucher']->voucher_status === 'Unposted'){
                $account_voucher = TableRegistry::get('account_voucher');
                $query = $account_voucher->query();
                $query->update()
                ->set(['voucher_status' => 'Cancelled'])
                ->where(['id_account_voucher' => $id])
                ->execute();
                $msg = "Success|The voucher #" .$id . " status has been changed."  ;

            }
            elseif($voucher_details['account_voucher']->voucher_status === 'Posted'){

                    $conn = ConnectionManager::get('default');
                    $stmt = $conn->execute("select voucher_number as last_ID from account_voucher  where id_account_voucher =(select max(id_account_voucher) from account_voucher where  account_voucher_type_id = '5' )");
                    $res = $stmt ->fetchAll('assoc');
                    $last_ID =  $res[0];
                    $vt = "JV-";
                    $VN = "";
                    $voucher_number = "";
                    if(count($last_ID) > 0){

                        if (strpos($last_ID['last_ID'], '-') !== false) {
                             $temp = explode("-",$last_ID['last_ID']); 
                             $VN = intval(substr($temp[1],4,10) ) + 1;
                             $voucher_number = $vt.date('y').date('m').$VN;
                        }else{
                             $VN = 1;
                             $voucher_number = $vt.date('y').date('m').$VN;
                            }
                    }else{
                        $VN = 1;
                        $voucher_number = $vt.date('y').date('m').$VN;
                    }
                    
                 
                    $accountVoucher = $this->AccountVoucher->newEntity();
                    $accountVoucher = $this->AccountVoucher->patchEntity($accountVoucher, $this->request->data);
                    $accountVoucher->voucher_number = $voucher_number;
                    $accountVoucher->account_voucher_type_id = 5;
                    $accountVoucher->voucher_date = date("Y-m-d H:i:s");
                    $accountVoucher->created_by = $this->request->session()->read('Auth.User.id');
                    $accountVoucher->voucher_status = "Active";
                    $accountVoucher->ref_voucher = $voucher_details['account_voucher']->voucher_number;
                    $accountVoucher->bp_id = $voucher_details['account_voucher']->bp_id;
                    $accountVoucher->bp_type = $voucher_details['account_voucher']->bp_type;
                    $accountVoucher->bp_name = $voucher_details['account_voucher']->bp_name;

                    $account_voucher_detailsble = TableRegistry::get('account_voucher_details');
                    if ($this->AccountVoucher->save($accountVoucher)) {
                            $vouchertable = TableRegistry::get('account_voucher');
                            $query = $vouchertable->find();
                            $query->select(['lastID'=> 'max(account_voucher.id_account_voucher)']);
                            $last_ID = $query->first();
                            foreach($rs as $row){ 

                                $account_voucher_details = $account_voucher_detailsble->newEntity();
                                $account_voucher_details->account_voucher_id = $last_ID->lastID;
                                $account_voucher_details->remarks = $row->remarks;
                                $account_voucher_details->payment_mode = $row->payment_mode;
                                $account_voucher_details->instrument_no = $row->instrument_no;
                                $account_voucher_details->cost_center_type = $row->cost_center_type;
                                $account_voucher_details->cost_center_name = $row->cost_center_name;
                                $account_voucher_details->cost_center_id = $row->cost_center_id;

                                if($row->transaction_type == "Credit"){ 

                                    $account_voucher_details->transaction_type = "Debit";
                                    $account_voucher_details->debit = $row->credit;

                                    $account_voucher_details->transaction_account_id = $row->transaction_account_id;

                                } elseif($row->transaction_type == "Debit"){

                                    $account_voucher_details->transaction_type = "Credit";
                                    $account_voucher_details->credit = $row->debit;
                                    $account_voucher_details->transaction_account_id = $row->transaction_account_id;

                                }
                                $account_voucher_detailsble->save($account_voucher_details);
                            }
                        }

                        $accountVoucher = $this->AccountVoucher->get($id, [
                            'contain' => []
                        ]);

                        $accountVoucher = $this->AccountVoucher->patchEntity($accountVoucher, $this->request->data);
                        $accountVoucher->voucher_status = "Cancelled";
                        $accountVoucher->description = $desc;

                        if ($this->AccountVoucher->save($accountVoucher)) {
                            $msg = "Success|The voucher no: ". $id ." has been cancelled";
                        } else {
                            $msg = "Success|The voucher no: ". $id ." could not be cancelled. Please, try again.";
                        }
            }
            else{
                $msg = "Error|Sorry wrong voucher status";
            }
            
       $this->set(compact('accountVoucher','msg'));
       $this->set('_serialize', ['msg']);
    }
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $accountVoucher = $this->AccountVoucher->get($id);
        if ($this->AccountVoucher->delete($accountVoucher)) {
            $this->Flash->success(__('The account voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The account voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function getvoucherbysearch(){
        
        $account_voucherTbl = TableRegistry::get('account_voucher');
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

           $query = $account_voucherTbl->find()->hydrate(false)
                    ->join([
                    [   'table' => 'account_voucher_details',
                        'alias' => 'voucherdetails',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.account_voucher_id = account_voucher.id_account_voucher',
                    ],
                    [   'table' => 'transaction_account',
                        'alias' => 'transactionaccount',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.transaction_account_id = transactionaccount.id_transaction_account'
                    ],
                    [   'table' => 'sub_control_account',
                        'alias' => 'subaccount',
                        'type' => 'INNER',
                        'conditions' => 'transactionaccount.sub_control_account_id = subaccount.id_sub_control_account'
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

            if (isset($this->request->data['voucher_status'])) {
            $voucher_id = $this->request->data['voucher_id'];
           // $from = $this->request->data['voucher_date_from'];
           // $to = $this->request->data['voucher_date_to'];
            $status = $this->request->data['voucher_status'];
            $paymentmode = $this->request->data['payment_mode'];
            $sub_account_from = $this->request->data['sub_account_from'];
            $sub_account_to = $this->request->data['sub_account_to'];
            $instrument_no = $this->request->data['instrument_no'];
            $from_date = $this->request->data['from_date'];
            $to_date = $this->request->data['to_date'];
            $cost_center = ucwords($this->request->data['cost_center']);
           
            
            $query->select(['id_account_voucher','voucher_number','voucher_date_created'=>'date_format(account_voucher.created_on,"%d-%m-%Y %H:%i")','voucher_status']);
            $query->select(['instrument_no'=>'voucherdetails.instrument_no','type'=>'voucherdetails.transaction_type','trans_account_no'=>'transactionaccount.transaction_account_number','sub_account_no'=>'subaccount.sub_control_account_number','control_account_no'=>'controlaccount.control_account_number','main_account_no'=>'mainaccount.main_account_number']);
            $query->select(['debit' =>  $query->func()->sum('debit'),'type'=>'transaction_type']);
            $query->select(['credit' => $query->func()->sum('credit'),'type'=>'transaction_type']);
            $query->select(['voucher_dated'=>'date_format(account_voucher.voucher_date,"%d-%m-%Y %H:%i")']);
            $query->select(['verified','center_name'=>'voucherdetails.cost_center_name']);
            
            
            $query->group('account_voucher_id');
            $query->group('account_voucher_id');
          
            $query->where(['id_account_voucher >' =>0]);

                if (!empty($voucher_id)) {
                    $query->andwhere(['voucher_number LIKE' => '%'.  $voucher_id . '%' ]);
                }
                if (!empty($status)) {
                    $query->andwhere(['voucher_status' => $status]);
                }
                if (!empty($cost_center)) {
                    $query->andwhere(['voucherdetails.cost_center_name LIKE' => '%'. $cost_center .'%']);
                }
                
                if (!empty($from) && !empty($to)) {
                    $query->andwhere(['account_voucher.created_on >=' => date("Y-m-d H:i:s", strtotime($from)), 'account_voucher.created_on <=' => date("Y-m-d H:i:s", strtotime($to))]);
                }
                
                if (!empty($from_date) && !empty($to_date)) {
                    $query->andwhere(['account_voucher.voucher_date >=' => date("Y-m-d H:i:s", strtotime($from_date)), 'account_voucher.voucher_date <=' => date("Y-m-d H:i:s", strtotime($to_date))]);
                }
                
                if (!empty($paymentmode)) {
                    $query->andwhere(['voucherdetails.payment_mode' => $paymentmode]);
                }
                
                if (!empty($sub_account_from)) {
                    $query->andwhere(['subaccount.id_sub_control_account >=' => $sub_account_from, 'subaccount.id_sub_control_account <='=>$sub_account_to]);
                }
                
                if (!empty($instrument_no)) {
                    $query->andwhere(['voucherdetails.instrument_no LIKE' => '%'. $instrument_no .'%']);
                }
                
                
                
                $query->order([$orderby => $orderdir]);
                if($length>-1){
                    $query->limit($length);
                }
                if($start>0){
                    $query->offset($start);

                }
         
            
        } else {

            $nowdate = date("Y-m-d H:i:s");
            $predays = date('Y-m-d', strtotime('-7 days'));
            $query = $account_voucherTbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'account_voucher_details',
                                'alias' => 'voucherdetails',
                                'type' => 'INNER',
                                'conditions' => 'voucherdetails.account_voucher_id = account_voucher.id_account_voucher',
                            ],
                            [   'table' => 'transaction_account',
                                'alias' => 'transactionaccount',
                                'type' => 'INNER',
                                'conditions' => 'voucherdetails.transaction_account_id = transactionaccount.id_transaction_account'
                            ],
                            [   'table' => 'sub_control_account',
                                'alias' => 'subaccount',
                                'type' => 'INNER',
                                'conditions' => 'transactionaccount.sub_control_account_id = subaccount.id_sub_control_account'
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

                    $query->select(['id_account_voucher','voucher_number','voucher_date_created'=>'date_format(account_voucher.created_on,"%d-%m-%Y %H:%i")','voucher_status','paymentmode'=>'voucherdetails.payment_mode','subaccountid'=>'subaccount.id_sub_control_account']);
                    $query->select(['instrument_no'=>'voucherdetails.instrument_no','type'=>'voucherdetails.transaction_type','trans_account_no'=>'transactionaccount.transaction_account_number','sub_account_no'=>'subaccount.sub_control_account_number','control_account_no'=>'controlaccount.control_account_number','main_account_no'=>'mainaccount.main_account_number']);
                    $query->select(['debit' => $query->func()->sum('debit'),'type'=>'transaction_type']);
                    $query->select(['credit' => $query->func()->sum('credit'),'type'=>'transaction_type']);
                    $query->select(['voucher_dated'=>'date_format(account_voucher.voucher_date,"%d-%m-%Y %H:%i")']);
                    $query->select(['verified','center_name'=>'voucherdetails.cost_center_name']);
                    
                    $query->group('account_voucher_id');
                    $query->group('account_voucher_id');
                    $query->andwhere(['voucher_status' => 'Unposted']);
                   // $query->where(['account_voucher.created_on >=' => date("Y-m-d H:i:s", strtotime($predays)), 'account_voucher.created_on <=' => date("Y-m-d H:i:s", strtotime($nowdate))]);
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
                // if user role is audit than show button verfiy
                if($this->request->session()->read('Auth.User.role_id')===9){
                    if($dat['verified'] == 'Verified'){
                        $actions = array('actions' => "<button onclick='javascript:openvoucer(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-warning m-b-5'>Open</button> <button onclick='javascript:loadmodal(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-danger m-b-5'>Delete</button> <button onclick='javascript:voucher_Verified(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-success m-b-5'> <i class='icon-like'></i> Verified</button>");
                    }else{
                    
                        $actions = array('actions' => "<button onclick='javascript:openvoucer(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-warning m-b-5'>Open</button> <button onclick='javascript:loadmodal(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-danger m-b-5'>Delete</button> <button onclick='javascript:voucher_verify(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-success m-b-5'>Verify</button>");
                    }
                    
                }else{
                    // if voucheer status is posted than hide edit button from list
                    if($dat['voucher_status'] === 'Posted'){
                        $actions = array('actions' => "<button onclick='javascript:openvoucer(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-success m-b-5'>Open</button> <button onclick='javascript:loadmodal(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-danger m-b-5'>Delete</button>");
                    }
                    else{
                       $actions = array('actions' => "<button onclick='javascript:openvoucer(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-success m-b-5'>Open</button> <button onclick='javascript:loadmodal(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-danger m-b-5'>Delete</button> <button onclick='javascript:edit_voucher(" . $dat['id_account_voucher'] . ")' class='btn btn-xs waves-effect waves-light btn-warning m-b-5'>Edit</button>");
                    }
                }
                
                array_push($data, array_merge($dat,$actions));
            }
           
            $recordsTotal = $total;
            $recordsFiltered = $total;
            $this->set(compact('draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data'));
            $this->set('_serialize', ['draw', 'start', 'length', 'recordsTotal', 'recordsFiltered', 'data']);
        
        }
    public function trialbalance(){
            $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
                        ->join([
                                [   'table' => 'sub_control_account',
                                    'alias' => 'sca',
                                    'type' => 'INNER',
                                    'conditions' => 'sca.id_sub_control_account = transaction_account.sub_control_account_id'
                                ],
                                [   'table' => 'control_account',
                                    'alias' => 'controlaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.id_control_account = sca.control_account_id'
                                ],
                                [   'table' => 'main_account',
                                    'alias' => 'mainaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                ]
                            ]);
            $query->select(['sca_id'=>'id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sca.sub_control_account_number','subaccountname'=>'sca.sub_control_account_Name']);
            $query->select(['ta_no'=>'transaction_account_number','ta_title'=>'transaction_account_name']);
            $query->select(['transaction_account_id'=>'id_transaction_account']);
            $accounts = $query->toArray();                   
            $this->set(compact('accounts'));
            
        } 
    public function gettrialblance(){
            // paramets from TB
           if(isset($this->request->data['fdate'])){ 
                $from  = date("Y-m-d H:i:s", strtotime($this->request->data['fdate']));
           }
           if(isset($this->request->data['tdate'])){ 
                $to   = date("Y-m-d H:i:s", strtotime($this->request->data['tdate']));
           }
           if(isset($this->request->data['fac'])){ 
                $sub_account_from   = $this->request->data['fac'];
           }
           if(isset($this->request->data['tac'])){ 
                $sub_account_to     = $this->request->data['tac'];
           } 
          
           // paramets from FS
            if(isset($this->request->params['pass'][0])){
                $from = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][0]));
            }
            if(isset($this->request->params['pass'][1])){
                $to = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][1]));
            }
            if(isset($this->request->params['pass'][2])){
                $sub_account_from = $this->request->params['pass'][2];
            }
            if(isset($this->request->params['pass'][3])){
                $sub_account_to = $this->request->params['pass'][3];
            }
          
            $data = array();
            $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
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
            $query->select(['id_transaction_account','transaction_account_number','transaction_account_name','sub_control_account_id']); 
            $query->select(['sca'=>'subaccount.sub_control_account_number']);
            $query->select(['ca'=>'controlaccount.control_account_number']);
            $query->select(['ma'=>'mainaccount.main_account_number']);

            $query->group('id_transaction_account');
            $query->order('id_transaction_account');

            if (!empty($sub_account_from)) {
                $query->where(['id_transaction_account >=' => $sub_account_from, 'id_transaction_account <='=>$sub_account_to]);
             }
                 
            $query->hydrate(false);
            $data = array();
            $AC = $query->ToArray();
            $conn = ConnectionManager::get('default');
            foreach($AC as $account){
            $trans_ac_id = $account['id_transaction_account'];
                    
                $stmt = $conn->execute("SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account, id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(debit)-sum(credit),0)>=0 Then replace(ifnull(sum(debit)-sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)<0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(debit)-sum(credit),0)<0 Then replace(ifnull(sum(debit)- sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)>=0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted'		
                and ma.main_account_name in ('Assets', 'Expenses') and avd.voucher_detail_date < '$from'
                and  id_transaction_account = '$trans_ac_id' 
                group by id_transaction_account,transaction_account_name

                union
                SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account,id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(credit)-sum(debit),0)<0 Then replace(ifnull(sum(credit)- sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)>=0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(credit)-sum(debit),0)>=0 Then replace(ifnull(sum(credit)-sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)<0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted'		
                and ma.main_account_name in ('Liabilities', 'Capital','Revenue') and avd.voucher_detail_date < '$from'
                and  id_transaction_account = '$trans_ac_id'   
                group by id_transaction_account,transaction_account_name ");
                $rs = $stmt ->fetchAll('assoc');
                $odebit = 0;
                $ocredit = 0;
                if(!empty($rs)){
                    $odebit = $rs[0]['odebit'];
                    $ocredit = $rs[0]['ocredit'];
                }else{
                    $odebit = 0;
                    $ocredit = 0;
                }
                
                
                $stmts = $conn->execute("SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account, id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(debit)-sum(credit),0)>=0 Then replace(ifnull(sum(debit)-sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)<0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(debit)-sum(credit),0)<0 Then replace(ifnull(sum(debit)- sum(credit),0),'-','')
                When ifnull(sum(debit)-sum(credit),0)>=0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted' and avd.voucher_detail_date >= '$from' and avd.voucher_detail_date <= '$to'	
                and ma.main_account_name in ('Assets', 'Expenses') 
                and  id_transaction_account = '$trans_ac_id' 
                group by id_transaction_account,transaction_account_name

                union
                SELECT concat(ma.main_account_number,'-',ca.control_account_number,'-',sca.sub_control_account_number,'-',ta.transaction_account_number) as account,id_transaction_account, ta.transaction_account_name,
                Case 
                When ifnull(sum(credit)-sum(debit),0)<0 Then replace(ifnull(sum(credit)- sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)>=0 Then 0.00 
                End as 'odebit',
                Case 
                When ifnull(sum(credit)-sum(debit),0)>=0 Then replace(ifnull(sum(credit)-sum(debit),0),'-','')
                When ifnull(sum(credit)-sum(debit),0)<0 Then 0.00 
                End as 'ocredit'

                FROM account_voucher_details as avd
                join account_voucher as av on av.id_account_voucher = avd.account_voucher_id   
                join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account 
                join sub_control_account as sca on sca.id_sub_control_account =  ta.sub_control_account_id
                join control_account as ca on ca.id_control_account = sca.control_account_id
                join main_account as ma on ma.id_main_account = ca.main_account_id
                where av.voucher_status =  'Posted' and avd.voucher_detail_date >= '$from' and avd.voucher_detail_date <= '$to'		
                and ma.main_account_name in ('Liabilities', 'Capital','Revenue') 
                and  id_transaction_account = '$trans_ac_id'   
                group by id_transaction_account,transaction_account_name ");
                $res = $stmts ->fetchAll('assoc');
                $cdebit = 0;
                $ccredit = 0;
             
                if(!empty($res)){
                    $cdebit = $res[0]['odebit'];
                    $ccredit = $res[0]['ocredit'];
                  
                }else{
                    $cdebit = 0;
                    $ccredit = 0;
                }
              
                /// geting opening balance 
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['ODEBIT'] = $odebit;
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['OCREDIT'] = $ocredit;
                
                
                /// geting opening balance 
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['CDEBIT'] = $cdebit;
                $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['CCREDIT'] = $ccredit;
                
            }
            
            $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
                        ->join([
                                [   'table' => 'sub_control_account',
                                    'alias' => 'sca',
                                    'type' => 'INNER',
                                    'conditions' => 'sca.id_sub_control_account = transaction_account.sub_control_account_id'
                                ],
                                [   'table' => 'control_account',
                                    'alias' => 'controlaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.id_control_account = sca.control_account_id'
                                ],
                                [   'table' => 'main_account',
                                    'alias' => 'mainaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                ]
                            ]);
            $query->select(['sca_id'=>'id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sca.sub_control_account_number','subaccountname'=>'sca.sub_control_account_Name']);
            $query->select(['ta_no'=>'transaction_account_number','ta_title'=>'transaction_account_name']);
            $query->select(['transaction_account_id'=>'id_transaction_account']);
            $accounts = $query->toArray();           
            $cost_center_typeTbl = TableRegistry::get('cost_center_type');
            $cost_center_type = $cost_center_typeTbl->find();
           
            $this->set(compact('cost_center_type','accounts','data','from','to', 'sub_account_from', 'sub_account_to'));
            $this->set('_serialize', ['data']);
            $this ->render('trialbalance');
    }
    public function getcentertype(){
        
        $centertypeid =  $this->request->data['ctype'];
        
        $cost_center_typeTbl = TableRegistry::get('cost_center_type');
        $cost_center_type = $cost_center_typeTbl->find();
        $cost_center_type->where(['id_cost_center_type'=>$centertypeid]);
        
        $result = $cost_center_type->First();
        $tablename  = $result['related_table'];
        $field_id   = $result['related_table_id'];
        $field_name = $result['related_table_field'];
       
        $dynamicTbl = TableRegistry::get($tablename);
        $dynamic = $dynamicTbl->find();
        $dynamic->select(['id'=>$field_id,'name'=>$field_name]);
        $data = $dynamic->ToArray();
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
        
    }
    public function getbusinesstype(){
        
        $bt =  $this->request->data['bt'];
        $tax_id =  $this->request->data['tax_id'];
        $business_partnersTbl = TableRegistry::get('business_partners');
        $business_name = $business_partnersTbl->find();
        $business_name->where(['id_business_type'=>$bt]);
        $result = $business_name->First();
        
        $tablename  = $result['related_table'];
        $field_id   = $result['related_table_id'];
        $field_name = $result['related_table_field'];
      
        $dynamicTbl = TableRegistry::get($tablename);
        $dynamic = $dynamicTbl->find();
        if($tax_id === '1' || $tax_id === '2'){
            $dynamic->select(['id'=>$field_id,'name'=>$field_name,'tax'=>'taxation']);
        }else{
            $dynamic->select(['id'=>$field_id,'name'=>$field_name,'tax'=>'0']);
        }
        $data = $dynamic->ToArray();
        
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
        
    }
    public function generalledger(){
        
        $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
                        ->join([
                                [   'table' => 'sub_control_account',
                                    'alias' => 'sca',
                                    'type' => 'INNER',
                                    'conditions' => 'sca.id_sub_control_account = transaction_account.sub_control_account_id'
                                ],
                                [   'table' => 'control_account',
                                    'alias' => 'controlaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.id_control_account = sca.control_account_id'
                                ],
                                [   'table' => 'main_account',
                                    'alias' => 'mainaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                ]
                            ]);
            $query->select(['sca_id'=>'id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sca.sub_control_account_number','subaccountname'=>'sca.sub_control_account_Name']);
            $query->select(['ta_no'=>'transaction_account_number','ta_title'=>'transaction_account_name']);
            $query->select(['transaction_account_id'=>'id_transaction_account']);
            $accounts = $query->toArray();           
            
            $cost_center_typeTbl = TableRegistry::get('cost_center_type');
            $cost_center_type = $cost_center_typeTbl->find();
            
            $this->set(compact('accounts','cost_center_type'));
        
        
    }
    public function getgeneralledgerdetails(){
        
            $from               = date("Y-m-d H:i:s", strtotime($this->request->data['fdate']));
            $to                 = date("Y-m-d H:i:s", strtotime($this->request->data['tdate']));
            $sub_account_from   = $this->request->data['fac'];
            $sub_account_to     = $this->request->data['tac'];
            //$v_status           = $this->request->data['vs'];
            $cost_center        = $this->request->data['cc'];
            $cost_center_type   = $this->request->data['cct'];
            $start_date         = date("Y-m-d H:i:s", strtotime(date("Y")."-7-1"));
          
            $data = array();
            $transaction_accountTbl = TableRegistry::get('transaction_account');
            $query = $transaction_accountTbl->find()->hydrate(false)
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
                $query->select(['id_transaction_account','transaction_account_number','transaction_account_name','sub_control_account_id']); 
                $query->select(['sca'=>'subaccount.sub_control_account_number']);
                $query->select(['ca'=>'controlaccount.control_account_number']);
                $query->select(['ma'=>'mainaccount.main_account_number']);
             
                $query->group('id_transaction_account');
                $query->order('id_transaction_account');
                
                if (!empty($sub_account_from)) {
                    $query->where(['id_transaction_account >=' => $sub_account_from, 'id_transaction_account <='=>$sub_account_to]);
                 }
                 
                $query->hydrate(false);
                $AC = $query->ToArray();
              
                $conn = ConnectionManager::get('default');
                foreach($AC as $account){
                    
                    //$sub_ac_id = $account['sub_control_account_id'];
                    $sub_ac_id = $account['id_transaction_account'];
                    
                    $stmt = $conn->execute("select ifnull(sum(ifnull(Debit,0))-sum(ifnull(Credit,0)),0) as 'opening',avd.voucher_detail_date
                    from account_voucher_details as avd
                    join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                    join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                    where sca.id_sub_control_account = '$sub_ac_id' and avd.voucher_detail_date >= '$start_date' and  avd.voucher_detail_date < '$from' ");
                    $rs = $stmt ->fetchAll('assoc');
                    
                    foreach($rs as $row){
                       
                        $sql = "select date_format(voucher_detail_date,'%d-%m-%Y %H:%i') as date  ,Debit,Credit,cost_center_type,cost_center_name,id_sub_control_account,remarks,voucher_number
                        from account_voucher as av
                        join account_voucher_details as avd on av.id_account_voucher = avd.account_voucher_id
                        join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                        join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account";
                        
                       
                     //   $sql .= " where sca.id_sub_control_account = '$sub_ac_id' ";
                        $sql .= " where ta.id_transaction_account = '$sub_ac_id' ";
                        $sql .= " and av.voucher_status = 'Posted' ";
                        if(!empty($from)){
                            $sql .= " and avd.voucher_detail_date >= '$from' and avd.voucher_detail_date <= '$to' ";
                        }
                        
                        if(!empty($cost_center_type)){
                            $sql .= " and avd.cost_center_type = '$cost_center_type' ";
                        }
                        
                        if(!empty($cost_center)){
                            $sql .= " and avd.cost_center_name = '$cost_center' ";
                        }
                       
                        
                        $result = $conn->execute($sql);
                        $res = $result ->fetchAll('assoc');
                        $data[$account['transaction_account_name']][$account['ma']."-".$account['ca']."-".$account['sca']."-".$account['transaction_account_number']]['opning'][$row['opening']]['details'] =  $res;
                         
                    }
                }
              
                
                $this->set(compact('data'));
                $this->set('_serialize', ['data']);
                
        
    }
    public function getbanks(){
        $id =  $this->request->data['tid'];
        $transaccountTbl = TableRegistry::get('transaction_account');
        $query = $transaccountTbl->find()->hydrate(false)
                    ->join([
                            [   'table' => 'sub_control_account',
                                'alias' => 'subcontrolaccount',
                                'type' => 'INNER',
                                'conditions' => 'transaction_account.sub_control_account_id = subcontrolaccount.id_sub_control_account'
                            ]
                        ]);
        
        $query->select(['id_transaction_account','transaction_account_name','transaction_account_number','sca'=>'subcontrolaccount.sub_control_account_number']);
        if($id==='2'){
        $query->where(['sub_control_account_id'=>'007']);
        }else{
            $query->where(['sub_control_account_id'=>'006']);
            $query->andwhere(['transaction_account_number'=>'0012']);
        }
        $data = $query->toArray(); 
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
         
    }
    public function financialstatements(){
        
    $transaction_accountTbl = TableRegistry::get('transaction_account');
    $query = $transaction_accountTbl->find()->hydrate(false)
                ->join([
                        [   'table' => 'sub_control_account',
                            'alias' => 'sca',
                            'type' => 'INNER',
                            'conditions' => 'sca.id_sub_control_account = transaction_account.sub_control_account_id'
                        ],
                        [   'table' => 'control_account',
                            'alias' => 'controlaccount',
                            'type' => 'INNER',
                            'conditions' => 'controlaccount.id_control_account = sca.control_account_id'
                        ],
                        [   'table' => 'main_account',
                            'alias' => 'mainaccount',
                            'type' => 'INNER',
                            'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                        ]
                    ]);
    $query->select(['sca_id'=>'id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sca.sub_control_account_number','subaccountname'=>'sca.sub_control_account_Name']);
    $query->select(['ta_no'=>'transaction_account_number','ta_title'=>'transaction_account_name']);
    $query->select(['transaction_account_id'=>'id_transaction_account']);
    $accounts = $query->toArray();                      
    $cost_center_typeTbl = TableRegistry::get('cost_center_type');
    $cost_center_type = $cost_center_typeTbl->find();
    $this->set(compact('accounts','cost_center_type'));
    }
    public function profitandloss(){
        
         $conn = ConnectionManager::get('default');
         $from               = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][0]));
         $to                 = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][1]));
         $head = ['Revenue','Expenses'];  // $head = ['Revenue','Expenses'];
         
         $data = array();
         foreach($head as $account_names){
                            $sqlquery = "select control_account_name
                            from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' 
                            group by  ca.control_account_name order by control_account_number asc ";
                            $stmt = $conn->execute($sqlquery);
                            $rs = $stmt ->fetchAll('assoc');
                foreach($rs as $rows){
                     foreach($rows as $row){
                            $sql = "select sub_control_account_name from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and  ca.control_account_name = '$row'
                            group by  ca.control_account_name,sub_control_account_name";
                            $stmt2 = $conn->execute($sql);
                            $res = $stmt2 ->fetchAll('assoc');
                        foreach($res as $subaccountname){
                            foreach($subaccountname as $acname){
                            if($account_names === 'Revenue'){
                            $sql = "select ifnull(sum(Credit),0)-ifnull(sum(Debit),0) as amount,add_sub ";
                           // $sql = "select ifnull(sum(Credit),0) as amount,add_sub ";     
                                }else{
                            $sql = "select ifnull(sum(Debit),0)-ifnull(sum(Credit),0) as amount,add_sub "; 
                           // $sql = "select ifnull(sum(Debit),0) as amount,add_sub ";         
                            }
                            $sql .= "from account_voucher_details  as avd 
                            join account_voucher as av on av.id_account_voucher = avd.account_voucher_id           
                            join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and ca.control_account_name ='$row' and sca.sub_control_account_name = '$acname' 
                            and avd.voucher_detail_date >= '$from' and  avd.voucher_detail_date <= '$to' and av.voucher_status = 'Posted'
                            group by  ma.main_account_name,control_account_name,ca.control_account_name,sca.sub_control_account_name";
                            
                            $stmt3 = $conn->execute($sql);
                            $trs = $stmt3 ->fetchAll('assoc');
                             if($trs){   
                                foreach($trs as $amount){

                                 $data[$account_names][$row][$acname][] =  $amount['amount']. "|".$amount['add_sub']; 

                                }
                             }else{
                                 $data[$account_names][$row][$acname][] =  "0|Add";  
                             }   
                        }
                     }
                }
         }
       }
      
       
           $subcontrolaccountTbl = TableRegistry::get('sub_control_account');
           $query = $subcontrolaccountTbl->find()->hydrate(false)
                           ->join([
                                   [   'table' => 'control_account',
                                       'alias' => 'controlaccount',
                                       'type' => 'INNER',
                                       'conditions' => 'sub_control_account.control_account_id = controlaccount.id_control_account'
                                   ],
                                   [   'table' => 'main_account',
                                       'alias' => 'mainaccount',
                                       'type' => 'INNER',
                                       'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                   ]
                               ]);
            $query->select(['id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sub_control_account.sub_control_account_number','subaccountname'=>'sub_control_account.sub_control_account_Name']);
            $accounts = $query->toArray();           
            $cost_center_typeTbl = TableRegistry::get('cost_center_type');
            $cost_center_type = $cost_center_typeTbl->find();
            
            $this->set(compact('accounts','cost_center_type','data','from','to'));
            $this->set('_serialize', ['data']);   
      
  }
    public function balancesheet(){
      
         $conn = ConnectionManager::get('default');
         $from = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][0]));
         $to   = date("Y-m-d H:i:s", strtotime($this->request->params['pass'][1]));
         $head = ['Assets'];  // $head = ['Revenue','Expenses'];
         foreach($head as $account_names){
                            $sqlquery = "select control_account_name
                            from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names'
                            group by  ca.control_account_name order by control_account_number asc";
                            $stmt = $conn->execute($sqlquery);
                            $rs = $stmt ->fetchAll('assoc');
                foreach($rs as $rows){
                     foreach($rows as $row){
                            $sql = "select sub_control_account_name from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and  ca.control_account_name = '$row'
                            group by  ca.control_account_name,sub_control_account_name   order by sca.orders asc";
                            $stmt2 = $conn->execute($sql);
                            $res = $stmt2 ->fetchAll('assoc');
                        foreach($res as $subaccountname){
                            foreach($subaccountname as $acname){
                            $sql = "select ifnull(sum(Debit),0)-ifnull(sum(Credit),0) as amount,add_sub "; 
                            $sql .= "from account_voucher_details  as avd 
                            join account_voucher as av on av.id_account_voucher = avd.account_voucher_id    
                            join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and ca.control_account_name ='$row' and sca.sub_control_account_name = '$acname' 
                            and avd.voucher_detail_date >= '$from' and  avd.voucher_detail_date <= '$to' and av.voucher_status =  'Posted'
                            group by  ma.main_account_name,control_account_name,ca.control_account_name,sca.sub_control_account_name";
                            
                            $stmt3 = $conn->execute($sql);
                            $trs = $stmt3 ->fetchAll('assoc');
                             if($trs){   
                                foreach($trs as $amount){

                                 $Assets[$row][$acname][] =  $amount['amount']. "|".$amount['add_sub']; 

                                }
                             }else{
                                 $Assets[$row][$acname][] =  "0|Add";  
                             }   
                        }
                     }
                }
         }
       }
        // end assets 
         $head = ['Liabilities','Capital'];  // $head = ['Revenue','Expenses'];
         $Equities = array();
         foreach($head as $account_names){
                            $sqlquery = "select control_account_name
                            from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' 
                            group by  ca.control_account_name ";
                            $stmt = $conn->execute($sqlquery);
                            $rs = $stmt ->fetchAll('assoc');
                foreach($rs as $rows){
                     foreach($rows as $row){
                            $sql = "select sub_control_account_name from transaction_account  as ta 
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and  ca.control_account_name = '$row'
                            group by  ca.control_account_name,sub_control_account_name";
                            $stmt2 = $conn->execute($sql);
                            $res = $stmt2 ->fetchAll('assoc');
                        foreach($res as $subaccountname){
                            foreach($subaccountname as $acname){
                            if($account_names === 'Liabilities'){
                            $sql = "select ifnull(sum(Credit),0)-ifnull(sum(Debit),0) as amount,add_sub ";
                                }else{
                            $sql = "select ifnull(sum(Credit),0)-ifnull(sum(Debit),0) as amount,add_sub "; 
                            }
                            $sql .= "from account_voucher_details  as avd 
                            join account_voucher as av on av.id_account_voucher = avd.account_voucher_id       
                            join transaction_account as ta on avd.transaction_account_id =  ta.id_transaction_account
                            join sub_control_account as sca on ta.sub_control_account_id = sca.id_sub_control_account
                            join control_account as ca on ca.id_control_account  = sca.control_account_id
                            join main_account as ma on ma.id_main_account  = ca.main_account_id
                            where ma.main_account_name = '$account_names' and ca.control_account_name ='$row' and sca.sub_control_account_name = '$acname' 
                            and avd.voucher_detail_date >= '$from' and  avd.voucher_detail_date <= '$to' and av.voucher_status = 'Posted'
                            group by  ma.main_account_name,control_account_name,ca.control_account_name,sca.sub_control_account_name";
                            
                            $stmt3 = $conn->execute($sql);
                            $trs = $stmt3 ->fetchAll('assoc');
                             if($trs){   
                                foreach($trs as $amount){

                                 $Equities[$account_names][$row][$acname][] =  $amount['amount']. "|".$amount['add_sub']; 

                                }
                             }else{
                                 $Equities[$account_names][$row][$acname][] =  "0|Add";  
                             }   
                        }
                     }
                }
         }
       }
          $transaction_accountTbl = TableRegistry::get('transaction_account');
          $query = $transaction_accountTbl->find()->hydrate(false)
                        ->join([
                                [   'table' => 'sub_control_account',
                                    'alias' => 'sca',
                                    'type' => 'INNER',
                                    'conditions' => 'sca.id_sub_control_account = transaction_account.sub_control_account_id'
                                ],
                                [   'table' => 'control_account',
                                    'alias' => 'controlaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.id_control_account = sca.control_account_id'
                                ],
                                [   'table' => 'main_account',
                                    'alias' => 'mainaccount',
                                    'type' => 'INNER',
                                    'conditions' => 'controlaccount.main_account_id = mainaccount.id_main_account'
                                ]
                            ]);
            $query->select(['sca_id'=>'id_sub_control_account','mainaccountno'=>'mainaccount.main_account_number','controlaccountno'=>'controlaccount.control_account_number','subaccountno'=>'sca.sub_control_account_number','subaccountname'=>'sca.sub_control_account_Name']);
            $query->select(['ta_no'=>'transaction_account_number','ta_title'=>'transaction_account_name']);
            $query->select(['transaction_account_id'=>'id_transaction_account']);
            $accounts = $query->toArray();   
            
            $cost_center_typeTbl = TableRegistry::get('cost_center_type');
            $cost_center_type = $cost_center_typeTbl->find();
            
            // getting net profit
            $net_profittbl = TableRegistry::get('net_profit');
            $query = $net_profittbl->find('all');
            $query->where(['from_date' => date("Y-m-d H:i:s", strtotime($from)), 'to_date' => date("Y-m-d H:i:s", strtotime($to))]);
            $result = $query->first();
            if(!empty($result)){
                $net_profit = $result->net_profit;
            }else{
                $net_profit = 0;
            }
            $this->set(compact('Assets','Equities','cost_center_type','accounts','from','to','net_profit'));
            $this->set('_serialize', ['Assets','Equities','net_profit']);
      
  }
    public function storepl(){
      
       $from = date("Y-m-d H:i:s", strtotime($this->request->data['fdate']));
       $to   = date("Y-m-d H:i:s", strtotime($this->request->data['tdate']));
       $profit =  $this->request->data['net_profit'];
      
       $net_profittbl = TableRegistry::get('net_profit');
        
        $exists = $net_profittbl->exists(['from_date >=' => $from, 'to_date' =>$to,'net_profit <=' =>$profit]);
        if($exists){
              //$msg = 'Warning|Already confirmed,You can not confirm again.';
              $msg = 'success';
        }else{
                $query = $net_profittbl->newEntity(); 
                $query->from_date = $from;
                $query->to_date =$to;
                $query->net_profit =  $profit;
                $net_profittbl->save($query);
                $msg = 'success';
        }
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
      
  }
    public function updatevoucherstatus(){
      
        $vn = $this->request->data['vn'];
        $vs = $this->request->data['vs'];
     
        $account_voucher = TableRegistry::get('account_voucher');
        $query = $account_voucher->find();
        $query->select(['voucher_status']);
        $query->where(['voucher_number'=>$vn]);
        $result = $query->first();
                
        if($vs === "Posted" && $result->voucher_status === "Unposted"){
                $query = $account_voucher->query();
                $query->update()
                ->set(['voucher_status' => $vs
                       ,'approved_by'=> $this->request->session()->read('Auth.User.id')])
                ->where(['voucher_number' => $vn])
                ->execute();
                $msg = "Success|The voucher #" .$vn . " status has been changed.";
                
        }elseif($vs === "Cancelled" && $result->voucher_status === "Unposted"){
            
                $query = $account_voucher->query();
                $query->update()
                ->set(['voucher_status' => $vs
                       ,'approved_by'=> $this->request->session()->read('Auth.User.id') ])
                ->where(['voucher_number' => $vn])
                ->execute();
                $msg = "Success|The voucher #" .$vn . " status has been changed."  ;
      
        }else{
            $msg = "Error|Sorry! You can not change the status of this voucher #.". $vn ;
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
      
  }
    public function verifyvoucher(){
      
        $vn = $this->request->data['vid'];
        $account_voucher = TableRegistry::get('account_voucher');
        $query = $account_voucher->query();
        $query->update()
        ->set(['verified' => 'Verified'
               ,'verified_by'=> $this->request->session()->read('Auth.User.id')])
        ->where(['id_account_voucher' => $vn])
        ->execute();
        $msg = "Success|The voucher #" .$vn . " has been Verified."  ;

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
        
      
  }
    public function voucheredit($id = null){

      if($this->request->is('post')){
          
           $accountVoucher = $this->AccountVoucher->newEntity();
           $account_voucher_detailsble = TableRegistry::get('account_voucher_details');
           $vouchertable = TableRegistry::get('account_voucher');
           $query = $account_voucher_detailsble->query();
           $query->delete()->where(['account_voucher_id' =>  $this->request->data['voucher_id']])->execute();
           
           $voucher_number = $this->request->data['voucher_number'];
            $query = $vouchertable->query();
            $query->update()
                ->set(['account_voucher_type_id'=>$this->request->data['voucher_type'],
                       'voucher_date'=>date('Y-m-d h:i', strtotime($this->request->data['voucher_date'])),
                       'description'=>$this->request->data['voucher_desc'],
                       'voucher_status'=>$this->request->data['vs'],
                       'bp_id'=>$this->request->data['bn_id'],
                       'bp_type'=>$this->request->data['bn_type'],
                       'bp_name'=>$this->request->data['bn_name']])
                ->where(['id_account_voucher' => $this->request->data['voucher_id']])
                ->execute();
            
           
            $mData = $this->request->data['transactions'];
            
            foreach($mData as $row){ 
                   
                $account_voucher_details = $account_voucher_detailsble->newEntity();
                $account_voucher_details->transaction_account_id = $row['account_id'];
                $account_voucher_details->account_voucher_id = $this->request->data['voucher_id'];
                $account_voucher_details->remarks = $row['remarks'];
                $account_voucher_details->payment_mode = $row['paymentmode'];
                $account_voucher_details->instrument_no = $row['instrumentno'];
                $account_voucher_details->cost_center_type = $row['costcentertype'];
                $account_voucher_details->cost_center_name = $row['costcenter'];
                $account_voucher_details->cost_center_id = $row['costcentertid'];
                $account_voucher_details->voucher_detail_date =  $this->request->data['voucher_date'];
                
                if($row['debit'] !== ""){                
                    $account_voucher_details->transaction_type = "Debit";
                    $account_voucher_details->debit = $row['debit'];
                } elseif($row['credit'] !== ""){
                    $account_voucher_details->transaction_type = "Credit";
                    $account_voucher_details->credit = $row['credit'];
                }
                $account_voucher_detailsble->save($account_voucher_details);
            
            } 
              $msg = "Success|The account voucher has been saved. Transaction No. is ". $voucher_number;
            
        }
        $account_voucherTbl = TableRegistry::get('account_voucher');
        $query = $account_voucherTbl->find()->hydrate(false)
                    ->join([
                    [   'table' => 'account_voucher_details',
                        'alias' => 'voucherdetails',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.account_voucher_id = account_voucher.id_account_voucher',
                    ],
                    [   'table' => 'account_voucher_type',
                        'alias' => 'accountvouchertype',
                        'type' => 'INNER',
                        'conditions' => 'accountvouchertype.id_account_voucher_type = account_voucher.account_voucher_type_id',
                    ],
                    [   'table' => 'transaction_account',
                        'alias' => 'transactionaccount',
                        'type' => 'INNER',
                        'conditions' => 'voucherdetails.transaction_account_id = transactionaccount.id_transaction_account'
                    ],
                    [   'table' => 'sub_control_account',
                        'alias' => 'subaccount',
                        'type' => 'INNER',
                        'conditions' => 'transactionaccount.sub_control_account_id = subaccount.id_sub_control_account'
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
                    ],
                    [   'table' => 'users',
                        'alias' => 'users',
                        'type' => 'INNER',
                        'conditions' => 'users.id = account_voucher.created_by'
                    ]

                ]);

            $query->select(['center_name'=>'voucherdetails.cost_center_name','center_type'=>'voucherdetails.cost_center_type','description','id_account_voucher','voucher_number','voucher_date_created'=>'date_format(account_voucher.created_on,"%d-%m-%Y %H:%i")','voucher_status','paymentmode'=>'voucherdetails.payment_mode']);
            $query->select(['credit'=>'voucherdetails.credit','debit'=>'voucherdetails.debit','type'=>'voucherdetails.transaction_type','trans_account_no'=>'transactionaccount.transaction_account_number','trans_account_title'=>'transactionaccount.transaction_account_name','sub_account_no'=>'subaccount.sub_control_account_number','control_account_no'=>'controlaccount.control_account_number','main_account_no'=>'mainaccount.main_account_number']);
            $query->select(['remakrs'=>'voucherdetails.remarks','instrument_no'=>'voucherdetails.instrument_no','vouchertype'=>'accountvouchertype.account_voucher_type']);
            $query->select(['bp_name','full_name'=>'users.full_name','id_details'=>'voucherdetails.id_account_voucher_details']);
            $query->select(['voucher_dated'=>'date_format(account_voucher.voucher_date,"%d-%m-%Y %H:%i")']);
            $query->select(['pmode'=>'voucherdetails.payment_mode','taid'=>'voucherdetails.transaction_account_id']);
            $query->select(['bp_type','bp_id','cost_id'=>'voucherdetails.cost_center_id']);
            $query->select(['pm'=>'voucherdetails.payment_method']);
            
            $query->orderAsc('voucherdetails.id_account_voucher_details');
            $query->where(['id_account_voucher ' => $id]);
            $accountvoucher = $query->toArray();
 

            $account_voucher_typeTbl = TableRegistry::get('account_voucher_type');
            $accountvouchertype = $account_voucher_typeTbl->find();
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

                $cost_center_typeTbl = TableRegistry::get('cost_center_type');
                $cost_center_type = $cost_center_typeTbl->find();

                $business_partnersTbl = TableRegistry::get('business_partners');
                $business_partners = $business_partnersTbl->find();
                $flag = 0;


                $this->set(compact('accountvoucher','accountvouchertype','transaction_account','msg','cost_center_type','business_partners','paymentadvice','flag'));
                $this->set('_serialize', ['accountVoucher','accountvouchertype','transaction_account','msg','cost_center_type','business_partners']);

          }
  
    public function cytologyform(){
      $this->set(compact('data'));
      $this->set('_serialize', ['data']);
    }
    public function histopathologyform(){
      $this->set(compact('data'));
      $this->set('_serialize', ['data']);
    }
    
   
    
   
    
   

}
