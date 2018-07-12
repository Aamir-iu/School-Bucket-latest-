<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassesSectionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassesSectionsTable Test Case
 */
class ClassesSectionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClassesSectionsTable
     */
    public $ClassesSections;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('ClassesSections') ? [] : ['className' => 'App\Model\Table\ClassesSectionsTable'];
        $this->ClassesSections = TableRegistry::get('ClassesSections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClassesSections);

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
}
