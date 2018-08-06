<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Registration Model
 *
 * @method \App\Model\Entity\Registration get($primaryKey, $options = [])
 * @method \App\Model\Entity\Registration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Registration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Registration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Registration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Registration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Registration findOrCreate($search, callable $callback = null)
 */
class RegistrationTable extends Table
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

        $this->table('registration');
        $this->displayField('id_registration');
        $this->primaryKey('id_registration');
        
        $this->hasMany('students_master_details', [
            'foreignKey' => 'registration_id'
        ]);
        
        
        $this->hasMany('exam_results', [
            'foreignKey' => 'id_registration'
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
//        $validator
//            ->integer('id_registration')
//            ->allowEmpty('id_registration', 'create');
//
//        $validator
//            ->allowEmpty('gr');
//
//        $validator
//            ->allowEmpty('fmc');
//
//        $validator
//            ->allowEmpty('student_name');
//
//        $validator
//            ->allowEmpty('father_name');
//
//        $validator
//            ->allowEmpty('monther_name');
//
//        $validator
//            ->allowEmpty('contact1');
//
//        $validator
//            ->allowEmpty('contact2');
//
//        $validator
//            ->allowEmpty('contact3');
//        $validator
//            ->allowEmpty('phone');
//
//        $validator
//            ->dateTime('dob')
//            ->allowEmpty('dob');
//
//        $validator
//            ->dateTime('doa')
//            ->allowEmpty('doa');
//
//        $validator
//            ->allowEmpty('nic');
//
//        $validator
//            ->allowEmpty('address');
//
//        $validator
//            ->allowEmpty('sex');
//
//        $validator
//            ->allowEmpty('active');
//
//     

        return $validator;
    }
}
