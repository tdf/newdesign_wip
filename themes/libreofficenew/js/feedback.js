// javascript for feedback page
(function($) {
    $(document).ready(function() {
        var entry_parms = {};
        var urlParams;
        var match,
            pl     = /\+/g,  // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
            query  = window.location.search.substring(1);

        urlParams = {};
        while (match = search.exec(query))
            urlParams[decode(match[1])] = decode(match[2]);

        var componentMap = {
            DrawingDocument:        'Draw',
            BasicIDE:               'BASIC',
            Bibliography:           'LibreOffice',
            ChartDocument:          'Chart',
            DataSourceBrowser:      'Base',
            FormDesign:             'Base',
            FormulaProperties:      'Formula Editor',
            GlobalDocument:         'LibreOffice',
            OfficeDatabaseDocument: 'Base',
            PresentationDocument:   'Impress',
            QueryDesign:            'Base',
            SpreadsheetDocument:    'Calc',
            StartModule:            'LibreOffice',
            TableDataView:          'Base',
            TableDesign:            'Base',
            TextDocument:           'Writer',
            XMLFormDocument:        'Base'
        };
        // browser based os query...
        var OSName = 'unknown';
        if (navigator.userAgent.indexOf("Win")!=-1)   OSName='Windows (All)';
        if (navigator.userAgent.indexOf("Mac")!=-1)   OSName='Mac OS X (All)';
        if (navigator.userAgent.indexOf("X11")!=-1)   OSName='Linux (All)';
        if (navigator.userAgent.indexOf("Linux")!=-1) OSName='Linux (All)';
        // for the os in the autodetection, we only support 32bit or 64bit builds
        // so don't bother to check for others
        var OSArch = 'x86';
        if (navigator.userAgent.indexOf("x86_64")!=-1) OSArch='x86_64';
        if (navigator.userAgent.indexOf("WOW64")!=-1)  OSArch='x86_64';

        // LOversion=5.0.0.5&LOlocale=de&LOmodule=TextDocument
        // product=LibreOffice&bug_status=UNCONFIRMED&bug_severity=enhancement&format=guided&buildid=LibreOffice%205.1.0.0.alpha1&additional_info=%0A[Information%20Automatically%20Included%20from%20LibreOffice]%0ALOlocale:%20en-US%0ALOmodule:%20StartModule%0ALangPack:%20Foobar%0AOS:%20SuperAmigaAndroid%20(x86_64)
        entry_parms['format'] = 'guided';
        if ('LOversion' in urlParams) {
            entry_parms['product'] = 'LibreOffice';
            if (urlParams['LOmodule'] in componentMap) {
                entry_parms['component'] = componentMap[urlParams['LOmodule']];
            }
            entry_parms['bug_status'] = 'UNCONFIRMED';
            entry_parms['buildid'] = 'LibreOffice ' + urlParams['LOversion'];
            entry_parms['additional_info'] = '[Information automatically included from LibreOffice]'
                                           + '\nLocale: ' + urlParams['LOlocale']
                                           + '\nModule: ' + urlParams['LOmodule']
                                           + '\n[Information guessed from browser]';
            if (OSName != 'unknown') {
                // assuming most users don't spoof their user agent string, browser OS and LO version should match up
                // this isn't true for the arch - as you can have either in 32bit, even if your OS supports 64bit...
                entry_parms['op_sys'] = OSName;
                entry_parms['additional_info'] += '\nOS: ' + OSName;
                entry_parms['additional_info'] += '\nOS is 64bit: ' + (OSArch == 'x86_64' ? 'yes' : 'no');
            } else {
                // fall back to complete user agent if not matched
                entry_parms['additional_info'] += '\nBrowser information: ' + navigator.userAgent;
            }
        }
        var buglink = $("div.container a[href^='https://bugs.documentfoundation.org/enter_bug.cgi']");
        buglink.attr('href', 'https://bugs.documentfoundation.org/enter_bug.cgi?' + jQuery.param(entry_parms));
    })
})(jQuery);
