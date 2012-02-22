<?php

class Seocounter extends CFormModel {

    public $seoCounterName;
    public $seoCounterCode;
    public $seoCounterPlaceInput;
    public $seoCounterLanguageVersion;
    public $placeinput;

    public function init() {
        parent::init();
        $this->placeinput = array(
            "0" => Translater::getDictionary()->seoCounterPlaceInputHEAD,
            "1" => Translater::getDictionary()->seoCounterPlaceInputBeginBody,
            "2" => Translater::getDictionary()->seoCounterPlaceInputEndBody
        );
    }

    public function rules() {
        return array(
            array('seoCounterName,seoCounterCode,seoCounterPlaceInput,seoCounterLanguageVersion', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'seoCounterName' => Translater::getDictionary()->seoCounterNameTitle,
            'seoCounterCode' => Translater::getDictionary()->seoCounterCodeTitle,
            'seoCounterPlaceInput' => Translater::getDictionary()->seoCounterPlaceInputTitle,
            'seoCounterLanguageVersion' => Translater::getDictionary()->seoCounterLanguageVersionTitle,
        );
    }

    public function registrCodeCounter(Content $model) {
        if (($model->locale_id == $this->seoCounterLanguageVersion) || ($this->seoCounterLanguageVersion == 0)) {
          Yii::app()->clientScript->registerScript(md5($this->seoCounterName), $this->seoCounterCode, $this->seoCounterPlaceInput); 
        }
    }

}

?>
