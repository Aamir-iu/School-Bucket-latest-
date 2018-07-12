<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccountVoucherDetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TransactionAccounts
 * @property \Cake\ORM\Association\BelongsTo $AccountVouchers
 *
 * @method \App\Model\Entity\AccountVoucherDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\AccountVoucherDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AccountVoucherDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AccountVoucherDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccountVoucherDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AccountVoucherDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AccountVoucherDetail findOrCreate($search, callable $callback = null)
 */
class AccountVoucherDetailsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('account_voucher_details');
        $this->displayField('id_account_voucher_details');
        $this->primaryKey('id_account_voucher_details');
        
        $this->belongsTo('transaction_account', [
            'foreignKey' => 'transaction_account_id'
        ]);
        
         $this->belongsTo('account_voucher', [
            'foreignKey' => 'account_voucher_id'
        ]);
        
        
    }

    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_account_voucher_details')
            ->allowEmpty('id_account_voucher_details', 'create');

        $validator
            ->allowEmpty('transaction_type');

        $validator
            ->decimal('amount')
            ->allowEmpty('amount');

        $validator
            ->allowEmpty('remarks');

        return $validator;
    }

    
}
