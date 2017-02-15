<?php namespace App\Lib;

class Activity {
    function __construct(){
        define("DEFAULT_LOG","/afs/ir/your-home-directory/logs/default.log");
    }

    function write_mysql_log($message, $db){
        // Check database connection
        if( ($db instanceof MySQLi) == false) {
            return array(status => false, message => 'MySQL connection is invalid');
        }
        
        // Check message
        if($message == '') {
            return array(status => false, message => 'Message is empty');
        }
        
        // Get IP address
        if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
            $remote_addr = "REMOTE_ADDR_UNKNOWN";
        }
        
        // Get requested script
        if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
            $request_uri = "REQUEST_URI_UNKNOWN";
        }
        
        // Escape values
        $message     = $db->escape_string($message);
        $remote_addr = $db->escape_string($remote_addr);
        $request_uri = $db->escape_string($request_uri);
        
        // Construct query
        $sql = "INSERT INTO my_log (remote_addr, request_uri, message) VALUES('$remote_addr', '$request_uri','$message')";
        
        // Execute query and save data
        $result = $db->query($sql);
        
        if($result) {
            return array(status => true);  
        }
        else {
            return array(status => false, message => 'Unable to write to the database');
        }
    }

    function write_log($message, $logfile='') {
        // Determine log file
        if($logfile == '') {
            // checking if the constant for the log file is defined
            if (defined(DEFAULT_LOG) == TRUE) {
                $logfile = DEFAULT_LOG;
            }
            // the constant is not defined and there is no log file given as input
            else {
                error_log('No log file defined!',0);
                return array(status => false, message => 'No log file defined!');
            }
        }
        
        // Get time of request
        if( ($time = $_SERVER['REQUEST_TIME']) == '') {
            $time = time();
        }
        
        // Get IP address
        if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
            $remote_addr = "REMOTE_ADDR_UNKNOWN";
        }
        
        // Get requested script
        if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
            $request_uri = "REQUEST_URI_UNKNOWN";
        }
        
        // Format the date and time
        $date = date("Y-m-d H:i:s", $time);
        
        // Append to the log file
        if($fd = @fopen($logfile, "a")) {
            $result = fputcsv($fd, array($date, $remote_addr, $request_uri, $message));
            fclose($fd);
        
            if($result > 0)
            return array(status => true);  
            else
            return array(status => false, message => 'Unable to write to '.$logfile.'!');
        }
        else {
            return array(status => false, message => 'Unable to open log '.$logfile.'!');
        }
    }
}
