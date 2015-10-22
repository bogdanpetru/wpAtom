<?php 
/**
 *
 *  @author Bogdan Petru Pintican
 *  @link  bogdanpintican@gmail.com
 *  @package wpAtom
 *  
 * 
 */

class wpAtom {

	/**
	 * Gets formated rss feed
	 * @param  string $url
	 * @param  int $limit
	 * @return array 
	 */
	public static function get_rss_feed($url, $limit){
		$rss = new DOMDocument();
		$rss->load('http://www.adrcentru.ro/RSS.aspx');        
		$feed = array();
	
		foreach ($rss->getElementsByTagName('item') as $node) {
	    $item = array (        
	        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
	        'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
	        'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
	        'unix' => strtotime($item['date']),
	        'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
	    );
			array_push($feed, $item);
			$limit--;
			if(!$limit){ break; }
		}

		return $feed;
	}

	/**
	 * @return array
	 */
	public static function get_categories(){
		global $post;

		$categories =  get_the_category($post->ID);
		$categories_list = array(); 

		foreach( $categories as $category ){
			$categories_list[] = $category->slug; 	
		}
	}


	public static function getYoutubeImage($videoUrl){
			$re = "/\\?v=(.{11})/";
			preg_match($re, $videoUrl, $videoID);
			$videoID = $videoID[1];

			return "https://img.youtube.com/vi/$videoID/hqdefault.jpg";
	}


	public static function getVimeoImage($videoUrl){

		$re = "/\.com\/(.+)/";
		preg_match($re, $videoUrl, $videoID);

		$videoID = $videoID[1];
		$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $videoID . '.php'));

	    return  $hash[0]['thumbnail_large'];
	}



	public static function getVideoImage($videoUrl){
		$re = "/vimeo/";

		preg_match($re, $videoUrl, $isVimeo);

		if(count($isVimeo) !== 0){
			return $this->getVimeoImage($videoUrl);
		} else {
			return $this->getYoutubeImage($videoUrl);
		}
	}


	public static function trim_words($string, $noWords, $more = ' [...]'){
		if (strlen($string) > $noWords){
		    $string = wordwrap($string, $noWords);
		    $string = substr($string, 0, strpos($string, "\n")) . $more;
		}
		return $string;
	}

	public static function get_custom_post_types(){
		$post_types_list = get_post_types();
		$post_types_arr = array();
		foreach( $post_types_list as $post_type ){
			if( in_array($post_type, array('post')) ) {
				continue;
			}
			
			$post_slug = sanitize_title($post_type);
			$post_types_arr[$post_slug] = __($post_type, 'wpAtom');
		}

		return $post_types_arr;
	}

	/**
	 * From @link https://github.com/roots/sage
	 */
	public static function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'wpAtom');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'wpAtom'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'wpAtom');
  } else {
    return get_the_title();
  }
}


}


?>