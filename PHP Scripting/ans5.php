<?php
// checks if its a get or post.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo '
        <html>
            <body>
Enter XML:
<!--- form for the xml arithimitc. textarea allows it to keep its shape and not just keep expanding. -->
<form method="POST" action="">
      <label for="xml-input"></label>
      <textarea id="xml-input" name="xml" rows="10" cols="50"></textarea>
      <br />
      <input type="submit" value="Submit" />
    </form>
    ';

} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $xml = $_POST["xml"];
    $xmlObj = simplexml_load_string($xml);
    if (!$xmlObj) {
        echo "Invalid XML.";
    } else {
	//convertthe xml to a string to be read.
        $operation = $xmlObj->operation;
        $number1 = (string) $xmlObj->number1;
        $number2 = (string) $xmlObj->number2;
        if ($number1 === '' || $number2 === '') {
	    echo "Invalid numbers entered";
	} elseif (!is_numeric($number1) || !is_numeric($number2)) {
    		echo "Invalid numbers entered";
			}
		 else {
            switch ($operation) {
	//all the different math arithmitic required. +, -, *, /
                case "add":
                    $result = $number1 + $number2;
                    break;
                case "subtract":
                    $result = $number1 - $number2;
                    break;
                case "multiply":
                    $result = $number1 * $number2;
                    break;
                case "divide":
                    if ($number2 == 0) {
                        echo "Divived by zero. Error occured.";
                        exit();
                    } else {
                        $result = $number1 / $number2;
                    }
                    break;
                default:
                    echo "Invalid operand.";
                    exit();
            }
	// prints the answer
            echo "Answer: $result";
        }
    }
}
?>

