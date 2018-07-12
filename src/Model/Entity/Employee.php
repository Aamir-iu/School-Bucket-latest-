<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $employee_id
 * @property int $user_id
 * @property string $employee_name
 * @property string $employee_address
 * @property string $employee_no
 * @property string $employee_email
 * @property string $employee_phone1
 * @property string $employee_phone2
 * @property string $employee_pic
 * @property int $employee_created_by
 * @property \Cake\I18n\Time $employee_created_on
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\User $user
 */
class Employee extends Entity
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
        'employee_id' => false
    ];
}
