<?php
namespace bz4work\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class PrintHeadWidget extends Widget
{
    public $delimiter = ',';
    public $headers;
    private $html;

    public function init()
    {
        parent::init();

        $this->prepare_data();
    }

    public function run()
    {
        return $this->render('printHead', [
            'html' => $this->html,
        ]);
    }

    private function prepare_data()
    {
        if(empty($this->headers) && !is_array($this->headers)) $this->html = null;

        $html = '';
        foreach ($this->headers as $header => $strings) {
            $html .= '<h1>'.Html::encode($header).'</h1>';

            $parts = explode($this->delimiter, $strings);
            foreach ($parts as $part) {

                $part = strip_tags($part);
                $part = htmlspecialchars($part, ENT_QUOTES);

                $html .= $part.'<hr>';
            }
        }

        $this->html = $html;
    }
}