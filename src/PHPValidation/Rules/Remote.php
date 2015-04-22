<?php

namespace PHPValidation\Rules;

/**
 * Requests a resource to check the element for validity.
 *
 * http://jqueryvalidation.org/remote-method/
 *
 * `remote`
 */
class Remote extends Base
{
    public $message = "Please fix this field.";

    /**
     * Requests a resource to check the element for validity.
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
    {
        if ($this->validation->optional($value)) {
            return true;
        }

        if (is_string($options)) {
            $options = ['url' => $options];
        }

        $defaults = [
            "data"   => [$field => $value],
            "method" => 'GET'
        ];
        $options = array_replace_recursive($defaults, $options);

        return (bool) $this->request($options);
    }

    protected function request($options)
    {
        if (!isset($options['url'])) {
            return false;
        }

        foreach ($options['data'] as $key => $value) {
            if (is_callable($value)) {
                $options['data'][$key] = call_user_func($value);
            }
        }

        if (strtoupper(trim($options['method'])) == 'POST') {
            return $this->post($options['url'], $options['data']);
        } else {
            return $this->get($options['url'], $options['data']);
        }
    }

    protected function get($url, array $data = null)
    {
        $data = $data ? http_build_query($data) : '';
        $url  = $data ? $url . '?' . $data : $url;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $output = curl_exec($ch);

        curl_close($ch);
        return trim($output);
    }

    protected function post($url, array $data = null)
    {
        $data = $data ? http_build_query($data) : '';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);

        curl_close($ch);
        return trim($output);
    }
}
