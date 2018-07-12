<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GalleryDetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MasterGalleries
 *
 * @method \App\Model\Entity\GalleryDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\GalleryDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GalleryDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GalleryDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GalleryDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GalleryDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GalleryDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class GalleryDetailsTable extends Table
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

        $this->table('gallery_details');
        $this->displayField('id_gallery_details');
        $this->primaryKey('id_gallery_details');

        $this->belongsTo('MasterGalleries', [
            'foreignKey' => 'master_gallery_id'
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
            ->integer('id_gallery_details')
            ->allowEmpty('id_gallery_details', 'create');

        $validator
            ->allowEmpty('pic');

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
