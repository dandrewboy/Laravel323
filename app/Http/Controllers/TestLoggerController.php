<?php

namespace App\Http\Controllers;

use App\Utility\ILoggerService;


class TestLoggerController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }
    
    public function index() {
        echo "In index()<br/>";
        $this->logger->info("Entering TestLoggerController.index()");
       echo "Out of index()";
    }
    //
}
