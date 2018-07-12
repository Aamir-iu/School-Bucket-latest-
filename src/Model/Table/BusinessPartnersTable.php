<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessPartners Model
 *
 * @property \Cake\ORM\Association\BelongsTo $RelatedTables
 *
 * @method \App\Model\Entity\BusinessPartner get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessPartner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BusinessPartner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessPartner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessPartner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessPartner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessPartner findOrCreate($search, callable $callback = null)
 */
class BusinessPartnersTable extends Table
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

        $this->table('business_partners');
        $this->displayField('id_business_type');
        $this->primaryKey('id_business_type');

        $this->belongsTo('RelatedTables', [
            'foreignKey' => 'related_table_id'
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
            ->integer('id_business_type')
            ->allowEmpty('id_business_type', 'create');

        $validator
            ->allowEmpty('business_type');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->allowEmpty('related_table');

        $validator
            ->allowEmpty('related_table_field');

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
        $rules->add($rules->existsIn(['related_table_id'], 'RelatedTables'));

        return $rules;
    }
}
