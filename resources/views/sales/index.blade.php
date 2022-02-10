<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRM Manager</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>

    <body>
      @if(gettype($custList) == "object")
      <table class="table-secondary">
        <thead>
          <tr>
          <th scope="col"><b> # </b></td>
            @foreach($custList[0] as $key => $value) 
              <th scope="col"><b> {{ $key }} </b></td>
            @endforeach
          </tr>
        </thead>

        <tbody>
          @foreach($custList as $index => $child)
            <tr>
              <th scope="row"><b> {{ $index }} </b></td>
              @foreach($child as $child_value)
                <td> {{ $child_value }} </td>
              @endForeach
            </tr>
          @endForeach
        </tbody>
      </table>
      @endif




      <!-- JavaScript Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
