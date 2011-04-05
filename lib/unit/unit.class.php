<?php
namespace Lib/Unit;

class Test
{
    /**
     * Parameters being used by the function to be tested.
     * @access private
     **/
    private $subject = array();
    
    /**
     * Expected result of a test.
     * @access private
     **/
    private $result = null;

    /**
     *
     * @param mixed $result expected result from a test.
     * @param mixed $subject parameters being used in each test.
     **/
    public function __construct()
    {
        $this->subject = func_get_args();
        
        $this->result = array_shift($this->subject);
        
        //$this->show('Subject: ' . implode(', ', $this->subject));
        //$this->show('Expecting: ' . $this->result);
    }
    
    public function run($fnName)
    {
        $ms = array_sum(explode(' ', microtime())); // setting the start time.
        $fnResult = call_user_func_array($fnName, $this->subject);
        
        $result = new TestResult(
            is_array($fnName) ? implode('::', $fnName): $fnName,
            $fnResult,
            round((array_sum(explode(' ', microtime())) - $ms) * 1000, 4),
            $this->result === $fnResult);
        
        return $result;
    }
}
