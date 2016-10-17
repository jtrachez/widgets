<?php namespace Tequila\Widgets;

use Illuminate\View\View;

abstract class BaseWidget implements WidgetInterface
{

    /**
     * Whether or not user is authorized to view widget content
     *
     * By default, widget are not authorized, to force developer
     * to implement authorization
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Returns empty string when widget is not authorized
     *
     * @return string
     */
    public function forbidden()
    {
        return '';
    }

    /**
     * Outputs widget taking into account authorization
     *
     * @return mixed
     */
    public function render()
    {
        if (!$this->authorize()) {
            return $this->forbidden();
        }
        // User render() method for better debugging in case of an error.
        // Without using render(), __toString() will be fired, and if there is
        // an error, we will only a get a fatal error like this
        //  "__toString() must not throw an exception ..."
        $content = $this->content();
        return $content instanceof View ? $content->render() : $content;
    }

    /**
     *  Return widget contents
     */
    abstract protected function content();
}
