<?php namespace nobackend\Mailer\Render;

interface RenderInterface
{
    /**
     * @param $fileName
     * @param array $data
     *
     * @return string
     */
    public function render(string $fileName, array $data = []) : string;
}