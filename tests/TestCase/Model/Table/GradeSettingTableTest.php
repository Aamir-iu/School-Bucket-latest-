<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GradeSettingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GradeSettingTable Test Case
 */
class GradeSettingTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GradeSettingTable
     */
    public $GradeSetting;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.grade_setting'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GradeSetting') ? [] : ['className' => 'App\Model\Table\GradeSettingTable'];
        $this->GradeSetting = TableRegistry::get('GradeSetting', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GradeSetting);

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
