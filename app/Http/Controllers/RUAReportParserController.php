<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseRuaReportRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RUAReportParserController extends Controller
{
    /**
     * Parse DMARC RUA report XML file.
     *
     * @param ParseRuaReportRequest $request
     * @return array
    */
    public function parseRuaReport(ParseRuaReportRequest $request){
        $file_content = stripslashes(file_get_contents($request->file('report')->getRealPath()));

        $parsed = simplexml_load_string($file_content);

        $result = [
            'domain'         => (string)$parsed->policy_published->domain,
            'start_date'     => Carbon::createFromTimestamp($parsed->report_metadata->date_range->begin)->toDateTimeString(),
            'end_date'       => Carbon::createFromTimestamp($parsed->report_metadata->date_range->end)->toDateTimeString(),
            'email_provider' => (string)$parsed->report_metadata->org_name,
            'report_id'      => (string)$parsed->report_metadata->report_id,
            'rows'           => []
        ];

        foreach ($parsed->record as $record){
            $count = (integer)$record->row->count;

            $result['rows'][] = [
                'ip' => (string)$record->row->source_ip,
                'dkim' => [
                    'auth' => [
                        'fail'    => $record->auth_results->dkim->result == 'fail' ? $count : 0,
                        'success' => $record->auth_results->dkim->result == 'pass' ? $count : 0,
                    ],
                    'alignment' => [
                        'fail'    => $record->row->policy_evaluated->dkim == 'fail' ? $count : 0,
                        'success' => $record->row->policy_evaluated->dkim == 'pass' ? $count : 0,
                    ],
                ],
                'spf' => [
                    'auth' => [
                        'fail'    => $record->auth_results->spf->result == 'fail' ? $count : 0,
                        'success' => $record->auth_results->spf->result == 'pass' ? $count : 0,
                    ],
                    'alignment' => [
                        'fail'    => $record->row->policy_evaluated->spf == 'fail' ? $count : 0,
                        'success' => $record->row->policy_evaluated->spf == 'pass' ? $count : 0,
                    ],
                ],
            ];
        }

        return $result;
    }
}
