<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * ControlAccount Controller
 *
 * @property \App\Model\Table\ControlAccountTable $ControlAccount
 */
class ControlAccountController extends AppController {

    public function index() {

        $main_account_id = $this->request->params['pass'][0];
        $main_accountTbl = TableRegistry::get('main_account');
        $main_account = $main_accountTbl->find('all');
        $main_account->where(['id_main_account' => $main_account_id]);
        $main_account = $main_account->ToArray();


        $controlAccountTbl = TableRegistry::get('control_account');
        $controlAccount = $controlAccountTbl->find()->contain(['users' => function ($q) {
                return $q
                                ->select(['created_by' => 'full_name', 'id']);
            }
                ]);
                $control_account_created = $controlAccount->func()->date_format([
                    'control_account_createdon' => 'identifier',
                    "'%d-%m-%Y %H:%i'" => 'literal'
                ]);
                $controlAccount->select(['id_control_account', 'control_account_number', 'control_account_name', 'control_account_date' => $control_account_created, 'control_account_createdby']);
                $controlAccount->where(['main_account_id' => $main_account_id]);
                $this->set(compact('controlAccount', 'main_account'));
                $this->set('_serialize', ['controlAccount', 'main_account']);
            }

            public function isAuthorized($user) {
                $action = $this->request->params['action'];

                // The add and index actions are always allowed.
                if (in_array($action, ['index', 'add', 'edit', 'view', 'delete'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
                    return true;
                }
                // All other actions require an id.
                if (empty($this->request->params['pass'][0])) {
                    return false;
                }
                return parent::isAuthorized($user);
            }

            public function view($id = null) {
                $controlAccount = $this->ControlAccount->get($id, [
                    'contain' => []
                ]);

                $this->set('controlAccount', $controlAccount);
                $this->set('_serialize', ['controlAccount']);
            }

            public function add() {


                $controlAccount = $this->ControlAccount->newEntity();
                $ControlAccountTbl = TableRegistry::get('control_account');
                if ($this->request->is('post')) {

                    $query = $ControlAccountTbl->find();
                    $query->select(['lastID' => 'max(control_account.id_control_account)']);
                    $last_ID = $query->first();
                    $last_no = $last_ID->lastID + 1;
                    if ($last_no >= 1 && $last_no <= 9) {
                        $control_account_no = "00" . $last_no;
                    } elseif ($last_no >= 10 && $last_no <= 99) {
                        $control_account_no = "0" . $last_no;
                    } else {
                        $control_account_no = $last_no;
                    }


                    $controlAccount = $this->ControlAccount->patchEntity($controlAccount, $this->request->data);
                    $controlAccount->control_account_number = $control_account_no;
                    $controlAccount->main_account_id = $this->request->data['ACno'];
                    $controlAccount->control_account_name = $this->request->data['ac_name'];
                    $controlAccount->control_account_createdby = $this->request->session()->read('Auth.User.id');
                    if ($this->ControlAccount->save($controlAccount)) {
                        $msg = 'Success|The control account has been saved';
                    } else {
                        $msg = 'Error|The control account not saved.Please, try again.';
                    }
                }
                $this->set(compact('msg'));
                $this->set('_serialize', ['msg']);
            }

            public function edit($id = null) {
                $id = $this->request->data['acc_id'];

                $controlAccount = $this->ControlAccount->get($id, [
                    'contain' => []
                ]);
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $controlAccount = $this->ControlAccount->patchEntity($controlAccount, $this->request->data);

                    $controlAccount->control_account_number = $this->request->data['controlaccountid'];
                    $controlAccount->control_account_name = $this->request->data['acc_name'];

                    if ($this->ControlAccount->save($controlAccount)) {
                        $msg = "Success|The control account has been saved";
                    } else {
                        $msg = "Error|The control account not saved.Please, try again.";
                    }
                }
                $this->set(compact('msg'));
                $this->set('_serialize', ['msg']);
            }

            /**
             * Delete method
             *
             * @param string|null $id Control Account id.
             * @return \Cake\Network\Response|null Redirects to index.
             * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
             */
            public function delete($id = null) {
                $id = $this->request->data['id'];

             
                //  deleting sub control account
                $sub_control_accountTbl = TableRegistry::get('sub_control_account');
                $sub_control_account = $sub_control_accountTbl->find('all');
                $sub_control_account->where(['control_account_id' => $id]);
                $sub_control_account_id = $sub_control_account->First();

                $query = $sub_control_accountTbl->query();
                $query->delete()->where(['control_account_id' => $id])->execute();



                //  deleting transaction account
                $transaction_accountTbl = TableRegistry::get('transaction_account'); // delete all from randsaction accounts
                $query = $transaction_accountTbl->query();
                $query->delete()->where(['sub_control_account_id' => $sub_control_account_id['id_sub_control_account']])->execute();


                $this->request->allowMethod(['post', 'delete']);
                $controlAccount = $this->ControlAccount->get($id);
                if ($this->ControlAccount->delete($controlAccount)) {
                    $msg = 'Success|The control account has been deleted.';
                } else {
                    $msg = 'Success|The control account could not be deleted. Please, try again.';
                }

                $this->set(compact('msg'));
                $this->set('_serialize', ['msg']);
            }

        }
        