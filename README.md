# text-cutter
Small utility to adaptively cut long description for short previews.

# Usage
Firstly, create an instance of TextCutter class and specify cutting method and type of text decoration like this:

$text = new TextCutter(TextCutter::METHOD_WHOLE_WORDS, TextCutter::DECORATION_ELLIPSIS);

Now you can use ->cut($text, $length) method to cut your texts!
