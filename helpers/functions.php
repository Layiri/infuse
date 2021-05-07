<?php

/**
 * Get user adress
 * @return mixed
 */
function getIPAddress()
{
    //whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } //whether ip is from the remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 * Get user ip
 * @return string
 */
function getUrl()
{

    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https://";
    else
        $url = "http://";
    // Append the host(domain name, ip) to the URL.
    $url .= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL
    $url .= (isset($_GET['name'])) ? '/infuse/' . $_GET['name'] . 'html' : $_SERVER['REQUEST_URI'];

    return $url;

}