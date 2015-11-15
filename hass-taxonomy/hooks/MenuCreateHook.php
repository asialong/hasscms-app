<?php
/**
 * HassCMS (http://www.hassium.org/)
 *
 * @link http://github.com/hasscms for the canonical source repository
 * @copyright Copyright (c) 2016-2099 Hassium Software LLC.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace hass\taxonomy\hooks;

use hass\helpers\Util;
use League\Event\ListenerAcceptorInterface;
use League\Event\ListenerProviderInterface;

use hass\taxonomy\models\Taxonomy;

/**
 *
 * @package hass\package_name
 * @author zhepama <zhepama@gmail.com>
 * @since 1.0
 *       
 */
class MenuCreateHook implements ListenerProviderInterface
{

    public function provideListeners(ListenerAcceptorInterface $acceptor)
    {
        $acceptor->addListener(\hass\menu\Module::EVENT_MENU_LINK_CREATE, [
            $this,
            "onCreateLink"
        ]);
    }

    public function onCreateLink($event)
    {
        $event->parameters->set(\Yii::$app->get("moduleManager")
            ->getModuleModelByClass('hass\taxonomy\Module')->name, [
            $this,
            "createLink"
        ]);
    }

    public function createLink($name, $original)
    {
        $model = Taxonomy::findOne($original);
        if (empty($name)) {
            $name = $model->name;
        }
        
        return [
            $name,
            Util::getEntityUrl($model)
        ];
    }
}