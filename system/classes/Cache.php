<?php

class Cache
{

    public $url;

    public function startFullCache()
    {
        $this->url = '../tmp/cache/' . md5($_SERVER['PHP_SELF'] . $_SERVER['QUERY_STRING']);
        if ((filesize($this->url) > 1) && (time() - filectime($this->url)) < (60 * 15)) {
            readfile($this->url);
            exit;
        }
        ob_start();
        return $this->url;
    }

    public function endFullCache($cacheUrl)
    {
        $output = ob_get_contents();
        ob_end_clean();
        file_put_contents($cacheUrl, $output);
        echo $output;
        flush();
    }
}
