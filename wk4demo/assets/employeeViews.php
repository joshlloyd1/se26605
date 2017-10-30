<?php
/**
 * Created by PhpStorm.
 * User: calexander
 * Date: 10/29/17
 * Time: 5:36 PM
 */
function getEmployeesAsTable($db, $employees, $cols = null, $sortable = false) {
    setlocale(LC_MONETARY, 'en_US.UTF-8');
    $table = "";
    if ( count($employees) > 0 ):
        $table .= "<table border='1px;'>" . PHP_EOL;
        if ($cols && !$sortable):
            $table .= "\t<tr>";
            foreach ($cols as $col) {
                $table .= "<th>$col</th>"; // build column headers as anchors, indicating sort=asc&col=colname
            }
            $table .= "</tr>" . PHP_EOL;
        endif;
        if ($cols && $sortable):
            $dir = "ASC";
            $table .= "\t<tr>";
            foreach ($cols as $col) {
                $href = "?action=sort&col=$col&dir=$dir";
                $table .= "<th><a href='$href'>$col</a></th>"; // build column headers as anchors, indicating sort=asc&col=colname
            }
            $table .= "</tr>" . PHP_EOL;
        endif;
        foreach ($employees as $employee):
            $table .= "\t<tr>";
            $table .= "<td>" . $employee['emp_id'] . "</td>";
            $table .= "<td>" . $employee['dept_name'] . "</td>";
            $table .= "<td>" . $employee['first_name'] . "</td>";
            $table .= "<td>" . $employee['last_name'] . "</td>";
            $table .= "<td>" . date('m/d/Y', strtotime($employee['hire_date']) ) . "</td>";
            $table .= "<td>";
            if ( strtotime($employee['term_date']) > 0 ) :
                $table .= date('m/d/Y', strtotime($employee['term_date']) );
            else :
                $table .= "&nbsp;";
            endif;
            $table .= "</td>";
            $table .= "<td>" . $employee['salary'] . "</td>";
            $table .= "</tr>" . PHP_EOL;
        endforeach;
        $table .= "</table>" . PHP_EOL;
        return $table;
    else :
        return "<section>We have no employees to display</section>";
    endif;
}
function employeeForm($depts) {
    $form = "<form>" . PHP_EOL;
    $form .= "<select name='deptID'>" . PHP_EOL;
    foreach ($depts as $dept) {
        $form .= "<option value =" . $dept['dept_id']. "'>";
        $form .= $dept['dept_name'] . "</option>";
    }
    $form .= "</select>";
    $form .= "</form>";
    return $form;
}