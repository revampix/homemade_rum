<?php

class Query
{

    /**
     * @param array $navigationTimings
     * @param string $guid
     *
     * @return string
     */
    public function insertNavigationTimings(array $navigationTimings, $guid)
    {
        $iteration = 1;

        return $query = "INSERT INTO navigation_timings
            (url,
            boomerang_version,
            vis_st,
            ua_plt,
            ua_vnd,
            pid,
            nt_red_cnt,
            nt_nav_type,
            nt_nav_st,
            nt_red_st,
            nt_red_end,
            nt_fet_st,
            nt_dns_st,
            nt_dns_end,
            nt_con_st,
            nt_con_end,
            nt_req_st,
            nt_res_st,
            nt_res_end,
            nt_domloading,
            nt_domint,
            nt_domcontloaded_st,
            nt_domcontloaded_end,
            nt_domcomp,
            nt_load_st,
            nt_load_end,
            nt_unload_st,
            nt_unload_end,
            nt_spdy,
            nt_cinf,
            nt_first_paint,
            guid)

            VALUES ('{$navigationTimings['u']}',
            '{$navigationTimings['v']}',
            '{$navigationTimings['vis_st']}',
            '{$navigationTimings['ua_plt']}',
            '{$navigationTimings['ua_vnd']}',
            '{$navigationTimings['pid']}',
            {$navigationTimings['nt_red_cnt']},
            {$navigationTimings['nt_nav_type']},
            {$navigationTimings['nt_nav_st']},
            {$navigationTimings['nt_red_st']},
            {$navigationTimings['nt_red_end']},
            {$navigationTimings['nt_fet_st']},
            {$navigationTimings['nt_dns_st']},
            {$navigationTimings['nt_dns_end']},
            {$navigationTimings['nt_con_st']},
            {$navigationTimings['nt_con_end']},
            {$navigationTimings['nt_req_st']},
            {$navigationTimings['nt_res_st']},
            {$navigationTimings['nt_res_end']},
            {$navigationTimings['nt_domloading']},
            {$navigationTimings['nt_domint']},
            {$navigationTimings['nt_domcontloaded_st']},
            {$navigationTimings['nt_domcontloaded_end']},
            {$navigationTimings['nt_domcomp']},
            {$navigationTimings['nt_load_st']},
            {$navigationTimings['nt_load_end']},
            {$navigationTimings['nt_unload_st']},
            {$navigationTimings['nt_unload_end']},
            {$navigationTimings['nt_spdy']},
            '{$navigationTimings['nt_cinf']}',
            {$navigationTimings['nt_first_paint']},
            {$guid});";
    }

    public function insertResourceTimingsQuery(array $timingData, $pageViewId)
    {
        $url = $timingData['name'];

        return $query = "INSERT INTO resource_timings
            (page_view_id,
            url,
            startTime,
            responseEnd,
            responseStart,
            requestStart,
            connectEnd,
            secureConnectionStart,
            connectStart,
            domainLookupEnd,
            domainLookupStart,
            redirectEnd,
            redirectStart,
            fetchStart,
            duration)

            VALUES ($pageViewId,
            '{$url}',
            {$timingData['startTime']},
            {$timingData['responseEnd']},
            {$timingData['responseStart']},
            {$timingData['requestStart']},
            {$timingData['connectEnd']},
            {$timingData['secureConnectionStart']},
            {$timingData['connectStart']},
            {$timingData['domainLookupEnd']},
            {$timingData['domainLookupStart']},
            {$timingData['redirectEnd']},
            {$timingData['redirectStart']},
            {$timingData['fetchStart']},
            {$timingData['duration']})";
    }

}