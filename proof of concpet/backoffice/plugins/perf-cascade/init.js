/**
 * functionality for example page
 * `perfCascade` is a global object if not running in AMD or CommonJS context (it uses UMD)
 */
(function (perfCascade) {

    /** holder DOM element to render PerfCascade into */
    var outputHolderOrig = document.getElementById("waterfall-view");
    /** Select box for multi-page HARs */
    var pageSelectorEl = document.getElementById("page-selector");
    /** Holder element for legend HTML */
    var legendHolderEl = document.getElementById("legend-holder");

    /** options for PerfCascade (all have defaults)
     * Source: /src/ts/typing/options.d.ts
     */
    var perfCascadeOptions = {
        rowHeight: 23, //default: 23
        showAlignmentHelpers: true, //default: true
        showIndicatorIcons: false, //default: true
        leftColumnWith: 55, //default: 25
        pageSelector: pageSelectorEl, //default: undefined
        legendHolder: legendHolderEl, //default: undefined (hide-legend)
        showUserTiming: true //default: false
    };

    /** renders the har (passing in the har.log node) */
    function renderPerfCascadeChartOrig(harLogData) {
        /** remove all children of `outputHolderOrig`,
         * so you can upload new HAR files and get a new SVG  */
        while (outputHolderOrig.childNodes.length > 0) {
            outputHolderOrig.removeChild(outputHolderOrig.childNodes[0]);
        }

        /**
         * THIS IS WHERE THE MAGIC HAPPENS
         * pass HAR and options to `newPerfCascadeHar` to generate the SVG element
         */
        var perfCascadeSvgOrig = perfCascade.fromHar(harLogData, perfCascadeOptions);

        /** append SVG to page - that's it */
        outputHolderOrig.appendChild(perfCascadeSvgOrig);
    }

    /** functionality for "use example HAR" */
    function getHar(e) {
        e.preventDefault();

        // Removing old active classes
        var activeBeaconLinks = document.getElementsByClassName('becon-link active');
        for (var i = 0; i < activeBeaconLinks.length; i++) {
            activeBeaconLinks[i].classList.remove('active');
        }

        var harLink = this.href;

        // Adding active class to current clicked link
        this.classList.add('active');

        var xhrOrig = new XMLHttpRequest();
        xhrOrig.open('GET', harLink, true);

        xhrOrig.addEventListener("readystatechange", function () {
            if (xhrOrig.readyState == 4 && xhrOrig.status == 200) {
                var response = JSON.parse(xhrOrig.responseText);
                renderPerfCascadeChartOrig(response);
            }
        });

        xhrOrig.send();
    }

    var beconLinks = document.getElementsByClassName('becon-link');

    for (var i = 0; i < beconLinks.length; i++) {
        beconLinks[i].addEventListener("click", getHar, false);

        if (i === 0) {
            var harLink = beconLinks[i].href;

            beconLinks[i].classList.add('active');

            var xhrOrig = new XMLHttpRequest();
            xhrOrig.open('GET', harLink, true);

            xhrOrig.addEventListener("readystatechange", function () {
                if (xhrOrig.readyState == 4 && xhrOrig.status == 200) {
                    var response = JSON.parse(xhrOrig.responseText);
                    renderPerfCascadeChartOrig(response);
                }
            });

            xhrOrig.send();
        }
    }

})(window.perfCascade);