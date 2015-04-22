<?php

namespace PHPValidation\Rules;

/**
 * `stateUS`
 */
class StateUS extends Base
{
    public $message = "Please specify a valid state.";

    /**
     * Validates US States and/or Territories by @jdforsythe
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
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return boolean
     */
    public function validate($value, $options = null, $field = null)
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
        return $this->validation->optional($value) || preg_match($regex, $value);
    }
}
