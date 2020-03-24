@extends('layouts.main')

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">DKIM, DMARC and SPF records</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form"  id="dns-form" action="{{ route('dns.dkim-dmarc-spf') }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="form-label-group">

                                                <input type="text" id="domain-column" class="form-control" placeholder="domain.com"
                                                       name="domain">
                                                <label for="domain-column">Domain</label>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-label-group">
                                                <input type="text" id="dkim-selector-column" class="form-control" placeholder="Your domain DKIM DNS selector"
                                                       name="dkim_selector">
                                                <label for="dkim-selector-column">DKIM Selector</label>
                                            </div>
                                        </div>

                                        <div class="col-1 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">DMARC RUA Reports parser</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form"  id="rua-report-form" action="{{ route('dns.rua-report-upload') }}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="form-label-group">

                                                <input type="file" id="report-column" class="form-control" placeholder="domain.com"
                                                       name="report">
                                                <label for="report-column">DMARC RUA report file</label>
                                            </div>
                                        </div>

                                        <div class="col-1 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="report-result">
                                    <div class="row">
                                        <div class="col">
                                            <div  id="report-results-domain" class="alert alert-info">Domain: <span></span></div>
                                        </div>
                                        <div class="col">
                                            <div  id="report-results-start-date" class="alert alert-info">Start Date: <span></span></div>
                                        </div>
                                        <div class="col">
                                            <div  id="report-results-end-date" class="alert alert-info">End Date: <span></span></div>
                                        </div>
                                        <div class="col">
                                            <div  id="report-results-email-provider" class="alert alert-info">Email Provider: <span></span></div>
                                        </div>
                                        <div class="col">
                                            <div  id="report-results-report-id" class="alert alert-info">Report ID: <span></span></div>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="report-results-table">
                                        <thead>
                                        <tr>
                                            <td>IP</td>
                                            <td>DKIM AUTH FAILS</td>
                                            <td>DKIM AUTH PASSES</td>
                                            <td>DKIM ALIGNMENT FAILS</td>
                                            <td>DKIM ALIGNMENT PASSES</td>
                                            <td>SPF AUTH FAILS</td>
                                            <td>SPF AUTH PASSES</td>
                                            <td>SPF ALIGNMENT FAILS</td>
                                            <td>SPF ALIGNMENT PASSES</td>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
