<?php
# https://docs.google.com/spreadsheets/d/1XZr6Xo-EH0duwkNFb3ntVs3c5833GNvVUVKjtAgATIw/edit#gid=1807969768
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UrlLog;
class CheckingController extends Controller
{
	//
	public function check(Request $request) {
		return view('list');
	}
	public function results(Request $request) {
		$goodLinks = 0;
		$job_id = time().mt_rand (10000000 , 90000000);
		#max_execution_time = 1500;
	/**
	* Basic cURL wrapper function for PHP
	* @link http://snipplr.com/view/51161/basic-curl-wrapper-function-for-php/
	* @param string $url URL to fetch
	* @param array $curlopt Array of options for curl_setopt_array
	* @return string
	*/
	/**
	* Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
	* array containing the HTTP server response header fields and content.
	*/

		function get_web_page( $url )
		{
			$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 240,      // timeout on connect
			CURLOPT_TIMEOUT        => 240,      // timeout on response
			CURLOPT_MAXREDIRS      => 20,       // stop after 10 redirects
			);
			$ch      = curl_init( $url );
			curl_setopt_array( $ch, $options );
			$content = curl_exec( $ch );
			$err     = curl_errno( $ch );
			$errmsg  = curl_error( $ch );
			$header  = curl_getinfo( $ch );
			curl_close( $ch );
			$header['errno']   = $err;
			$header['errmsg']  = $errmsg;
			$header['content'] = $content;
			return $header;
		}
	
		$failCount = 0;
		$urlList = explode(PHP_EOL, $request->urls);
		$sitesChecked = count($urlList);
		$checkLog = [];
		$noFollowTotal = 0;
		$domainList = [];
		$urlList = array_unique($urlList);

		foreach($urlList as $url) {
		$tcgLinks = 0;	
			set_time_limit(1500);

			if(!stristr($url, 'http://') && !stristr($url, 'https://')) {
				$url = 'http://'.$url;
			}
			array_push($domainList, parse_url($url, PHP_URL_HOST));

			
			$followedLinks = 0;
			$url=trim($url);
			$output = get_web_page($url);
			$out = $output['content'];
			$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
			if(preg_match_all("/$regexp/siU", $out, $matches, PREG_SET_ORDER)) {  // This means we've found an a href in the source.
				foreach($matches as $match) {  // for each link on the page, is it one to us?
					set_time_limit(1500);
					$nofollow = 0;
					$totalURLsPerSite = count($match);
					$score = 0;
					if(stristr($match[2], 'instantcheckmate.com') || stristr($match[2], 'truthfinder.com') || stristr($match[2], 'nextgenleads.com') || stristr($match[2], 'firstquotehealth.com') || stristr($match[2], 'insuranceclarity.com') || stristr($match[2], 'thecontrolgroup.com')) {
						$tcgLinks++;  // it's to one of our sites, so we increment that for this URL.
						$score = 1;
						if(stristr($match[0], 'rel=\'nofollow\'') || stristr($match[0], 'rel="nofollow"') || stristr($match[0], 'rel=nofollow')) {
							$nofollow = 1;
							$score = .25;
							$noFollowTotal++;
						}
						else {
							$nofollow = 0;
							$followedLinks++;
						}
						$linkInfo = [$url, parse_url($url, PHP_URL_HOST), $match[2], $match[0], $match[3], $nofollow, $tcgLinks, $score];
						$url_log = new UrlLog;
						$url_log->url = $linkInfo[0];
						$url_log->domain = parse_url($url, PHP_URL_HOST);
						$url_log->link_code = $linkInfo[3];
						$url_log->target_url = $linkInfo[2];
						$url_log->anchor_text = $linkInfo[1];
						$url_log->nofollow = $nofollow;
						$url_log->links_on_page = $tcgLinks;
						$url_log->job_id = $job_id;
						$url_log->score = $score;
						$url_log->save();
						array_push($checkLog, $linkInfo);
					} 
				}
			}
			if(isset($linkInfo)) {
				#URL had at least one good link;
				if($followedLinks < 1) {
					#There were links but all had no follow;
				}
				else {
					$goodLinks++;
				}
			} else {
				$url_log = new UrlLog;
				if(!stristr($url, 'http://') && !stristr($url, 'https://')) {
							$url = 'http://'.$url;
						}
				$url_log->url = $url;

				$url_log->domain = parse_url($url, PHP_URL_HOST);
				$url_log->job_id = $job_id;
				$url_log->save();
			}
			unset($linkInfo);
		}
		$uniqueDomains = count(array_unique($domainList));
		$validLinks = Urllog::where('nofollow',0)->where('link_code', '!=', '')->groupby('domain')->distinct()->get()->count();

		$resultMessage = "$sitesChecked unique URLs were entered.  Of those, there were $uniqueDomains unique Domains. Of the $sitesChecked unique URLs, $goodLinks had one or more links to us.  There were $noFollowTotal links with nofollow.  In the end there were $validLinks valid links that do not have rel=nofollow and are on unique domains.";

usort($checkLog, function($a, $b) {
    return $a['7'] <=> $b['7'];
});


		return view('results', compact('checkLog', 'resultMessage'));
	}
}