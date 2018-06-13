<?php

/**
 * @author IAMROOT Community

 * Copyright IamRoot.
 * GooglePlayStore Scrapper created by iamroot
 * We using php brute fore method for selecting the true or false response
 * package id is the result for making android detail post to affiliate with iamroot API

 */

namespace iamroot_play_parse;

class playstore{
 
 /**
 * Class BatchRequest
 *
 * @package playstore
 */


        /**
        * @var the static parameter for elimination spesific response
        */

        var $keyword;

        var $page;



    function brute_force(){

   

        $json = $this->http_build_post_query($this->keyword,$this->page);


        // internal looping 

        foreach ($json->query as $key => $val){
            
            $delimit[] = $key."=".$val;

        }

        // join parameter
        
        $query = implode("&",$delimit);

        $parser = $json->token;

        $parser = $this->token_parser($parser,4);

        /**
         * @return array
         */

        return $this->build_query($parser,$query);
    }

    function token_parser($parser,$length){

        for($i = 1; $i < $length; $i++){

            $parser = base64_decode($parser);

        }
        
        /**
         * @return String
         */

        return $parser;
    }

    function http_build_post_query(){

         /**
         * Creates a new Request entity.
         * @param Page Info               $this->page
         * @param Uniq Keuword            $this->keyword
         */


        $query = [
            "token" => "WVVoU01HTklUVFpNZVRsb1kwZHpkV1JIT1haaVNFMTJaRE5CZEZsWFVuUmhWelIyV1ZkU2RHRlhOSFJaVjNCb1pVTTFkMkZJUVQwPQ==",
            
            "query" => [
                    "action" => "loadmore",
                    "p"      =>   $this->page,
                    "sort"   => "",    
                    "type"   =>    "search",
                    "value"  => $this->keyword,
            ]   
        ];


        /**
         * @return Json
         */
        return json_decode(json_encode($query));
    }

    function lower_case(){

        /**
         * Creates a new Request entity.
         * @throws selecttio string delimiter html dom parser
         */

         $lower = [
                "token"             => "YUhSMGNITTZMeTloY0dzdWRHOXZiSE09",

                "featured_case"     => "store/apps/details?id=",
                
                "scrap_area"        => "<ul class=\"gridlist\" id=\"content\">",
                "last_scrap_area"   => "</ul>",

                "list1"             => '<li class="hvr-underline-from-center">',
                "list2"             => "</li>",

                "package"           => '<a href="',
            ];


        /**
         * @return Json
         */


        return json_decode(json_encode($lower));
    }


    function build_query($parser,$query){


        /**
         * Creates a new Request entity.
         * @param post url              | $parser
         * @param post value            | $query
         * @method POST                 | $query
         */

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$parser);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        curl_close ($ch);

        // get html dom structural

        $get_area = explode($this->lower_case()->scrap_area,$response);

        foreach($get_area as $key => $val){
            
            $limit_area = explode($this->lower_case()->last_scrap_area,$val);

            $fetch_list = explode($this->lower_case()->list1,$limit_area[0]);

            foreach($fetch_list as $key1 => $val1){

                if($key1 !== 0){
        
                   /**
                   * Creates a new Request entity.
                   * @param Bigger affliliate from lower_case()        
                   * @var lower_case()
                   * @method POST
                   */

                    $limit_list = explode($this->lower_case()->list2,$val1);
                    $url_content = explode($this->lower_case()->package,$limit_list[0]);
                    $url_content = explode('"',$url_content[1]);

                    /**
                    * Creates a new Request entity.
                    * @param post url              | $parser
                    * @param post value            | $query
                    * @method POST                 | $query
                    */

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$this->token_parser($this->lower_case()->token,3).$url_content[0]);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $detail = curl_exec ($ch);
                    curl_close ($ch);
                    
                    $parse_html_dom = explode($this->lower_case()->featured_case,$detail);
                    $parse_html_dom = explode('&',@$parse_html_dom[1]);
                    $parse_html_dom = $parse_html_dom[0];

                    if(!empty(@$parse_html_dom)) $result[] = $parse_html_dom;
                }
            }
        }

        /**
        * @return array
        */
        return $result;
    }
}