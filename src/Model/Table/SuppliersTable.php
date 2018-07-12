<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Suppliers Model
 *
 * @method \App\Model\Entity\Supplier get($primaryKey, $options = [])
 * @method \App\Model\Entity\Supplier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Supplier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Supplier|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier findOrCreate($search, callable $callback = null)
 */
class SuppliersTable extends Table
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

        $this->table('suppliers');
        $this->displayField('id_suppliers');
        $this->primaryKey('id_suppliers');
        
        $this->hasMany('PurchaseOrders', [
            'foreignKey' => 'id_suppliers'
        ]);
        
        $this->hasMany('SupplierProducts', [
            'foreignKey' => 'id_suppliers'
        ]);
        
        
    }

  
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_suppliers')
            ->allowEmpty('id_suppliers', 'create');

        $validator
            ->allowEmpty('supplier_name');

        $validator
            ->allowEmpty('supplier_address');

        $validator
            ->allowEmpty('contact_person');

        $validator
            ->allowEmpty('phone1');

        $validator
            ->allowEmpty('phone2');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('website');

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
//        $rules->add($rules->isUnique(['email']));
//
//        return $rules;
//    }
}
