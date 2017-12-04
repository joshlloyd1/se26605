<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/19/2017
 * Time: 3:58 PM
 */
function isPostRequest() { // checks is post has been returned from form
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}
function isGetRequest() { // checks if get has been returned from form
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
}
