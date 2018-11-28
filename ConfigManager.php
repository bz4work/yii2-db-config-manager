<?php
namespace bz4work;


use yii\base\Component;
use yii\base\Exception;

use bz4work\Models\Config;
use bz4work\Interfaces\IConfigManagerInterface;

class ConfigManager extends Component implements IConfigManagerInterface
{
    //замутить Dependency Injection
    protected $model;

    //get all
    public function getParams($only_enabled = true, $as_array = true)
    {
        $list = Config::find();

        if($only_enabled === true){
            $list->where(['id' => 1]);
        }

        if($as_array === true){
            $list->asArray();
        }

        return $list->all();
    }

    //get param from DB
    public function get($name)
    {
        $param = Config::findOne(['param_name' => $this->cStr($name)]);

        if(!empty($param->id)){
            return $this->transformToType($param->param_value, $param->param_type);
        }

        return false;
    }

    //set param into DB
    public function set($name, $value, $type = 'TEXT')
    {
        $method = 'insert';
        $response = null;

        if(empty($type)){
            throw new Exception('Type cannot be empty.');
        }

        $exist_param = Config::findOne(['param_name' => $this->cStr($name)]);
        if(!empty($exist_param->id)){
            $method = 'update';
        }

        if($method === 'update'){//update exists record
            $exist_param->param_type = strtoupper(trim((string)$type));
            $exist_param->param_value = $value;
            $response = $exist_param->save();
        }else{//insert new record
            $new_param = new Config();
            $new_param->param_name = $this->cStr($name);
            $new_param->param_value = $value;
            $new_param->param_type = strtoupper(trim((string)$type));
            $response = $new_param->save();
        }

        return $response;
    }

    //clear_string
    protected function cStr($string)
    {
        return trim((string)$string);
    }


    //преобразовует значение в нужный тип
    public function transformToType($value, $type)
    {
        switch($type){
            case 'TEXT': return (string)$value; break;
            case 'INT': return (int)$value; break;
            case 'FLOAT': return (float)$value; break;
            default:
                throw new Exception('Unknown param type.');
        }
    }



}