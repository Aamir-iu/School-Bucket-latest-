<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterGallery Model
 *
 * @property \Cake\ORM\Association\HasMany $GalleryDetails
 *
 * @method \App\Model\Entity\MasterGallery get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterGallery newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterGallery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterGallery|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterGallery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterGallery[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterGallery findOrCreate($search, callable $callback = null, $options = [])
 */
class MasterGalleryTable extends Table
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

        $this->table('master_gallery');
        $this->displayField('id_master_gallery');
        $this->primaryKey('id_master_gallery');

        $this->hasMany('GalleryDetails', [
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
            ->integer('id_master_gallery')
            ->allowEmpty('id_master_gallery', 'create');

        $validator
            ->allowEmpty('desc');

        return $validator;
    }
}
