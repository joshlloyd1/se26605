<?php
$table = "<table>\n"; // empty table var
$arr = [];
$arr1 = [];
$str = "";
for ($rows = 1; $rows <= 10; $rows++) {// makes rows for table
    $table .= "\t<tr>";

    for ($cols=1; $cols <= 10; $cols++) { // makes columns for table
        $str = ""; // makes a new blank hex

        for($num = 0; $num < 6; $num++) { // runs 6 times for a hex number
            $arr[$num] = mt_rand(0, 15);// creates random number
            $arr1[$num] = dechex($arr[$num]);  // turns number to a hex
            $str .= $arr1[$num]; // stores
        }
        $table .= "<td bgcolor=\"#$str\">" . $str . "<br >" . "<span style='color:#ffffff'>" . $str . "</span>" .  "</td>"; // outputs to table
    }
	$table .= "</tr>\n";
}
$table .= "</table>";// closes table
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 1 Josh Lloyd</title>
</head>
<body>
<?php
echo $table; ?>
</body>
</html>