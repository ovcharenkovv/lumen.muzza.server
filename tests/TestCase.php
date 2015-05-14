<?php

class TestCase extends Laravel\Lumen\Testing\TestCase {

    /**
     * Setup the test environment.
     *
     * @return void
     */

    public function setUp()
    {
        parent::setUp();
        $this->createApplication();
    }

	/**
	 * Creates the application.
	 *
	 * @return \Laravel\Lumen\Application
	 */
	public function createApplication()
	{
		return require __DIR__.'/../bootstrap/app.php';
	}

    /**
     * @return int
     */
    public function generateRandomId()
    {
        return rand(100, 10000);
    }


    /**
     * @param callable $callback
     * @param string $expectedException
     * @param null $expectedCode
     * @param null $expectedMessage
     */
    public function assertException(callable $callback, $expectedException = 'Exception', $expectedCode = null, $expectedMessage = null)
    {
        if (!class_exists($expectedException) && !interface_exists($expectedException)) {
            $this->fail("An exception of type '$expectedException' does not exist.");
        }

        try {
            $callback();
        } catch (\Exception $e) {
            $class = get_class($e);
            $message = $e->getMessage();
            $code = $e->getCode();

            $extraInfo = $message ? " (message was $message, code was $code)" : ($code ? " (code was $code)" : '');
            $this->assertInstanceOf($expectedException, $e, "Failed asserting the class of exception$extraInfo.");

            if ($expectedCode !== null) {
                $this->assertEquals($expectedCode, $code, "Failed asserting code of thrown $class.");
            }
            if ($expectedMessage !== null) {
                $this->assertContains($expectedMessage, $message, "Failed asserting the message of thrown $class.");
            }
            return;
        }

        $extraInfo = $expectedException !== 'Exception' ? " of type $expectedException" : '';
        $this->fail("Failed asserting that exception$extraInfo was thrown.");
    }


}
