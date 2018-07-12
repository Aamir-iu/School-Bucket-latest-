<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeSalary Entity
 *
 * @property int $id_employee_salary
 * @property int $employee_id
 * @property float $basic_salary
 * @property int $working_days
 * @property float $per_day_salary
 * @property float $extra_amount
 * @property float $late
 * @property float $absents
 * @property float $detect_salary
 * @property float $installment
 * @property float $gross_salary
 * @property float $PFA
 * @property float $Net_salary
 * @property int $salary_month
 * @property int $salary_year
 * @property \Cake\I18n\Time $salary_date
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Employee $employee
 */
class EmployeeSalary extends Entity
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
        'id_employee_salary' => false
    ];
}
