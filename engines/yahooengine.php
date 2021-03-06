<?php
    /**
     * Copyright 2010 Peter Lind. All rights reserved.

     * Redistribution and use in source and binary forms, with or without modification, are
     * permitted provided that the following conditions are met:

     *    1. Redistributions of source code must retain the above copyright notice, this list of
     *       conditions and the following disclaimer.

     *    2. Redistributions in binary form must reproduce the above copyright notice, this list
     *       of conditions and the following disclaimer in the documentation and/or other materials
     *       provided with the distribution.

     * THIS SOFTWARE IS PROVIDED BY Peter Lind ``AS IS'' AND ANY EXPRESS OR IMPLIED
     * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
     * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL Peter Lind OR
     * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
     * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
     * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
     * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
     * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
     * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

     * The views and conclusions contained in the software and documentation are those of the
     * authors and should not be interpreted as representing official policies, either expressed
     * or implied, of Peter Lind.
     *
     * PHP version 5
     *
     * @package   Engine
     * @author    Peter Lind <peter@plphp.dk>
     * @copyright 2010 Peter Lind
     * @license   http://plind.dk/plseo/#license New BSD License
     * @link      http://www.github.com/Fake51/PLSEO
     */

    /**
     * Yahoo base engine class - all national and non-national Yahoo
     * engine classes should inherit from here
     *
     * @package Engine
     * @author  Peter Lind <peter@plphp.dk>
     */

class YahooEngine extends SearchEngine
{
    protected function getSearchUrl($page)
    {
        $start = $page > 1 ? '&pstart=1&b=' . (($page - 1) * 10 + 1) : '';
        return $this->baseurl . 'search?p=' . rawurlencode($this->keyword) . $start;
    }

    /**
     * parses page fetched from Yahoo
     *
     * @param string $return - page fetched from Yahoo
     *
     * @access protected
     * @return array
     */
    protected function _parseCurlReturn($return)
    {
        preg_match_all('/<h3>(<a class="yschttl.*?)<\/h3>/', $return, $matches);
        if (!empty($matches[1]))
        {
            $i = 1;
            $return = array();
            foreach ($matches[1] as $link)
            {
                if (preg_match('/<a\s+[^>]*href=[\'"]?.*EXP=\d+\/\*\*([^\'" ]+)[\'"]?[^>]*>(.*?)<\/a>/', $link, $match))
                {
                    $l = str_ireplace(array('http%3a//', 'https%3a//'), array('http://', 'http://'), $match[1]);
                    $return[$i] = array('url' => $l, 'headline' => strip_tags($match[2]));
                }
                $i++;
            }
            return $return;
        }
        else
        {
            throw new Exception("No results returned");
        }
    }
}
