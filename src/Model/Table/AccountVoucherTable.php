<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccountVoucher Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AccountVoucherTypes
 *
 * @method \App\Model\Entity\AccountVoucher get($primaryKey, $options = [])
 * @method \App\Model\Entity\AccountVoucher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AccountVoucher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AccountVoucher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccountVoucher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AccountVoucher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AccountVoucher findOrCreate($search, callable $callback = null)
 */
class AccountVoucherTable extends Table
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

        $this->table('account_voucher');
        $this->displayField('id_account_voucher');
        $this->primaryKey('id_account_voucher');

        $this->hasMany('account_voucher_details', [
            'foreignKey' => 'account_voucher_id',

        ]);
        
        $this->belongsTo('account_voucher_type', [
            'foreignKey' => 'account_voucher_type_id',

        ]);
        
        
        
        
    }

    
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_account_voucher')
            ->allowEmpty('id_account_voucher', 'create');

        $validator
            ->integer('voucher_number')
            ->requirePresence('voucher_number', 'create')
            ->notEmpty('voucher_number');

        $validator
            ->dateTime('voucher_date')
            ->requirePresence('voucher_date', 'create')
            ->notEmpty('voucher_date');

//        $validator
//            ->dateTime('created_on')
//            ->requirePresence('created_on', 'create')
//            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->allowEmpty('description');

        $validator
            ->requirePresence('voucher_status', 'create')
            ->notEmpty('voucher_status');

//        $validator
//            ->dateTime('cancellation_date')
//            ->allowEmpty('cancellation_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
//    public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->existsIn(['account_voucher_type_id'], 'AccountVoucherTypes'));
//
//        return $rules;
//    }
}
