<?php namespace Tequila\Widgets;

interface WidgetInterface
{
    /**
     * Whether or not user is authorized to view widget content
     *
     * @return bool
     */
    public function authorize();

    /**
     * @return mixed
     */
    public function forbidden();

    /**
     * Method to echo out the widget result.
     *
     * This methods checks the user right before
     * calling the render methods.
     *
     * @return mixed
     */
    public function render();
}
