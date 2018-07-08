let initToggleNavBar = () => {
    let toggleNavBar = document.getElementById('toggle-nav-bar');
    let element = document.getElementById('left-bar');

    if (! toggleNavBar) {
        return;
    }

    let leftBar = localStorage.getItem("layout_left_bar");
    if (leftBar === 'open') {
        element.classList.add("left-bar--open");
    }

    toggleNavBar.addEventListener('click', function() {
        element.classList.toggle("left-bar--open");
        localStorage.setItem(
            "layout_left_bar",
            element.classList.contains("left-bar--open") ? 'open' : 'close'
        );
    });
};

window.initTab = function(tabsOne) {
    let items = tabsOne.querySelectorAll('.tabs__items .item');
    if (! items.length) {
        return;
    }

    let activeItem = tabsOne.querySelector('.item.active');
    if (! activeItem) {
        if (activeItem = tabsOne.querySelector('.item:first-child')) {
            activeItem.classList.add('active');
            let elementId = activeItem.getAttribute('data-target');
            if (elementId) {
                let contentElement = document.getElementById(elementId);
                if (contentElement) {
                    contentElement.classList.add('active');
                }
            }
        }
    }

    items.forEach(function(item) {

        item.addEventListener('click', function(event) {
            event.preventDefault();

            if (this.classList.contains("active")) {
                return;
            }

            let activeItem = this.parentNode.querySelector('.item.active');
            if (activeItem) {
                activeItem.classList.remove('active');
            }

            let activeContentItem = this.parentNode.parentNode.querySelector('.tabs__contents .content.active');
            if (activeContentItem) {
                activeContentItem.classList.remove('active');
            }

            let elementId = this.getAttribute('data-target');
            if (elementId) {
                let contentElement = document.getElementById(elementId);
                if (contentElement) {
                    contentElement.classList.add('active');
                }
            }

            this.classList.add('active');
        });

    });
};

// let initTabs = () => {
//     let tabs = document.querySelectorAll('.tabs');
//     if (! tabs.length) {
//         return;
//     }
//
//     tabs.forEach(function(tabsOne) {
//         window.initTab(tabsOne);
//     });
// };

window.addEventListener('DOMContentLoaded', function() {
    initToggleNavBar();
    // initTabs();
});

