<?php

namespace Tequila\Widgets;

use Illuminate\Foundation\Application;
use Tequila\Widgets\Exceptions\WidgetNotFoundException;

class WidgetsManager
{

    protected $widgets = [];

    protected $app;

    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    public function run($widget, $type = 'frontend')
    {
        try {
            $widgetClass = $this->widgetExists($widget, $type);
            echo $widgetClass ? app($widgetClass)->render() : false;
        } catch (WidgetNotFoundException $e) {
            echo $e->getMessage();
        }
    }

    private function widgetExists($widget, $type)
    {
        $widget_with_namespace = '';

        foreach ($this->app->config['widgets']['namespaces'] as $namespace) {
            $widget_with_namespace = $namespace . ucfirst($type) . '\\' . studly_case($widget);

            if (class_exists($widget_with_namespace)) {
                $this->widgets['init'][] = $widget_with_namespace;
            }
        }

        if (!in_array($widget_with_namespace, $this->widgets['init'])) {
            $this->widgets['errors'][] = $widget_with_namespace;
            throw new WidgetNotFoundException($widget . ' widget not found on ' . $widget_with_namespace . ' namespace ');
        }

        return $widget_with_namespace;
    }

    public function errors()
    {
        return $this->widgets['errors'];
    }
}
