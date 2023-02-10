<?php

namespace sinri\openai\bridge\web\controller;

use sinri\ark\web\implement\ArkWebController;

class SampleController extends ArkWebController
{
    public function sample()
    {
        $this->_sayOK(["method" => __METHOD__]);
    }
}