<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inquiry Entity
 *
 * @property int $id_inquery
 * @property string $f_name
 * @property string $l_name
 * @property string $contact
 * @property string $address
 * @property \Cake\I18n\Time $inquery_date
 * @property \Cake\I18n\Time $created_on
 * @property int $creared_by
 */
class Inquiry extends Entity
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
        'id_inquery' => false
    ];
}
