<?php
include_once('tmhOAuth.php');
class AFX_Social_Media {
    private $credentials;

    function __construct($credentials) {
        $this->credentials = $credentials;
    }

	/*********************************************
	* function getXML($user, $file_name)
	* Returns cached version of file or grabs and caches a new version
	* if there is not a current cached version [or] the cached version is
	* over an hour old.
	*
	* @param string $url Location of file to grab
	* @param string $filename File to save cached version
	* @return string $xmlstring File contents or empty
	***********************************************/
	function getXML($url,$filename) {
		$xmlstring = false;
		if(file_exists($filename)) {
			if(strtotime('+ 1 hour',filemtime($filename)) > strtotime("now")) $xmlstring = file_get_contents($filename);
		}
		if($xmlstring === false) {
			$xmlstring = file_get_contents($url);
			$fh = fopen($filename,'w');
			fwrite($fh,$xmlstring);
			fclose($fh);
		}
		return $xmlstring;
	}
	
	/*********************************************
	* function getJson($file_name)
	* Returns cached version of file or false
	*
	* @param string $filename File to save cached version
	* @return string $string File contents or empty
	***********************************************/
	function getJson($filename) {
		$filestring = false;
		if(file_exists($filename)) {
			if(strtotime('+ 1 hour',filemtime($filename)) > strtotime("now")) $filestring = file_get_contents($filename);
		}
		return $filestring;
	}
	
	/*********************************************
	* function setJson($file_name,$string)
	* Creates new cache file
	*
	* @param string $filename File to save cached version
	* @param string $string File contents
	***********************************************/
	function setJson($filename,$string) {
    	$fh = fopen($filename,'w');
        fwrite($fh,$string);
		fclose($fh);
	}

	/*********************************************
	* function getTimeMessage($datetime)
	* Takes a date and returns an easy to read format based on how
	* long ago it was.
	*
	* @param string $datetime Date that you would like to convert
	* @return string $timemessage Date in easy to read format
	***********************************************/
	function getTimeMessage($datetime) {
		$timeago = (time() - strtotime($datetime));
		$thehours = floor($timeago/3600);
		$theminutes = floor($timeago/60);
		$thedays = floor($timeago/86400);

		if($theminutes < 60){
			if($theminutes < 1){
				$timemessage =  "Less than 1 minute ago";
			} else if($theminutes == 1) {
					$timemessage = $theminutes." minute ago.";
				} else {
				$timemessage = $theminutes." minutes ago.";
			}
		} else if($theminutes > 60 && $thedays < 1){
				if($thehours == 1){
					$timemessage = $thehours." hour ago.";
				} else {
					$timemessage = $thehours." hours ago.";
				}
			} else {
			if($thedays == 1){
				$timemessage = $thedays." day ago.";
			} else {
				$timemessage = $thedays." days ago.";
			}
		}
		return $timemessage;
	}

	/*********************************************
	* function changeLink($string, $tags=false, $nofollow, $target)
	* Returns formated link based on user inputs.
	*
	* @param string $link HTML containing link
	* @param boolean $tags If true then turns to plain text
	* @param boolean $nofollow If true then adds rel 'nofollow'  attribute
	* @param boolean $target If true then adds target '_blank' attribute
	* @return string $link Returns formatted link
	**********************************************/
	function changeLink($link, $tags=false, $nofollow=false, $target=false){
		if($tags) {
			$link = strip_tags($link);
		} else {
			if($target) {
				$link = str_replace("<a", "<a target=\"_blank\"", $link);
			}
			if($nofollow) {
				$link = str_replace("<a", "<a rel=\"nofollow\"", $link);
			}
		}
		return $link;
	}

	/*********************************************
	* function getLatestYouTube($user, $results = 10)
	* Grabs youtube videos and date based on parameters passed.
	*
	* @param string $user Youtube user id
	* @param integer $results Total results
	* @return array $videos Array containing 'date' and 'url' for each row
	**********************************************/
	function getLatestYoutube($user,$results = 10) {
		$rssfeed = "http://gdata.youtube.com/feeds/base/users/{$user}/uploads?orderby=updated&alt=rss&client=ytapi-youtube-rss-redirect&v=2&max-results={$results}";
		$xmlstring = $this->getXML($rssfeed,'youtube.xml');

		$xmlDoc = new DOMDocument();
		$xmlDoc->loadXML($xmlstring);
		$x = $xmlDoc->getElementsByTagName("item"); // get all entries

		$videos = array();
		foreach($x as $item){
			$tmpvideo=array();

			if($item->childNodes->length) {
				foreach($item->childNodes as $i) {
					$tmpvideo[$i->nodeName] = $i->nodeValue;
				}
			}

			$timemessage = $this->getTimeMessage($tmpvideo['pubDate']);

			$matches = array();
			preg_match( "/.*?v=(.*?)&/" , $tmpvideo['link'], $matches );

			$videos[] = array('date'=>$timemessage,'url'=>$matches[1]);
		}

		return $videos;
	}

	/*********************************************
	* Deprecated
	**/
	function getLatestTweet($user,$results, $tags=false, $nofollow=true, $target=true){
		
		return false;
		
	}
	
	function getLatestTweetNew($user, $results, $tags=false, $nofollow=true, $target=true,$cache = true) {
        
        if($cache) $response = $this->getJson('twitter.json');
        else $response = false;
        if($response===false) {
            $tmhOAuth = new tmhOAuth($this->credentials);
             
            $reqArr =  array(
              //'screen_name' => $user, 
              'count' => $results,
              'result_type' => 'recent'
            );
            $reqArr['q'] = "from:{$user} ";
            if(is_array($tags)) {
	            foreach($tags as $tag) {
		             $reqArr['q'] .= " {$tag} OR";
	            }
            }
             $reqArr['q'] = rtrim($reqArr['q'], " OR");
             
            $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/search/tweets.json'), $reqArr );
            if ($tmhOAuth->response['code'] == 200) {
                $response = $tmhOAuth->response['response'];
                if($cache) $this->setJson('twitter.json',$response);
                
            } else {
                echo "<!-- Error retrieving api -->";
                echo htmlentities($tmhOAuth->response['response']);
                return;
            }    
        }
        
        $response = json_decode($response);
		  if(isset($response->statuses)) {
	        $response = $response->statuses;
        }
      
      $tweetarray = array();
		foreach($response as $i=>$tweettag){
			$tweettime = $tweettag->created_at;
			$tweet = $tweettag->text;
			$timemessage = $this->getTimeMessage($tweettime);
			$tweet = $this->changeLink($tweet, $tags, $nofollow, $target);
			$tweetarray[] = array('tweet'=>$tweet,'date'=>$timemessage);
		}
		return $tweetarray;
    }
    
    function getAllTweets($user, $results, $hashtags=false, $nofollow=true, $target=true,$cache = true) {
        
        if($cache) $response = $this->getJson('twitter-all-tweets.json');
        else $response = false;
        if($response===false) {
            $tmhOAuth = new tmhOAuth($this->credentials);
                          
            $reqArr =  array(
              'screen_name' => $user, 
              'count' => $results,
              'exclude_replies' => true,
              'include_rts' => false
            );
             
            $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline.json'), $reqArr );
            if($tmhOAuth->response['code'] == 200) {
                $response = $tmhOAuth->response['response'];
                if($cache) $this->setJson('twitter-all-tweets.json',$response);                
            } else {
                echo "<!-- Error retrieving api -->";
                echo htmlentities($tmhOAuth->response['response']);
                return;
            }    
        }
        
        $response = json_decode($response);
		  if(isset($response->statuses)) {
	        $response = $response->statuses;
        }
      
      $tweetarray = array();
		foreach($response as $i=>$tweettag){
			$tweettime = $tweettag->created_at;
			$tweet = $tweettag->text;
			$timemessage = $this->getTimeMessage($tweettime);
			$tweet = $this->changeLink($tweet, $hashtags, $nofollow, $target);
			if($hashtags !== false) {
				foreach($hashtags as $hashtag) {
					if(strpos($tweet, $hashtag) !== false) $tweetarray[] = array('tweet'=>$tweet, 'date'=>$timemessage);	
				}
			} else $tweetarray[] = array('tweet'=>$tweet, 'date'=>$timemessage);
		}
		return $tweetarray;
    }

}
?>