<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComplainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComplainsTable Test Case
 */
class ComplainsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ComplainsTable
     */
    public $Complains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.complains',
        'app.campuses',
        'app.users',
        'app.roles',
        'app.departments',
        'app.users',
        'app.employee_department',
        'app.requisitions',
        'app.registrations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Complains') ? [] : ['className' => 'App\Model\Table\ComplainsTable'];
        $this->Complains = TableRegistry::get('Complains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Complains);

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
