<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamMarksDetail Entity
 *
 * @property int $id_marks_detail
 * @property int $class_id
 * @property int $shift_id
 * @property int $session_id
 * @property int $subject_id
 * @property int $min_marks
 * @property int $max_marks
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 * @property \App\Model\Entity\Session $session
 * @property \App\Model\Entity\Subject $subject
 */
class ExamMarksDetail extends Entity
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
        'id_marks_detail' => false
    ];
}
