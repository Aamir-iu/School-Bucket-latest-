<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoGrn Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pos
 * @property \Cake\ORM\Association\HasMany $PoGrnDetail
 *
 * @method \App\Model\Entity\PoGrn get($primaryKey, $options = [])
 * @method \App\Model\Entity\PoGrn newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PoGrn[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PoGrn|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PoGrn patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PoGrn[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PoGrn findOrCreate($search, callable $callback = null)
 */
class PoGrnTable extends Table
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

        $this->table('po_grn');
        $this->displayField('id_po_grn');
        $this->primaryKey('id_po_grn');

       
        $this->hasMany('PoGrnDetail', [
            'foreignKey' => 'po_grn_id'
        ]);
        
        $this->belongsTo('suppliers', [
            'foreignKey' => 'suppliers_id'
        ]);
        
        $this->belongsTo('PurchaseOrders', [
            'foreignKey' => 'po_id'
        ]);
        
       
        $this->belongsTo('purchase_orders', [
            'foreignKey' => 'po_id'
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
            ->integer('id_po_grn')
            ->allowEmpty('id_po_grn', 'create');

        $validator
            ->allowEmpty('po_number');

        $validator
            ->dateTime('grn_date')
            ->allowEmpty('grn_date');
        
        $validator
            ->integer('grn_created_by')
            ->allowEmpty('grn_created_by');

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
//        $rules->add($rules->existsIn(['po_id'], 'Pos'));
//
//        return $rules;
//    }
}
