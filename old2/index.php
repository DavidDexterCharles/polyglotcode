<?php

/*
  Requires PHP MarkDown
  http://michelf.com/projects/php-markdown/
*/

/*
  The first step is to build a PHP function that will
  connect to GitHub using cURL:
*/

/* gets url */
function get_content_from_github($url, $requestType = 'GET', $data = array(), $header = true)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_USERAGENT, "yiiext.components.github-api (v 0.5dev)");
    // curl_setopt($ch, CURLOPT_HEADER, $header); // returns header in output
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    switch ($requestType) {

      default:

      case 'GET':

        curl_setopt($ch, CURLOPT_HTTPGET, true);

        break;

      case 'POST':

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        break;

      case 'PUT':

        curl_setopt($ch, CURLOPT_PUT, true);
        // curl_setopt($ch, CURLOPT_INFILE, $file=fopen(...));
        // curl_setopt($ch, CURLOPT_INFILESIZE, strlen($data));

        break;
    }

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $content = curl_exec($ch);

    curl_close($ch);

    return $content;
}

/*
  Next we need to define a few settings
*/

/* static settings */
$plugin      = 'Overlay';
$cache_path  = $_SERVER['DOCUMENT_ROOT'] . '/plugin-cache/';
$cache_file  = $plugin . '-github.txt';
$github_json = get_repo_json($cache_path . $cache_file, $plugin);

/*
  The next step is to create another PHP function that grabs the repository
  information (JSON-encoded, because I love JSON) -- either fresh from GitHub
  (by first grabbing the most recent commit hash, then grabbing the contents
  of the two files) or our local cached information:
*/

/* gets the contents of a file if it exists, otherwise grabs and caches */
function get_repo_json($file, $plugin)
{
    //vars
    $current_time = time();
    $expire_time  = 24 * 60 * 60;
    $file_time    = filemtime($file);

    //decisions, decisions
    if (file_exists($file) && ($current_time - $expire_time < $file_time)) {

        //echo 'returning from cached file';
        return json_decode(file_get_contents($file));
    }

    else {
        $json           = array();
        $json['repo']   = json_decode(get_content_from_github('http://github.com/api/v2/json/repos/show/darkwing/' . $plugin), true);
        $json['commit'] = json_decode(get_content_from_github('http://github.com/api/v2/json/commits/list/darkwing/' . $plugin . '/master'), true);
        $json['readme'] = json_decode(get_content_from_github('http://github.com/api/v2/json/blob/show/darkwing/' . $plugin . '/' . $json['commit']['commits'][0]['parents'][0]['id'] . '/Docs/' . $plugin . '.md'), true);
        $json['js']     = json_decode(get_content_from_github('http://github.com/api/v2/json/blob/show/darkwing/' . $plugin . '/' . $json['commit']['commits'][0]['parents'][0]['id'] . '/Source/' . $plugin . '.js'), true);
echo "Apples";
        file_put_contents($file, json_encode($json));

        return $content;
    }
}

/*
  Once we've acquired the appropriate information, we output the information
  to screen:
*/

/* build json */
if ($github_json) {

    //get markdown
    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/walshbook3/PHP-Markdown-Extra-1.2.4/markdown.php');

    //build content
    $content = '<p>' . $github_json['repo']['repository']['description'] . '</p>';
    $content .= '<h2>MooTools JavaScript Class</h2><pre class="js lit">' . $github_json['js']['blob']['data'] . '</pre><br>';
    $content .= trim(str_replace(array(
        '<code>',
        '</code>'
    ), '', Markdown($github_json['readme']['blob']['data'])));
}

/*
  That's all! Now I get the benefit of hosting my code on GitHub but displaying
  it on my own website. I've created a special WordPress template page to do
  so and recommend you do too!
*/

?>