<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SmsLog Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Campuses
 *
 * @method \App\Model\Entity\SmsLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\SmsLog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SmsLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SmsLog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SmsLog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SmsLog findOrCreate($search, callable $callback = null)
 */
class SmsLogTable extends Table
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

        $this->table('sms_log');
        $this->displayField('id_sms_log');
        $this->primaryKey('id_sms_log');

        $this->belongsTo('Campuses', [
            'foreignKey' => 'campus_id'
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
            ->integer('id_sms_log')
            ->allowEmpty('id_sms_log', 'create');

        $validator
            ->allowEmpty('mobile_number');

        $validator
            ->allowEmpty('message');

        $validator
            ->allowEmpty('code');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('no_of_sms')
            ->allowEmpty('no_of_sms');

        $validator
            ->dateTime('sms_date')
            ->allowEmpty('sms_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['campus_id'], 'Campuses'));

        return $rules;
    }
}
