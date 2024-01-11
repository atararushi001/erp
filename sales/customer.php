<?php
@include '../include/config.php';
@include '../include/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Layout</title>
  <?php include '../include/script.php' ?>
 
</head>

<body class="bg-gray-100">
  <?php include '../include/sidebar.php' ?>
  <?php include '../include/header.php' ?>

  <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
    <div class="bg-white shadow-sm p-4">
      <div class="flex justify-between">
        <h1 class="text-xl font-semibold">Customers</h1>
        <a href="add_customer.php"><button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">
            Add Customer
          </button></a>
      </div>
      <div class="flex flex-wrap justify-end p-4 gap-4">
        <div>
          <input type="text" name="daterange" value="01/01/2018 - 01/15/2018"  class="border rounded-sm text-gray-700 outline-none p-2" />
        </div>
        <div class="flex bg-white text-gray-700 border rounded-sm p-2">
          <input type="search" placeholder="Search" class="border-none outline-none" id="myInput" />
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M21.0004 21.0004L16.6504 16.6504" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table id="customerTable" class="min-w-full table-auto">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                #
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
              Company Name 
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
              Customer Code
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
              Customer type
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Creator
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Created Date
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Status
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Action
              </th>
            </tr>
          </thead>

          <tbody>

            <?php getcustomer();  ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

  <script src="../assets/js/script.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script>
     function changestatus(customerId) {
 
 fetch('../include/function.php?changestatus=' + customerId)
    .then(response => response.json())
    .then(data => {
      window.location.href = "customer.php";
    })
    .catch(error => {
       console.error('Error:', error);
    });
}
    $(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
    $(document).ready(function() {
      var table = $('#customerTable').DataTable();
      $('#myInput').on('keyup', function() {
        table.search(this.value).draw();
      });

      if (window.location.href.includes("sales")) {
        const sales = document.querySelector(".sales");
        const salesMenu = document.getElementById("salesSubmenu");

        sales.classList.add("active");

        const customerLink = document.querySelector('a[href="/erp/sales/customer.php"]');
        if (customerLink) {
          customerLink.classList.add('font-bold', 'text-black');
        }
      }
    });
   

  </script>

</body>

</html>sales/customer.phpsales/customer.php