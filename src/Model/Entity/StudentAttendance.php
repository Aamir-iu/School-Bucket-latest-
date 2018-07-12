<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentAttendance Entity
 *
 * @property int $id_attendance
 * @property int $registration_id
 * @property int $class_id
 * @property int $shift_id
 * @property int $campus_id
 * @property string $status
 * @property \Cake\I18n\Time $attendace_date
 * @property int $created_by
 * @property \Cake\I18n\Time $created_on
 *
 * @property \App\Model\Entity\Registration $registration
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 * @property \App\Model\Entity\Campus $campus
 */
class StudentAttendance extends Entity
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
