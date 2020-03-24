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
@endsection
