document.addEventListener('DOMContentLoaded', function () {

  function ajaxServiceSearch() {
    var service = document.getElementById('service');

    if (!service) {
      return;
    }

    service.addEventListener('keyup', function (e) {
      var value = e.target.value;
      fetch('/wp-admin/admin-ajax.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
        },
        body: 'action=search&service=' + value,
        credentials: 'same-origin'
      }).then(function (response) {
        return response.json();
      }).then(function (response) {
        var url = new URL(window.location.href);
        var param = url.searchParams.get('location') ?? '';
        var container = document.getElementById('service-block');
        container.innerHTML = '';
        if (response.data) {
          response.data.forEach(function (item) {
            var link = document.createElement('a');
            link.href = "/search_results/?service=" + encodeURIComponent(item.meta_value) + "&location=" + encodeURIComponent(param);
            link.textContent = item.meta_value;
            var div = document.createElement('div');
            div.classList.add('search-form__block-item');
            div.appendChild(link);
            container.appendChild(div);
          });
        }
      });
    });
  }

  ajaxServiceSearch();

  function ajaxLocationSearch() {
    var location = document.getElementById('location');

    if (!location) {
      return;
    }

    location.addEventListener('keyup', function (e) {
      var value = e.target.value;
      fetch('/wp-admin/admin-ajax.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
        },
        body: 'action=search&location=' + value,
        credentials: 'same-origin'
      }).then(function (response) {
        return response.json();
      }).then(function (response) {
        var url = new URL(window.location.href);
        var param = url.searchParams.get('service') ?? '';
        var container = document.getElementById('location-block');
        container.innerHTML = '';
        if (response.data) {
          response.data.forEach(function (item) {
            var result = item.meta_value.split(',')[0];
            var link = document.createElement('a');
            link.href = "/search_results/?location=" + encodeURIComponent(result) + "&service=" + encodeURIComponent(param);
            link.textContent = result;
            var div = document.createElement('div');
            div.classList.add('search-form__block-item');
            div.appendChild(link);
            container.appendChild(div);
          });
        }
      });
    });
  }

  ajaxLocationSearch();

  function tabsHandler() {
    var container = document.querySelector('.tab__container');
    if (!container) {
      return;
    }
    var tabs = container.querySelectorAll('.tab__head-item');
    var contents = container.querySelectorAll('.tab__content');
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(item => item.classList.remove('active'));
        tab.classList.add('active');
        var id = tab.getAttribute('id');
        contents.forEach(content => content.style.display = 'none');
        container.querySelector('.' + id).style.display = 'block'
      });
    });
  }

  tabsHandler();
});
