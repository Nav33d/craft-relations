<?php

/**
 * Relations plugin for Craft CMS 3
 *
 * A field type to show reverse related elements
 *
 * @link      https://naveedziarab.co.uk/
 * @copyright Copyright (c) 2018 Nav33d
 */

namespace nav33d\relations\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;
use craft\helpers\Template;

use nav33d\relations\Relations as RelationsPlugin;
use nav33d\relations\assetbundles\RelationsAsset;

class Relations extends Field
{

    // Static Methods
    // =========================================================================

    /**
     * Returns the display name of this field type.
     *
     * @return string The display name of this field type.
     */
    public static function displayName(): string
    {
        return Craft::t('relations', 'Relations');
    }


    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        return RelationsPlugin::$plugin->relations->get($element);
    }


    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        $view = Craft::$app->getView();

        // Register our asset bundle
        $view->registerAssetBundle(RelationsAsset::class);

        // Get reverse related elements
        $relations = $value;
        if ( !$relations )
        {
            $relations = RelationsPlugin::$plugin->relations->get($element);
        }

        return $view->renderTemplate('relations/fields/relations/_input', [
            'relations' => $relations,
        ]);
    }


}
