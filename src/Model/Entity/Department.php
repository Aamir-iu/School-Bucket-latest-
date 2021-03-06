<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property int $department_id
 * @property string $department_name
 * @property int $department_manager
 * @property \Cake\I18n\Time $department_created_on
 * @property int $department_created_by
 *
 * @property \App\Model\Entity\Department $department
 */
class Department extends Entity
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
        'department_id' => false
    ];
}
