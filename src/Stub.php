<?php namespace Tequila\Widgets;


use Tequila\Widgets\Exceptions\WidgetStubNotFoundException;

trait Stub
{
    /**
     * Sets stub from filename
     *
     * @param       $stubFile
     * @param array $replacements
     * @return string
     * @throws WidgetStubNotFoundException
     */
    protected function stub($stubFile, $replacements = [])
    {
        if (!$this->files->exists($stubFile)) {
            throw new WidgetStubNotFoundException("Stub not found [$stubFile]");
        }

        $stub = $this->files->get($stubFile);
        foreach ($replacements as $token => $replacement) {
            $stub = str_replace('{{' . $token . '}}', $replacement, $stub);
        }

        return $stub;
    }
}
