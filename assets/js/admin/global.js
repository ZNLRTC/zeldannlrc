window.Tether = {};



function loading() {
  var alertList = document.querySelectorAll('.alert')
  alertList.forEach(function (alert) {
    new bootstrap.Alert(alert)
  })
}

$(document).on('click', '#sidebarCollapses', function () {

  $('#sidebar').toggleClass('active');
  $('#body').toggleClass('active');
});

function myFunction() {
  var x = document.getElementById("showpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function adduserNotif() {
  var x = document.getElementById("showpass_useradd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}