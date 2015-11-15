<?php
/**
 *
* HassCMS (http://www.hassium.org/)
*
* @link http://github.com/hasscms for the canonical source repository
* @copyright Copyright (c) 2016-2099 Hassium Software LLC.
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/
namespace hass\urlrule\controllers;

use Yii;
use hass\backend\BaseController;
use hass\helpers\ArrayHelper;
use hass\urlrule\components\UrlRule;
use hass\helpers\Util;

/**
*
* @package hass\package_name
* @author zhepama <zhepama@gmail.com>
* @since 1.0
 */
class DefaultController extends BaseController
{

    public function init()
    {
        parent::init();
        Util::setComponent('appUrlManager', [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                [
                    "class" => UrlRule::className()
                ]
            ]
        ],true);
    }


    public function actions()
    {
        return [
            "delete" => [
                "class" => '\hass\backend\actions\DeleteAction',
                'modelClass' => 'hass\urlrule\models\UrlRule'
            ],
            "index" => [
                "class" => '\hass\backend\actions\IndexAction',
                'modelClass' => 'hass\urlrule\models\UrlRule',
                "query"=>[
                    "orderBy"=>['id' => SORT_DESC]
                ],
                'sort'=>["attributes"=>["name"]],
                "filters"=>["%name"]
            ],
            "update" => [
                "class" => '\hass\backend\actions\UpdateAction',
                'modelClass' => 'hass\urlrule\models\UrlRule'
            ]
        ];
    }

}

?>