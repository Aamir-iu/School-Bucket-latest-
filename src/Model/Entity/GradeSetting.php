<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GradeSetting Entity
 *
 * @property int $id_grades
 * @property float $per
 * @property float $per_i
 * @property float $per_ii
 * @property float $per_iii
 * @property float $per_iv
 * @property float $per_v
 * @property float $per_vi
 * @property float $per_vii
 * @property string $grade
 * @property string $grade_i
 * @property string $grade_ii
 * @property string $grade_iii
 * @property string $grade_iv
 * @property string $grade_v
 * @property string $grade_vi
 * @property string $grade_vii
 */
class GradeSetting extends Entity
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
        'id_grades' => false
    ];
}
