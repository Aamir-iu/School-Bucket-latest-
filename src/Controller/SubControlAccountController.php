<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * SubControlAccount Controller
 *
 * @property \App\Model\Table\SubControlAccountTable $SubControlAccount
 */
class SubControlAccountController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index() {

        $control_account_id = $this->request->params['pass'][0];
        $main_account_id = $this->request->query('main_account_id');

        $control_accountTbl = TableRegistry::get('control_account');
        $control_account = $control_accountTbl->find('all');
        $control_account->where(['id_control_account' => $control_account_id]);
        $control_account = $control_account->ToArray();

        $maincontrol_accountTbl = TableRegistry::get('main_account');
        $main_account = $maincontrol_accountTbl->find('all');
        $main_account->where(['id_main_account' => $main_account_id]);
        $main_account = $main_account->ToArray();



        $sub_control_accountTbl = TableRegistry::get('sub_control_account');
        $subControlAccount = $sub_control_accountTbl->find()->contain(['users' => function ($q) {
                return $q
                                ->select(['created_by' => 'full_name', 'id']);
            }
                ]);
                $control_account_created = $subControlAccount->func()->date_format([
                    'sub_control_account_createdon' => 'identifier',
                    "'%d-%m-%Y %H:%i'" => 'literal'
                ]);

                $subControlAccount->select(['id_sub_control_account', 'sub_control_account_number', 'sub_control_account_name', 'control_account_id', 'sub_control_account_createdby', 'sub_control_account_date' => $control_account_created]);
                $subControlAccount->where(['control_account_id' => $control_account_id]);
                $this->set(compact('subControlAccount', 'control_account', 'control_account_id', 'main_account'));
            }

            public function isAuthorized($user) {
                $action = $this->request->params['action'];
                // The add and index actions are always allowed.
                if (in_array($action, ['index', 'add', 'edit', 'view', 'delete'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3) {
                    return true;
                }
                // All other actions require an id.
                if (empty($this->request->params['pass'][0])) {
                    return false;
                }
                return parent::isAuthorized($user);
            }

            public function view($id = null) {
                $subControlAccount = $this->SubControlAccount->get($id, [
                    'contain' => []
                ]);

                $this->set('subControlAccount', $subControlAccount);
                $this->set('_serialize', ['subControlAccount']);
            }

            /**
             * Add method
             *
             * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
             */
            public function add() {
                $subControlAccount = $this->SubControlAccount->newEntity();
                $subControlAccountTbl = TableRegistry::get('sub_control_account');
                if ($this->request->is('post')) {


                    $query = $subControlAccountTbl->find();
                    $query->select(['lastID' => 'max(sub_control_account.id_sub_control_account)']);
                    $last_ID = $query->first();
                    $last_no = $last_ID->lastID + 1;
                    if ($last_no >= 1 && $last_no <= 9) {
                        $subcontrol_account_no = "00" . $last_no;
                    } elseif ($last_no >= 10 && $last_no <= 99) {
                        $subcontrol_account_no = "0" . $last_no;
                    } else {
                        $subcontrol_account_no = $last_no;
                    }


                    $subControlAccount = $this->SubControlAccount->patchEntity($subControlAccount, $this->request->data);
                    $subControlAccount->sub_control_account_number = $subcontrol_account_no;
                    $subControlAccount->control_account_id = $this->request->data['controlaccountid'];
                    $subControlAccount->sub_control_account_name = $this->request->data['sub_acc_name'];
                    $subControlAccount->add_sub = $this->request->data['addsub'];
                    $subControlAccount->pnl = $this->request->data['pl'];

                    $subControlAccount->sub_control_account_createdby = $this->request->session()->read('Auth.User.id');

                    if ($this->SubControlAccount->save($subControlAccount)) {
                        $msg = "Success|The sub control account has been saved";
                    } else {
                        $msg = "Error|The sub control account not saved.Please, try again.";
                    }
                }
                $this->set(compact('msg'));
                $this->set('_serialize', ['msg']);
            }

            /**
             * Edit method
             *
             * @param string|null $id Sub Control Account id.
             * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
             * @throws \Cake\Network\Exception\NotFoundException When record not found.
             */
            public function edit($id = null) {
                $id = $this->request->data['sub_acc_id'];

                $subControlAccount = $this->SubControlAccount->get($id, [
                    'contain' => []
                ]);
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $subControlAccount = $this->SubControlAccount->patchEntity($subControlAccount, $this->request->data);
                    // $subControlAccount->sub_control_account_number = $this->request->data['controlaccountid'];
                    $subControlAccount->sub_control_account_name = $this->request->data['sub_acc_name'];
                    $subControlAccount->add_sub = $this->request->data['addsub'];
                    $subControlAccount->pnl = $this->request->data['pl'];
                    
                    
                    if ($this->SubControlAccount->save($subControlAccount)) {
                        $msg = "Success|The sub control account has been saved";
                    } else {
                        $msg = "Error|The sub control account not saved.Please, try again.";
                    }
                }
                $this->set(compact('msg'));
                $this->set('_serialize', ['msg']);
            }

            /**
             * Delete method
             *
             * @param string|null $id Sub Control Account id.
             * @return \Cake\Network\Response|null Redirects to index.
             * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
             */
            public function delete($id = null) {
                $id = $this->request->data['id'];

                //  deleting transaction account
                $transaction_accountTbl = TableRegistry::get('transaction_account'); // delete all from randsaction accounts
                $query = $transaction_accountTbl->query();
                $query->delete()->where(['sub_control_account_id' => $id])->execute();


                $this->request->allowMethod(['post', 'delete']);
                $subControlAccount = $this->SubControlAccount->get($id);
                if ($this->SubControlAccount->delete($subControlAccount)) {
                    $msg = 'Success|The sub control account has been deleted.';
                } else {
                    $msg = 'Success|The sub control account could not be deleted. Please, try again.';
                }

                $this->set(compact('msg'));
                $this->set('_serialize', ['msg']);
            }

        }
        