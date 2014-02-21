<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cache file naming routine factored out to allow for manual deletion.
 *
 * Responsible for sending final output to browser
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @hacked-by    Bradford Mar
 */
class MY_Output extends CI_Output {

    /**
     * Get the uri of a given cached page
     *
     * @access    public
     * @return    
     */    

    function get_cache_URI($set_uri = null){
        $CFG =& load_class('Config');
        $URI =& load_class('URI');

        $set_uri = (isset($set_uri)) ? $set_uri : $URI->uri_string;

        $cache_path = ($CFG->item('cache_path') == '') ? BASEPATH.'../application/cache/' : $CFG->item('cache_path');

        if ( ! is_dir($cache_path) OR ! is_writable($cache_path))
        {
             return FALSE;
         }

        /*
         * Build the file path.  The file name is an MD5 hash of the full URI
         *
         * NOTE: if you use .htaccess to remove your "index.php" file in the url
         * you might have to prepend a slash to the submitted$set_uri in order to 
         * get it working.
         */
        $uri =    $CFG->item('base_url').
                $CFG->item('index_page').
                $set_uri;

        return array('path'=>$cache_path, 'uri'=>$uri);
    }


    // --------------------------------------------------------------------

    /**
     * Manually clear a cached file
     *
     * @access    public
     * @return    void
     */    

    function clear_page_cache($set_uri = null, $filepath = null){
        switch (isset($filepath))
        {
            case FALSE:
                $cacheuri = $this->get_cache_URI($set_uri);
                $filepath = $cacheuri['path'];
                $filepath .= md5($cacheuri['uri']);            
            default:
                if(file_exists($filepath))
                {
                    touch($filepath);
                    unlink($filepath);
                    log_message('debug', "Cache deleted for: ".$cacheuri['uri']);
                } else
                {
                    return FALSE;
                }
            break;
        }
    }
}
// END MY_Output Class

/* End of file MY_Output.php */
/* Location: ./system/application/libraries/MY_Output.php */
