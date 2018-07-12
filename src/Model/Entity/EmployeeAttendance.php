<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeAttendance Entity
 *
 * @property int $id_attendance
 * @property int $employee_id
 * @property int $id_department
 * @property string $status
 * @property \Cake\I18n\Time $attendace_date
 * @property \Cake\I18n\Time $attendance_time
 * @property int $created_by
 * @property \Cake\I18n\Time $created_on
 *
 * @property \App\Model\Entity\Employee $employee
 */
class EmployeeAttendance extends Entity
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
        'id_attendance' => false
    ];
}
