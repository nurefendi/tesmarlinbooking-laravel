<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bilangan Marlinbooking</title>
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-form-validator-net/form-validator/theme-default.min.css') }}">
</head>

<body>
<a href="{{url('/')}}" class="btn btn-secondary" >Hitung Angka</a>
<h1>
Cek ongkir
</h1><br>

    <div class="col-md-12">

        <form onsubmit="return false" id="form-data">

            <div class="col-sm-8">
                <div class="form-group">
                    <label for="firstname">Kota Awal</label><br>
                    <select class="form-control select2" id="awal" name="awal">
                        @php
                        $city = city();
                        $city = json_decode($city,true);
                        @endphp
                        @foreach($city['rajaongkir']['results'] as $citys)
                        <option value="{{ $citys['city_id'] }}" {{$citys['city_id'] =='501'? 'selected':'' }}>{{ $citys['city_name'] }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="firstname">Kota Tujuan</label><br>
                    <select class="form-control select2" onchange="check()" id="city" name="city">
                        @php
                        $city = city();
                        $city = json_decode($city,true);
                        @endphp
                        @foreach($city['rajaongkir']['results'] as $citys)
                        <option value="{{ $citys['city_id'] }}">{{ $citys['city_name'] }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <label for="city">Kurir</label>
                    <select class="form-control" onchange="cekOngkir()" name="eks" id="eks">
                        <option></option>
                        <option value="jne">Jalur Nugraha Ekakurir (JNE)</option>
                        <option value="pos">POS Indonesia (POS)</option>
                        <option value="tiki">Citra Van Titipan Kilat (TIKI)</option>
                    </select>

                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="company">Servis</label>
                           <select class="form-control" name="servis" id="servis">
                            <option value=""></option>
                           </select>

                </div>
            </div>

            <div class="col-sm-8">
                <div class="form-group">
                    <label for="city">Ongkos yang diperlukan</label>
                <input type="text" id="hasil_ongkir" name="hasil_ongkir" class="form-control" readonly> 
            </div>
            </div>

        </form>

    </div>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('jquery-form-validator-net/form-validator/jquery.form-validator.min.js') }}"></script>
    <script>
      $(document).ready(function () {
          $("#btn-submit").click(function (e) {

          });

          $("#servis").change(function () {
              nominal = typeof $(this).find(':selected').attr('data-ongkir') == 'undefined'? 0:$(this).find(':selected').attr('data-ongkir');
              $('#hasil_ongkir').val(format_rupiah(nominal));
          });
      });

      function cekOngkir() {
          // 'origin='.$origin.'&destination='.$destination.'&weight='.$weight.'&courier='.$courier,
          var destination = $("#city").val();
          var kurir = $("#eks").val();
          origin = $("#awal").val();
          $('#servis').val('');
          $('#hasil_ongkir').val('');
          $('#servis').html("<option></option>");
          $.ajax({
              type: "GET",
              url: "{{ url('biayakirim') }}?origin=" + origin + "&destination=" + destination + "&weight=200&courier=" + kurir,
              dataType: "JSON",
              success: function (data) {
                  console.log(data.rajaongkir.results);
                  $.each(data.rajaongkir.results[0].costs, function (no, val) {
                      var option = $('<option />');
                      option.attr('data-ongkir', data.rajaongkir.results[0].costs[no].cost[0].value).attr("value", data.rajaongkir.results[0].costs[no].service).text(data.rajaongkir.results[0].costs[no].description + ' (' + data.rajaongkir.results[0].costs[no].service + ') - ' + data.rajaongkir.results[0].costs[no].cost[0].etd + ' Hari');
                      $("#servis").append(option);
                  });
              }
          });
      }

      function format_rupiah(nStr) {
    if (nStr === null) {
        return 'Rp 0';
    }
    nStr += '';
    x = nStr.split(',');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return 'Rp ' + x1 + x2;
}

    
    </script>
</body>

</html>