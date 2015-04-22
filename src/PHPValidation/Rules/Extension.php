<?php

namespace PHPValidation\Rules;

/**
 * `extension`
 */
class Extension extends Base
{
    public $message = "Please enter a value with a valid extension.";

    /**
     * Older "accept" file extension method.
     * Old docs: http://docs.jquery.com/Plugins/Validation/Methods/accept
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        $options = is_string($options) ? preg_replace('/,/', '|', $options) : "png|jpe?g|gif";
        return $this->validation->optional($value) || preg_match("/.(" . $options . ")$/i", $value);
    }
}
