<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClassSchedule Entity
 *
 * @property int $id_class_schedule
 * @property int $day_id
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 * @property int $subject_id
 * @property int $class_id
 * @property int $shift_id
 * @property string $desc
 *
 * @property \App\Model\Entity\Day $day
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 */
class ClassSchedule extends Entity
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
        'id_class_schedule' => false
    ];
}
