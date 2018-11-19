

function admin_side_menu() {

    const submenu_trigger = document.getElementsByClassName('has-submenu');

    for (var i = 0; i < submenu_trigger.length; i++){

        submenu_trigger[i].onclick = function () {

            var _this = this;
            var icon = _this.querySelector('.fas');
            var iconClassList = classList(icon);
            //console.log(iconClassList);

            _this.classList.toggle('is-active');


            const submenu = this.nextElementSibling;

            if(_this.classList.contains('is-active')){
                submenu.style.display = 'block';
                iconClassList.replace('fa-angle-right', 'fa-angle-down');

            } else {
                submenu.style.display = 'none';
                iconClassList.replace('fa-angle-down', 'fa-angle-right');
            }
        }


    }
}

admin_side_menu();
