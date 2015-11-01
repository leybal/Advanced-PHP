<?php

namespace Layer\Connector;

/**
 * Interface ConnectorInterface
 * @package Layer\Connector
 */
interface ConnectorInterface
{
    /**
     * @return mixed
     */
    public function connect();

    /**
     * @return mixed
     */
    public function connectClose();
}