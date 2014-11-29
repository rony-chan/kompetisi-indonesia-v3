<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sitemap extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->helper(array('text','url'));
		$this->load->library('google_sitemap'); //Load Plugin
	}
	function index()
	{
	$sitemap = new google_sitemap; //Create a new Sitemap Object
	$item = new google_sitemap_item(base_url()."start/kompetisi/jelajah",date("Y-m-d"), 'weekly', '0.8' ); 
	//Create a new Item
	$sitemap->add_item($item); //Append the item to the sitemap object
	$item = new google_sitemap_item(base_url()."start/kompetisi/news",date("Y-m-d"), 'weekly', '0.8' ); //Create a new Item
	$sitemap->add_item($item); //Append the item to the sitemap object
	$sitemap->build("./sitemap.xml"); //Build it…
	//Let's compress it to gz
	$data = implode("", file("./sitemap.xml"));
	$gzdata = gzencode($data, 9);
	$fp = fopen("./sitemap.xml.gz", "w");
	fwrite($fp, $gzdata);
	fclose($fp);
	//Let's Ping google
	$this->_pingGoogleSitemaps(base_url()."/sitemap.xml.gz");
	}
	function _pingGoogleSitemaps( $url_xml )
	{
		$status = 0;
		$google = 'http://blogsearch.google.com/ping';
		if( $fp=@fsockopen($google, 80) )
		{
			$req = 'GET /ping?url=' .
			urlencode( $url_xml ) . "&btnG=Submit+Blog&hl=en HTTP/1.1\r\n" .
			"Host: $google\r\n" .
			"User-Agent: Mozilla/5.0 (compatible; " .
				PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
	"Connection: Close\r\n\r\n";
	print_r($req);
	fwrite( $fp, $req );
	while( !feof($fp) )
	{
		if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) )
		{
			$status = intval( $m[1] );
			break;
		}
	}
	fclose( $fp );
	}
	return( $status );
	}
}