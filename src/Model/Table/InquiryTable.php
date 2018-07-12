<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inquiry Model
 *
 * @method \App\Model\Entity\Inquiry get($primaryKey, $options = [])
 * @method \App\Model\Entity\Inquiry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Inquiry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inquiry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inquiry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Inquiry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inquiry findOrCreate($search, callable $callback = null)
 */
class InquiryTable extends Table
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

        $this->table('inquiry');
        $this->displayField('id_inquery');
        $this->primaryKey('id_inquery');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'created_by'
        ]);
        
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'for_class_id'
        ]);
        
        $this->belongsTo('area', [
            'foreignKey' => 'area_id'
        ]);
        
        
    }

  
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_inquery')
            ->allowEmpty('id_inquery', 'create');

        $validator
            ->allowEmpty('f_name');

        $validator
            ->allowEmpty('l_name');

        $validator
            ->allowEmpty('contact');

        $validator
            ->allowEmpty('address');

        $validator
            ->date('inquery_date')
            ->allowEmpty('inquery_date');

       

        return $validator;
    }
}
