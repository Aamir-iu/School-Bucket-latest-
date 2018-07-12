<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubControlAccount Model
 *
 * @method \App\Model\Entity\SubControlAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\SubControlAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SubControlAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SubControlAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubControlAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SubControlAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SubControlAccount findOrCreate($search, callable $callback = null)
 */
class SubControlAccountTable extends Table
{

   
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('sub_control_account');
        $this->displayField('id_sub_control_account');
        $this->primaryKey('id_sub_control_account');
        
        $this->belongsTo('users', [
            'foreignKey' => 'sub_control_account_createdby'
        ]);
        
         $this->belongsTo('control_account', [
            'foreignKey' => 'control_account_id'
        ]);
         
       
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_sub_control_account')
            ->allowEmpty('id_sub_control_account', 'create');

        $validator
            ->allowEmpty('sub_control_account_number');
        $validator
            ->allowEmpty('control_account_id');

        $validator
            ->integer('sub_control_account_createdby')
            ->allowEmpty('sub_control_account_createdby');

        $validator
            ->dateTime('sub_control_account_createdon')
            ->allowEmpty('sub_control_account_createdon');

        return $validator;
    }
}
