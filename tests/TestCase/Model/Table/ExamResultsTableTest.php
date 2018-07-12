<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamResultsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamResultsTable Test Case
 */
class ExamResultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamResultsTable
     */
    public $ExamResults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exam_results',
        'app.classes',
        'app.shifts',
        'app.exam_types',
        'app.subjects',
        'app.orders',
        'app.scheduler',
        'app.employees',
        'app.users',
        'app.roles',
        'app.campuses',
        'app.departments',
        'app.users',
        'app.employee_department',
        'app.requisitions',
        'app.subjects',
        'app.classes_sections'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExamResults') ? [] : ['className' => 'App\Model\Table\ExamResultsTable'];
        $this->ExamResults = TableRegistry::get('ExamResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExamResults);

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
