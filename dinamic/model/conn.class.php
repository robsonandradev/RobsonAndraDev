<?php
class Conn
{
    function getConn(){
        return new mysqli("localhost", "u828243502_root", "2319suhrob", "u828243502_mine");
        //return new mysqli("localhost", "root", "", "robsonandradev");
    }
}
?>