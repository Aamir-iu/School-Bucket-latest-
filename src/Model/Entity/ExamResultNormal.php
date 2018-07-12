<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamResultNormal Entity
 *
 * @property int $id_exam_marks
 * @property int $registration_id
 * @property int $class_id
 * @property int $shift_id
 * @property int $session_id
 * @property int $exam_type_id
 * @property int $subject_id
 * @property string $max_marks
 * @property string $min_marks
 * @property string $obtained_marks
 * @property float $total_marks
 * @property float $total_obtained
 * @property float $per
 * @property string $grade
 * @property string $rank
 * @property string $remarks
 * @property int $total_attetance
 * @property int $marks_attendance
 *
 * @property \App\Model\Entity\Registration $registration
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 * @property \App\Model\Entity\Session $session
 * @property \App\Model\Entity\ExamType $exam_type
 * @property \App\Model\Entity\Subject $subject
 */
class ExamResultNormal extends Entity
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
        'id_exam_marks' => false
    ];
}
