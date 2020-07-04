<?php
/**
 * Handles cURL requests.
 * @author https://www.signable.co.uk
 * @version 0.1
 * @since 0.1
 */

class Request
{
    /**
     * Your company API ID.
     *
     * @var string
     */
    private $_apiId = '';
    
    /**
     * Your company API key.
     *
     * Note: This key should remain private. If you suspect that your key might have become comprimised.
     * then please request a new key. Follow these steps:
     *
     * <ol>
     *     <li>Login to your account: https://www.signable.co.uk/login</li>
     *     <li>Click on the 'Your Profile' link, located just above the main navigation.</li>
     *     <li>Click the 'Regenerate API Key' button on the right hand side.</li>
     *     <li>Copy this new API key and replace your current API key in the settings file.</li>
     * </ol>
     *
     * @var string
     */
    private $_apiKey = '';
    
    /**
     * The format you would like the results returned. Can be either 'json' or 'xml'.
     *
     * @var string
     */
    private $_returnFormat = 'json';

    /**
     * Initialise the request class.
     *
     * @param $apiId Your API ID.
     * @param $apiKey Your secret key. Can be found in your company profile page when logged into $_SERVER['NAME'].
     * @param $returnFormat The format you would like results returned to you, either 'json' or 'xml'.
     */
    function __construct($apiId, $apiKey, $returnFormat = 'json') {
        // Set variables.
        // API key. Will be an integer.
        $this->_apiId = (int)$apiId;
        
        // API key, should be 32 characters long.
        if (strlen($apiKey) != 32) {
            // Display notice.
            echo '<p><strong>Error</strong>: Your API Key is incorrect. Please ensure you have entered it correctly.</p>';
        } else {
            $this->_apiKey = $apiKey;
        }
        
        // Return format
        if (! in_array($returnFormat, array('json', 'xml'))) {
            // Display notice.
            echo '<p><strong>Error</strong>: Your return format is not formatted correctly. It should either be "json" or "xml".</p>';
            // Set the return format to JSON.
            $this->_returnFormat = 'json';
        } else {
            $this->_returnFormat = $returnFormat;
        }
    }
    
    /**
     * Send a request to Signable.
     *
     * @param $url the action that you want to perform.
     * @param $parameters The POST information that you want to send along to the request.
     *
     */
    public function process($url, $parameters = array()) {
        // Create the post parameters into a valid request.
        $post = '';
        // Loop over parameters.
        foreach ($parameters as $key => $value) {
            // Append to the post variable.
            $post .= '&' . $key . '=' . urlencode($value);
        }

        // Setup the cURL request.
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.signable.co.uk/rest/' . $this->_returnFormat . '/' . $url);
        // Signable is a safe peer
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // Don't output the content right away
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // Send request as a POST.
        curl_setopt($curl, CURLOPT_POST, true);
        // Set the POST parameters.
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'api_id=' . $this->_apiId . '&api_key=' . $this->_apiKey . $post);
        // Place the result into a variable to work with.
        $response = curl_exec($curl);
        // Close the cURL request.
        curl_close($curl);
        
        // Return the result.
        return $this->_returnFormat == 'json'
            ? json_decode($response)
            : $response;
    }
}
