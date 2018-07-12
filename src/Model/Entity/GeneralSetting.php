<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GeneralSetting Entity
 *
 * @property int $id_general_setting
 * @property string $Institution_Name
 * @property string $Institution_Address
 * @property string $Institution_Email
 * @property string $Institution_Phone
 * @property string $Institution_Mobile
 * @property string $Institution_Fax
 * @property string $Admin_Contact_Person
 * @property int $Country
 * @property int $Currency_Type
 * @property string $Language
 * @property string $Timezone
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property string $logo
 */
class GeneralSetting extends Entity
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
        'id_general_setting' => false
    ];
}
