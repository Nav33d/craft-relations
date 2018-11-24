<?php

/**
 * Relations plugin for Craft CMS 3
 *
 * A field type to show reverse related elements
 *
 * @link      https://naveedziarab.co.uk/
 * @copyright Copyright (c) 2018 Nav33d
 */

namespace nav33d\relations\assetbundles;

use Craft;
use craft\web\View;
use craft\helpers\Json;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class RelationsAsset extends AssetBundle
{

  // Public Methods
  // =========================================================================

  /**
   * Initializes the bundle.
   */
  public function init()
  {
      // define the path that your publishable resources live
    $this->sourcePath = "@nav33d/relations/assetbundles/dist";

    // define the dependencies
    $this->depends = [
      CpAsset::class,
    ];

    // define the relative path to CSS/JS files that should be registered with the page
    // when this asset bundle is registered
    $this->js = [
      'js/relations.js',
    ];

    $this->css = [
      'css/relations.css',
    ];

    parent::init();
  }

}
