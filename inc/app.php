<?php 


/**
 *
 *	Document standard.
 *	Good names
 *	Comments for complex pices of code
 *	@var type of class prop
 *	@param   [varname] [description]
 *	@return [type] [description]
 *  @author [author] <[email]>
 *  @package [name]
 *  
 * 
 */


class simepleStart {

	/**
	 * Gets the Rss Feed
	 * 
	 * Returns a array of arrays, each array has the keys:
	 * - title
	 * - date
	 * - unix
	 * - description
	 * 
	 * @param  string $url
	 * @param  int $limit
	 * @return array 
	 */
	public static function get_rss_feed($url, $limit)

	{

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
			if(!$limit){
				break;
			}
		}

	}

	/**
	 * Get Pagination
	 * @param  queryObject &$query_object [description]
	 * @return text/htmt
	 */
	public static function get_pagination(&$query_object){
			$big = 999999999; // need an unlikely integer
			$pagination =  paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, $query_object->get( 'page' ) ),
				'total' => $query_object->max_num_pages
			));	

		return $pagination;
	}

	/**
	 * Retrives Categories
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
}


?>