<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InquiryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InquiryTable Test Case
 */
class InquiryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InquiryTable
     */
    public $Inquiry;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inquiry'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Inquiry') ? [] : ['className' => 'App\Model\Table\InquiryTable'];
        $this->Inquiry = TableRegistry::get('Inquiry', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Inquiry);

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
