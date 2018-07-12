<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DownloadSyllabus Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 *
 * @method \App\Model\Entity\DownloadSyllabus get($primaryKey, $options = [])
 * @method \App\Model\Entity\DownloadSyllabus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DownloadSyllabus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DownloadSyllabus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DownloadSyllabus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DownloadSyllabus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DownloadSyllabus findOrCreate($search, callable $callback = null)
 */
class DownloadSyllabusTable extends Table
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

        $this->table('download_syllabus');
        $this->displayField('id_download_syllabus');
        $this->primaryKey('id_download_syllabus');

        $this->belongsTo('Registration', [
            'foreignKey' => 'registration_id'
        ]);
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]);
        $this->belongsTo('Shift', [
            'foreignKey' => 'shift_id'
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
            ->integer('id_download_syllabus')
            ->allowEmpty('id_download_syllabus', 'create');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('download');

        $validator
            ->dateTime('date')
            ->allowEmpty('date');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

       

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
   
}
