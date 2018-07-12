<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Registration Entity
 *
 * @property int $id_registration
 * @property string $gr
 * @property string $fmc
 * @property string $student_name
 * @property string $father_name
 * @property string $monther_name
 * @property string $contact1
 * @property string $contact2
 * @property string $contact3
 * @property \Cake\I18n\Time $dob
 * @property \Cake\I18n\Time $doa
 * @property string $nic
 * @property string $address
 * @property string $sex
 * @property string $active
 * @property string $image
 */
class Registration extends Entity
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
        'id_registration' => false
    ];
}
