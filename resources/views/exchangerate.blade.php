@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12" >
			<h2>Currency exchange rate <small></small></h2>
			<div id="exchangeRate" class="table-responsive">
				<div class="loading-image">
					<h1 style="text-align: center">Loading exchange rate...</h1><br><br><br><br>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('css')
@endsection

@section('js')
<script>
	$(document).ready(function() {  
      getExchangeRate(); //Get the initial currency rate.
      //setInterval(getExchangeRate, 14400000); //Update the currency rate every 4 hours.
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