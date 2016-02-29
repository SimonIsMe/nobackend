<?php namespace nobackend;

class Translate
{
    private static $_instance;

    private $_language;

    private $_translations = [];

    private function __construct()
    {
    }

    /**
     * @return Translate
     */
    public static function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new Translate();
        }

        return self::$_instance;
    }

    /**
     * @param string $language
     *
     * @return void
     */
    public function setLanguage($language)
    {
        $this->_language = $language;
    }

    /**
     * @param string $content
     * @param string $language = null
     *
     * @return string
     */
    public function translate($content, $language = null)
    {
        $language = null == $language ? $this->_language : $language;

        if (false == isset($this->_translations[$language])) {
            $this->_translations[$language] = require_once __DIR__ . '/../../Translate/' . $language . '.php';
        }

        if (isset($this->_translations[$this->_language][$content])) {
            return $this->_translations[$this->_language][$content];
        }
        return $content;
    }
}