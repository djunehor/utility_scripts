<?php
// Determine if there is an equal number of parentheses
// and if they balance logically, i.e.
// ()()) = Bad (trailing ")")
// (())()() = GOOD
// )()()(()) = BAD (leading ")")
// any other character inbetween is ignore
// function returns YES for valid strings i.e those with balances braces, and NO if otherwise

function checkBraces($array)
{

    //initialise result array
    $result = [];

    //let's ensure data is valid i.e array
    if(!is_array($array)) {
        return 'Input is not an array';
    }

    //constraint 1: array length should be <= 15
    if(count($array) > 15) {
        return 'Array length cannot be more than 15';
    }



    //let's loop through each string in the array
    foreach($array as $string) {

        //let's convert the string to an array so we can loop through
        $str = str_split($string);
        $strlen = strlen($string);

        //constraint 2: string length should be <= 100
        if($strlen > 100) {
            return 'String length cannot be more than 100';
            //we can also use continue here to skip to next string instead of terminating process
        }

        $openbraces = 0;
        $closebraces = 0;


        //for the string to be valid, openbraces must equal closebraces
        for ($i = 0; $i < $strlen; $i++)
        {
            $c = $str[$i]; //current character

            if ($c == '(') {
                $openbraces++;
            }

            if ($c == ')') {
                $closebraces++;
            }

            if ($c == '{') {
                $openbraces++;
            }

            if ($c == '}') {
                $closebraces++;
            }

            if ($c == '[') {
                $openbraces++;
            }

            if ($c == ']') {
                $closebraces++;
            }

        }

        if ($openbraces != $closebraces) {
            $result[$string] = "NO";
        } else {
            $result[$string] = "YES";
        }
    }

    return $result;
}

$tests = array(
    '[{}]', /* should pass */
    '[}]{}', /* should fail - leading close */
    '({)([)}(}[(', /* should fail - trailing open */
    '()()())()()' /* should fail - errant ")" in middle */
);

//we're printing the array.
//We can also json_encode or convert to string using implode()
print_r(checkBraces($tests));
?>