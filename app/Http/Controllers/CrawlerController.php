<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    /**
     * Transfer url information.
     *
     * @param Request $request
     *  url: url to transfer
     *
     * @return string json
     *  screenshot
     *  title
     *  description
     *  body
     *  createdAt
     */
    public function transfer(Request $request)
    {
        $url = $request->input('url', 'https://example.com');

        // do action
        try {
            $info = array();
            $imagePrefix = 'data:image/png;base64,';
            $linkTemplate = '<a href="%s">%s<a/>';

            $client = new Client;

            $httpResponse = $client->get($url);
            $content = $httpResponse->getBody()
                                    ->getContents();

            $crawler = new Crawler();

            $crawler->addHtmlContent($content);
            $title = $crawler->filterXPath('descendant-or-self::head/title')->text('No title!');

            $crawler = new Crawler();

            $crawler->addHtmlContent($content);
            $description = $crawler->filterXPath('//meta[contains(@name, "description")]')->text('No description!');

            $info['screenshot'] = $imagePrefix . Browsershot::url($url)->base64Screenshot();
            $info['title'] = sprintf($linkTemplate, $url, $title);
            $info['description'] = $description;
            $info['createdAt'] = $httpResponse->getHeader('Last-Modified')[0] ?? '';
        } catch (\Throwable $th) {
            Log::error('transferUrlFail', [
                'code' => $th->getCode(),
                'msg' => $th->getMessage()
            ]);
        }

        // set response
        return response()->json($info);
    }

    /**
     * Transfer url detail information.
     *
     * @param Request $request
     *  url: url to transfer
     *
     * @return string json
     *  screenshot
     *  title
     *  description
     *  body
     *  createdAt
     */
    public function transferDetail(Request $request)
    {
        $url = $request->input('url', 'https://example.com');

        // do action
        try {
            $info = array();
            $imagePrefix = 'data:image/png;base64,';
            $linkTemplate = '<a href="%s">%s<a/>';

            $client = new Client;

            $httpResponse = $client->get($url);
            $content = $httpResponse->getBody()
                                    ->getContents();

            $crawler = new Crawler();

            $crawler->addHtmlContent($content);
            $title = $crawler->filterXPath('descendant-or-self::head/title')->text('No title!');

            $crawler = new Crawler();

            $crawler->addHtmlContent($content);
            $description = $crawler->filterXPath('//meta[contains(@name, "description")]')->text('No description!');

            $crawler = new Crawler();

            $crawler->addHtmlContent($content);
            $body = $crawler->filterXPath('descendant-or-self::body')->text('No body!');

            $info['screenshot'] = $imagePrefix . Browsershot::url($url)->base64Screenshot();
            $info['title'] = sprintf($linkTemplate, $url, $title);
            $info['description'] = $description;
            $info['body'] = $body;
            $info['createdAt'] = $httpResponse->getHeader('Last-Modified')[0] ?? '';
        } catch (\Throwable $th) {
            Log::error('transferUrlFail', [
                'code' => $th->getCode(),
                'msg' => $th->getMessage()
            ]);
        }

        // set response
        return response()->json($info);
    }
}
