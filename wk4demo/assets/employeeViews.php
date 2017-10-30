<?php
/**
 * Created by PhpStorm.
 * User: calexander
 * Date: 10/29/17
 * Time: 5:36 PM
 */
function getEmployeesAsTable($db, $employees, $cols = null) {
    setlocale(LC_MONETARY, 'en_US.UTF-8');
    $table = "";
    if ( count($employees) > 0 ):
        $table .= "<table>" . PHP_EOL;
        if ($cols):
            $table .= "\t<tr>";
            foreach ($cols as $col) {
                $table .= "<th>$col</th>"; // build column headers as anchors, indicating sort=asc&col=colname
            }
            $table .= "</tr>" . PHP_EOL;
        endif;
        foreach ($employees as $employee):
            $table .= "\t<tr>";
            $table .= "<td>" . $employee['emp_id'] . "</td>";
            $table .= "<td>" . $employee['dept_id'] . "</td>";
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
            $table .= "<td>" . money_format('%.2n ', $employee['salary']). "</td>";
            $table .= "</tr>" . PHP_EOL;
        endforeach;
        $table .= "</table>" . PHP_EOL;
        return $table;
    else :
        return "<section>We have no employees to display</section>";
    endif;
}