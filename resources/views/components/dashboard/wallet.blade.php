<div class="col-md-4 col-sm-6 col-xs-12 pull-right">
    <div class="panel panel-default wallet-panel">
        <div class="panel-body">
            <div class="row" style="margin-top:1rem;">
                <div class="col-md-8 col-md-8 col-xs-8">
                    <div class="row">
                        <div class="col-md-12">
                            <span>اعتبار: {{Auth::user()->all_credit()}} تومان</span>
                            <br>
                            @if(Auth::user()->isManager() || Auth::user()->isDoctor() || Auth::user()->isNurse())
                                <span>قابل برداشت: {{Auth::user()->avialable_credit()}} تومان</span>
                            @endif
                        </div>
                      
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <img src="{{asset('/imgs/001-wallet.svg')}}">
                </div>
                @if(Auth::user()->isManager())
                    <div class="col-md-12">
                        <a class="btn btn-default btn-checkout" href="{{route('panel.transactions.create.withdraw')}}">تسویه حساب</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>