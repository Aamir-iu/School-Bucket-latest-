<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ControlAccount Model
 *
 * @method \App\Model\Entity\ControlAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\ControlAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ControlAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ControlAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ControlAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ControlAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ControlAccount findOrCreate($search, callable $callback = null)
 */
class ControlAccountTable extends Table
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

        $this->table('control_account');
        $this->displayField('id_control_account');
        $this->primaryKey('id_control_account');
        
        
        $this->belongsTo('users', [
            'foreignKey' => 'control_account_createdby'
        ]);
        
      
        
        
        
    }

    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_control_account')
            ->allowEmpty('id_control_account', 'create');

        $validator
            ->allowEmpty('control_account_number');

        $validator
            ->dateTime('control_account_createdon')
            ->allowEmpty('control_account_createdon');

        $validator
            ->allowEmpty('control_account_createdby');

        return $validator;
    }
}
