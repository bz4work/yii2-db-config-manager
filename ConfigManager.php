<?php
namespace bz4work;


use yii\base\Component;
use yii\base\Exception;

use bz4work\models\Config;
use bz4work\interfaces\IConfigManagerInterface;

class ConfigManager extends Component implements IConfigManagerInterface
{

    private static $instance;

    public static function getInstance()
    {
        if(is_null(static::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    private function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    //get all params
    public function getParams($as_array = true)
    {
        $list = Config::find();

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
            $param->param_value = $this->transformToType($param->param_value, $param->param_type);
        }

        return $param;
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


    //transform value
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