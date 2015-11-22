<?php

/**
 * Performs text cutting with specified cut method and type.
 */
class TextCutter
{
    /** TODO */
    const METHOD_CUT_WORDS = 0;

    /** TODO */
    const METHOD_WHOLE_WORDS = 1;

    /** TODO */
    const DECORATION_ELLIPSIS = 0;

    /** TODO */
    const DECORATION_NONE = 1;


    /** TODO */
    private $method = self::METHOD_WHOLE_WORDS;

    /** TODO */
    private $type = self::DECORATION_ELLIPSIS;


    /**
     * @param int $method
     * @param int $type
     */
    public function __construct(
        $method = self::METHOD_WHOLE_WORDS, $type = self::DECORATION_ELLIPSIS
    ) {
        $this->method = $method;
        $this->type = $type;
    }

    /**
     * @param string $text
     * @param int $max_length
     *
     * @return string
     */
    public function cut($text = '', $max_length = 200)
    {
        if ($this->type == self::DECORATION_ELLIPSIS) {
            $max_length -= 3;
        }
        switch ($this->method) {
        case self::METHOD_CUT_WORDS:
            $text = substr($text, 0, $max_length);
            break;
        case self::METHOD_WHOLE_WORDS:
            $text = substr($text, 0, $max_length + 1);
            if (strlen($text) > $max_length) {
                $text = wordwrap($text, $max_length);
                if ($lastWordPosition = strpos($text, "\n")) {
                    $text = substr($text, 0, $lastWordPosition);
                }
            }
        }
        if ($this->type == self::DECORATION_ELLIPSIS) {
            $text .= '...';
        }
        return $text;
    }
}
