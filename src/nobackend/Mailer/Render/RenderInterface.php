<?php namespace nobackend\Mailer;

interface RenderInterface
{
    /**
     * @param $fileName
     * @param array $data
     *
     * @return array
     */
    public function render($fileName, array $data = []);
}