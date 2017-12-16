<?php
/**
 * Created by PhpStorm.
 * User: prototype
 * Date: 26.10.17
 * Time: 11:25
 */


use Rees\Sanitizer\Sanitizer;


class QueryBuilder
{

    private $sanitizer;

    public function __construct()
    {
        $this->sanitizer = new Sanitizer();
    }

    /**
     * @note Returns navigation rules accroding to sanitize library
     * @return array
     */
    private function getNavigationTimingRules()
    {
        // Construct rules array.
        return [
            'url'      => 'trim',
            'boomerang_version' => 'trim',
            'vis_st' => 'trim',
            'ua_plt' => 'trim',
            'ua_vnd' => 'trim',
            'pid' => 'trim',
            'nt_red_cnt' => 'trim',
            'nt_nav_type' => 'trim',
            'nt_nav_st' => 'trim',
            'nt_red_st' => 'trim',
            'nt_red_end' => 'trim',
            'nt_fet_st' => 'trim',
            'nt_dns_st' => 'trim',
            'nt_dns_end' => 'trim',
            'nt_con_st' => 'trim',
            'nt_con_end' => 'trim',
            'nt_req_st' => 'trim',
            'nt_res_st' => 'trim',
            'nt_res_end' => 'trim',
            'nt_domloading' => 'trim',
            'nt_domint' => 'trim',
            'nt_domcontloaded_st' => 'trim',
            'nt_domcontloaded_end' => 'trim',
            'nt_domcomp' => 'trim',
            'nt_load_st' => 'trim',
            'nt_load_end' => 'trim',
            'nt_unload_st' => 'trim',
            'nt_unload_end' => 'trim',
            'nt_spdy' => 'trim',
            'nt_cinf' => 'trim',
            'nt_first_paint' => 'trim',
            'guid' => 'trim'
        ];
    }

    /**
     * @param array $navigationTimings
     * @return array
     */
    public function generateNavigationTimingsData(array $navigationTimings)
    {
        $iteration = 1;

        $mappedArray = array(
            'url' => $navigationTimings['u'],
            'boomerang_version' => $navigationTimings['v'],
            'vis_st' => $navigationTimings['vis_st'],
            'ua_plt' => $navigationTimings['ua_plt'],
            'ua_vnd' => $navigationTimings['ua_vnd'],
            'pid' => $navigationTimings['pid'],
            'nt_red_cnt' => $navigationTimings['nt_red_cnt'],
            'nt_nav_type' => $navigationTimings['nt_nav_type'],
            'nt_nav_st' => $navigationTimings['nt_nav_st'],
            'nt_red_st' => $navigationTimings['nt_red_st'],
            'nt_red_end' => $navigationTimings['nt_red_end'],
            'nt_fet_st' => $navigationTimings['nt_fet_st'],
            'nt_dns_st' => $navigationTimings['nt_dns_st'],
            'nt_dns_end' => $navigationTimings['nt_dns_end'],
            'nt_con_st' => $navigationTimings['nt_con_st'],
            'nt_con_end' => $navigationTimings['nt_con_end'],
            'nt_req_st' => $navigationTimings['nt_req_st'],
            'nt_res_st' => $navigationTimings['nt_res_st'],
            'nt_res_end' => $navigationTimings['nt_res_end'],
            'nt_domloading' => $navigationTimings['nt_domloading'],
            'nt_domint' => $navigationTimings['nt_domint'],
            'nt_domcontloaded_st' => $navigationTimings['nt_domcontloaded_st'],
            'nt_domcontloaded_end' => $navigationTimings['nt_domcontloaded_end'],
            'nt_domcomp' => $navigationTimings['nt_domcomp'],
            'nt_load_st' => $navigationTimings['nt_load_st'],
            'nt_load_end' => $navigationTimings['nt_load_end'],
            'nt_unload_st' => $navigationTimings['nt_unload_st'],
            'nt_unload_end' => $navigationTimings['nt_unload_end'],
            'nt_spdy' => $navigationTimings['nt_spdy'],
            'nt_cinf' => $navigationTimings['nt_cinf'],
            'nt_first_paint' => $navigationTimings['nt_first_paint'],
            'guid' => $navigationTimings['guid'],
        );


        $rules = $this->getNavigationTimingRules();
        $this->sanitizer->sanitize($rules, $mappedArray);


        return $mappedArray;
    }

    /**
     * @note Resource timing rules - sanitize library
     * @return array
     */
    private function getResourceTimingRules()
    {
        return  [
            'page_view_id' => 'trim',
            'url' => 'trim',
            'startTime' => 'trim',
            'responseEnd' => 'trim',
            'responseStart' => 'trim',
            'requestStart' => 'trim',
            'connectEnd' => 'trim',
            'secureConnectionStart' => 'trim',
            'connectStart' => 'trim',
            'domainLookupEnd' => 'trim',
            'domainLookupStart' => 'trim',
            'redirectEnd' => 'trim',
            'redirectStart' => 'trim',
            'fetchStart' => 'trim',
            'duration' => 'trim',
        ];
    }

    /**
     * Generates resource timing data
     *
     * @param array $timingData
     * @param $pageViewId
     * @return array
     */
    public function generateResourceTimingsQuery(array $timingData, $pageViewId)
    {
        $url = $timingData['name'];

        $mappedData = array(
            'page_view_id' => $pageViewId,
            'url' => $url,
            'startTime' => $timingData['startTime'],
            'responseEnd' => $timingData['responseEnd'],
            'responseStart' => $timingData['responseStart'],
            'requestStart' => $timingData['requestStart'],
            'connectEnd' => $timingData['connectEnd'],
            'secureConnectionStart' => $timingData['secureConnectionStart'],
            'connectStart' => $timingData['connectStart'],
            'domainLookupEnd' => $timingData['domainLookupEnd'],
            'domainLookupStart' => $timingData['domainLookupStart'],
            'redirectEnd' => $timingData['redirectEnd'],
            'redirectStart' => $timingData['redirectStart'],
            'fetchStart' => $timingData['fetchStart'],
            'duration' => $timingData['duration'],
        );

        $rules = $this->getResourceTimingRules();
        $this->sanitizer->sanitize($rules, $mappedData);

        return $mappedData;

    }

    /**
     * @param $gaClientId
     * @param $guid
     * @param $pageViewId
     * @return array
     */
    public function generateGoogleAnalyticsReferenceQuery($gaClientId, $guid, $pageViewId)
    {
        $mappedData = array(
            'guid' => $guid,
            'analytics_client_id' => $gaClientId,
            'page_view_id' => $pageViewId
        );

        return $mappedData;
    }

    /**
     * @param array $mobileConnectionData
     * @param $pageViewId
     * @return array
     */
    public function generateMobileConnectionQuery($mobileConnectionData, $pageViewId)
    {
        $mappedData = array(
            'page_view_id' => $pageViewId
        );

        $mappedData['type']         = !empty($mobileConnectionData['type']) ? $mobileConnectionData['type'] : '';
        $mappedData['bandwidth']    = !empty($mobileConnectionData['bandwidth']) ? $mobileConnectionData['bandwidth'] : '';
        $mappedData['metered']      = !empty($mobileConnectionData['metered']) ? $mobileConnectionData['metered'] : '';
        $mappedData['downlink_max'] = !empty($mobileConnectionData['downlink_max']) ? $mobileConnectionData['downlink_max'] : '';

        return $mappedData;
    }

}