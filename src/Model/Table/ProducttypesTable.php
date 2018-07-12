<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Producttypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Types
 *
 * @method \App\Model\Entity\Producttype get($primaryKey, $options = [])
 * @method \App\Model\Entity\Producttype newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Producttype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Producttype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producttype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Producttype[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Producttype findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProducttypesTable extends Table
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

        $this->table('producttypes');
        $this->displayField('type_id');
        $this->primaryKey('type_id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Products', [
            'className' => 'Products',
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
            ->allowEmpty('type_name');

        $validator
            ->allowEmpty('type_desc');

        return $validator;
    }


}
