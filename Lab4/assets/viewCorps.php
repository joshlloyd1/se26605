<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/1/2017
 * Time: 10:35 AM
 */

function corpForm($depts) {
    $form = "<form method='get' action='viewCorps.php'>" . PHP_EOL;


    $form .= "<select name='deptID'>" . PHP_EOL;
        $form .= "<option>ID</option>";
        $form .= "<option>corp</option>";
        $form .= "<option>incorp_dt</option>";
        $form .= "<option>email</option>";
        $form .= "<option>zipcode</option>";
        $form .= "<option>owner</option>";
        $form .= "<option>phone</option>";
    $form .= "</select>";


    $form .= "<label>Sort By</label>";
    $form .= "<input type='radio' name='sort' value='Ascending'> Ascending";
    $form .= "<input type='radio' name='sort' value='Descending'> Descending";
    $form .= '<input type="submit" name="submit" value="Submit">';
    $form .= "</Form>" . PHP_EOL;
    return $form;
}