<?php

namespace TextCutter;

/**
 * Performs text cutting with specified cut method and type.
 */
class TextCutter
{
    /** Method at which last word can be broken */
    const METHOD_CUT_WORDS = 0;

    /** Methods that leaves the last word unbroken */
    const METHOD_WHOLE_WORDS = 1;

    /** Adds "..." to the end of the text if necessary */
    const DECORATION_ELLIPSIS = 0;

    /** No additional decoration to the text */
    const DECORATION_NONE = 1;


    /** Contains chosen cutting method. */
    private $method = self::METHOD_WHOLE_WORDS;

    /** Contains chosen decoration method. */
    private $type = self::DECORATION_ELLIPSIS;


    /**
     * Creates an instance of the class and specified parameters as requried.
     *
     * @param int $method Method to be used on cutting.
     * @param int $type   Decoration type to be used on cutting.
     */
    public function __construct(
        $method = self::METHOD_WHOLE_WORDS, $type = self::DECORATION_ELLIPSIS
    ) {
        $this->method = $method;
        $this->type = $type;
    }

    /**
     * Performs cutting of the text.
     *
     * @param string $text    Text to be cutted.
     * @param int $max_length Maximum length of the resulting text.
     *
     * @return string  Cutted text.
     */
    public function cut($text = '', $max_length = 200)
    {
        if (mb_strlen($text) <= $max_length) {
            return $text;
        }
        if ($this->type == self::DECORATION_ELLIPSIS) {
            $max_length -= 3;
        }
        switch ($this->method) {
        case self::METHOD_CUT_WORDS:
            $text = mb_substr($text, 0, $max_length);
            break;
        case self::METHOD_WHOLE_WORDS:
            $text = mb_substr($text, 0, $max_length + 1);
            if (mb_strlen($text) > $max_length) {
                $text = wordwrap($text, $max_length);
                if ($lastWordPosition = mb_strpos($text, "\n")) {
                    $text = mb_substr($text, 0, $lastWordPosition);
                }
            }
        }
        if ($this->type == self::DECORATION_ELLIPSIS) {
            $text .= '...';
        }
        return $text;
    }
}
