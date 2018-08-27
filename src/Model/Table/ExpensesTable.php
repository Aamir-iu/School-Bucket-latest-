<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * expenses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TransactionAccounts
 *
 * @method \App\Model\Entity\expense get($primaryKey, $options = [])
 * @method \App\Model\Entity\expense newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\expense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\expense|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\expense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\expense[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\expense findOrCreate($search, callable $callback = null)
 */
class ExpensesTable extends Table
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

        $this->table('expenses');
        $this->displayField('id_expanses');
        $this->primaryKey('id_expanses');

        $this->belongsTo('TransactionAccounts', [
            'foreignKey' => 'transaction_account_id'
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'created_by'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_expanses')
            ->allowEmpty('id_expanses', 'create');

        $validator
            ->allowEmpty('expanse_desc');

        $validator
            ->decimal('amount')
            ->allowEmpty('amount');

        $validator
            ->date('expanse_date')
            ->allowEmpty('expanse_date');


        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
   
}
