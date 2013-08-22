<?php

namespace SpiffyUserMetadata\Service;

use SpiffyUser\Entity\UserInterface;
use SpiffyUser\Service\AbstractPluginService;
use SpiffyUserMetadata\Plugin\MetadataPluginInterface;

class MetadataService extends AbstractPluginService
{
    /**
     * A list of plugins that are allowed to be registered with this service.
     *
     * @var array
     */
    protected $allowedPluginInterfaces = array(
        'SpiffyUserMetadata\Plugin\MetadataPluginInterface'
    );

    /**
     * Gets all metadata for the specified user.
     *
     * @param UserInterface $user
     * @return array
     */
    public function getMetadata(UserInterface $user)
    {
        $results = $this->getEventManager()->trigger(
            MetadataPluginInterface::EVENT_GET_METADATA,
            $this,
            array(
                'user' => $user,
            )
        );

        return $results->last();
    }

    /**
     * Gets a single metadata value for the specified user.
     *
     * @param UserInterface $user
     * @param string $key
     * @return string
     */
    public function getValue(UserInterface $user, $key)
    {
        $results = $this->getEventManager()->trigger(
            MetadataPluginInterface::EVENT_GET_VALUE,
            $this,
            array(
                'user' => $user,
                'key'  => $key
            )
        );

        return $results->last();
    }
}
