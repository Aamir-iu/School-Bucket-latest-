<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MainAccount Model
 *
 * @method \App\Model\Entity\MainAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\MainAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MainAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MainAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MainAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MainAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MainAccount findOrCreate($search, callable $callback = null)
 */
class MainAccountTable extends Table
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

        $this->table('main_account');
        $this->displayField('id_main_account');
        $this->primaryKey('id_main_account');
        
        $this->belongsTo('users', [
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
            ->integer('id_main_account')
            ->allowEmpty('id_main_account', 'create');

        $validator
            ->integer('main_account_number')
            ->allowEmpty('main_account_number');

        $validator
            ->allowEmpty('main_account_name');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

//        $validator
//            ->dateTime('created_on')
//            ->requirePresence('created_on', 'create')
//            ->notEmpty('created_on');

        return $validator;
    }
}
