<?php
// Create Full-Text Feeds
// Author: Keyvan Minoukadeh
// Copyright (c) 2011 Keyvan Minoukadeh
// License: AGPLv3
// Version: 2.5
// Date: 2011-01-08

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Usage
// -----
// Request this file passing it your feed in the querystring: makefulltextfeed.php?url=mysite.org
// The following options can be passed in the querystring:
// * URL: url=[feed or website url] (required, should be URL-encoded - in php: urlencode($url))
// * URL points to HTML (not feed): html=true (optional, by default it's automatically detected)
// * API key: key=[api key] (optional, refer to config.php)
// * Max entries to process: max=[max number of items] (optional)

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);
@set_time_limit(120);

// set include path
set_include_path(realpath(dirname(__FILE__).'/libraries').PATH_SEPARATOR.get_include_path());

// Autoloading of classes allows us to include files only when they're
// needed. If we've got a cached copy, for example, only Zend_Cache is loaded.
function __autoload($class_name) {
	static $mapping = array(
		// Include SimplePie for RSS/Atom parsing
		'SimplePie' => 'simplepie/simplepie.class.php',
		'SimplePie_Misc' => 'simplepie/simplepie.class.php',		
		// Include FeedCreator for RSS/Atom creation
		'FeedWriter' => 'feedwriter/FeedWriter.php',
		'FeedItem' => 'feedwriter/FeedItem.php',
		// Include Readability for identifying and extracting content from URLs
		'Readability' => 'readability/Readability.php',
		// Include Humble HTTP Agent to allow parallel requests and response caching
		'HumbleHttpAgent' => 'humble-http-agent/HumbleHttpAgent.php',
		// Include IRI class for resolving relative URLs
		'IRI' => 'iri/iri.php',
		// Include Zend Cache to improve performance (cache results)
		'Zend_Cache' => 'Zend/Cache.php',
		// Include Zend CSS to XPath for dealing with custom patterns
		'Zend_Dom_Query_Css2Xpath' => 'Zend/Dom/Query/Css2Xpath.php'
	);
	if (isset($mapping[$class_name])) {
		//echo "Loading $class_name\n<br />";
		require_once $mapping[$class_name];
		return true;
	} else {
		return false;
	}
}

////////////////////////////////
// Load config file if it exists
////////////////////////////////
require_once(dirname(__FILE__).'/config.php');
if (file_exists(dirname(__FILE__).'/custom_config.php')) {
	require_once(dirname(__FILE__).'/custom_config.php');
}

//////////////////////////////////////////////
// Convert $html to UTF8
// (uses HTTP headers and HTML to find encoding)
// adapted from http://stackoverflow.com/questions/910793/php-detect-encoding-and-make-everything-utf-8
//////////////////////////////////////////////
function convert_to_utf8($html, $header=null)
{
	$encoding = null;
	if ($html || $header) {
		if (is_array($header)) $header = implode("\n", $header);
		if (!$header || !preg_match_all('/^Content-Type:\s+([^;]+)(?:;\s*charset=["\']?([^;"\'\n]*))?/im', $header, $match, PREG_SET_ORDER)) {
			// error parsing the response
		} else {
			$match = end($match); // get last matched element (in case of redirects)
			if (isset($match[2])) $encoding = trim($match[2], '"\'');
		}
		if (!$encoding) {
			if (preg_match('/^<\?xml\s+version=(?:"[^"]*"|\'[^\']*\')\s+encoding=("[^"]*"|\'[^\']*\')/s', $html, $match)) {
				$encoding = trim($match[1], '"\'');
			} elseif(preg_match('/<meta\s+http-equiv=["\']Content-Type["\'] content=["\'][^;]+;\s*charset=["\']?([^;"\'>]+)/i', $html, $match)) {
				if (isset($match[1])) $encoding = trim($match[1]);
			}
		}
		if (!$encoding) {
			$encoding = 'utf-8';
		} else {
			if (strtolower($encoding) != 'utf-8') {
				if (strtolower($encoding) == 'iso-8859-1') {
					// replace MS Word smart qutoes
					$trans = array();
					$trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
					$trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
					$trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
					$trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
					$trans[chr(134)] = '&dagger;';    // Dagger
					$trans[chr(135)] = '&Dagger;';    // Double Dagger
					$trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
					$trans[chr(137)] = '&permil;';    // Per Mille Sign
					$trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
					$trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
					$trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
					$trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
					$trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
					$trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
					$trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
					$trans[chr(149)] = '&bull;';    // Bullet
					$trans[chr(150)] = '&ndash;';    // En Dash
					$trans[chr(151)] = '&mdash;';    // Em Dash
					$trans[chr(152)] = '&tilde;';    // Small Tilde
					$trans[chr(153)] = '&trade;';    // Trade Mark Sign
					$trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
					$trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
					$trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
					$trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
					$html = strtr($html, $trans);
				}
				$html = SimplePie_Misc::change_encoding($html, $encoding, 'utf-8');

				/*
				if (function_exists('iconv')) {
					// iconv appears to handle certain character encodings better than mb_convert_encoding
					$html = iconv($encoding, 'utf-8', $html);
				} else {
					$html = mb_convert_encoding($html, 'utf-8', $encoding);
				}
				*/
			}
		}
	}
	return $html;
}

function makeAbsolute($base, $elem) {
	$base = new IRI($base);
	foreach(array('a'=>'href', 'img'=>'src') as $tag => $attr) {
		$elems = $elem->getElementsByTagName($tag);
		for ($i = $elems->length-1; $i >= 0; $i--) {
			$e = $elems->item($i);
			//$e->parentNode->replaceChild($articleContent->ownerDocument->createTextNode($e->textContent), $e);
			makeAbsoluteAttr($base, $e, $attr);
		}
		if (strtolower($elem->tagName) == $tag) makeAbsoluteAttr($base, $elem, $attr);
	}
}
function makeAbsoluteAttr($base, $e, $attr) {
	if ($e->hasAttribute($attr)) {
		// Trim leading and trailing white space. I don't really like this but 
		// unfortunately it does appear on some sites. e.g.  <img src=" /path/to/image.jpg" />
		$url = trim(str_replace('%20', ' ', $e->getAttribute($attr)));
		$url = str_replace(' ', '%20', $url);
		if (!preg_match('!https?://!i', $url)) {
			$absolute = IRI::absolutize($base, $url);
			if ($absolute) {
				$e->setAttribute($attr, $absolute);
			}
		}
	}
}

////////////////////////////////
// Check if service is enabled
////////////////////////////////
if (!$options->enabled) { 
	die('The full-text RSS service is currently disabled'); 
}

////////////////////////////////
// Check for feed URL
////////////////////////////////
if (!isset($_GET['url'])) { 
	die('No URL supplied'); 
}
$url = $_GET['url'];
if (!preg_match('!^https?://.+!i', $url)) {
	$url = 'http://'.$url;
}
$valid_url = filter_var($url, FILTER_VALIDATE_URL);
if ($valid_url !== false && $valid_url !== null && preg_match('!^https?://!', $valid_url)) {
	$url = filter_var($url, FILTER_SANITIZE_URL);
} else {
	die('Invalid URL supplied');
}

////////////////////////////////
// Redirect to alternative URL?
////////////////////////////////
if ($options->alternative_url != '' && !isset($_GET['redir']) && mt_rand(0, 100) > 50) {
	$redirect = $options->alternative_url.'?redir=true&url='.urlencode($url);
	if (isset($_GET['html'])) $redirect .= '&html='.urlencode($_GET['html']);	
	if (isset($_GET['key'])) $redirect .= '&key='.urlencode($_GET['key']);
	if (isset($_GET['max'])) $redirect .= '&max='.(int)$_GET['max'];
	if (isset($_GET['links'])) $redirect .= '&links='.$_GET['links'];
	if (isset($_GET['exc'])) $redirect .= '&exc='.$_GET['exc'];
	if (isset($_GET['what'])) $redirect .= '&what='.$_GET['what'];	
	header("Location: $redirect");
	exit;
}

/////////////////////////////////
// Redirect to hide API key
/////////////////////////////////
if (isset($_GET['key']) && ($key_index = array_search($_GET['key'], $options->api_keys)) !== false) {
	$host = $_SERVER['HTTP_HOST'];
	$path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
	$redirect = 'http://'.htmlspecialchars($host.$path).'/makefulltextfeed.php?url='.urlencode($url);
	$redirect .= '&key='.$key_index;
	$redirect .= '&hash='.urlencode(sha1($_GET['key'].$url));
	if (isset($_GET['html'])) $redirect .= '&html='.urlencode($_GET['html']);
	if (isset($_GET['max'])) $redirect .= '&max='.(int)$_GET['max'];
	if (isset($_GET['links'])) $redirect .= '&links='.urlencode($_GET['links']);
	if (isset($_GET['exc'])) $redirect .= '&exc='.urlencode($_GET['exc']);
	if (isset($_GET['what'])) $redirect .= '&what='.urlencode($_GET['what']);
	header("Location: $redirect");
	exit;
}

///////////////////////////////////////////////
// Check if the request is explicitly for an HTML page
///////////////////////////////////////////////
$html_only = (isset($_GET['html']) && ($_GET['html'] == '1' || $_GET['html'] == 'true'));

///////////////////////////////////////////////
// Check if valid key supplied
///////////////////////////////////////////////
$valid_key = false;
if (isset($_GET['key']) && isset($_GET['hash']) && isset($options->api_keys[(int)$_GET['key']])) {
	$valid_key = ($_GET['hash'] == sha1($options->api_keys[(int)$_GET['key']].$url));
}

///////////////////////////////////////////////
// Check URL against list of blacklisted URLs
// TODO: set up better system for this
///////////////////////////////////////////////

if (!empty($options->allowed_urls)) {
	$allowed = false;
	foreach ($options->allowed_urls as $allowurl) {
		if (strstr($url, $allowurl) !== false) {
			$allowed = true;
			break;
		}
	}
	if (!$allowed) die('URL not allowed');
} else {
	foreach ($options->blocked_urls as $blockurl) {
		if (strstr($url, $blockurl) !== false) {
			die('URL blocked');
		}
	}
}

///////////////////////////////////////////////
// Max entries
// see config.php to find these values
///////////////////////////////////////////////
if (isset($_GET['max'])) {
	$max = (int)$_GET['max'];
	if ($valid_key) {
		$max = min($max, $options->max_entries_with_key);
	} else {
		$max = min($max, $options->max_entries);
	}
} else {
	if ($valid_key) {
		$max = $options->default_entries_with_key;
	} else {
		$max = $options->default_entries;
	}
}

///////////////////////////////////////////////
// Link handling
///////////////////////////////////////////////
if (($valid_key || !$options->restrict) && isset($_GET['links']) && in_array($_GET['links'], array('preserve', 'footnotes', 'remove'))) {
	$links = $_GET['links'];
} else {
	$links = 'preserve';
}

///////////////////////////////////////////////
// Exclude items if extraction fails
///////////////////////////////////////////////
if ($options->exclude_items_on_fail == 'user') {
	$exclude_on_fail = (isset($_GET['exc']) && ($_GET['exc'] == '1'));
} else {
	$exclude_on_fail = $options->exclude_items_on_fail;
}

///////////////////////////////////////////////
// Extraction pattern
///////////////////////////////////////////////
$auto_extract = true;
if ($options->extraction_pattern == 'user') {
	$extract_pattern = (isset($_GET['what']) ? trim($_GET['what']) : 'auto');
} else {
	$extract_pattern = trim($options->extraction_pattern);
}
if (($extract_pattern != '') && ($extract_pattern != 'auto')) {
	// split pattern by space (currently only descendants of 'auto' are recognised)
	$extract_pattern = preg_split('/\s+/', $extract_pattern, 2);
	if ($extract_pattern[0] == 'auto') { // parent selector is 'auto'
		$extract_pattern = $extract_pattern[1];
	} else {
		$extract_pattern = implode(' ', $extract_pattern);
		$auto_extract = false;
	}
	// Convert CSS to XPath
	// Borrowed from Symfony's cssToXpath() function: https://github.com/fabpot/symfony/blob/master/src/Symfony/Component/CssSelector/Parser.php
	// (Itself based on Python's lxml library)
	if (preg_match('#^\w+\s*$#u', $extract_pattern, $match)) {
		$extract_pattern = '//'.trim($match[0]);
	} elseif (preg_match('~^(\w*)#(\w+)\s*$~u', $extract_pattern, $match)) {
		$extract_pattern = sprintf("%s%s[@id = '%s']", '//', $match[1] ? $match[1] : '*', $match[2]);
	} elseif (preg_match('#^(\w*)\.(\w+)\s*$#u', $extract_pattern, $match)) {
		$extract_pattern = sprintf("%s%s[contains(concat(' ', normalize-space(@class), ' '), ' %s ')]", '//', $match[1] ? $match[1] : '*', $match[2]);
	} else {
		// if the patterns above do not match, invoke Zend's CSS to Xpath function
		$extract_pattern = Zend_Dom_Query_Css2Xpath::transform($extract_pattern);
	}
} else {
	$extract_pattern = false;
}

/////////////////////////////////////
// Check for valid format
// (stick to RSS for the time being)
/////////////////////////////////////
$format = 'rss';

//////////////////////////////////
// Check for cached copy
//////////////////////////////////
if ($options->caching) {
	$frontendOptions = array(
	   'lifetime' => ($valid_key || !$options->restrict) ? 10*60 : 20*60, // cache lifetime of 10 or 20 minutes
	   'automatic_serialization' => false,
	   'write_control' => false,
	   'automatic_cleaning_factor' => $options->cache_cleanup,
	   'ignore_user_abort' => false
	);
	$backendOptions = array(
		'cache_dir' => ($valid_key) ? $options->cache_dir.'/rss-with-key/' : $options->cache_dir.'/rss/', // directory where to put the cache files
		'file_locking' => false,
		'read_control' => true,
		'read_control_type' => 'strlen',
		'hashed_directory_level' => $options->cache_directory_level,
		'hashed_directory_umask' => 0777,
		'cache_file_umask' => 0664,
		'file_name_prefix' => 'ff'
	);

	// getting a Zend_Cache_Core object
	$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
	$cache_id = md5($max.$url.$valid_key.$links.$exclude_on_fail.$auto_extract.$extract_pattern.(int)isset($_GET['pubsub']));
	
	if ($data = $cache->load($cache_id)) {
		header("Content-type: text/xml; charset=UTF-8");
		if (headers_sent()) die('Some data has already been output, can\'t send RSS file');
		echo $data;
		exit;
	}
}

//////////////////////////////////
// Set Expires header
//////////////////////////////////
if ($valid_key) {
	header('Expires: ' . gmdate('D, d M Y H:i:s', time()+(60*10)) . ' GMT');
} else {
	header('Expires: ' . gmdate('D, d M Y H:i:s', time()+(60*20)) . ' GMT');
}

//////////////////////////////////
// Set up HTTP agent
//////////////////////////////////
$http = new HumbleHttpAgent();

/*
if ($options->caching) {
	$frontendOptions = array(
	   'lifetime' => 30*60, // cache lifetime of 30 minutes
	   'automatic_serialization' => true,
	   'write_control' => false,
	   'automatic_cleaning_factor' => $options->cache_cleanup,
	   'ignore_user_abort' => false
	); 
	$backendOptions = array(
		'cache_dir' => $options->cache_dir.'/http-responses/', // directory where to put the cache files
		'file_locking' => false,
		'read_control' => true,
		'read_control_type' => 'strlen',
		'hashed_directory_level' => $options->cache_directory_level,
		'hashed_directory_umask' => 0777,
		'cache_file_umask' => 0664,
		'file_name_prefix' => 'ff'
	);
	$httpCache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
	$http->useCache($httpCache);
}
*/

////////////////////////////////
// Tidy config
////////////////////////////////
if (function_exists('tidy_parse_string')) {
	$tidy_config = array(
		 'clean' => true,
		 'output-xhtml' => true,
		 'logical-emphasis' => true,
		 'show-body-only' => false,
		 'wrap' => 0,
		 'drop-empty-paras' => true,
		 'drop-proprietary-attributes' => false,
		 'enclose-text' => true,
		 'enclose-block-text' => true,
		 'merge-divs' => true,
		 'merge-spans' => true,
		 'char-encoding' => 'utf8',
		 'hide-comments' => true
	);			
}

////////////////////////////////
// Get RSS/Atom feed
////////////////////////////////
if (!$html_only) {
	$feed = new SimplePie();
	$feed->set_feed_url($url);
	$feed->set_autodiscovery_level(SIMPLEPIE_LOCATOR_NONE);
	$feed->set_timeout(20);
	$feed->enable_cache(false);
	$feed->set_stupidly_fast(true);
	$feed->enable_order_by_date(false); // we don't want to do anything to the feed
	$feed->set_url_replacements(array());
	// initialise the feed
	// the @ suppresses notices which on some servers causes a 500 internal server error
	$result = @$feed->init();
	//$feed->handle_content_type();
	//$feed->get_title();
	if ($result && (!is_array($feed->data) || count($feed->data) == 0)) {
		die('Sorry, no feed items found');
	}
}

////////////////////////////////////////////////////////////////////////////////
// Extract content from HTML (if URL is not feed or explicit HTML request has been made)
////////////////////////////////////////////////////////////////////////////////
if ($html_only || !$result) {
	unset($feed, $result);
	if ($response = $http->get($url)) {
		$effective_url = $response['effective_url'];
		$html = $response['body'];
		$html = convert_to_utf8($html, $response['headers']);	
	} else {
		die('Error retrieving '.$url);
	}
	if ($auto_extract) {
		// Run through Tidy (if it exists).
		// This fixes problems with some sites which would otherwise
		// trouble DOMDocument's HTML parsing.
		if (function_exists('tidy_parse_string')) {
			$tidy = tidy_parse_string($html, $tidy_config, 'UTF8');
			if (tidy_clean_repair($tidy)) {
				$html = $tidy->value;
			}
		}
		$readability = new Readability($html, $effective_url);
		if ($links == 'footnotes') $readability->convertLinksToFootnotes = true;
		if (!$readability->init() && $exclude_on_fail) die('Sorry, could not extract content');
		// content block is detected element
		$content_block = $readability->getContent();
	} else {
		$readability = new Readability($html, $effective_url);
		// content block is entire document
		$content_block = $readability->dom;
	}
	if ($extract_pattern) {
		$xpath = new DOMXPath($readability->dom);
		$elems = @$xpath->query($extract_pattern, $content_block);
		// check if our custom extraction pattern matched
		if ($elems && $elems->length > 0) {
			// get the first matched element
			$content_block = $elems->item(0);
			// clean it up
			$readability->removeScripts($content_block);
			$readability->prepArticle($content_block);
		} else {
			if ($exclude_on_fail) die('Sorry, could not extract content');
			$content_block = $readability->dom->createElement('p', 'Sorry, could not extract content');
		}
	}
	$readability->clean($content_block, 'select');
	if ($options->rewrite_relative_urls) makeAbsolute($effective_url, $content_block);
	$title = $readability->getTitle()->textContent;
	if ($extract_pattern) {
		// get outerHTML
		$content = $content_block->ownerDocument->saveXML($content_block);
	} else {
		$content = $content_block->innerHTML;
	}
	if ($links == 'remove') {
		$content = preg_replace('!</?a[^>]*>!', '', $content);
	}
	if (!$valid_key) {
		$content = $options->message_to_prepend.$content;
		$content .= $options->message_to_append;
	} else {
		$content = $options->message_to_prepend_with_key.$content;	
		$content .= $options->message_to_append_with_key;
	}
	unset($readability, $html);
	$output = new FeedWriter(); //ATOM an option
	$output->setTitle($title);
	$output->setDescription("Content extracted from $url");
	$output->setXsl('css/feed.xsl'); // Chrome uses this, most browsers ignore it
	if ($format == 'atom') {
		$output->setChannelElement('updated', date(DATE_ATOM));
		$output->setChannelElement('author', array('name'=>'Five Filters', 'uri'=>'http://fivefilters.org'));
	}
	$output->setLink($url);
	$newitem = $output->createNewItem();
	$newitem->setTitle($title);
	$newitem->setLink($url);
	if ($format == 'atom') {
		$newitem->setDate(time());
		$newitem->addElement('content', $content);
	} else {
		$newitem->setDescription($content);
	}
	$output->addItem($newitem);
	$output->genarateFeed(); 
	exit;
}

////////////////////////////////////////////
// Create full-text feed
////////////////////////////////////////////
$output = new FeedWriter();
$output->setTitle($feed->get_title());
$output->setDescription($feed->get_description());
$output->setXsl('css/feed.xsl'); // Chrome uses this, most browsers ignore it
if ($valid_key && isset($_GET['pubsub'])) { // used only on fivefilters.org at the moment
	$output->addHub('http://fivefilters.superfeedr.com/');
	$output->addHub('http://pubsubhubbub.appspot.com/');
	$output->setSelf('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
$output->setLink($feed->get_link()); // Google Reader uses this for pulling in favicons
if ($img_url = $feed->get_image_url()) {
	$output->setImage($feed->get_title(), $feed->get_link(), $img_url);
}
if ($format == 'atom') {
	$output->setChannelElement('updated', date(DATE_ATOM));
	$output->setChannelElement('author', array('name'=>'Five Filters', 'uri'=>'http://fivefilters.org'));
}

////////////////////////////////////////////
// Loop through feed items
////////////////////////////////////////////
$items = $feed->get_items(0, $max);	
// Request all feed items in parallel (if supported)
$urls_sanitized = array();
$urls = array();
foreach ($items as $key => $item) {
	$permalink = htmlspecialchars_decode($item->get_permalink());
	$permalink = $http->validateUrl($permalink);
	if ($permalink) {
		$urls_sanitized[] = $permalink;
	}
	$urls[$key] = $permalink;
}
$http->fetchAll($urls_sanitized);
$http->cacheAll();

foreach ($items as $key => $item) {
	$extract_result = false;
	$permalink = $urls[$key];
	$newitem = $output->createNewItem();
	$newitem->setTitle(htmlspecialchars_decode($item->get_title()));
	if ($valid_key && isset($_GET['pubsub'])) { // used only on fivefilters.org at the moment
		if ($permalink !== false) {
			$newitem->setLink('http://fivefilters.org/content-only/redirect.php?url='.urlencode($permalink));
		} else {
			$newitem->setLink('http://fivefilters.org/content-only/redirect.php?url='.urlencode($item->get_permalink()));
		}
	} else {
		if ($permalink !== false) {
			$newitem->setLink($permalink);
		} else {
			$newitem->setLink($item->get_permalink());
		}
	}
	if ($permalink && $response = $http->get($permalink)) {
		$effective_url = $response['effective_url'];
		$html = $response['body'];
		$html = convert_to_utf8($html, $response['headers']);
		if ($auto_extract) {
			// Run through Tidy (if it exists).
			// This fixes problems with some sites which would otherwise
			// trouble DOMDocument's HTML parsing. (Although sometimes it fails
			// to return anything, so it's a bit of tradeoff.)
			if (function_exists('tidy_parse_string')) {
				$tidy = tidy_parse_string($html, $tidy_config, 'UTF8');
				$tidy->cleanRepair();
				$html = $tidy->value;
			}		
			$readability = new Readability($html, $effective_url);
			if ($links == 'footnotes') $readability->convertLinksToFootnotes = true;
			$extract_result = $readability->init();
			// content block is detected element
			$content_block = $readability->getContent();
		} else {
			$readability = new Readability($html, $effective_url);
			// content block is entire document (for now...)
			$content_block = $readability->dom;			
		}
		if ($extract_pattern) {
			$xpath = new DOMXPath($readability->dom);
			$elems = @$xpath->query($extract_pattern, $content_block);
			// check if our custom extraction pattern matched
			if ($elems && $elems->length > 0) {
				$extract_result = true;				
				// get the first matched element
				$content_block = $elems->item(0);
				// clean it up
				$readability->removeScripts($content_block);
				$readability->prepArticle($content_block);
			}
		}
	}
	// if we failed to extract content...
	if (!$extract_result) {
		if ($exclude_on_fail) continue; // skip this and move to next item
		if (!$valid_key) {
			$html = $options->error_message;
		} else {
			$html = $options->error_message_with_key;
		}
		// keep the original item description
		$html .= $item->get_description();
	} else {
		$readability->clean($content_block, 'select');
		if ($options->rewrite_relative_urls) makeAbsolute($effective_url, $content_block);
		if ($extract_pattern) {
			// get outerHTML
			$html = $content_block->ownerDocument->saveXML($content_block);
		} else {
			$html = $content_block->innerHTML;
		}
		// post-processing cleanup
		$html = preg_replace('!<p>[\s\h\v]*</p>!u', '', $html);
		if ($links == 'remove') {
			$html = preg_replace('!</?a[^>]*>!', '', $html);
		}
		if (!$valid_key) {
			$html = $options->message_to_prepend.$html;
			$html .= $options->message_to_append;
		} else {
			$html = $options->message_to_prepend_with_key.$html;	
			$html .= $options->message_to_append_with_key;
		}	
	}
	if ($format == 'atom') {
		$newitem->addElement('content', $html);
		$newitem->setDate((int)$item->get_date('U'));
		if ($author = $item->get_author()) {
			$newitem->addElement('author', array('name'=>$author->get_name()));
		}
	} else {
		if ($valid_key && isset($_GET['pubsub'])) { // used only on fivefilters.org at the moment
			$newitem->addElement('guid', 'http://fivefilters.org/content-only/redirect.php?url='.urlencode($item->get_permalink()), array('isPermaLink'=>'false'));
		} else {
			$newitem->addElement('guid', $item->get_permalink(), array('isPermaLink'=>'true'));
		}
		$newitem->setDescription($html);
		if ((int)$item->get_date('U') > 0) {
			$newitem->setDate((int)$item->get_date('U'));
		}
		if ($author = $item->get_author()) {
			$newitem->addElement('dc:creator', $author->get_name());
		}
	}
	$output->addItem($newitem);
	unset($html);
}
// output feed
if ($options->caching) {
	ob_start();
	$output->genarateFeed();
	$output = ob_get_contents();
	ob_end_clean();
	$cache->save($output, $cache_id);
	echo $output;
} else {
	$output->genarateFeed();
}
?>