<?php

namespace common\widgets;

use Yii;
use yii\base\InvalidConfigException;
use kartik\grid\GridView;

class ActionColumn extends \kartik\grid\ActionColumn
{
    public $template = '{update} {delete}';
    public $width = '60px';
    public $viewOptions = [
        'label' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-edit">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M11.192 17.966c-3.242 -.28 -5.972 -2.269 -8.192 -5.966c2.4 -4 5.4 -6 9 -6c3.326 0 6.14 1.707 8.442 5.122" />
                        <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                    </svg>',
        'data-bs-toggle' => 'tooltip',
        'data-bs-placement' => 'top',
    ];
    public $updateOptions = [
        'label' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                       <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                    </svg>',
        'data-bs-toggle' => 'tooltip',
        'data-bs-placement' => 'top',
    ];
    public $deleteOptions = [
        'label' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <line x1="4" y1="7" x2="20" y2="7"></line>
                       <line x1="10" y1="11" x2="10" y2="17"></line>
                       <line x1="14" y1="11" x2="14" y2="17"></line>
                       <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                       <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                    </svg>',
        'data-bs-toggle' => 'tooltip',
        'data-bs-placement' => 'top',
    ];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {

        $this->initColumnSettings([
            'hiddenFromExport' => true,
            'mergeHeader' => true,
            'hAlign' => GridView::ALIGN_RIGHT,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'width' => '80px',
        ]);

        parent::init();
    }
}
