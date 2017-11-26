<?php
class Beacon_MobileConnection
{
    /**
     * This class aims to catch what we pass from Mobile Boomerang JS Plugin
     *
     * This is how the JS part of the plugin looks so far.
     *
     * (function() {
     *   var connection;
     *
     *   if (typeof navigator === "object") {
     *      connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection || navigator.msConnection;
     *   }
     *
     *   if (!connection) {
     *      return;
     *   }
     *
     *   BOOMR.addVar({
     *      "mob.ct": connection.type,
     *      "mob.bw": connection.bandwidth,
     *      "mob.mt": connection.metered
     *   });
     *
     *   if (connection.downlinkMax) {
     *      BOOMR.addVar("mob.lm", connection.downlinkMax);
     *   }
     * }());
     */

    /**
     * @param array $beacon
     * @return array
     */
    public function extractMobileConnectionAttributesFromBeacon(array $beacon)
    {
        $mobileConnectionAttributes = [];

        if (!empty($beacon['mob_ct'])) {
            $mobileConnectionAttributes['type'] = $beacon['mob_ct'];
        }

        if (!empty($beacon['mob_bw'])) {
            $mobileConnectionAttributes['bandwidth'] = $beacon['mob_bw'];
        }

        if (!empty($beacon['mob_mt'])) {
            $mobileConnectionAttributes['metered'] = $beacon['mob_mt'];
        }

        if (!empty($beacon['mob_lm'])) {
            $mobileConnectionAttributes['downlink_max'] = $beacon['mob_lm'];
        }

        return $mobileConnectionAttributes;
    }

}