// Alert Messages
setTimeout(function(){
    $('.alert').remove();
  }, 4000);

// Collection Page - Number Counter
$({ Counter: 0 }).animate({
    Counter: $('.counter-dresses').html()
  }, {
    duration: 2000,
    easing: 'swing',
    step: function() {
      $('.counter-dresses').text(Math.ceil(this.Counter));
    }
  });

  $({ Counter: 0 }).animate({
    Counter: $('.counter-clients').html()
  }, {
    duration: 2000,
    easing: 'swing',
    step: function() {
      $('.counter-clients').text(Math.ceil(this.Counter));
    }
  });

  $({ Counter: 0 }).animate({
    Counter: $('.counter-arrivals').html()
  }, {
    duration: 2000,
    easing: 'swing',
    step: function() {
      $('.counter-arrivals').text(Math.ceil(this.Counter));
    }
  });

// Plus And Minus Buttons - Collection Item - Days Rented
  function minusDaysRented(id) {
    $('#updateDaysRented'+id).attr('action', '/collections/' + id);
    $value = $('.daysRented'+id).val();
    $value = parseInt($value);
    if($value <= 0) {
      alert("Enter a valid number");
      return
    }
    $value--
    $(".daysRented"+id).val($value);
    $('#updateDaysRented'+id).submit();
  }

  function plusDaysRented(id) {
    $('#updateDaysRented'+id).attr('action', '/collections/' + id);
    $value = $('.daysRented'+id).val();
    $value = parseInt($value);
    $value++
    $(".daysRented"+id).val($value);
    $('#updateDaysRented'+id).submit();
  }

// Plus And Minus Buttons - Collection Item - Quantity
function minusProductQuantity(id) {
    $value = $('.quantity'+id).val();
    $value = parseInt($value);
    if($value <= 0) {
      alert("Enter a valid number");
      return
    }
    $value--
    $(".quantity"+id).val($value);
  }

  function plusProductQuantity(id) {
    $value = $('.quantity'+id).val();
    $value = parseInt($value);
    $value++
    $(".quantity"+id).val($value);
  }

// Quantity Controller
function availableStock(id) {
  let value = document.querySelector('#size'+id).getAttribute("data-stock");
  document.querySelector("#quantity").setAttribute('max', value);
  document.querySelector("#available").setAttribute('value', value);
}

// Dashboard Time
function showTime() {
    let now = new Date();
    let dateFormat = now.toDateString() + " " + now.toLocaleTimeString();
    // console.log(dateFormat)
    const timeElem = document.getElementById('time');

    if (timeElem === null) {
      clearInterval(this.customInterval);
      return
    }
    timeElem.innerHTML = dateFormat
}
const customInterval = setInterval(showTime, 1000);
showTime();

// User Cancel Order Modal
function userCancelOrderModal(id, transaction_id) {
    $('#userCancelOrderForm').attr('action', '/user/order/' + id + '/cancel');
    $('#userCancelOrderModalBody').html("Do you want to cancel Order ID: " + transaction_id + "?");
}

function deleteFavoritesModal(id, name) {
    $('#deleteFavoritesForm').attr('action', '/user/favorite/' + id + '/delete');
    $('#deleteFavoritesModalBody').html("Do you want to remove " + name + " from your favorites?");
}

function adminCancelOrderModal(id, transaction_id) {
    $('#adminCancelOrderForm').attr('action', '/admin/order/' + id + '/cancel');
    $('#adminCancelOrderModalBody').html("Do you want to cancel Order ID: " + transaction_id + "?");
}

function deleteRegisteredUserModal(id, name) {
    $('#deleteRegisteredUserForm').attr('action', '/admin/user/' + id + '/delete');
    $('#deleteRegisteredUserModalBody').html("Do you want to delete user " + name + "?");
}


