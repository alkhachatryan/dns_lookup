<?php

namespace App\Http\Controllers;

use App\Http\Requests\DkimDmarcSpfRecordsRequest;
use Illuminate\Http\Request;

class DNSLookupController extends Controller
{
    /**
     * The domain to query.
     *
     * @var string
    */
    private $domain;

    /**
     * DKIM selector for domain.
     * Could be not filled.
     *
     * In case if it's empty - the controller will not ask for this record.
     *
     * @var string|null
    */
    private $dkim_selector;

    /**
     * Get DKIM, DMARC and SPF records of the domain.
     *
     * @param DkimDmarcSpfRecordsRequest $request
     * @return array
    */
    public function getDkimDmarcSpfRecords(DkimDmarcSpfRecordsRequest $request){
        $this->domain        = $request->input('domain');
        $this->dkim_selector = $request->input('dkim_selector');

        $result = [
            'dmarc' => $this->dmarcRecordsEnabled(),
            'spf'   => $this->spfRecordsEnabled(),
        ];

        if($request->filled('dkim_selector'))
            $result['dkim'] = $this->dkimRecordsEnabled();

        return $result;
    }

    /**
     * Check if the DMARC records enabled for domain.
     *
     * @return boolean
     */
    private function dmarcRecordsEnabled(){
        return count(dns_get_record('_dmarc.' . $this->domain, DNS_TXT)) > 0;
    }

    /**
     * Check if the SPF records enabled for domain.
     *
     * @return boolean
     */
    private function spfRecordsEnabled(){
        $records = dns_get_record($this->domain, DNS_TXT);

        foreach ($records as $record) {
            $txt = strtolower($record['txt']);
            // An SPF record can be empty (no mechanism)
            if ($txt == 'v=spf1' || stripos($txt, 'v=spf1 ') === 0)
                return true;
        }

        return false;
    }

    /**
     * Check if the DKIM records enabled for domain.
     *
     * @return boolean
     */
    private function dkimRecordsEnabled(){
        return count(dns_get_record($this->dkim_selector . '._domainkey.' . $this->domain, DNS_TXT)) > 0;
    }
}
