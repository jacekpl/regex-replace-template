<?php

class RegexReplace
{
    /**
     * @param $string
     * @param array $data
     * @return mixed
     */
    public function execute($string, array $data)
    {
        preg_match_all('/{.*?}/', $string, $ret);

        foreach($ret as $variables) {
            foreach($variables as $variable) {
                $string = $this->parse($string, $data, $variable);
            }
        }

        return $string;
    }

    /**
     * @param $string
     * @param array $data
     * @param $variable
     * @return mixed
     */
    private function parse($string, array $data, $variable)
    {
        $variableStripped = str_replace(array('{', '}'), '', $variable);
        $variableData = explode(',', $variableStripped);

        $variableName = null;
        $variableFallback = null;

        if (isset($variableData[0])) {
            $variableName = $variableData[0];
        }

        if (isset($variableData[1])) {
            $variableFallback = str_replace('fallback=', '', $variableData[1]);
        }

        if (isset($data[$variableName]) && null !== $data[$variableName]) {
            $string = str_replace($variable, $data[$variableName], $string);

            return $string;
        }

        if (isset($variableFallback)) {
            $string = str_replace($variable, $variableFallback, $string);

            return $string;
        }

        return $string;
    }

    public function variables($string)
    {
        preg_match_all('/{.*?}/', $string, $ret);

        $variablesArray = [];

        foreach($ret as $variables) {
            foreach($variables as $variable) {
                $variableStripped = str_replace(array('{', '}'), '', $variable);
                $variableData = explode(',', $variableStripped);

                $variablesArray[] = ['variable' => $variableData[0], 'fallback' => isset($variableData[1]) ? isset($variableData[1]) ? str_replace('fallback=', '', $variableData[1]) : null : null];
            }
        }

        return $variablesArray;
    }
}
