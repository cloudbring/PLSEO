#!/usr/bin/env php
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
     * @package   Client
     * @author    Peter Lind <peter@plphp.dk>
     * @copyright 2010 Peter Lind
     * @license   http://plind.dk/plseo/#license New BSD License
     * @link      http://www.github.com/Fake51/PLSEO
     */


if ($_SERVER['argc'] < 3)
{
    echo <<<TXT
PLSEO - Search Engine Position Checker
Version: 0.8
Author: Peter Lind <peter@plphp.dk>

Usage:
    <run_script.sh> domain keyword(s) [search engine] [max pages to check] [user agent]

Example:
    ./run_script.sh plphp.dk "typo3" 15

TXT;
    exit;
}

require_once dirname(__FILE__) . '/searchclient.php';

$site    = $_SERVER['argv'][1];
$keyword = $_SERVER['argv'][2];
$engine  = !empty($_SERVER['argv'][3]) ? $_SERVER['argv'][3] : null;
$pages   = !empty($_SERVER['argv'][4]) && intval($_SERVER['argv'][4]) ? $_SERVER['argv'][4] : 10;
$agent   = !empty($_SERVER['argv'][5]) ? $_SERVER['argv'][5] : null;

$client = new SearchClient($site, $keyword, $pages, $agent);
var_dump($client->findRankings($engine));

