<?php

/* array sort helper function */
function randomSort($a, $b)
{
    return rand(-1, 1);
}
	
class PTagCloud
{
	var $m_arTags = array();
	
	//custom parameters
	var $m_displayedElementsCount;
	var $m_searchURL; 
	var $m_backgroundImage;
	var $m_backgroundColor;
	var $m_width;
	var $m_arColors;
	var $m_bUTF8;
	
	function __construct($displayedElementCount, $arSeedWords = false)
	{
		ini_set('upload_max_filesize', '50M');
		ini_set('post_max_size', '50M');
		ini_set('memory_limit', '50M');
		$max_upload = (int)(ini_get('upload_max_filesize'));
		$max_post = (int)(ini_get('post_max_size'));
		$memory_limit = (int)(ini_get('memory_limit'));
		$upload_mb = min($max_upload, $max_post, $memory_limit);

	    $this->m_displayedElementsCount = $displayedElementCount;
	    $this->m_bUTF8 = false;
	    
		$this->commonWords = "";

		$this->totalWords = 0;

	}
	 
	function PTagCloud($displayedElementCount, $arSeedWords = false)
	{
		$this->__construct($displayedElementCount, $arSeedWords);
	}
	
	function setUTF8($bUTF8)
	{
	    $this->m_bUTF8 = $bUTF8;
	}

	/* word replace helper */
    function str_replace_word($needle, $replacement, $haystack)
    {
        $pattern = "/\b$needle\b/i";
        $haystack = preg_replace($pattern, $replacement, $haystack);
        return $haystack;
    }

    function get_total_words(){
		return $this->totalWords;
    }

    function set_total_words($q){
		$this->totalWords = $q;
    }

    function get_tags_raw(){
    	return $this->m_arTags;
    }

    function get_tags(){
    	$this->removeCommons();
	    arsort($this->m_arTags);
	    $arTopTags = array_slice($this->m_arTags, 0, $this->m_displayedElementsCount);
    	return $arTopTags;
    }

    function setTagsFromCache($cache){
    	$this->m_arTags = $cache;
    }

    function set_commons($commons){
    	$this->commonWords = $commons;
    }

    function sanitize($text) {
        $url_searches = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&ntilde;'); 
        $url_searches_up = array('&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&Ntilde;'); 
        $url_searches_extra = array('á', 'é', 'í', 'ó', 'ú', 'ñ'); 
        $url_searches_extra_up = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'); 
        $url_replacements =   array('a', 'e', 'i', 'o', 'u', 'n');
     
        $text = str_replace($url_searches, $url_replacements, $text);
        $text = str_replace($url_searches_extra, $url_replacements, $text);
        $text = str_replace($url_searches_up, $url_replacements, $text);
        $text = str_replace($url_searches_extra_up, $url_replacements, $text);
        
        return $text;
    }

    function keywords_extract($text)
    {
        $text = strtolower($text);
        $text = strip_tags($text);
      
		$text = $this->sanitize($text);

        /* remove punctuation and newlines */
        /*
         * Changed to handle international characters
         */
        if ($this->m_bUTF8)
            $text = preg_replace('/[^\p{L}0-9\s]|\n|\r/u',' ',$text);
        else
            $text = preg_replace('/[^a-zA-Z0-9\s]|\n|\r/',' ',$text);
            
        /* remove extra spaces created */
        $text = preg_replace('/ +/',' ',$text);
      
        $text = trim($text);
        $words = explode(" ", $text);
        $this->totalWords += count($words);
        $keywords = array();
        foreach ($words as $value) 
        {
            $temp = trim($value);
            if (is_numeric($temp))
                continue;
            $keywords[] = trim($temp);
        }
    
        return $keywords;
    }
  
    function addTagsFromText($SeedText)
    {
        $words = $this->keywords_extract($SeedText);
		foreach ($words as $key => $value)
		{
			$this->addTag($value);
		}
    }

    function removeCommons(){
		/* 
         * Handle common words first because they have punctuation and we need to remove them
         * before removing punctuation.
         */
        $commonWords = $this->commonWords;
        $commonWords = strtolower($commonWords);
        $commonWords = explode(",", $commonWords);
        
        foreach($commonWords as $cw)
        {
            if(isset($this->m_arTags[$cw])){
            	unset($this->m_arTags[$cw]);
            }
        }
    }
	
	function addTag($tag, $useCount = 1)
	{
		$tag = strtolower($tag);
		if (array_key_exists($tag, $this->m_arTags))
			$this->m_arTags[$tag] += $useCount;
		else
			$this->m_arTags[$tag] = $useCount;
	}
	 
}
?>