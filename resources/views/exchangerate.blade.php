@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-12" >
			<h2>Currency Exchange Rate <small></small></h2>
			<div class="row">
				<div class="col-sm-9">
					<div id="exchangeRate" class="table-responsive">
						<div class="loading-image">
							<h1 style="text-align: center">Loading exchange rate...</h1><br><br><br><br>
						</div>
					</div>
				</div>

				<div class="col-sm-3">
					<div id="currency_widget_holder"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ url('currency_widget/css/ui-lightness/jquery-ui-1.8.2.custom.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ url('currency_widget/css/currency_widget.css') }}" />
@endsection

@section('js')
<script type="text/javascript" src="{{ url('currency_widget/js/jquery.currency_widget.js') }}"></script>

<script>
	$(document).ready(function() {  
      getExchangeRate(); //Get the initial currency rate.
      //setInterval(getExchangeRate, 14400000); //Update the currency rate every 4 hours.
      $('#currency_widget_holder').currency_widget({ 
      		url: '{{url("/api/currencyconverter")}}',
 			source_currencies: { 'BHD': 'Bahraini Dinar', 'KWD': 'Kuwaiti Dinar', 'OMR':'Omani Riyal', 'QAR':'Qatari Riyal', 'SAR':'Saudi Riyal', 'AED':'UAE Dirham', 'USD':'US Dollar', 'EUR':'Euro' },
 			target_currencies: { 'BHD': 'Bahraini Dinar', 'KWD': 'Kuwaiti Dinar', 'OMR':'Omani Riyal', 'QAR':'Qatari Riyal', 'SAR':'Saudi Riyal', 'AED':'UAE Dirham', 'USD':'US Dollar', 'EUR':'Euro' }
			}); // set the available currencies

    });

    function getExchangeRate() {
      $.ajax({
      	url: "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22BHDUSD%22,%20%22KWDUSD%22,%20%22OMRUSD%22,%20%22QARUSD%22,%20%22SARUSD%22,%20%22AEDUSD%22)&env=store://datatables.org/alltableswithkeys",
        
        success: function(result) {
	    	var rate = result.getElementsByTagName("rate");

	    	html = '<table class="table table-striped table-bordered"><thead><tr><th>Currency</th><th>Date</th><th>Time</th><th>Selling Rate (USD)</th><th>Purchasing Rate (USD)</th></tr><thead><tbody>';
			for(var i = 0; i < rate.length; i++) {
			    var name = rate[i].childNodes[0].textContent;
			    var date = rate[i].childNodes[2].textContent;
			    var time = rate[i].childNodes[3].textContent;
			    var ask = rate[i].childNodes[4].textContent;
			    var bid = rate[i].childNodes[5].textContent;
			    html += '<td>'+name+"</td><td>"+date+"</td><td>"+time+"</td><td>"+ask+"</td><td>"+bid+'</td></tr>';
			}
			html += '<tbody></table>';

			$("#exchangeRate").html(html);
        },
        error: function(error) {
          $("#exchangeRate").html('<p>'+error+'</p>');
        }
      });
    }
</script>

@endsection