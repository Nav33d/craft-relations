<?php

/**
 * Relations plugin for Craft CMS 3
 *
 * A field type to show reverse related elements
 *
 * @link      https://naveedziarab.co.uk/
 * @copyright Copyright (c) 2018 Nav33d
 */

namespace nav33d\relations\services;

use Craft;
use craft\elements\Entry;
use craft\elements\Category;
use craft\elements\User;
use craft\elements\Asset;

use yii\base\Component;

use nav33d\relations\Relations as RelationsPlugin;

class Relations extends Component
{

    public function get($element)
    {
        if (!$element) {
            return [];
        }

        return array_merge(
            Entry::find()->relatedTo(["targetElement" => $element])->all(),
            Category::find()->relatedTo(["targetElement" => $element])->all(),
            Asset::find()->relatedTo(["targetElement" => $element])->all(),
            User::find()->relatedTo(["targetElement" => $element])->all()
        );
    }

}
