<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GeneralSetting Model
 *
 * @method \App\Model\Entity\GeneralSetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\GeneralSetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GeneralSetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GeneralSetting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GeneralSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GeneralSetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GeneralSetting findOrCreate($search, callable $callback = null)
 */
class GeneralSettingTable extends Table
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

        $this->table('general_setting');
        $this->displayField('id_general_setting');
        $this->primaryKey('id_general_setting');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
//        $validator
//            ->integer('id_general_setting')
//            ->allowEmpty('id_general_setting', 'create');
//
//        $validator
//            ->allowEmpty('Institution_Name');
//
//        $validator
//            ->allowEmpty('Institution_Address');
//
//        $validator
//            ->allowEmpty('Institution_Email');
//
//        $validator
//            ->allowEmpty('Institution_Phone');
//
//        $validator
//            ->allowEmpty('Institution_Mobile');
//
//        $validator
//            ->allowEmpty('Institution_Fax');
//
//        $validator
//            ->allowEmpty('Admin_Contact_Person');
//
//        $validator
//            ->integer('Country')
//            ->allowEmpty('Country');
//
//        $validator
//            ->integer('Currency_Type')
//            ->allowEmpty('Currency_Type');
//
//        $validator
//            ->allowEmpty('Language');
//
//        $validator
//            ->allowEmpty('Timezone');

//        $validator
//            ->dateTime('created_on')
//            ->requirePresence('created_on', 'create')
//            ->notEmpty('created_on');
//
//        $validator
//            ->integer('created_by')
//            ->allowEmpty('created_by');
//
//        $validator
//            ->allowEmpty('logo');

        return $validator;
    }
}
