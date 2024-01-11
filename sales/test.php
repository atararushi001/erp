<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Modal with Close Button</title>
  <style>
    /* Style for the modal container */
    #myModal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      padding: 20px;
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 1;
    }

    /* Style for the close button */
    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      cursor: pointer;
    }

    /* Style for the overlay/background */
    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }
  </style>
</head>
<body>

  <!-- Button to open the modal -->
  <button onclick="openModal()">Open Model</button>

  <!-- The Modal -->
  <div id="myModal">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>This is a styled modal</h2>
    <p>Some content inside the modal.</p>
    <button onclick="closeModal()">Close</button>
  </div>

  <!-- The Overlay -->
  <div id="overlay"></div>

  <script>
    // Function to open the modal
    function openModal() {
      document.getElementById('myModal').style.display = 'block';
      document.getElementById('overlay').style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
      document.getElementById('myModal').style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
    }
  </script>

</body>
</html>
