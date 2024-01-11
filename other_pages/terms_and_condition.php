<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Layout</title>
    <?php include '../include/script.php' ?>
    <style>
        #termsAndConditionsPopup {
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
                <h1 class="text-xl font-semibold">Terms and Condition</h1>
                <button class="text-white text-sm px-4 py-2" id="openTermsAndConditions" style="background-color: #007bff;">
                    Add Terms and Condition
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
        id="termsAndConditionsPopup">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-sm shadow-lg"
            style="width: 600px;">
            <div class="flex justify-between border-b">
                <h2 class="text-gray-800 font-semibold p-4 text-xl">Add new Terms and Condition</h2>
                <svg id="closeTermsAndConditions" onclick="closeTermsAndConditions()"
                    class="cursor-pointer mt-3 mr-2 close-button" width="35" height="35" viewBox="0 0 50 50" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.5 12.5L12.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12.5 12.5L37.5 37.5" stroke="black" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <form class="p-4">
                <div class="mb-4">
                    <label for="tac_title" class="text-gray-700 font-semibold">Title
                    </label>
                    <input type="text" id="tac_title" placeholder="Add Title"
                        class="border rounded-sm outline-none p-2 w-full text-sm focus:ring focus:ring-blue-400 mt-2" rows="5">
                </div>
                <div>
                    <label for="terms_and_conditions_text" class="text-gray-700 font-semibold">Terms & Condition
                    </label>
                    <input type="text" id="terms_and_conditions_text" placeholder="Add Terms & Condition"
                        class="border rounded-sm outline-none p-2 w-full text-sm focus:ring focus:ring-blue-400 mt-2" rows="5">
                </div>
                <div class="flex items-center justify-start gap-4 mt-32">
                    <button class="text-white text-sm px-4 py-2 w-28" style="background-color: #007bff;"
                        id="openTermsAndConditionsButton">Save</button>
                    <button class="border bg-white text-sm px-4 py-2 w-28" style="color: #007bff; border: 1px solid #007bff;"
                        id="cancelTermsAndConditionsButton">Cancel</button>
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

              const Link = document.querySelector('a[href="/erp/other_pages/terms_and_condition.php"]');
              if (Link) {
                Link.classList.add('font-bold', 'text-black');
              }
            }
        });

        const body = document.getElementById("body");
        const termsAndConditionsPopup = document.getElementById("termsAndConditionsPopup");
        const openTermsAndConditions = document.getElementById("openTermsAndConditions");
        const closeTermsAndConditions = document.getElementById("closeTermsAndConditions");

        openTermsAndConditions.addEventListener("click", () => {
            termsAndConditionsPopup.style.display = "block";
            body.classList.remove("hidden");
        });

        closeTermsAndConditions.addEventListener("click", () => {
            termsAndConditionsPopup.style.display = "none";
        });
    </script>
</body>

</html>