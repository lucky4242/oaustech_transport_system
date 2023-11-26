<?php include_once "../connection.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>

<body>
  <h1>Scan Driver QR CODE</h1>
  <div id="reader" width="600px"></div>

  <div id="result">QR RESULT</div>
  <script>
    // const decodedText = "id: driver123\nname: John Doe";
    let result = document.getElementById("result");

    function onScanSuccess(decodedText, decodedResult) {
      // console.log(`Code matched = ${decodedText}`, decodedResult);
      decodedText = decodedText.toLowerCase();
      const isValidFormat = /^id:\s+.+\nname:\s+.+$/i.test(decodedText);
      if (!isValidFormat) {
        result.innerHTML = `The QR Code scanned is not a valid driver qr code\n${decodedText}`;
        //   console.log("Decoded text is not in the expected format.");
      } else {
        const idMatch = decodedText.match(/id:\s+(.+)/i);
        const nameMatch = decodedText.match(/name:\s+(.+)/i);

        if (idMatch && nameMatch) {
          const id = idMatch[1];
          const name = nameMatch[1];
          location.href = `./complete-payment.php?driverId=${id}&driverName=${name}`;
          console.log("ID:", id);
          console.log("Name:", name);
        } else {
          result.innerHTML =
            "Could not retrieve ID and/or Name from decoded text.";
          console.log("Could not retrieve ID and/or Name from decoded text.");
        }
      }
    }

    function onScanFailure(error) {
      console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
      "reader", {
        fps: 10,
        qrbox: {
          width: 250,
          height: 250
        }
      },
      /* verbose= */
      false
    );
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
  </script>
</body>

</html>