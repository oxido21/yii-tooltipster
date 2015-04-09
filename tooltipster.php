<?php

/*
 * tooltipster widget class file.
 
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:

 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.

 * tooltipster extends CWidget and implements a base class for a tag-managing widget.
 * more about the plugin http://calebjacob.com/tooltipster/ can be found at 
 * @version: 0.2
 */

class tooltipster extends CWidget
{

  // @ string sets identifier class/id for tooltips
  public $identifier = '.tooltipster';
  // @ array of options settings
  public $options=array();


  // function to init the widget
  public function init() {
    // if not informed will generate Yii defaut generated id, since version 1.6
    if (!isset($this->id))
      $this->id = $this->getId();
    // publish the required assets
    $this->publishAssets();
  }

  // function to run the widget
  public function run() {
   
      $options = $this->buildOptions(); // Get default options.

      Yii::app()->clientScript->registerScript('tooltipster_' . $this->id, '
          $("'.$this->identifier.'").tooltipster(' . $options . ');
          ', CClientScript::POS_READY);
      
  }

  // function to publish and register assets on page 
  public function publishAssets() {
    $assets = dirname(__FILE__) . '/assets';
    $baseUrl = Yii::app()->assetManager->publish($assets, false, 1);

    if (is_dir($assets)) {
      Yii::app()->clientScript->registerCoreScript('jquery');
      Yii::app()->clientScript->registerCssFile($baseUrl . '/css/tooltipster.css');
      Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/jquery.tooltipster.js', CClientScript::POS_HEAD);
    }
    else {
      throw new Exception('tooltipster - Error: Couldn\'t find assets to publish.');
    }
  }

  // function to publish and register a theme css file
  public function publishTheme($theme) {
    $theme = dirname(__FILE__) . '/assets/css/themes/' . $theme . ".css";

    if (is_file($theme)) {
        $themeUrl = Yii::app()->assetManager->publish($theme);
        Yii::app()->clientScript->registerCssFile($themeUrl);
    }
    else {
      throw new Exception('tooltipster - Error: Couldn\'t find theme to publish.');
    }
  }

  private function buildOptions() {
    $_build_options = array();
    $_default_options = array(
        'animation' => 'fade',
        'arrow' => true,
        'arrowColor' => '',
        'autoClose' => true,
        'content' => null,
        'contentAsHTML' => false,
        'contentCloning' => true,
        'debug' => true,
        'delay' => 200,
        'minWidth' => 0,
        'maxWidth' => null,
        'functionInit' => 'js:function(origin, content) {}',
        'functionBefore'=>'js:function(origin, continueTooltip) { continueTooltip(); }',
        'functionReady' => 'js:function(origin, tooltip) {}',
        'functionAfter'=>'js:function(origin) {}',
        'hideOnClick' => false,
        'icon' => '(?)',
        'iconCloning' => true,
        'iconDesktop' => false,
        'iconTouch' => false,
        'iconTheme' => 'tooltipster-icon',
        'interactive' => false,
        'interactiveTolerance' => 350,
        'multiple' => false,
        'offsetX' => 0,
        'offsetY' => 0,
        'onlyOne' => false,
        'position' => 'top',
        'positionTracker' => false,
        'positionTrackerCallback' => 'js:function(origin){ if(this.option(\'trigger\') == \'hover\' && this.option(\'autoClose\')) { this.hide(); } }',
        'restoration' => 'current',
        'speed' => 350,
        'timer' => 0,
        'theme' => 'tooltipster-default',
        'touchDevices' => true,
        'trigger' => 'hover',
        'updateAnimation' => true
    );

    foreach ($this->options as $key => $value) {
     
      // check valid option
      if (!array_key_exists($key, $_default_options))
        continue; // ignore unknown option
      
      // If theme is not the default publish the theme css asset
      if ($key == 'theme' && $value != 'tooltipster-default') {
          $this->publishTheme($value);
      }
      
      //just add option if not default
      if ($value != $_default_options[$key]) {
        $_build_options[$key] = $value;
      }
    }

    $_build_options = CJavaScript::encode($_build_options);
    $_build_options = preg_replace('#\s+#', ' ', $_build_options);
    return $_build_options;
  }

}

?>
