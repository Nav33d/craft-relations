<?php

/**
 * Relations plugin for Craft CMS 3
 *
 * A field type to show reverse related elements
 *
 * @link      https://naveedziarab.co.uk/
 * @copyright Copyright (c) 2018 Nav33d
 */

namespace nav33d\relations;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

use nav33d\relations\fields\Relations as RelationsField;

/**
 * @author    Naveed Ziarab
 * @package   Relations
 * @since     1.0.0
 */

class Relations extends Plugin
{
    // Static Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register services
        $this->setComponents([
            'relations' => \nav33d\relations\services\Relations::class,
        ]);

        // Register our field
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = RelationsField::class;
            }
        );
    }

}
