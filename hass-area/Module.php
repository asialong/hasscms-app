<?php
/**
 *
 * HassCMS (http://www.hassium.org/)
 *
 * @link http://github.com/hasscms for the canonical source repository
 * @copyright Copyright (c) 2016-2099 Hassium Software LLC.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace hass\area;

use hass\backend\BaseModule;
use hass\helpers\Hook;
use yii\base\BootstrapInterface;
use Yii;

/**
 *
 * @package hass\package_name
 * @author zhepama <zhepama@gmail.com>
 * @since 1.0
 */
class Module extends BaseModule implements BootstrapInterface
{

    const EVENT_BLOCK_TYPE = "EVENT_BLOCK_TYPE";

    const DEFAULT_BLOCK_TYPE = "text";

    public function init()
    {
        parent::init();
    }

    public function bootstrap($backend)
    {
        Hook::on(\hass\system\Module::EVENT_SYSTEM_GROUPNAV, [
            $this,
            "onSetGroupNav"
        ]);
        
        Hook::on(\hass\area\Module::EVENT_BLOCK_TYPE, [
            $this,
            "onBlockModule"
        ]);
    }

    public function onBlockModule($event)
    {
        $event->parameters->set("text", [
            "nav" => [
                'label' => "文本块"
            ],
            "model" => "hass\\area\\models\\TextForm",
            "view" => "@hass/area/views/hooks/block-text.php",
            "widget" => 'hass\area\widgets\TextWidget'
        ]);
    }

    /**
     *
     * @param \hass\helpers\Event $event            
     */
    public function onSetGroupNav($event)
    {
        $model = \Yii::$app->get("moduleManager")->getModuleModel($this->id);
        $event->parameters->set($model->group, [
            [
                'label' => "区域",
                'icon' => "fa-circle-o",
                'url' => [
                    "/$this->id/default/index"
                ]
            ],
            [
                'label' => "区块",
                'icon' => "fa-circle-o",
                'url' => [
                    "/$this->id/block/index"
                ]
            ]
        ]);
    }
}

?>