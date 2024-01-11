document.querySelectorAll("aside nav a").forEach(function (item) {
  item.addEventListener("click", function () {
    document.querySelectorAll("aside nav a").forEach(function (menuItem) {
      menuItem.classList.remove("active");
    });

    this.classList.add("active");
  });
});

// document.querySelectorAll("aside ul li a").forEach(function (submenuItem) {
//   submenuItem.addEventListener("click", function (event) {
//     document.querySelectorAll("aside ul li a").forEach(function (submenuLink) {
//       submenuLink.classList.remove("active");
//     });

//     this.classList.add("active");
//   });
// });

// function handleNavbarHover() {
//   const sidebar = document.getElementById("sidebar");
//   const navMenuImgs = document.querySelectorAll(".nav-menu-img");

//   sidebar.classList.toggle("w-60");
//   navMenuImgs.forEach((img) => {
//     img.classList.toggle("mr-6");
//   });
// }

// const navbar = document.querySelector("#sidebar");
// navbar.addEventListener("mouseenter", handleNavbarHover);
// navbar.addEventListener("mouseleave", handleNavbarHover);

function toggleNavbarText() {
  const mediaQuery = window.matchMedia("(max-width: 768px)");
  const sidebar = document.getElementById("sidebar");
  const mydiv = document.getElementById("mydiv");
  const navMenuImgs = document.querySelectorAll(".nav-menu-img");

  if (mediaQuery.matches) {
    sidebar.classList.toggle("open-from-right");
  } else {
    sidebar.classList.toggle("w-60");
    mydiv.classList.toggle("ml-60");
  }
}

function toggleSubmenu(submenuId) {
  const submenu = document.getElementById(submenuId);
  if (submenu.style.display === "block") {
    submenu.style.display = "none";
  } else {
    submenu.style.display = "block";
  }
}

function removeCustomer(button) {
  let deleteDiv = button.parentNode.parentNode.parentNode;
  deleteDiv.remove();
  CustomerAddressNumber--;

  let countdata = CustomerAddressNumber;

  let currentId = "customeraddress" + countdata;

  while (document.querySelector("#" + currentId)) {

    let newname = countdata-1;
    document.querySelector("#" + currentId).innerHTML =
      "Customer Address " + newname;
    console.log(newname);
    countdata++;
    currentId = "customeraddress" + countdata;
  }
}

var ProductNumber = 0;

$(document).ready(function () {
  var totalSalesDiv = $("#total_sales");

  if (ProductNumber > 0) {
    totalSalesDiv.show();
  } else {
    totalSalesDiv.hide();
  }
});

function addProduct() {
  ProductNumber++;
  let newProductDiv = document.createElement("div");
  newProductDiv.innerHTML = `<div class="max-w-full mb-4">
        <div class="bg-white rounded-sm shadow-md mb-4">
            <div class="w-full border-b flex">
                <h2 class="text-gray-700 font-semibold p-4 text-lg">Product ${ProductNumber}</h2>
                <button class="ml-auto mr-4 flex mt-auto mb-auto" onclick="removeProduct(this)">
                    <svg class="mr-2 mt-1" width="23" height="23" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 9L9 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 9L15 15" stroke="#FF3B2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                                
                    <p class="text-red-500 text-lg">Remove Product</p>
                </button>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-1 p-4 gap-4">
                <div>
                  <label for="product_category${ProductNumber}" class="text-gray-700 font-semibold">Product Category</label>
                  <select
                    name="product_category${ProductNumber}"
                    id="product_category${ProductNumber}"
                    class="select2-init border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 !important"
                  >
                    <option value="Product Category">Product Category</option>
                    <option value="Category 2">Category 2</option>
                    <option value="Category 3">Category 3</option>
                  </select>
                </div>
                <div class="lg:col-span-2">
                    <label for="product_description${ProductNumber}" class="text-gray-700 font-semibold">Product Description</label>
                    <input type="text" id="product_description${ProductNumber}" name="product_description${ProductNumber}" placeholder="Product Description" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div>
                    <label for="part_number${ProductNumber}" class="text-gray-700 font-semibold">Part Number</label>
                    <input type="text" id="part_number${ProductNumber}" name="part_number${ProductNumber}" placeholder="Part Number" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 p-4 pt-0 gap-4">
                <div>
                    <label for="product_hsn_code${ProductNumber}" class="text-gray-700 font-semibold">HSN Code</label>
                    <input type="text" id="product_hsn_code${ProductNumber}" name="product_hsn_code${ProductNumber}" placeholder="HSN Code" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div>
                    <label for="product_quantity${ProductNumber}" class="text-gray-700 font-semibold">Quantity</label>
                    <input type="text" id="product_quantity${ProductNumber}" name="product_quantity${ProductNumber}" placeholder="Quantity" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div>
                    <label for="product_rate${ProductNumber}" class="text-gray-700 font-semibold">Rate</label>
                    <input type="text" id="product_rate${ProductNumber}" name="product_rate${ProductNumber}" placeholder="Rate" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
                <div>
                    <label for="product_amount${ProductNumber}" class="text-gray-700 font-semibold">Amount</label>
                    <input type="text" id="product_amount${ProductNumber}" name="product_amount${ProductNumber}" placeholder="Amount" class="border rounded-sm outline-none p-2 w-full focus:ring focus:ring-blue-400 mt-2">
                </div>
            </div>
        </div>
    </div>`;
  document.getElementById("add-product").appendChild(newProductDiv);
  $(newProductDiv)
    .find(".select2-init")
    .each(function () {
      $(this).select2({
        width: "100%",
        placeholder: "Add Product Category",
        language: {
          noResults: function () {
            return $(
              "<button class='w-full p-2 text-center text-white' style='background-color: #007bff;'>Add Product Category</button>"
            );
          },
        },
      });
    });
}

function removeProduct(button) {
  let deleteProduct = button.parentNode.parentNode.parentNode;
  deleteProduct.remove();
  ProductNumber--;
}

//Close all mdoel
function closeModal(elementname) {
  document.getElementById(elementname).style.display = "none";
}
//open all mdoel

function openModal(elementname, selcterelement) {
  $(selcterelement).select2("close");
  document.getElementById(elementname).style.display = "block";
}

//function to get data while edit option

//save data of any add button of selecter
function savedata(formname, selecter, inputselecter) {
  var form = $("#" + formname);
  var url = form.attr("action");
  var addtext = form.find("input[name='" + inputselecter + "']");
  $.ajax({
    type: "POST",
    url: url,
    data: form.serialize(),
    success: function (data) {
      console.log(inputselecter);
      var newOption = new Option(addtext.val(), data, false, false);
      $(selecter).append(newOption).trigger("change");
      addtext.val("");

      alert("Form Submited Successfully");
      closeModal(inputselecter + "Popup");
    },
    error: function (data) {
      alert("some Error");
    },
  });
}
