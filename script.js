$(document).ready(() => {
  //page load focus on product id input field
  $("#ItemCode").focus();

  //index page(login) load effect
  $(".login").fadeIn(3000);

  //signup  page load effect
  $(".signup").fadeIn(3000);

  //Login form
  $(".login").on("submit", function (event) {
    event.preventDefault();

    //Get userNmae from input
    var userName = $("#userName").val();    
   
    //Get password from input
    var pass = $("#pass").val();
    

    //Clear pervious error message
    $(".error-message").hide();

    let isValid = true;

    if (userName == "") {
      //Display error message if the empty input field
      $("#userNameError").text("Required field").show();
      //Focus on the input field
      $("#userName").focus();
      isValid = false;
    }

    if (pass == "") {
      //Display error message  if the empty input field
      $("#passError").text("Required field").show();
      //Focus on the input field
      $("#pass").focus();
      isValid = false;
    }

    //if all fields are valid, login
    if (isValid) {
      $.ajax({
        url: "./login.php",
        method: "POST",
        data: { UserName: userName, Pass: pass },
        success: function (response) {
          console.log("Raw response:", response);
          let res = JSON.parse(response);
          if (res.status === "success") {
            // Redirect to the Main.php page after successful login
            window.location.href = "admin_dashboard.php";
          } else if (res.message == "Invalid user name") {
            //Display error message if invalid user name
            $("#userNameError").text("Incorrect username.").show();
            //Fouce on the input field
            $("#userName").focus();
          } else if (res.message == "Invalid password") {
            //Display error message if invalid user name
            $("#passError").text("Incorrect password.").show();
            //Fouce on the input field
            $("#pass").focus();
          }
        },
        error: function (xhr, status, error) {
          console.log("AJAX error:", status, error);
        },
      });
    }
  });

  // Hide error message when user types in input fields
  $("#userName").on("input", function () {
    //Hide the error message
    $("#userNameError").hide();
  });

  $("#pass").on("input", function () {
    //Hide the error message
    $("#passError").hide();
  });

  //SignUP form
  $(".signup").on("submit", function (event) {
    //prevenet default action in the form submission
    event.preventDefault();

    // Serialize form data
    let formData = $(this).serialize();

    // Log the serialized data to the console
    console.log("Serialized form data:", formData);

    let isValid = true;

    let userName = $("#username").val();
    let fullName = $("#fullName").val();
    let email = $("#email").val();
    let password = $("#pass").val();
    let confirmPassword = $("#cPass").val();

    //Clear pervious error message
    $(".error-message").hide();

    if (
      fullName == "" &&
      email == "" &&
      userName == "" &&
      password == "" &&
      confirmPassword == ""
    ) {
      $(".error-message").text("Required field").show();
      isValid = false;
      $("input[type='text'], input[type='password']")
        .css("border-color", "")
        .addClass("error");
    } else {
      if (fullName == "") {
        $("#fullNameError").text("The First Name field is required.").show();
        isValid = false;
        borderAndFocus("fullName");
        hideErrorMessage("fullName", "fullNameError");
      }

      if (email == "") {
        $("#EmailError").text("The email field is required.").show();
        isValid = false;
        borderAndFocus("email");
        hideErrorMessage("email", "EmailError");
      } else if (!isValidEmail(email)) {
        $("#EmailError").text("Please enter a valid email address.").show();
        isValid = false;
        $("#email").css("border-color", "").addClass("error");
        borderAndFocus("email");
        hideErrorMessage("email", "EmailError");
      }

      if (userName == "") {
        $("#userNameError").text("The User Name field is required.").show();
        isValid = false;
        borderAndFocus("username");
        hideErrorMessage("username", "userNameError");
      }

      if (password == "") {
        $("#passError").text("The Password field is required.").show();
        isValid = false;
        borderAndFocus("pass");
        hideErrorMessage("pass", "passError");
      }

      if (password != confirmPassword) {
        $("#cpError")
          .text("Passowrd and confirmation password do not match.")
          .show();
        isValid = false;
        borderAndFocus("cPass");
        hideErrorMessage("cPass", "cpError");
      }
    }

    if (isValid) {
      $.ajax({
        url: "./member_register.php",
        method: "POST",
        data: formData,
        success: function (response) {
          //console.log("Raw response:", response);
          let res = JSON.parse(response);
          if (res.message === "User registered successfully") {
            console.log(res.message);
            //Dispaly Warring message
            $("#sampleModalLabel").text("Succes!");
            sampleModelChange("User registered successfully");
            clearSignupInputFields();
          } else if (res.message === "Username and email already exist") {
            errorMessages("Username already exists", "Email already exists");
            borderAndFocus("username");
            borderAndFocus("email");
          } else if (res.message === "Username already exists") {
            $("#userNameError").text("Username already exists.").show();
            borderAndFocus("username");
            hideErrorMessage("username", "userNameError");
          } else if (res.message === "Email already exists") {
            $("#EmailError").text("Email already exists.").show();
            $("#email").css("border-color", "").addClass("error");
            borderAndFocus("email");
            hideErrorMessage("email", "EmailError");
          }
        },
        error: function (xhr, status, error) {
          console.log("AJAX error:", status, error);
        },
      });
    }
  });

  const passwordInput = $('input[data-ms-member="password"]');

  const submitButton = $("[ms-code-submit-button]");

  // Password validation logic
  function checkAllValid() {
    // Select all elements with the attribute ms-code-pw-validation
    const validationPoints = $("[ms-code-pw-validation]");
    return validationPoints.toArray().every(function (validationPoint) {
      // Find the valid icon within each validation point
      const validIcon = $(validationPoint).find(
        '[ms-code-pw-validation-icon="true"]'
      );

      // Return true if the valid icon is present and its display is set to "flex"
      return validIcon.length && validIcon.css("display") === "flex";
    });
  }

  // Event listener for keyup event on password input field
  passwordInput.on("keyup", function () {
    // Show the validation rules container when typing in the password field
    $(".validation-container").css("display", "block"); // Show validation rules

    // Get the current value of the password input field
    const password = $(this).val();
    // Select all validation points
    const validationPoints = $("[ms-code-pw-validation]");

    // Iterate over each validation point
    validationPoints.each(function () {
      // Current validation point element
      const validationPoint = $(this);

      // Get the validation rule attribute
      const rule = validationPoint.attr("ms-code-pw-validation");

      let isValid = false;

      // Check if the rule is a minimum length requirement
      if (rule.startsWith("minlength-")) {
        const minLength = parseInt(rule.split("-")[1]);
        isValid = password.length >= minLength;

        // Check if the rule requires a special character
      } else if (rule === "special-character") {
        isValid = /[!@#$%^&*(),.?":{}|<>]/g.test(password);

        // Check if the rule requires both uppercase and lowercase letters
      } else if (rule === "upper-lower-case") {
        isValid = /[a-z]/.test(password) && /[A-Z]/.test(password);

        // Check if the rule requires at least one number
      } else if (rule === "number") {
        isValid = /\d/.test(password);
      }

      // Find the valid and invalid icons within the current validation point
      const validIcon = validationPoint.find(
        '[ms-code-pw-validation-icon="true"]'
      );
      const invalidIcon = validationPoint.find(
        '[ms-code-pw-validation-icon="false"]'
      );

      // Toggle display of valid/invalid icons
      if (validIcon.length && invalidIcon.length) {
        if (isValid) {
          validIcon.css("display", "flex");
          invalidIcon.css("display", "none");
        } else {
          validIcon.css("display", "none");
          invalidIcon.css("display", "flex");
        }
      }
    });

    // Enable submit button if all password rules are met
    if (checkAllValid()) {
      $("#btnsignup").removeClass("disabled");
      $(".validation-container").css("display", "none");
    } else {
      $("#btnsignup").addClass("disabled");
    }
  });

  // if UserName and email exists
  function errorMessages(stringOne, stringTwo) {
    let errorsM = {
      errorMsgOne: stringOne,
      errorMsgTwo: stringTwo,
    };
    $("#userNameError").text(errorsM.errorMsgOne).show();
    $("#EmailError").text(errorsM.errorMsgTwo).show();
  }

  //Check if  valid email
  function isValidEmail(email) {
    const emailPattern = /[a-zA-Z\d._-]+@[a-zA-Z\d_-]+\.[a-zA-Z\d.]{2,}/;
    return emailPattern.test(email);
  }

  // Reset border-color before adding the 'error' class
  function borderAndFocus(name) {
    $("#" + name)
      .css("border-color", "")
      .addClass("error");
  }

  // Hide error message when user types in input field and remove error class
  function hideErrorMessage(inputName, inputErrorName) {
    $("#" + inputName).on("input", function () {
      $("#" + inputErrorName).hide();
      $("#" + inputName).removeClass("error");
    });
  }

  //Clear signup input fields
  function clearSignupInputFields() {
    let arrs = ["fullName", "username", "email", "pass", "cPass"];

    arrs.forEach((arr) => {
      $("#" + arr).val("");
    });
  }
  

  //Sample model change
  function sampleModelChange(string) {
    // console.log("Sample model change triggered"); 
    // console.log(string);
    $(".modal-body p").text(string);
    $("#sampleModal")
      .modal({
        backdrop: "static", // Prevent the modal from closing on outside click
        keyboard: false, // Disable closing the modal with the Esc key
      })
      .modal("show");

    $("#modal-ok-button").on("click", function () {
      // Hide the modal
      var myModalEl = $("#sampleModal");
      var modal = bootstrap.Modal.getInstance(myModalEl);
      modal.hide();
    });
  }


   // Cart functionality
  if ($("#cart-items").length) {
    // Initialize checkboxes as unchecked
    $(".select-product").prop("checked", false);
    $("#select-all").prop("checked", false);
    $("#proceed-checkout").prop("disabled", true);

    // Bind quantity update events
    $(".update-qty").click(function () {
      const itemIndex = $(this).data("index");
      const action = $(this).data("action");
      updateCartItem(itemIndex, action);
    });

    // Bind remove item events
    $(".remove-item").click(function () {
      const itemIndex = $(this).data("index");
      removeCartItem(itemIndex);
    });

    // Bind size selection events
    $(".size-select").change(function () {
      const itemIndex = $(this).data("index");
      const size = $(this).val();
      updateCartSize(itemIndex, size);
    });

    // Bind product selection for checkout
    const $proceedCheckout = $("#proceed-checkout");
    $(".select-product").change(function () {
      const selected = $(".select-product:checked").length > 0;
      $proceedCheckout.prop("disabled", !selected);
      updateSelectAllState();
      updateCartSummary();
    });

    // Select all checkbox
    $("#select-all").change(function () {
      console.log("select all work")
      const isChecked = $(this).is(":checked");
      $(".select-product").prop("checked", isChecked);
      $proceedCheckout.prop(
        "disabled",
        !isChecked && $(".select-product:checked").length === 0
      );
      updateCartSummary();
    });

    // Remove selected items
    $("#remove-selected").click(function () {
      console.log("remove work")
      const selectedIndices = Array.from($(".select-product:checked")).map(
        (cb) => $(cb).data("index")
      );
      selectedIndices.forEach((itemIndex) => removeCartItem(itemIndex));
    });

    // Proceed to checkout
    $proceedCheckout.click(function (e) {
      e.preventDefault();
      const selectedIndices = Array.from($(".select-product:checked")).map(
        (cb) => $(cb).data("index")
      );
      if (selectedIndices.length > 0) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "checkout.php";
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "selectedIndices";
        input.value = JSON.stringify(selectedIndices);
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
      }
    });

    // Initial cart summary update
    updateCartSummary();
  }

  function updateCartItem(itemIndex, action) {
    $.post(
      "update_cart.php",
      {
        action: "update",
        item_index: itemIndex,
        qty_action: action,
      },
      function (response) {
        if (response.success) {
          const $itemRow = $(`#cart-item-${itemIndex}`);
          $itemRow.find(".qty-input").val(response.item.quantity);
          const itemTotal =
            response.item.quantity * (response.item.product.price || 0);
          $itemRow.find(".item-total").text(number_format(itemTotal, 2));
          updateCartSummary();
        } else {
          console.error("Failed to update cart item:", response.error);
        }
      },
      "json"
    ).fail(function () {
      console.error("Error updating cart item");
    });
  }

  function updateCartSize(itemIndex, size) {
    $.post(
      "update_cart.php",
      {
        action: "update",
        item_index: itemIndex,
        size: size,
      },
      function (response) {
        if (response.success) {
          console.log("Size updated successfully");
        } else {
          console.error("Failed to update size:", response.error);
        }
      },
      "json"
    ).fail(function () {
      console.error("Error updating size");
    });
  }

  function removeCartItem(itemIndex) {
    $.post(
      "update_cart.php",
      {
        action: "remove",
        item_index: itemIndex,
      },
      function (response) {
        if (response.success) {
          $(`#cart-item-${itemIndex}`).remove();
          updateCartSummary();
          if (response.cartCount === 0) {
            $("#cart-items").html(
              '<div class="alert alert-info">Your cart is empty. <a href="shop.php" class="text-primary">Continue shopping</a>.</div>'
            );
            $("#proceed-checkout").prop("disabled", true);
            $("#select-all").prop("checked", false);
          }
          const selected = $(".select-product:checked").length > 0;
          $("#proceed-checkout").prop("disabled", !selected);
          updateSelectAllState();
        } else {
          console.error("Failed to remove item:", response.error);
        }
      },
      "json"
    ).fail(function () {
      console.error("Error removing cart item");
    });
  }

  function updateCartSummary() {
    let subtotal = 0;
    $(".select-product:checked").each(function () {
      const itemIndex = $(this).data("index");
      const $itemRow = $(`#cart-item-${itemIndex}`);
      const quantity = parseInt($itemRow.find(".qty-input").val());
      const priceText = $itemRow.find(".item-total").text().replace(/,/g, "");
      const itemTotal = parseFloat(priceText);
      subtotal += itemTotal;
    });
    const shipping = subtotal > 0 ? 500 : 0;
    const total = subtotal + shipping;

    $("#cart-summary").html(`
            <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span id="subtotal">LKR ${number_format(subtotal, 2)}</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span>Shipping</span>
                <span id="shipping">LKR ${number_format(shipping, 2)}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span id="total">LKR ${number_format(total, 2)}</span>
            </div>
        `);
  }

  function updateSelectAllState() {
    const allChecked =
      $(".select-product").length > 0 &&
      $(".select-product:checked").length === $(".select-product").length;
    $("#select-all").prop("checked", allChecked);
  }

  function number_format(number, decimals) {
    return number.toLocaleString("en-US", {
      minimumFractionDigits: decimals,
      maximumFractionDigits: decimals,
    });
  }

  // Get the filter form element
  const filterForm = document.getElementById("filter-form");

  // Check if the filter form exists on the page
  if (filterForm) {
    // Add event listener for form submission
    filterForm.addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent the default form submission (page refresh)

      // Get filter values from the dropdowns
      const category = document.getElementById("category").value || "";
      const size = document.getElementById("size").value || "";
      const priceRange =
        document.getElementById("price_range").value || "0-999999";
      const [price_min, price_max] = priceRange.split("-"); // Split price range into min and max
      const gender = document.getElementById("gender").value || "";
      const sort = document.getElementById("sort").value || "id DESC";

      // Build query string with filter parameters
      const params = new URLSearchParams({
        category,
        size,
        price_min,
        price_max,
        gender,
        sort,
      });

      // Make AJAX request to fetch filtered products
      fetch("filter-products.php?" + params.toString())
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then((data) => {
          // Check for errors in the response
          if (data.error) {
            console.error(data.error);
            alert("Error fetching products: " + data.error);
            return;
          }

          // Get the container for products
          const container = document.getElementById("shop-products-container");
          container.innerHTML = ""; // Clear existing products

          // Check if no products were found
          if (data.products.length === 0) {
            container.innerHTML =
              '<p class="text-center">No products found matching your filters.</p>';
            return;
          }

          // Render new products dynamically
          data.products.forEach((product) => {
            const col = document.createElement("div");
            col.className = "col";
            col.innerHTML = `
                        <div class="card h-100">
                            <img src="${
                              product.image
                            }" class="card-img-top" alt="${product.name}">
                            <div class="card-body text-center">
                                <h5 class="card-title h6">${product.name.substring(
                                  0,
                                  20
                                )}...</h5>
                                <p class="card-text small">Size: ${
                                  product.size
                                }</p>
                                <p class="card-text small">LKR ${Number(
                                  product.price
                                ).toFixed(2)}</p>
                                <a href="product.php?id=${
                                  product.id
                                }" class="btn btn-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    `;
            container.appendChild(col);
          });
        })
        .catch((error) => {
          console.error("Error fetching products:", error);
          alert("An error occurred while fetching products. Please try again.");
        });
    });
  }  

  //Checkout page
  const paymentMethod = document.getElementById("payment_method");
  const creditCardDetails = document.getElementById("credit-card-details");

  paymentMethod.addEventListener("change", function () {
    if (this.value === "credit_card") {
      creditCardDetails.classList.add("show");
    } else {
      creditCardDetails.classList.remove("show");
    }
  });
});
  


