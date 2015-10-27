<?php

namespace entityfx\utils\ioc;

interface IIocComponent {
    const COMPONENT_NAME = 'ioc';

    public function getContainer();
}