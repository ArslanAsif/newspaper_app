<style>
    .div-of-img {
        text-align: center;
    }

    .img-of-div {
        width: 300px;
        height: 150px;
        border: 1px solid grey;
        border-radius: 5px;
    }

    .flag-selection-title {
        text-align: center;
    }
</style>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title flag-selection-title">Select Your Country</h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="div-of-img col-md-4">
                        <a href="#">
                            <img class="img-of-div" src="{{ url('/images/countries_flags/bh.png') }}" >
                            <h4>Bahrain</h4>
                        </a>
                    </div>
                    <div class="div-of-img col-md-4">
                        <a href="#">
                        <img  class="img-of-div" src="{{ url('/images/countries_flags/kw.png') }}">
                        <h4>Kuwait</h4>
                    </div>
                    <div class="div-of-img col-md-4">
                        <a href="#">
                            <img class="img-of-div" src="{{ url('/images/countries_flags/om.png') }}">
                            <h4>Oman</h4>
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px">
                    <div class="div-of-img col-md-4">
                        <a href="#">
                            <img class="img-of-div" src="{{ url('/images/countries_flags/qa.png') }}">
                            <h4>Qatar</h4>
                        </a>
                    </div>
                    <div class="div-of-img col-md-4">
                        <a href="#">
                            <img class="img-of-div" src="{{ url('/images/countries_flags/sa.png') }}">
                            <h4>Saudi Arabia</h4>
                        </a>
                    </div>
                    <div class="div-of-img col-md-4">
                        <a href="#">
                            <img class="img-of-div" src="{{ url('/images/countries_flags/ae.png') }}">
                            <h4>United Arab Emirates</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!---End Modal->