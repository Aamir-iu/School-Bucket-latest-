<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransactionAccount Model
 *
 * @method \App\Model\Entity\TransactionAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\TransactionAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TransactionAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TransactionAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransactionAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionAccount findOrCreate($search, callable $callback = null)
 */
class TransactionAccountTable extends Table
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

        $this->table('transaction_account');
        $this->displayField('id_transaction_account');
        $this->primaryKey('id_transaction_account');
        
        
        $this->belongsTo('users', [
            'foreignKey' => 'transaction_account_createdby'
        ]);
        
        $this->hasMany('sub_control_account', [
            'foreignKey' => 'id_sub_control_account'
        ]);
        
      
        
    }

    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_transaction_account')
            ->allowEmpty('id_transaction_account', 'create');

        $validator
            ->allowEmpty('transaction_account_number');

        $validator
            ->integer('transaction_account_createdby')
            ->allowEmpty('transaction_account_createdby');

        $validator
            ->dateTime('transaction_account_createdon')
            ->allowEmpty('transaction_account_createdon');

        return $validator;
    }
}
