<?php

require_once 'mp/utils/Validation.php';

class ValidationAdditional extends Validation
{
    const RULE_MAX_WORDS            = "maxWords";
    const RULE_MIN_WORDS            = "minWords";
    const RULE_RANGE_WORDS          = "rangeWords";
    const RULE_ACCEPT               = "accept"; // Not implemented
    const RULE_ALPHANUMERIC         = "alphanumeric";
    const RULE_BANKACCOUNT_NL       = "bankaccountNL";       // Not implemented
    const RULE_BANKORGIROACCOUNT_NL = "bankorgiroaccountNL"; // Not implemented
    const RULE_BIC                  = "bic";                 // Not implemented
    const RULE_CIF_ES               = "cifES";               // Not implemented
    const RULE_CREDITCARDTYPES      = "creditcardtypes";
    const RULE_CURRENCY             = "currency";
    const RULE_DATE_FA              = "dateFA";  // Not implemented
    const RULE_DATE_ITA             = "dateITA"; // Not implemented
    const RULE_DATE_NL              = "dateNL";  // Not implemented
    const RULE_EXTENSION            = "extension";
    const RULE_GIROACCOUNT_NL       = "giroaccountNL"; // Not implemented
    const RULE_IBAN                 = "iban";          // Not implemented
    const RULE_INTEGER              = "integer";
    const RULE_IPV4                 = "ipv4";
    const RULE_IPV6                 = "ipv6";
    const RULE_LETTERSONLY          = "lettersonly";
    const RULE_LETTERSWITHBASICPUNC = "letterswithbasicpunc";
    const RULE_MOBILE_NL            = "mobileNL"; // Not implemented
    const RULE_MOBILE_UK            = "mobileUK"; // Not implemented
    const RULE_NIE_ES               = "nieES";    // Not implemented
    const RULE_NIF_ES               = "nifES";    // Not implemented
    const RULE_NOWHITESPACE         = "nowhitespace";
    const RULE_PATTERN              = "pattern";
    const RULE_PHONE_NL             = "phoneNL";              // Not implemented
    const RULE_PHONE_UK             = "phoneUK";              // Not implemented
    const RULE_PHONE_US             = "phoneUS";              // Not implemented
    const RULE_PHONES_UK            = "phonesUK";             // Not implemented
    const RULE_POSTAL_CODE_CA       = "postalCodeCA";         // Not implemented
    const RULE_POSTALCODE_BR        = "postalcodeBR";         // Not implemented
    const RULE_POSTALCODE_IT        = "postalcodeIT";         // Not implemented
    const RULE_POSTALCODE_NL        = "postalcodeNL";         // Not implemented
    const RULE_POSTCODE_UK          = "postcodeUK";           // Not implemented
    const RULE_REQUIRE_FROM_GROUP   = "require_from_group";   // Not implemented
    const RULE_SKIP_OR_FILL_MINIMUM = "skip_or_fill_minimum"; // Not implemented
    const RULE_STATE_US             = "stateUS";
    const RULE_STRIPPEDMINLENGTH    = "strippedminlength";
    const RULE_TIME                 = "time";
    const RULE_TIME12H              = "time12h";
    const RULE_URL2                 = "url2";  // Not implemented
    const RULE_VIN_US               = "vinUS"; // Not implemented
    const RULE_ZIPCODE_US           = "zipcodeUS";
    const RULE_ZIPRANGE             = "ziprange";

    public function __construct()
    {
        parent::__construct();

        $this->messages([
            self::RULE_MAX_WORDS            => "Please enter %s words or less.",
            self::RULE_MIN_WORDS            => "Please enter at least %s words.",
            self::RULE_RANGE_WORDS          => "Please enter between %s and %s words.",
            self::RULE_ACCEPT               => "Please enter a value with a valid mimetype.",
            self::RULE_ALPHANUMERIC         => "Letters, numbers, and underscores only please",
            self::RULE_BANKACCOUNT_NL       => "Please specify a valid bank account number",
            self::RULE_BANKORGIROACCOUNT_NL => "Please specify a valid bank or giro account number",
            self::RULE_BIC                  => "Please specify a valid BIC code",
            self::RULE_CIF_ES               => "Please specify a valid CIF number.",
            self::RULE_CREDITCARDTYPES      => "Please enter a valid credit card number.",
            self::RULE_CURRENCY             => "Please specify a valid currency",
            self::RULE_DATE_FA              => "Please enter a correct date",
            self::RULE_DATE_ITA             => "Please enter a correct date",
            self::RULE_DATE_NL              => "Please enter a correct date",
            self::RULE_EXTENSION            => "Please enter a value with a valid extension.",
            self::RULE_GIROACCOUNT_NL       => "Please specify a valid giro account number",
            self::RULE_IBAN                 => "Please specify a valid IBAN",
            self::RULE_INTEGER              => "A positive or negative non-decimal number please",
            self::RULE_IPV4                 => "Please enter a valid IP v4 address.",
            self::RULE_IPV6                 => "Please enter a valid IP v6 address.",
            self::RULE_LETTERSONLY          => "Letters only please",
            self::RULE_LETTERSWITHBASICPUNC => "Letters or punctuation only please",
            self::RULE_MOBILE_NL            => "Please specify a valid mobile number",
            self::RULE_MOBILE_UK            => "Please specify a valid mobile number",
            self::RULE_NIE_ES               => "Please specify a valid NIE number.",
            self::RULE_NIF_ES               => "Please specify a valid NIF number.",
            self::RULE_NOWHITESPACE         => "No white space please",
            self::RULE_PATTERN              => "Invalid format.",
            self::RULE_PHONE_NL             => "Please specify a valid phone number.",
            self::RULE_PHONE_UK             => "Please specify a valid phone number",
            self::RULE_PHONE_US             => "Please specify a valid phone number",
            self::RULE_PHONES_UK            => "Please specify a valid uk phone number",
            self::RULE_POSTAL_CODE_CA       => "Please specify a valid postal code",
            self::RULE_POSTALCODE_BR        => "Informe um CEP válido.",
            self::RULE_POSTALCODE_IT        => "Please specify a valid postal code",
            self::RULE_POSTALCODE_NL        => "Please specify a valid postal code",
            self::RULE_POSTCODE_UK          => "Please specify a valid UK postcode",
            self::RULE_REQUIRE_FROM_GROUP   => "Please fill at least %s of these fields.",
            self::RULE_SKIP_OR_FILL_MINIMUM => "Please either skip these fields or fill at least %s of them.",
            self::RULE_STATE_US             => "Please specify a valid state",
            self::RULE_STRIPPEDMINLENGTH    => "Please enter at least %s characters",
            self::RULE_TIME                 => "Please enter a valid time, between 00:00 and 23:59",
            self::RULE_TIME12H              => "Please enter a valid time in 12-hour am/pm format",
            self::RULE_URL2                 => $this->messages[self::RULE_URL],
            self::RULE_VIN_US               => "The specified vehicle identification number (VIN) is invalid.",
            self::RULE_ZIPCODE_US           => "The specified US ZIP Code is invalid",
            self::RULE_ZIPRANGE             => "Your ZIP-code must be in the range 902xx-xxxx to 905xx-xxxx"
        ]);
    }

    /*=============================
    =            Rules            =
    =============================*/

    protected function ruleMaxWords($value, $options = null)
    {
        return $this->optional($value) || preg_match_all('/\b\w+\b/', strip_tags($value)) <= $options;
    }

    protected function ruleMinWords($value, $options = null)
    {
        return $this->optional($value) || preg_match_all('/\b\w+\b/', strip_tags($value)) >= $options;
    }

    protected function ruleRangeWords($value, $options = null)
    {
        $valueStripped = strip_tags($value);
        $regex         = '/\b\w+\b/';
        return $this->optional($value) || preg_match_all($regex, $valueStripped) >= $options[0] && preg_match_all($regex, $valueStripped) <= $options[1];
    }

    protected function ruleAlphanumeric($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^\w+$/i', $value);
    }

    /* NOTICE: Modified version of Castle.Components.Validator.CreditCardValidator
     * Redistributed under the the Apache License 2.0 at http://www.apache.org/licenses/LICENSE-2.0
     * Valid Types: mastercard, visa, amex, dinersclub, enroute, discover, jcb, unknown, all (overrides all other settings)
     */
    protected function ruleCreditcardtypes($value, $options = null)
    {
        if (preg_match('/[^0-9\-]+/', $value)) {
            return false;
        }

        $value = preg_replace('/\D/', '', $value);

        $validTypes = 0x0000;

        if ($options['mastercard'] || in_array('mastercard', $options)) {
            $validTypes |= 0x0001;
        }
        if ($options['visa'] || in_array('visa', $options)) {
            $validTypes |= 0x0002;
        }
        if ($options['amex'] || in_array('amex', $options)) {
            $validTypes |= 0x0004;
        }
        if ($options['dinersclub'] || in_array('dinersclub', $options)) {
            $validTypes |= 0x0008;
        }
        if ($options['enroute'] || in_array('enroute', $options)) {
            $validTypes |= 0x0010;
        }
        if ($options['discover'] || in_array('discover', $options)) {
            $validTypes |= 0x0020;
        }
        if ($options['jcb'] || in_array('jcb', $options)) {
            $validTypes |= 0x0040;
        }
        if ($options['unknown'] || in_array('unknown', $options)) {
            $validTypes |= 0x0080;
        }
        if ($options['all'] || in_array('all', $options)) {
            $validTypes = 0x0001 | 0x0002 | 0x0004 | 0x0008 | 0x0010 | 0x0020 | 0x0040 | 0x0080;
        }
        if ($validTypes & 0x0001 && preg_match('/^(5[12345])/', $value)) {
            //mastercard
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0002 && preg_match('/^(4)/', $value)) {
            //visa
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0004 && preg_match('/^(3[47])/', $value)) {
            //amex
            return strlen($value) === 15;
        }
        if ($validTypes & 0x0008 && preg_match('/^(3(0[012345]|[68]))/', $value)) {
            //dinersclub
            return strlen($value) === 14;
        }
        if ($validTypes & 0x0010 && preg_match('/^(2(014|149))/', $value)) {
            //enroute
            return strlen($value) === 15;
        }
        if ($validTypes & 0x0020 && preg_match('/^(6011)/', $value)) {
            //discover
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0040 && preg_match('/^(3)/', $value)) {
            //jcb
            return strlen($value) === 16;
        }
        if ($validTypes & 0x0040 && preg_match('/^(2131|1800)/', $value)) {
            //jcb
            return strlen($value) === 15;
        }
        if ($validTypes & 0x0080) {
            //unknown
            return true;
        }

        return false;
    }

    /**
     * Validates currencies with any given symbols by @jameslouiz
     * Symbols can be optional or required. Symbols required by default
     *
     * Usage examples:
     *  currency: ["£", false] - Use false for soft currency validation
     *  currency: ["$", false]
     *  currency: ["RM", false] - also works with text based symbols such as "RM" - Malaysia Ringgit etc
     *
     *  <input class="currencyInput" name="currencyInput">
     *
     * Soft symbol checking
     *  currencyInput: {
     *     currency: ["$", false]
     *  }
     *
     * Strict symbol checking (default)
     *  currencyInput: {
     *     currency: "$"
     *     //OR
     *     currency: ["$", true]
     *  }
     *
     * Multiple Symbols
     *  currencyInput: {
     *     currency: "$,£,¢"
     *  }
     */
    protected function ruleCurrency($value, $options = null)
    {
        $isParamString = is_string($options);
        $symbol        = $isParamString ? $options : $options[0];
        $soft          = $isParamString ? true : $options[1];
        $regex;

        $symbol = preg_replace('/,/', '', $symbol);
        $symbol = preg_quote($symbol);
        $symbol = $soft ? $symbol . "]" : $symbol . "]?";
        $regex  = "/^[" . $symbol . "([1-9]{1}[0-9]{0,2}(\,[0-9]{3})*(\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|(\.[0-9]{1,2})?)$/";

        return $this->optional($value) || preg_match($regex, $value);
    }

    // Older "accept" file extension method. Old docs: http://docs.jquery.com/Plugins/Validation/Methods/accept
    protected function ruleExtension($value, $options = null)
    {
        $options = is_string($options) ? preg_replace('/,/', '|', $options) : "png|jpe?g|gif";
        return $this->optional($value) || preg_match("/.(" . $options . ")$/i", $value);
    }

    protected function ruleInteger($value, $options = null)
    {
        return $this->optional($value) || filter_var($value, FILTER_VALIDATE_INT);
    }

    protected function ruleIpv4($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)$/i', $value);
    }

    protected function ruleIpv6($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))$/i', $value);
    }

    protected function ruleLettersonly($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^[a-z]+$/i', $value);
    }

    protected function ruleLetterswithbasicpunc($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^[a-z\-.,()\'"\s]+$/i', $value);
    }

    protected function ruleNowhitespace($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^\S+$/i', $value);
    }

    /**
     * Return true if the field value matches the given format RegExp
     *
     * @example $.validator.methods.pattern("AR1004",element,/^AR\d{4}$/)
     * @result true
     *
     * @example $.validator.methods.pattern("BR1004",element,/^AR\d{4}$/)
     * @result false
     *
     * @name $.validator.methods.pattern
     * @type Boolean
     * @cat Plugins/Validate/Methods
     */
    protected function rulePattern($value, $options = null)
    {
        if ($this->optional($value)) {
            return true;
        }

        if (is_string($options)) {
            $options = "/^(?:" . $options . ")$/";
        }

        return preg_match($options, $value);
    }

    /* Validates US States and/or Territories by @jdforsythe
     * Can be case insensitive or require capitalization - default is case insensitive
     * Can include US Territories or not - default does not
     * Can include US Military postal abbreviations (AA, AE, AP) - default does not
     *
     * Note: "States" always includes DC (District of Colombia)
     *
     * Usage examples:
     *
     *  This is the default - case insensitive, no territories, no military zones
     *  stateInput: {
     *     caseSensitive: false,
     *     includeTerritories: false,
     *     includeMilitary: false
     *  }
     *
     *  Only allow capital letters, no territories, no military zones
     *  stateInput: {
     *     caseSensitive: false
     *  }
     *
     *  Case insensitive, include territories but not military zones
     *  stateInput: {
     *     includeTerritories: true
     *  }
     *
     *  Only allow capital letters, include territories and military zones
     *  stateInput: {
     *     caseSensitive: true,
     *     includeTerritories: true,
     *     includeMilitary: true
     *  }
     *
     *
     *
     */
    protected function ruleStateUS($value, $options = null)
    {
        $isDefault          = isset($options);
        $caseSensitive      = ($isDefault || isset($options['caseSensitive'])) ? false : $options['caseSensitive'];
        $includeTerritories = ($isDefault || isset($options['includeTerritories'])) ? false : $options['includeTerritories'];
        $includeMilitary    = ($isDefault || isset($options['includeMilitary'])) ? false : $options['includeMilitary'];
        $regex;

        if (!$includeTerritories && !$includeMilitary) {
            $regex = "/^(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$/";
        } elseif ($includeTerritories && $includeMilitary) {
            $regex = "/^(A[AEKLPRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$/";
        } elseif ($includeTerritories) {
            $regex = "/^(A[KLRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$/";
        } else {
            $regex = "/^(A[AEKLPRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$/";
        }

        $regex = $caseSensitive ? $regex : $regex . "i";
        return $this->optional($value) || preg_match($regex, $value);
    }

    // TODO check if value starts with <, otherwise don't try stripping anything
    protected function ruleStrippedminlength($value, $options = null)
    {
        return strlen(trim(strip_tags($value))) >= $options;
    }

    protected function ruleTime($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^([01]\d|2[0-3])(:[0-5]\d){1,2}$/', $value);
    }

    protected function ruleTime12h($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^((0?[1-9]|1[012])(:[0-5]\d){1,2}(\ ?[AP]M))$/i', $value);
    }

    protected function ruleZipcodeUS($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^\d{5}(-\d{4})?$/', $value);
    }

    protected function ruleZiprange($value, $options = null)
    {
        return $this->optional($value) || preg_match('/^90[2-5]\d{2}-\d{4}$/', $value);
    }
}
