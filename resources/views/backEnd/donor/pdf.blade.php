<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF DONASI</title>
</head>
<body>
  <table border="1">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Donasi</th>
        <th scope="col">Nama Donor</th>
        <th scope="col">Total Donasi</th>
        <th scope="col">Pembayaran Via</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donors as $donor)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$donor->donation->title}}</td>
            <td>{{$donor->user->name}}</td>
            <td>{{number_format($donor->amount)}}</td>
            <td>{{$donor->paymentMethod->name}}</td>
          </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>