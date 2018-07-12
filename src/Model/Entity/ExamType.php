<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExamType Entity
 *
 * @property int $id_exam_types
 * @property string $exam_type
 *
 * @property \App\Model\Entity\ExamMarksDetail[] $exam_marks_details
 * @property \App\Model\Entity\ExamResultGo[] $exam_result_go
 * @property \App\Model\Entity\ExamResult[] $exam_results
 */
class ExamType extends Entity
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
        'id_exam_types' => false
    ];
}
