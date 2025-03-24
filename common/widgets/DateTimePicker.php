<?php

namespace common\widgets;

use kartik\base\Lib;
use yii\base\InvalidConfigException;
use yii\helpers\FormatConverter;

class DateTimePicker extends \kartik\datetime\DateTimePicker
{
    public $pickerIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                       <line x1="16" y1="3" x2="16" y2="7"></line>
                       <line x1="8" y1="3" x2="8" y2="7"></line>
                       <line x1="4" y1="11" x2="20" y2="11"></line>
                       <line x1="11" y1="15" x2="12" y2="15"></line>
                       <line x1="12" y1="15" x2="12" y2="18"></line>
                    </svg>';

    public $removeIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <line x1="18" y1="6" x2="6" y2="18"></line>
                       <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>';

}