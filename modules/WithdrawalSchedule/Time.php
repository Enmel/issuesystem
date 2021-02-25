<?php

namespace Modules\WithdrawalSchedule;

class Time
{
    public string $value;

    public function __construct(String $timeString)
    {
        if(!preg_match("/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9]):([0-5]?[0-9])$/", $timeString)){
            if(!preg_match("/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/", $timeString)){
                throw new \Exception("Formato invalido. Debe coincidir con hh:mm o hh:mm:ss", 1);
            }
        }

        $this->value = $timeString;
    }
}