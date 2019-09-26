<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once ('BasicEnum.php');

class EnumStatus extends BasicEnum
{
    const ACTIVE = 1;
    const BLOCKED = 0;
}