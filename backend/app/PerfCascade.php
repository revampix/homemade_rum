<?php

namespace App;


/**
 *
 *
 *
 * @param array $data
 */
/**
{
    "log": {
        "version": "1.2",
        "creator": {
            "name": "Home Made RUM",
            "version": "1"
        },
        "pages": [
            {
                "startedDateTime": "2017-02-11T09:36:22.868Z",
                "id": "page_1",
                "title": "https://github.com/",
                "pageTimings": {
                "onContentLoad": 1995.6460000003062,
                    "onLoad": 4262.566999999763,
                    "firstPaint": 3262.566999999763

                }
            }
        ],
        "entries": [

    ]
    }
}
*/

class PerfCascade
{

    public function boomerangToPerfCascade(array $data)
    {
        $navStart = $data['nt_nav_st'];

        //Fix for some browser versions
        $firstPaint = str_replace('.', '', $data['nt_first_paint']);

        $arr = [
            'log' =>[
                'version' => '1.2',
                'creator' => [
                    'name'    => 'Home Made RUM',
                    'version' => '1'
                ],
                'pages' => [
                    [
                        'startedDateTime' => $this->_milisecondsToISO8601($navStart),
                        'id' => "page_1",
                        'title' => "",
                        'pageTimings' => [
                            "onContentLoad" => $data['nt_domcontloaded_end'] - $navStart,
                            "firstPaint" => $firstPaint - $navStart
                        ]
                    ]
                ],
                'entries' => $this->_generateEntries($data, $navStart)
            ]

        ];

        return $arr;
    }

    private function _generateEntries(array $data, $navStart)
    {
        $perfEntries = [];

        foreach ($data['restiming'] as $timings) {

            $resPath = $timings['url'];
            $perfEntries[] = $this->_createPerfEntry($navStart, $resPath, $timings);
        }

        return $perfEntries;
    }


    /**
     * @param int $navigationStart
     * @param string $resPath
     * @param string $resTimings
     *
     * @return array
     */
    private function _createPerfEntry($navigationStart, $resPath, $resTimings)
    {
        $decodedTimingsArr = $resTimings;

        $perfEntry = [
            "startedDateTime" => $this->_milisecondsToISO8601($navigationStart + (int) $decodedTimingsArr['fetchStart']),
            "time" => (int) $decodedTimingsArr['duration'],
            "request" => [
                "method" => "GET",
                "url" => $resPath,
                "httpVersion" => "HTTP/1.1",
                "headers" => [],
                "queryString" => [],
                "cookies" => [],
                "headersSize" => 0,
                "bodySize" => 0
            ],
            "response" => [
                "status" => 200,
                "statusText" => "OK",
                "httpVersion" => "HTTP/1.1",
                "headers" => [],
                "cookies" => [],
                "content" => [
                    "size" => 0,
                    "mimeType" => "text/html",
                    "compression" => 0
                ],
                "redirectURL" => "",
                "headersSize" => 0,
                "bodySize" => 0,
                "_transferSize" => 0
            ],
            "cache" => [],

            /**
             * Boomcatch
             *
             * Taken from: https://github.com/springernature/boomcatch/blob/37879f54893b1b1974fce45a7a43bb2a21894399/src/mappers/har.js
             *
             * function getTimings (data) {
                return {
                    blocked: parseInt(data.rt_fet_st) - parseInt(data.rt_st),
                    dns: getOptionalDuration(data.rt_dns_st, data.rt_dns_end),
                    connect: getOptionalDuration(data.rt_con_st, data.rt_con_end),
                    // HACK: The resource timing API doesn't provide us with separate
                    //       metrics for `send` and `wait`, so we're assigning all of
                    //       the time to `send` and setting `wait` to zero.
                    send: getOptionalDuration(data.rt_req_st, data.rt_res_st),
                    wait: 0,
                    receive: getOptionalDuration(data.rt_res_st, data.rt_res_end),
                    ssl: getOptionalDuration(data.rt_scon_st, data.rt_con_end)
                };
            }
             */

            "timings" => [
                "blocked" => $decodedTimingsArr['requestStart'] - $decodedTimingsArr['fetchStart'],
                "dns" => $decodedTimingsArr['domainLookupEnd'] - $decodedTimingsArr['domainLookupStart'],
                "connect" => $decodedTimingsArr['connectEnd'] - $decodedTimingsArr['connectStart'],
                "send" => -1,
                "wait" => $decodedTimingsArr['responseStart'] - $decodedTimingsArr['requestStart'],
                "receive" => $decodedTimingsArr['responseEnd'] - $decodedTimingsArr['responseStart'],
                "ssl" => -1 //$decodedTimingsArr['connectEnd'] - $decodedTimingsArr['secureConnectionStart']
            ],
            "serverIPAddress" => "",
            "connection" => "",
            "pageref" => "page_1"
        ];

        return $perfEntry;
    }

    /**
     * @param $milliseconds
     * @return string
     */
    private function _milisecondsToISO8601($milliseconds)
    {
        return date('Y-m-d\TH:i:s', substr($milliseconds, 0, 10)) . '.' . substr($milliseconds, 10) . 'Z';
    }

}

