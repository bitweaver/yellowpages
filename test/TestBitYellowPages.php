<?php
require_once('../../bit_setup_inc.php');
require_once(YELLOWPAGES_PKG_PATH.'YellowPages.php');

class TestBitYellowPages extends Test {
    
    var $test;
    var $id;
    var $count;
    
    function TestBitYellowPages()
    {
        global $gBitSystem;
        Assert::equalsTrue($gBitSystem->isPackageActive( 'yellowpages' ), 'Package not active');
    }

    function testCreateItem()
    {
        $this->test = new YellowPages();
        Assert::equalsTrue($this->test != NULL, 'Error during initialisation');
    }

    function testGetItems()
    {
	$filter = array();
        $list = $this->test->getList($filter);
        $this->count = count($list);
        Assert::equalsTrue(is_array($list));
    }

    function testStoreItem()
    {
	$newItemHash = array(
		"title" => "Test Title",
		"description" => "Test Description",
		"data" => "Test Text"
	);
        Assert::equalsTrue($this->test->store($newItemHash));
    }
    
    function testIsValidItem()
    {
        Assert::equalsTrue($this->test->isValid());
    }
    
    function testNullItem()
    {
	$this->id = $this->test->mYellowPagesId;
        $this->test = NULL;
        Assert::equals($this->test, NULL);
    }
    
    function testLoadItem()
    {
        $this->test = new YellowPages($this->id);
        Assert::equals($this->test->load(), 23);
    }

    function testUrlItem()
    {
        Assert::equalsTrue($this->test->getDisplayUrl() != "");
    }

    function testExpungeItem()
    {
        Assert::equalsTrue($this->test->expunge());
    }

    function testCountItems()
    {
	$filter = array();
        $count = count($this->test->getList($filter));
        Assert::equals($this->count, $count);
    }

}
?>
