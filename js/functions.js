function submit(){
	$url = $(".link");
	getYoutubeVideoID($url);
}
// URL parser
function getYoutubeVideoID($url){
	$video_id = false;
	$url = parse_url($url);
	
	if (strcasecmp($url['host'], 'youtu.be') === 0)
    {
        //youtu.be/<video id>
        $video_id = substr($url['path'], 1);
    }
    elseif (strcasecmp($url['host'], 'www.youtube.com') === 0)
    {
        if (isset($url['query']))
        {
            parse_str($url['query'], $url['query']);
            if (isset($url['query']['v']))
            {
                //www.youtube.com/(dontcare)?v=<video id>
                $video_id = $url['query']['v'];
            }
        }
        if ($video_id == false)
        {
            $url['path'] = explode('/', substr($url['path'], 1));
            if (in_array($url['path'][0], array('e', 'embed', 'v')))
            {
                //www.youtube.com/(whitelist)/<video id>
                $video_id = $url['path'][1];
            }
        }
    }
    return $video_id;
}

