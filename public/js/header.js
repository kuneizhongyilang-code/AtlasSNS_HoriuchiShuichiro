// ログアウト
document.addEventListener('DOMContentLoaded', function () {

  const logoutLink = document.getElementById('logout-link');
  const logoutForm = document.getElementById('logout-form');

  logoutLink.addEventListener('click', function (event) {

    event.preventDefault();

    logoutForm.submit();

  });

});
