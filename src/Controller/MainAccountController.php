<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * MainAccount Controller
 *
 * @property \App\Model\Table\MainAccountTable $MainAccount
 */
class MainAccountController extends AppController {

    public function index() {
        //$mainAccount = $this->paginate($this->MainAccount);
        $mainAccountTbl = TableRegistry::get('main_account');
        $mainAccount = $mainAccountTbl->find()->contain(['users' => function ($q) {
                return $q
                                ->select(['user_name' => 'full_name', 'id']);
            }
                ]);
                $control_account_created = $mainAccount->func()->date_format([
                    'created_on' => 'identifier',
                    "'%d-%m-%Y %H:%i'" => 'literal'
                ]);
                $mainAccount->select(['id_main_account', 'main_account_number', 'main_account_name', 'main_account_date' => $control_account_created, 'created_by']);

                $this->set(compact('mainAccount'));
                $this->set('_serialize', ['mainAccount']);
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
                $mainAccount = $this->MainAccount->get($id, [
                    'contain' => []
                ]);

                $this->set('mainAccount', $mainAccount);
                $this->set('_serialize', ['mainAccount']);
            }

            /**
             * Add method
             *
             * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
             */
            public function add() {
                $mainAccount = $this->MainAccount->newEntity();
                $main_accountble = TableRegistry::get('main_account');
                if ($this->request->is('post')) {

                    $query = $main_accountble->find();
                    $query->select(['lastID' => 'max(main_account.id_main_account)']);
                    $last_ID = $query->first();
                    $last_no = $last_ID->lastID + 1;
                    if ($last_no >= 1 && $last_no <= 9) {
                        $main_account_no = "0" . $last_no;
                    } else {
                        $main_account_no = $last_no;
                    }

                    $mainAccount = $this->MainAccount->patchEntity($mainAccount, $this->request->data);
                    $mainAccount->main_account_number = $main_account_no;
                    $mainAccount->main_account_name = $this->request->data['ac_name'];
                    $mainAccount->created_by = $this->request->session()->read('Auth.User.id');

                    if ($this->MainAccount->save($mainAccount)) {
                        $msg = 'Success|The main  control account has been saved';
                    } else {
                        $msg = 'Error|The main control account not saved.Please, try again.';
                    }
                }
                $this->set(compact('mainAccount', 'msg'));
                $this->set('_serialize', ['mainAccount', 'msg']);
            }

            /**
             * Edit method
             *
             * @param string|null $id Main Account id.
             * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
             * @throws \Cake\Network\Exception\NotFoundException When record not found.
             */
            public function edit($id = null) {
                $id = $this->request->data['acc_id'];
                $mainAccount = $this->MainAccount->get($id, [
                    'contain' => []
                ]);
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $mainAccount = $this->MainAccount->patchEntity($mainAccount, $this->request->data);
                    $mainAccount->main_account_name = $this->request->data['ac_name'];
                    if ($this->MainAccount->save($mainAccount)) {
                        $msg = 'Success|The main  control account has been saved';
                    } else {
                        $msg = 'Error|The main control account not saved.Please, try again.';
                    }
                }
                $this->set(compact('mainAccount', 'msg'));
                $this->set('_serialize', ['mainAccount', 'msg']);
            }

            /**
             * Delete method
             *
             * @param string|null $id Main Account id.
             * @return \Cake\Network\Response|null Redirects to index.
             * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
             */
            public function delete($id = null) {
                $id = $this->request->data['id'];
                //  deleting control account
                $control_accountTbl = TableRegistry::get('control_account');
                $control_account = $control_accountTbl->find('all');
                $control_account->where(['main_account_id' => $id]);
                $control_account_id = $control_account->First();
              
                $query = $control_accountTbl->query();
                $query->delete()->where(['main_account_id' => $id])->execute();   
                
                 //  deleting sub control account
                $sub_control_accountTbl = TableRegistry::get('sub_control_account');
                $sub_control_account = $sub_control_accountTbl->find('all');
                $sub_control_account->where(['control_account_id' => $control_account_id['id_control_account']]);
                $sub_control_account_id = $sub_control_account->First();
                
                $query = $sub_control_accountTbl->query();
                $query->delete()->where(['control_account_id' => $control_account_id['id_control_account']])->execute(); 
               
              
                
                 //  deleting transaction account
                $transaction_accountTbl = TableRegistry::get('transaction_account'); // delete all from randsaction accounts
                $query = $transaction_accountTbl->query();
                $query->delete()->where(['sub_control_account_id' => $sub_control_account_id['id_sub_control_account']])->execute();

              

                 
                 //  deleting main account
                $this->request->allowMethod(['post', 'delete']);
                $mainAccount = $this->MainAccount->get($id);
                if ($this->MainAccount->delete($mainAccount)) {


                    $msg = 'Success|The main account has been deleted.';
                } else {
                    $mdg = 'Success|The main account could not be deleted. Please, try again.';
                }

                $this->set(compact('msg'));
                $this->set('_serialize', ['msg']);
            }

        }
        