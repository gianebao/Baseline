<?php
namespace Lib/Unit;

class Report
{
    /**
     * Displays a message for each action being done.
     **/
    public $verbose = true;
    public $summary = array();
    
    private function say($msg)
    {
        if ($this->verbose)
        {
            echo "\n", $msg;
        }
    }
    
    private function setResultFromTest(&$resultItem, &$test)
    {
        $resultItem = array(
                'function' => $test->getFnName(),
                'status' => $test->getStatus(),
                'performance' => $test->getPerformance(),
                'result' => $test->getResult()
            );
        
        $this->say('== Status: ' . ($resultItem['status'] ? 'SUCCESS': 'FAILED'));
        $this->say('== Performance: ' . $resultItem['performance'] . ' ms');
    }
    
    public function addTest(Test $unit, $desc, $set = array())
    {
        $resultItem = array('description' => $desc);
        $this->say('# ' . $resultItem['description']);
        
        $set = is_array($set) ? $set: array($set);
        
        if (!empty($set['BASE']))
        {
            $base = $unit->run($set['BASE']);
            unset($set['BASE']);
            $this->say('Testing [Base]: ' . $base->getFnName());
            $this->setResultFromTest($resultItem['test']['BASE'], $base);
        }
        
        for ($i = 0, $count = count($set); $i < $count; $i++)
        {
            $test = $unit->run($set[$i]);
            $this->say('Testing: ' . $test->getFnName());
            $this->setResultFromTest($resultItem['test'][$i], $test);
            $resultItem['test'][$i]['efficiency'] = $test->compareEff($base);
            $this->say('== Efficiency: ' . $resultItem['test'][$i]['efficiency'] . ' %');
        }
        
        $this->summary[] = $resultItem;
    }
}
