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
<a href="{{url('/cekongkir')}}" class="btn btn-secondary" >Cek Ongkir</a>
<h1>
Hitung perulangan
</h1><br>
    <div class="col-md-12">

        <form onsubmit="return false" id="form-data">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="angka_awal">Angka</label>
                    <input type="number" min="0" class="form-control" data-validation="required alphanumeric" name="angka_awal" id="angka_awal" aria-describedby="helpId1"
                        placeholder="Masukkan angka">
                </div>
            </div>
            <div class="col-md-6">
                <button id="btn-submit" class="btn btn-primary">
                        Submit
                </button>
            </div>
            <div class="col-md-6" style="margin-top:25px">
            <pre id="hasil" >
            </pre>
            </div>
        </form>

    </div>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('jquery-form-validator-net/form-validator/jquery.form-validator.min.js') }}"></script>
    <script>
      $(document).ready(function () {
        $("#btn-submit").click(function (e) { 
          e.preventDefault();

          form = "#form-data";
          if (!$(form).isValid()) {
                return;
            }
          $.ajax({
            type: "POST",
            url: "{{ url('/proses') }}",
            data: $(form).serialize(),
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (response) {
              if(response.status){
                // alert(response.pesan);
                $('#hasil').html(response.data);
              } else {
                alert(response.pesan);
              }
            }
          });
        });
      });

     
    </script>
</body>

</html>