$(document).ready(function() {  
  getExchangeRate(); //Get the initial weather.
  setInterval(getExchangeRate, 3600000); //Update the weather every 60 minutes.
});

function getExchangeRate() {
  $.ajax({
  	url: "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22USDBHD%22,%20%22USDKWD%22,%20%22USDOMR%22,%20%22USDQAR%22,%20%22USDSAR%22,%20%22USDAED%22)&env=store://datatables.org/alltableswithkeys",
    
    success: function(result) {

    	var rate = result.getElementsByTagName("rate");
		for(var i = 0; i < rate.length; i++) {
		    var rate = rate[i];
		    var name = rate.getElementsByTagName("Name");
		    var raterate = rate.getElementsByTagName("Rate");
		    var date = rate.getElementsByTagName("Date");
		    var time = rate.getElementsByTagName("Time");
		    var ask = rate.getElementsByTagName("Ask");
		    var bid = rate.getElementsByTagName("Bid");

		    console.log(name+" "+raterate+" "+date+" "+time+" "+ask+" "+bid+"\n"+);
		}
    },
    error: function(error) {
      $("#exchangeRate").html('<p>'+error+'</p>');
    }
  });
}