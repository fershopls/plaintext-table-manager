<?php

namespace FershoPls\Database\Plaintext;

class PlaintextTableManager {

    protected $data;

    public function load ($data = null) {
        if ($data)
            $this->data = $data;
        else $this->output("Couldn't load file content.");
        return $this;
    }

    /**
     * Return array of data proccessed by rules
     * @param  array  $rules Array of Rules
     * @param  bool   $trim  Clean the String
     * @return array         Variable to array
     */
    public function toArray($rules, $trim = true) {
        if (!isset($rules) or !is_array($rules)) return false;
        $array = [];
        foreach ($this->getLinesFromContent($this->data) as $line)
            array_push($array, $this->applyRulesArray($rules, $line, $trim));
        return $array;
    }

    /**
     * Substr read the content and return array
     * @param  array  $rules Array of rules
     * @param  string $str   Content
     * @param  bool   $trim  Clean the String
     * @return array         Variables Proccessed
     */
    private function applyRulesArray ($rules, $str, $trim) {
        $data = [];
        foreach ($rules as $input => $rule) {
            list($ini, $end) = explode('|', $rule);
            $tmp = substr($str, $ini-1, $end);
            if ($trim) $tmp = trim($tmp);
            $data[$input] = $tmp;
        }
        //$data['line_content'] = $str;
        return $data;
    }

    /**
     * Split data by new lines
     * @param  string $data [description]
     * @return array        Array of lines
     */
    private function getLinesFromContent ($data) {
        return explode(PHP_EOL, $data);
    }

    private function output ($message = "")
    {
        echo get_class($this) . ": " . $message . PHP_EOL;
    }

}