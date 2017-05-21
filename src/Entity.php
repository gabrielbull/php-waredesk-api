<?php

namespace Waredesk;

interface Entity
{
    public function reset(array $data = null);
    public function __clone();
}
