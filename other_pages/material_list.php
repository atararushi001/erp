<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Layout</title>
    <?php include '../include/script.php' ?>
    <style>
        #materialPopup {
            display: none;
            z-index: 99;
        }
    </style>
</head>

<body class="bg-gray-100" id="body">
    <?php include '../include/sidebar.php' ?>
    <?php include '../include/header.php' ?>

    <div id="mydiv" class="max-w-full mx-auto mt-20 ml-16 p-4 text-sm transition-all duration-300">
        <div class="bg-white shadow-sm p-4">
            <div class="flex justify-between">
                <h1 class="text-xl font-semibold">Master Product Material List</h1>
                <button class="text-white text-sm px-4 py-2" id="openMaterial" style="background-color: #007bff;">
                    Add Material
                </button>
            </div>
            <div class="flex flex-wrap justify-end p-4 gap-4">
                <div class="flex bg-white text-gray-700 border rounded-sm p-2">
                    <input type="search" placeholder="Search" class="border-none outline-none" id="search-input" />
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                            stroke="#8A8A8A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21.0004 21.0004L16.6504 16.6504" stroke="#8A8A8A" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 p-4 transition-all duration-300"
        id="materialPopup">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg"
            style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Create new Material</h2>
                <svg id="closeMaterial" onclick="closeMaterial()" class="cursor-pointer mt-3 mr-2 close-button"
                    width="35" height="35" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <form class="p-4">
                <div class="mb-4">
                    <label for="material_name" class="text-gray-700 font-semibold">Material Name</label>
                    <input type="text" id="material_name" placeholder="Material Name"
                        class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div>
                    <label for="material_hsn_code" class="text-gray-700 font-semibold">HSN Code</label>
                    <input type="text" id="material_hsn_code" placeholder="HSN Code"
                        class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" id="openMaterialButton" style="background-color: #007bff;">Save</button>
                    <button class="border bg-white text-sm px-4 py-2 w-28"
                        id="cancelMaterialButton" style="color: #007bff; border: 1px solid #007bff;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            if(window.location.href.includes("other_pages")) {
              const otherPages = document.querySelector(".other_pages");
              otherPages.classList.add("active");

              const Link = document.querySelector('a[href="/erp/other_pages/material_list.php"]');
              if (Link) {
                Link.classList.add('font-bold', 'text-black');
              }
            }
        });

        const body = document.getElementById("body");
        const materialPopup = document.getElementById("materialPopup");
        const openMaterial = document.getElementById("openMaterial");
        const closeMaterial = document.getElementById("closeMaterial");

        openMaterial.addEventListener("click", () => {
            materialPopup.style.display = "block";
            body.classList.remove("hidden");
        });

        closeMaterial.addEventListener("click", () => {
            materialPopup.style.display = "none";
        });
    </script>

</body>

</html>