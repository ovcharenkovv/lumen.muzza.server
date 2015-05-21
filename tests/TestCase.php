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
     * @return string
     */
    public function generateRandomStr($length = 255)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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

    /**
     * Get protected or private method
     *
     * @param $className
     * @param $methodName
     * @return ReflectionMethod
     */
    public function getMethod($className, $methodName)
    {
        $class = new ReflectionClass($className);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }


}
