<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamResult Entity
 *
 * @property int $id_exam
 * @property int $class_id
 * @property int $shift_id
 * @property int $exam_type_id
 * @property int $subject_id
 * @property string $subject_name
 * @property string $mm
 * @property string $pm
 * @property string $mo
 * @property float $per
 * @property string $grade
 * @property string $rank
 * @property string $result
 *
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 * @property \App\Model\Entity\ExamType $exam_type
 * @property \App\Model\Entity\Subject $subject
 */
class ExamResult extends Entity
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
        'id_exam' => false
    ];
}
