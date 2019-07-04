<?php

namespace App\System;

interface CPUInterface
{
    public function getRoot();

    public function getInfo();

    public function getLoad();
}