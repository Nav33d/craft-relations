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
use craft\db\Query;

use yii\base\Component;

use nav33d\relations\Relations as RelationsPlugin;

class Relations extends Component
{

    public function get($element)
    {
        $relatedElements = [];

        if ( !$element )
        {
            return [];
        }

        $relatedIds = (new Query())
            ->select(['sourceId'])
            ->from(['{{relations}}'])
            ->where(['targetId' => $element->id])
            ->column();

        if ( !$relatedIds )
        {
            return [];
        }

        $elementsService = Craft::$app->elements;
        foreach ( $relatedIds as $id )
        {
            $relatedElement = $elementsService->getElementById($id);

            if ( method_exists($relatedElement, 'getOwner') && $relatedElement->getOwner() )
            {
                while ( method_exists($relatedElement, 'getOwner') )
                {
                    $relatedElement = $relatedElement->getOwner();
                }
            }

            if ( !isset($relatedElements[$relatedElement->id]) )
            {
                $relatedElements[$relatedElement->id] = $relatedElement;
            }
        }

        return $relatedElements;
    }

}
