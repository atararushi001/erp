

<?php 

if (!isset($_SESSION['user_id'])) {
     
  echo "<script>window.location.href='login/login.php'</script>";
 
}
$datarow = getuserdata ($_SESSION['user_id']);
// print_r($datarow);
// die();
?>
<main>
    <nav class="fixed top-0 left-0 w-full h-20 bg-white shadow-md z-50 flex justify-between items-center">
      <div>
        <a href="/erp/index.php">
          <img src="https://aarvitechnolabs.in/aarviERP/assets/icons/logo1.svg" class="ml-7 w-32 h-auto" />
        </a>
      </div>
      <div class="ml-7 mr-auto">
        <svg onclick="toggleNavbarText()" class="cursor-pointer" width="31" height="21" viewBox="0 0 31 21" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_375_1515)">
            <path
              d="M0 10.2075C0.0180616 10.1747 0.0424055 10.1434 0.0541848 10.1083C0.290556 9.40188 0.795495 9.02134 1.54152 8.99868C1.82579 8.99008 2.11085 8.99634 2.39512 8.99634C11.0615 8.99634 19.728 8.99555 28.3944 9.00024C28.6457 9.00024 28.9095 9.02056 29.1467 9.09635C29.8071 9.30655 30.2163 9.9637 30.1487 10.6466C30.0812 11.3311 29.5527 11.8828 28.864 11.9774C28.6999 12 28.5318 12.0039 28.3653 12.0039C19.5419 12.0055 10.7184 11.9992 1.8949 12.0141C0.958049 12.0149 0.299194 11.7117 0 10.7935C0 10.5982 0 10.4028 0 10.2075Z"
              fill="#031A61" />
            <path
              d="M18.8369 0.0027907C22.0856 0.0027907 25.3343 0.000446511 28.5839 0.00435349C29.4948 0.00513488 30.1607 0.651349 30.1552 1.51088C30.1497 2.2954 29.5246 2.95021 28.737 2.99632C28.6585 3.001 28.5799 2.99944 28.5014 2.99944C22.0628 2.99944 15.6235 2.99944 9.18493 2.99944C8.37923 2.99944 7.78948 2.59155 7.59865 1.90627C7.33479 0.96 8.01564 0.0223256 9.00274 0.00904186C10.2396 -0.00736744 11.4764 0.00357209 12.7132 0.00357209C14.7534 0.0027907 16.7951 0.0027907 18.8369 0.0027907Z"
              fill="#031A61" />
            <path
              d="M21.8396 20.9985C19.5929 20.9985 17.3462 21.0032 15.1003 20.9962C14.114 20.9931 13.4331 20.1726 13.6012 19.2177C13.726 18.5106 14.348 18.0058 15.1168 18.0042C16.7455 18.0003 18.3734 18.0027 20.0021 18.0027C22.8668 18.0027 25.7315 18.0027 28.5954 18.0027C29.2072 18.0027 29.6784 18.2613 29.9705 18.7965C30.2453 19.2998 30.2249 19.8147 29.9179 20.2992C29.6108 20.7844 29.153 21.0016 28.5782 21.0009C26.3323 20.9962 24.0855 20.9985 21.8396 20.9985Z"
              fill="#031A61" />
          </g>
          <defs>
            <clipPath id="clip0_375_1515">
              <rect width="30.1636" height="21" fill="white" />
            </clipPath>
          </defs>
        </svg>
      </div>
      <div class="ml-auto mr-5">
        
        <div class="flex items-center gap-4">
          <a href="../login/logout.php">Logout</a>
          
          <img src="../assets/icons/bell.svg" alt="" class="h-6 w-6">
          <div class="flex items-center gap-4 pl-4 border-l border-[#666]"> 
            <img src="../assets/img/person.png" alt="" class="h-9 w-9 rounded-full">
            <p class="text-md sm:text-lg font-semibold text-gray-800"><?php echo $datarow['user_username'] ?></p>
          </div>
        </div>
      </div>
    </nav>
  </main>