<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.06.15
 * Time: 22:26
 */

namespace entityfx\utils;


use yii\base\Component;
use yii\base\Event;

class ComponentBase extends Component {

    /**
     * ioc container
     *
     * @var Container
     */
    protected $ioc;

    public function triggerComponentEvent($name, Event $event, Component $component) {
        if ($component === null) return;
        $component->trigger($name, $event);
    }
}