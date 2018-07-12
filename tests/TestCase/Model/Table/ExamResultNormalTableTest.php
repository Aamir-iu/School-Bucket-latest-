<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamResultNormalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamResultNormalTable Test Case
 */
class ExamResultNormalTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamResultNormalTable
     */
    public $ExamResultNormal;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exam_result_normal',
        'app.registrations',
        'app.classes',
        'app.shifts',
        'app.sessions',
        'app.exam_types',
        'app.exam_marks_details',
        'app.classes_sections',
        'app.users',
        'app.roles',
        'app.campuses',
        'app.subjects',
        'app.orders',
        'app.scheduler',
        'app.employees',
        'app.departments',
        'app.users',
        'app.employee_department',
        'app.requisitions',
        'app.subjects',
        'app.exam_types',
        'app.exam_result_go',
        'app.exam_results',
        'app.registration',
        'app.students_master_details',
        'app.registration',
        'app.exam_results',
        'app.shift',
        'app.session',
        'app.exam_result_detail',
        'app.campuses',
        'app.admin_card_datesheet'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExamResultNormal') ? [] : ['className' => 'App\Model\Table\ExamResultNormalTable'];
        $this->ExamResultNormal = TableRegistry::get('ExamResultNormal', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExamResultNormal);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
