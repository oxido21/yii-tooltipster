yii-tooltipster
===============
This is just al wrapper for the awesome jQuery [tooltipster](http://calebjacob.com/tooltipster/) plugin. Yes, you are right: this plugin will display nice tooltips :D

Wanna see a [demo](http://calebjacob.com/tooltipster/)?

Wanna fork [yii-tooltipster](https://github.com/Dadeniss/yii-tooltipster) or [tooltipster](https://github.com/iamceege/tooltipster) on github?


##Requirements

Yii 1.1 or above

##Usage
Just call the widget once:
~~~[php]
$this->widget('ext.tooltipster.tooltipster');
~~~
By default this will create a simple tooltip for every element with the class **tooltipster**:
~~~[html]
<a href="http://www.yiiframework.com" class="tooltipster" title="This is my link's tooltip message!">
    Link
</a>

<div class="tooltipster" title="This is my div's tooltip message!"> 
    <p>This div has a tooltip when you hover over it!</p>
</div>
~~~

##Advanced options
There are two possible options: the identifier and an options-array.
~~~[php]
$this->widget('ext.tooltipster.tooltipster',
          array(
            'identifier'=>'.lolcat',
            'options'=>array('position'=>'right')
));
~~~
The **identifier** can be a css class or a id. Also you can use the **options**-array to submit all options tooltipster can work with (check the [docs](http://calebjacob.com/tooltipster/#options)).
~~~[html]
<a href="http://www.yiiframework.com" class="lolcat" title="This tooltip should be on the right side!">
    right?
</a>
~~~
### Default options:
~~~[php]
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
~~~
##Resources

 * [awesome tooltipster plugin](http://calebjacob.com/tooltipster/)
 * [tooltipster on github](https://github.com/iamceege/tooltipster)
 * [yii-tooltipster on github](https://github.com/Dadeniss/yii-tooltipster)
