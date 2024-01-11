
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
        <h1 class="text-xl font-semibold">Sales Enquiry list</h1>
        <a href="add_sales_enquiry.php"><button class="text-white text-sm px-4 py-2" style="background-color: #007bff;">
            Add Enquiry
          </button></a>
      </div>
      <div class="flex flex-wrap justify-end p-4 gap-4">
        <div>
          <input type="datetime-local" class="border rounded-sm text-gray-700 outline-none p-2" />
        </div>
        <div class="flex bg-white text-gray-700 border rounded-sm p-2">
          <input type="search" placeholder="Search" class="border-none outline-none" id="search-input" />
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
              stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M21.0004 21.0004L16.6504 16.6504" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table id="salesEnquiryTable" class="min-w-full table-auto">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                #
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Company | Customer Code
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Customer Name
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Branch/Warehouse
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Creator
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Created Date
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Version
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Status
              </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider"> </th>
              <th class="px-6 py-3 text-left text-sm leading-4 font-medium text-gray-500 tracking-wider">
                Action
              </th>
            </tr>
          </thead>

          <tbody>
            <?php getsales_enquiry(); ?>
           <!-- <tr>
              <td class="px-6 py-4 whitespace-no-wrap">1</td>
              <td class="px-6 py-4 whitespace-no-wrap">india pvt ltd</td>
              <td class="px-6 py-4 whitespace-no-wrap">Jay Parmar</td>
              <td class="px-6 py-4 whitespace-no-wrap">V U nagar</td>
              <td class="px-6 py-4 whitespace-no-wrap">Pritesh Umraniya</td>
              <td class="px-6 py-4 whitespace-no-wrap">11/12/2023</td>
              <td class="px-6 py-4 whitespace-no-wrap">Version 1</td>
              <td class="px-6 py-4 whitespace-no-wrap">
                <button class="text-green-900 border border-green-600 bg-green-300 w-16 p-2">
                  Active
                </button>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap">
                <svg class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 13H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 9H9H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
                <svg class="mt-2 cursor-pointer" width="18" height="18" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path
                    d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
                    stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="mt-2 cursor-pointer" width="18" height="18" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path
                    d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
                    stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-no-wrap">2</td>
              <td class="px-6 py-4 whitespace-no-wrap">uae company</td>
              <td class="px-6 py-4 whitespace-no-wrap">trishan parmar</td>
              <td class="px-6 py-4 whitespace-no-wrap">Qatar</td>
              <td class="px-6 py-4 whitespace-no-wrap">vedansh trivedi</td>
              <td class="px-6 py-4 whitespace-no-wrap">13/01/2023</td>
              <td class="px-6 py-4 whitespace-no-wrap">Version 2</td>
              <td class="px-6 py-4 whitespace-no-wrap">
                <button class="text-red-900 border border-red-600 bg-red-300 w-16 p-2">
                  Inactive
                </button>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap">
                <svg class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 13H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 9H9H8" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap flex justify-between">
                <svg class="mt-2 cursor-pointer" width="18" height="18" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 20H21" stroke="#8A8A8A" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path
                    d="M16.5 3.50023C16.8978 3.1024 17.4374 2.87891 18 2.87891C18.2786 2.87891 18.5544 2.93378 18.8118 3.04038C19.0692 3.14699 19.303 3.30324 19.5 3.50023C19.697 3.69721 19.8532 3.93106 19.9598 4.18843C20.0665 4.4458 20.1213 4.72165 20.1213 5.00023C20.1213 5.2788 20.0665 5.55465 19.9598 5.81202C19.8532 6.06939 19.697 6.30324 19.5 6.50023L7 19.0002L3 20.0002L4 16.0002L16.5 3.50023Z"
                    stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="mt-2 cursor-pointer" width="18" height="18" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 6H5H21" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path
                    d="M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6"
                    stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M10 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path d="M14 11V17" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
  <script src="../assets/js/script.js"></script>
  <script>
    new DataTable('#salesEnquiryTable');
    $(document).ready(function() {
      if(window.location.href.includes("sales")) {
        const sales = document.querySelector(".sales");
        sales.classList.add("active");

        const customerLink = document.querySelector('a[href="/erp/sales/sales_enquiry.php"]');
        if (customerLink) {
          customerLink.classList.add('font-bold', 'text-black');
        }
      }
    });
  </script>
  
</body>

</html>