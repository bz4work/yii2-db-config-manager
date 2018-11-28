<?php

namespace bz4work;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bz4work/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'main.css',
    ];

    public $js = [
        'main.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
