<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ExamResultsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ExamResultsController Test Case
 */
class ExamResultsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
