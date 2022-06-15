<?php

class ApplicationDetails
{
    public $jobCode = '';
    public $fullname = '';
    public $id = '';
    public $email = '';
    public $linkedin = '';
    public $studyYear = '';
    public $approval = '';
    public $sid;

    /**
     * idx - if several submitions, the id of the form data
     */
    public function __construct($data, $sid, $idx = null)
    {
        foreach ($data as $key => $value) {
            $prop = $this->dashesToCamelCase($key);
            if (!property_exists($this, $prop)) continue;

            $this->$prop = is_array($value) ? $value[$idx] : $value;
        }

        $this->sid = $this->sid ? $this->sid : $sid;
    }

    public static function propertyLabel($prop)
    {
        $labels = self::propertyLabels();
        return key_exists($prop, $labels) ? $labels[$prop] : '';
    }

    public static function propertyLabels()
    {
        return [
            'jobCode' => __('jobCode', 'NlsHunter'),
            'fullname' => __('Full Name', 'NlsHunter'),
            'id' => __('Id', 'NlsHunter'),
            'email' => __('Email', 'NlsHunter'),
            'linkedin' => __('Linkedin', 'NlsHunter'),
            'studyYear' => __('Study Year', 'NlsHunter'),
            'approval' => __('Approval', 'NlsHunter'),
            'sid' => __('Supplier Id', 'NlsHunter'),
        ];
    }

    private function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }
}
