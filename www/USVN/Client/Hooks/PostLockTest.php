<?php
// Call USVN_Client_Hooks_PostLockTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_Client_Hooks_PostLockTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_Client_Hooks_PostLock.
 * Generated by PHPUnit_Util_Skeleton on 2007-03-10 at 18:50:17.
 */
class USVN_Client_Hooks_PostLockTest extends USVN_Client_Hooks_HookTest {
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_Client_Hooks_PostLockTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hook = new USVN_Client_Hooks_PostLock('tests/tmp/testrepository', 'titi', 'test');
		$this->setHttp();
    }

    public function test_postLock()
    {
		$this->setServerResponseTo(0);
		$this->hook->send();
        $request  = $this->hook->getLastRequest();
        $this->assertEquals('usvn.client.hooks.postLock', $request->getMethod());
        $this->assertSame(array('007', 'titi', 'test'), $request->getParams());
    }
}

// Call USVN_Client_Hooks_PostLockTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_Client_Hooks_PostLockTest::main") {
    USVN_Client_Hooks_PostLockTest::main();
}
?>