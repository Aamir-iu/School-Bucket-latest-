<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RemarksForStudent Entity
 *
 * @property int $id_remarks_for_students
 * @property int $registration_id
 * @property int $class_id
 * @property int $shift_id
 * @property float $Attitude
 * @property float $Behavior
 * @property float $Character
 * @property float $Communicationskills
 * @property float $Groupwork
 * @property float $interestsandtalents
 * @property float $participation
 * @property float $socialskills
 * @property float $timemanagement
 * @property float $workhabits
 * @property float $date
 *
 * @property \App\Model\Entity\Registration $registration
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 */
class RemarksForStudent extends Entity
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
        'id_remarks_for_students' => false
    ];
}
