<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeType Entity
 *
 * @property int $id_fee_type
 * @property string $fee_type_name
 * @property string $status
 *
 * @property \App\Model\Entity\Concession[] $concession
 * @property \App\Model\Entity\Due[] $dues
 * @property \App\Model\Entity\FeeHead[] $fee_heads
 * @property \App\Model\Entity\Fee[] $fees
 */
class FeeType extends Entity
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
        'id_fee_type' => false
    ];
}
