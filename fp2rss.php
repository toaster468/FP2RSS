<?PHP
	/*
		Template for the RSS file
	*/
	include("xml.php");


	/*
		Password and username for the bot

		Remmeber that the password must be MD5 hashed.
	*/
	$p = "";
	$u = "";


	/*
		Variables for the XML stuff

		article variable is for putting the XML code right into the channel tag, where each thread goes
	*/
	$news = new SimpleXMLElement($xml);
	$article = $news->channel[0];

	/*
		Make sure the script doesn't time out.

		functions for getting the threads and OPs for each thread
	*/
	set_time_limit(0);

	function get_threads($user, $pass){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://api.facepun.ch/?username=" . $user . "&password=" . $pass . "&action=getthreads&forum_id=396&page=1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$json = curl_exec ($ch);
		curl_close ($ch);
		$json = json_decode($json, true);
		return($json);
	}

	function get_post($user, $pass, $thread_id, $page){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://api.facepun.ch/?username=" . $user . "&password=" . $pass . "&action=getposts&thread_id=" . $thread_id . "&page=" . $page); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$json = curl_exec ($ch);
		curl_close ($ch);
		$json = json_decode($json, true);
		return($json);
	}

	/*
		Get the threads

		foreach loop through all the threads adding a title, description, link, and source
	*/
	$threads = get_threads( $u, $p);

	foreach($threads["threads"] as $op){
		$post = get_post( $u, $p, $op["id"], 1);
		if($op["id"] == "1089075"){
			//Skip the rules thread
		}else{
			$item = $article->addChild("item");
			$item->addChild("title", $op["title"]);
			$item->addChild("description",	strip_tags($post["posts"][0]["message"]));
			$item->addChild("link", "http://facepunch.com/threads/" . $op["id"]);
			$item->addChild("source", "http://facepunch.com/threads/" . $op["id"]);
		}

	}

	/*
		Save the xml file
	*/
	$news->asXML("fp2rss.xml");
?>