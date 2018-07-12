<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClassesSection Entity
 *
 * @property int $id_class
 * @property string $class_name
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 */
class ClassesSection extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id_class' => false
    ];
}
