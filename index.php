<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Google Sheet Data</title>
</head>
<body>

    <div class="container">
      <h1>Getting / Dispaying Data Google Sheets</h1>
    </div>
  
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Party</th>
          </tr>
        </thead>
        <tbody class="output">

        </tbody>
      </table>
    </div>
  
  <?php include('sheets.php') ;?>
  
  <script>
    const dataOutput = document.querySelector('.output');

    let url = "data.json";
    let request = new XMLHttpRequest();
    request.onreadystatechange = () => {
      if (request.readyState == 4 && request.status == 200) {
      displayData(request.response)
    }
    }
    request.open("GET", url, true);
    request.send();


    function displayData(data){
      let parsedData = JSON.parse(data);
      let dataArray = parsedData.data
      dataArray.forEach((item) => {
        let itemHTML = `
          <tr>
            <td>${item[0]}</td>
            <td>${item[1]}</td>
            <td>${item[2]}</td>    
          </tr
        `;
        dataOutput.innerHTML = dataOutput.innerHTML + itemHTML;
      })
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
